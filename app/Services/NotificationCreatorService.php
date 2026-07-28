<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Throwable;

final class NotificationCreatorService
{
    public function createForUser(int $userId, string $title, string $message, string $type, string $link): void
    {
        try {
            Notification::create([
                'user_id' => $userId,
                'title' => $title,
                'message' => $message,
                'type' => $type,
                'link' => $link,
            ]);
        } catch (Throwable $e) {
            Log::warning('Failed to create notification', ['error' => $e->getMessage()]);
        }
    }

    public function createForAdmins(string $title, string $message, string $type, string $link): void
    {
        $admins = User::whereHas('profile', fn ($q) => $q->where('name', User::ROLE_ADMIN))->get();

        foreach ($admins as $admin) {
            $this->createForUser($admin->id, $title, $message, $type, $link);
        }
    }
}
