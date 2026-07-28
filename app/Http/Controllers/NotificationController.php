<?php

namespace App\Http\Controllers;

use App\Jobs\SendTestEmailJob;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use OpenApi\Attributes as OA;

class NotificationController extends Controller
{
    #[OA\Get(
        path: '/notifications',
        tags: ['Notifications'],
        summary: 'Listar notificações do utilizador',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Lista paginada de notificações'),
        ]
    )]
    public function index(Request $request)
    {
        $user = $this->authenticatedUser($request);

        $perPage = min((int) $request->query('per_page', 50), 200);

        $notifications = Notification::where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->paginate($perPage);

        return response()->json([
            'notifications' => $notifications->items(),
            'total' => $notifications->total(),
            'current_page' => $notifications->currentPage(),
            'last_page' => $notifications->lastPage(),
            'per_page' => $notifications->perPage(),
        ]);
    }

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
    public function markAsRead(Request $request, int $id)
    {
        // Evitamos que uma notificação de outro utilizador seja marcada indevidamente.
        $user = $this->authenticatedUser($request);

        $notification = Notification::where('user_id', $user->id)->find($id);
        if (! $notification) {
            return response()->json(['message' => 'Notificação não encontrada'], 404);
        }

        $notification->is_read = true;
        $notification->save();

        return response()->json(['notification' => $notification]);
    }

    #[OA\Post(
        path: '/notifications/test-email',
        tags: ['Notifications'],
        summary: 'Enviar email de teste via Mailgun',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Email de teste enviado'),
        ]
    )]
    public function sendTestEmail(Request $request)
    {
        $user = $this->authenticatedUser($request);

        SendTestEmailJob::dispatch($user->email, $user->name);
        Log::info('Test email queued', ['user_id' => $user->id, 'email' => $user->email]);

        return response()->json([
            'message' => 'Email de teste em processamento via fila.',
        ]);
    }
}
