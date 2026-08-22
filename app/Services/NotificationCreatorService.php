<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\UserRoleEnum;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Throwable;

final class NotificationCreatorService
{
    /**
     * Creates a notification targeted to a specific user safely.
     *
     * @param int $userId
     * @param string $title
     * @param string $message
     * @param string $type
     * @param string $link
     */
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
            Log::warning('Failed to create notification', [
                'user_id' => $userId,
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Creates a bulk notification for all users with the Administrator profile.
     *
     * @param string $title
     * @param string $message
     * @param string $type
     * @param string $link
     */
    public function createForAdmins(string $title, string $message, string $type, string $link): void
    {
        $admins = User::whereHas('profile', fn ($q) => $q->where('name', UserRoleEnum::Admin->value))->get();

        foreach ($admins as $admin) {
            $this->createForUser($admin->id, $title, $message, $type, $link);
        }
    }
}
