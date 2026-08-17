<?php

namespace App\Http\Controllers;

use App\Actions\CreatePublicTicketAction;
use App\Enums\NotificationTypeEnum;
use App\Enums\PublicTicketProblemTypeEnum;
use App\Http\Requests\PublicStoreTicketRequest;
use App\Jobs\GenerateAiRecommendationJob;
use App\Models\Equipment;
use App\Models\Ticket;
use App\Models\TicketAttachment;
use App\Services\NotificationCreatorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

final class PublicTicketController extends Controller
{
    private const ALLOWED_MIMES = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

    private const EXTENSION_BY_MIME = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/gif' => 'gif',
        'image/webp' => 'webp',
    ];

    public function __construct(
        private readonly CreatePublicTicketAction $createPublicTicket,
        private readonly NotificationCreatorService $notificationCreatorService,
    ) {}

    /**
     * Formulário público de reporte de avaria, acedido via QR Code.
     */
    public function create(Request $request): View
    {
        $machineId = (int) $request->query('machine_id');

        $equipment = Equipment::query()
            ->with(['room', 'category'])
            ->findOrFail($machineId);

        return view('ui.tickets.public.create', [
            'equipment' => $equipment,
            'problemTypes' => PublicTicketProblemTypeEnum::cases(),
        ]);
    }

    /**
     * Regista o ticket público e notifica os administradores.
     */
    public function store(PublicStoreTicketRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $equipment = Equipment::query()->findOrFail((int) $validated['equipment_id']);

        $problemType = PublicTicketProblemTypeEnum::normalize($validated['problem_type'])
            ?? PublicTicketProblemTypeEnum::Other;

        $ticket = $this->createPublicTicket->execute(
            equipment: $equipment,
            problemType: $problemType,
            description: $validated['description'],
            reporterName: $validated['reporter_name'] ?? null,
            reporterContact: $validated['reporter_contact'] ?? null,
        );

        if ($request->hasFile('photo')) {
            $this->storePhoto($ticket, $request);
        }

        // Recomendação de técnico via IA processada em segundo plano após o commit.
        GenerateAiRecommendationJob::dispatch($ticket)->afterCommit();

        $this->notifyAdmins($ticket);

        return redirect()->route('ticket.public.success', ['ticket' => $ticket->id]);
    }

    /**
     * Ecrã de confirmação com o número do ticket criado.
     */
    public function success(Ticket $ticket): View
    {
        return view('ui.tickets.public.success', [
            'ticket' => $ticket->load(['equipment', 'status']),
        ]);
    }

    /**
     * Grava a fotografia do reporte como anexo do ticket (sem conta de utilizador).
     */
    private function storePhoto(Ticket $ticket, PublicStoreTicketRequest $request): void
    {
        $file = $request->file('photo');

        if ($file === null) {
            return;
        }

        $realMime = $file->getMimeType();

        if (! in_array($realMime, self::ALLOWED_MIMES, true)) {
            return;
        }

        $extension = self::EXTENSION_BY_MIME[$realMime] ?? 'img';
        $safeFilename = Str::uuid() . '.' . $extension;
        $path = $file->storeAs('ticket_photos', $safeFilename, 'public');

        TicketAttachment::create([
            'ticket_id' => $ticket->id,
            'user_id' => null,
            'original_name' => $file->getClientOriginalName(),
            'file_name' => $safeFilename,
            'path' => $path,
            'disk' => 'public',
            'extension' => $extension,
            'mime_type' => $realMime,
            'size' => $file->getSize(),
        ]);
    }

    /**
     * Notifica todos os administradores da criação do novo ticket.
     */
    private function notifyAdmins(Ticket $ticket): void
    {
        $this->notificationCreatorService->createForAdmins(
            title: __('tickets.Novo Ticket Reportado'),
            message: __('equipment.:reference — :equipment (:priority)', [
                'reference' => $ticket->reference,
                'equipment' => $ticket->equipment?->name ?? $ticket->equipment_id,
                'priority' => $ticket->priority,
            ]),
            type: NotificationTypeEnum::TicketCreated->value,
            link: route('ui.tickets.show', $ticket),
        );
    }
}
