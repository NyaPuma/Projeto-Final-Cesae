<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadPhotoRequest;
use App\Http\Resources\TicketAttachmentResource;
use App\Models\Ticket;
use App\Models\TicketAttachment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

final class TicketAttachmentController extends Controller
{
    private const ALLOWED_MIMES = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

    private const EXTENSION_BY_MIME = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/gif' => 'gif',
        'image/webp' => 'webp',
    ];

    /**
     * Faz o upload e associa uma nova fotografia a um ticket.
     */
    public function store(UploadPhotoRequest $request, Ticket $ticket): JsonResponse
    {
        // 1. Autorização via Policy
        $this->authorize('attachPhoto', $ticket);

        $file = $request->file('photo');
        $realMime = $file->getMimeType();

        // 2. Validação adicional de segurança do Mime Type real
        if (! in_array($realMime, self::ALLOWED_MIMES, true)) {
            return response()->json([
                'message' => __('ticket_media.Tipo de ficheiro não permitido.'),
            ], 422);
        }

        // 3. Processamento seguro do nome do ficheiro e gravação no storage
        //    A extensão é derivada do MIME real (nunca do nome enviado pelo cliente)
        $extension = self::EXTENSION_BY_MIME[$realMime] ?? 'img';
        $safeFilename = Str::uuid() . '.' . $extension;
        $path = $file->storeAs('ticket_photos', $safeFilename, 'public');

        // 4. Registo do anexo na base de dados
        $attachment = TicketAttachment::create([
            'ticket_id' => $ticket->id,
            'user_id' => $request->user()->id,
            'original_name' => $file->getClientOriginalName(),
            'file_name' => $safeFilename,
            'path' => $path,
            'disk' => 'public',
            'extension' => $extension,
            'mime_type' => $realMime,
            'size' => $file->getSize(),
        ]);

        return response()->json([
            'message' => __('messages.Fotografia carregada com sucesso.'),
            'attachment' => new TicketAttachmentResource($attachment),
        ], 201);
    }

    /**
     * Lista todos os anexos associados a um ticket.
     */
    public function index(Request $request, Ticket $ticket): JsonResponse
    {
        // 1. Autorização via Policy
        $this->authorize('view', $ticket);

        $ticket->loadMissing('attachments');

        return response()->json([
            'attachments' => TicketAttachmentResource::collection($ticket->attachments),
        ]);
    }

    /**
     * Remove um anexo específico de um ticket.
     */
    public function destroy(Request $request, Ticket $ticket, TicketAttachment $attachment): JsonResponse
    {
        // 1. Autorização via Policy específica para eliminação de fotos
        $this->authorize('deletePhoto', $ticket);

        // 2. Garante integridade relacional entre o anexo e o ticket
        if ($attachment->ticket_id !== $ticket->id) {
            return response()->json([
                'message' => __('tickets.Anexo não encontrado para este ticket.'),
            ], 404);
        }

        // 3. Remove o ficheiro físico do storage se existir
        if (Storage::disk('public')->exists($attachment->path)) {
            Storage::disk('public')->delete($attachment->path);
        }

        // 4. Elimina o registo da base de dados
        $attachment->delete();

        return response()->json([
            'message' => __('messages.Fotografia removida com sucesso.'),
        ]);
    }
}
