<?php

namespace App\Actions;

use App\Enums\PublicTicketProblemTypeEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Equipment;
use App\Models\Ticket;
use App\Services\TicketStatusService;
use Illuminate\Support\Facades\DB;
use RuntimeException;

final readonly class CreatePublicTicketAction
{
    public function __construct(
        private TicketStatusService $statusService,
    ) {}

    /**
     * Cria um ticket reportado publicamente (via QR Code) sem conta de utilizador.
     */
    public function execute(
        Equipment $equipment,
        PublicTicketProblemTypeEnum $problemType,
        string $description,
        ?string $reporterName = null,
        ?string $reporterContact = null,
    ): Ticket {
        $openStatusId = $this->statusService->getByName(TicketStatusEnum::Open);

        if ($openStatusId === null) {
            throw new RuntimeException("O estado '" . TicketStatusEnum::Open->value . "' não foi encontrado no sistema.");
        }

        return DB::transaction(function () use ($equipment, $problemType, $description, $reporterName, $reporterContact, $openStatusId) {
            $ticket = Ticket::create([
                'reference' => 'TKT-' . now()->format('YmdHis') . '-' . strtoupper(uniqid()),
                'title' => trim($problemType->label() . ' — ' . $equipment->name),
                'description' => trim($description),
                'priority' => $problemType->priority()->value,
                'user_id' => null,
                'reporter_name' => trim((string) $reporterName) !== '' ? trim((string) $reporterName) : null,
                'reporter_contact' => trim((string) $reporterContact) !== '' ? trim((string) $reporterContact) : null,
                'source' => 'qr',
                'equipment_id' => $equipment->id,
                'room_id' => $equipment->room_id,
                'status_id' => $openStatusId,
                'opened_at' => now(),
            ]);

            return $ticket->load(['equipment', 'room', 'status']);
        });
    }
}
