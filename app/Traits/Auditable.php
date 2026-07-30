<?php

namespace App\Traits;

use App\Models\Audit;
use App\Models\User;
use Illuminate\Support\Facades\Log;

trait Auditable
{
    /** @var int|null Cached user ID resolved once per request */
    private static ?int $resolvedUserId = null;

    public static function bootAuditable(): void
    {
        foreach (['created', 'updated', 'deleted'] as $event) {
            call_user_func([static::class, $event], function ($model) use ($event) {
                try {
                    self::createAudit($model, $event);
                } catch (\Throwable $e) {
                    Log::warning('Audit trail failed', [
                        'model' => get_class($model),
                        'event' => $event,
                        'error' => $e->getMessage(),
                    ]);
                }
            });
        }
    }

    private static function createAudit($model, string $event): void
    {
        $request = null;
        if (function_exists('request')) {
            $request = request();
        }

        $userId = self::resolveUserId($request);

        $old = null;
        $new = null;

        if ($event === 'created') {
            $new = $model->getAttributes();
        } elseif ($event === 'deleted') {
            $old = $model->getOriginal();
        } else {
            $changes = $model->getChanges();
            if (! empty($changes)) {
                $oldVals = [];
                $newVals = [];
                foreach ($changes as $k => $v) {
                    $oldVals[$k] = $model->getOriginal($k);
                    $newVals[$k] = $v;
                }
                $old = $oldVals;
                $new = $newVals;
            }
        }

        Audit::create([
            'user_id' => $userId,
            'auditable_type' => get_class($model),
            'auditable_id' => $model->getKey(),
            'event' => $event,
            'old_values' => $old,
            'new_values' => $new,
            'url' => $request?->fullUrl(),
            'ip_address' => $request?->ip(),
            'user_agent' => $request?->userAgent(),
        ]);
    }

    private static function resolveUserId($request): ?int
    {
        if (self::$resolvedUserId !== null) {
            return self::$resolvedUserId;
        }

        $userId = null;

        if (function_exists('auth')) {
            $authUser = auth()->user();
            if ($authUser) {
                $userId = $authUser->id ?? $authUser->getKey();
            }
        }

        if ($userId === null && $request) {
            $token = $request->header('X-Auth-Token') ?: $request->bearerToken();
            if (is_string($token) && $token !== '') {
                $hashedToken = User::hashToken($token);
                $userId = User::where('api_token', $hashedToken)->value('id');
            }
        }

        self::$resolvedUserId = $userId !== null ? (int) $userId : null;

        return self::$resolvedUserId;
    }
}
