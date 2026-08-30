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
        $this->createForAdminsMany([
            ['title' => $title, 'message' => $message, 'type' => $type, 'link' => $link],
        ]);
    }

    /**
     * Creates a single bulk notification per payload entry, addressed to every
     * Administrator. Resolves the admin list once and uses a single insert per
     * entry instead of one query per admin.
     *
     * @param array<int, array{title: string, message: string, type: string, link: string}> $entries
     * @return int number of notifications created
     */
    public function createForAdminsMany(array $entries): int
    {
        if ($entries === []) {
            return 0;
        }

        try {
            $admins = User::query()
                ->whereHas('profile', fn ($q) => $q->where('name', UserRoleEnum::Admin->value))
                ->pluck('id');
        } catch (Throwable $e) {
            Log::warning('Failed to resolve admin recipients', [
                'error' => $e->getMessage(),
            ]);

            return 0;
        }

        if ($admins->isEmpty()) {
            return 0;
        }

        $now = now();
        $created = 0;

        foreach ($entries as $entry) {
            $rows = [];

            foreach ($admins as $adminId) {
                $rows[] = [
                    'user_id' => $adminId,
                    'title' => $entry['title'],
                    'message' => $entry['message'],
                    'type' => $entry['type'],
                    'link' => $entry['link'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            try {
                Notification::insert($rows);
                $created += count($rows);
            } catch (Throwable $e) {
                Log::warning('Failed to bulk create notifications', [
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return $created;
    }
}
