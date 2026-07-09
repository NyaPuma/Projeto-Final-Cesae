<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
            new OA\Response(response: 200, description: 'Lista paginada de notificações')
        ]
    )]
    public function index(Request $request)
    {
        // Cada utilizador só vê as notificações que lhe pertencem.
        $user = $this->authenticatedUser($request);

        $notifications = Notification::where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->paginate(15);

        return response()->json(['notifications' => $notifications]);
    }

    #[OA\Patch(
        path: '/notifications/{id}',
        tags: ['Notifications'],
        summary: 'Marcar notificação como lida',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 200, description: 'Notificação atualizada'),
            new OA\Response(response: 404, description: 'Notificação não encontrada')
        ]
    )]
    public function markAsRead(Request $request, int $id)
    {
        // Evitamos que uma notificação de outro utilizador seja marcada indevidamente.
        $user = $this->authenticatedUser($request);

        $notification = Notification::where('user_id', $user->id)->find($id);
        if (!$notification) {
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
            new OA\Response(response: 200, description: 'Email de teste enviado')
        ]
    )]
    public function sendTestEmail(Request $request)
    {
        // O envio usa o mailer de fallback configurado para demonstração e crédito extra.
        $user = $this->authenticatedUser($request);

        Mail::mailer('mailgun_fallback')->to($user->email)->send(new TestMail($user->name));
        Log::info('Mailgun fallback test email sent', ['user_id' => $user->id, 'email' => $user->email]);

        return response()->json([
            'message' => 'Email de teste enviado com sucesso via Mailgun/SendGrid fallback.',
            'mailer' => 'mailgun_fallback',
        ]);
    }
}
