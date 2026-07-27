<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadPhotoRequest;
use App\Models\Ticket;
use App\Models\TicketAttachment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TicketAttachmentController extends Controller
{
    private const ALLOWED_MIMES = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

    public function store(UploadPhotoRequest $request, int $id): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $ticket = Ticket::findOrFail($id);

        if (! $user->can('view', $ticket)) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        $file = $request->file('photo');
        $realMime = $file->getMimeType();

        if (! in_array($realMime, self::ALLOWED_MIMES, true)) {
            return response()->json(['message' => 'Tipo de ficheiro não permitido'], 422);
        }

        $path = $file->store('ticket_photos', 'public');
        $extension = $file->getClientOriginalExtension();
        $safeFilename = Str::uuid().'.'.$extension;

        $attachment = TicketAttachment::create([
            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
            'file_name' => $safeFilename,
            'path' => $path,
            'mime_type' => $realMime,
            'size' => $file->getSize(),
        ]);

        return response()->json([
            'attachment' => $attachment,
            'url' => asset("storage/{$path}"),
        ], 201);
    }

    public function index(Request $request, int $id): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $ticket = Ticket::with('attachments')->findOrFail($id);

        if (! $user->can('view', $ticket)) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        return response()->json(['attachments' => $ticket->attachments]);
    }

    public function destroy(Request $request, int $id, int $photoId): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $ticket = Ticket::findOrFail($id);
        $attachment = TicketAttachment::where('ticket_id', $ticket->id)->findOrFail($photoId);

        if ($user->cannot('deletePhoto', $ticket)) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        if (Storage::disk('public')->exists($attachment->path)) {
            Storage::disk('public')->delete($attachment->path);
        }

        $attachment->delete();

        return response()->json(['message' => 'Fotografia removida com sucesso.']);
    }
}
