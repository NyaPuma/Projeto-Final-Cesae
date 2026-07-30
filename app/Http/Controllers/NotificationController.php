<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use App\Jobs\SendTestEmailJob;
use App\Models\Notification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use OpenApi\Attributes as OA;

final class NotificationController extends Controller
{
    /**
     * Lista de forma paginada as notificações do utilizador autenticado.
     */
    #[OA\Get(
        path: '/notifications',
        tags: ['Notifications'],
        summary: 'Listar notificações do utilizador',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Lista paginada de notificações'),
        ]
    )]
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $perPage = min((int) $request->query('per_page', 50), 200);

        $notifications = Notification::where('user_id', $user->id)
            ->latest()
            ->paginate($perPage);

        return response()->json([
            'notifications' => NotificationResource::collection($notifications)->response()->getData(true),
        ]);
    }

    /**
     * Marca uma notificação específica como lida.
     */
    #[OA\Patch(
        path: '/notifications/{id}',
        tags: ['Notifications'],
        summary: 'Marcar notificação como lida',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Notificação atualizada'),
            new OA\Response(response: 404, description: 'Notificação não encontrada'),
        ]
    )]
    public function markAsRead(Request $request, int $id): JsonResponse
    {
        $user = $request->user();

        // Garante que a notificação pertence estritamente ao utilizador autenticado
        $notification = Notification::where('user_id', $user->id)->find($id);

        if (! $notification) {
            return response()->json([
                'message' => __('Notificação não encontrada.'),
            ], 404);
        }

        $notification->is_read = true;
        $notification->save();

        return response()->json([
            'message' => __('Notificação marcada como lida com sucesso.'),
            'notification' => new NotificationResource($notification),
        ]);
    }

    /**
     * Dispara o envio de um email de teste em background via fila.
     */
    #[OA\Post(
        path: '/notifications/test-email',
        tags: ['Notifications'],
        summary: 'Enviar email de teste via Mailgun',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Email de teste enviado'),
        ]
    )]
    public function sendTestEmail(Request $request): JsonResponse
    {
        $user = $request->user();

        SendTestEmailJob::dispatch($user->email, $user->name);

        Log::info('Test email queued', [
            'user_id' => $user->id,
            'email' => $user->email,
        ]);

        return response()->json([
            'message' => __('Email de teste em processamento via fila.'),
        ]);
    }
}
