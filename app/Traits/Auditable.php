<?php

namespace App\Traits;

use App\Models\Audit;
use App\Models\User;
use Illuminate\Support\Facades\Log;

trait Auditable
{
    public static function bootAuditable(): void
    {
        foreach (['created', 'updated', 'deleted'] as $event) {
            call_user_func([static::class, $event], function ($model) use ($event) {
                try {
                    $request = null;
                    if (function_exists('request')) {
                        $request = request();
                    }

                    $userId = null;
                    $authGuard = null;
                    if (function_exists('auth')) {
                        $authGuard = auth();
                    }

                    if ($authGuard && method_exists($authGuard, 'user')) {
                        $authUser = $authGuard->user();
                        if ($authUser) {
                            $userId = $authUser->id ?? ($authUser->getKey() ?? null);
                        }
                    } elseif ($request) {
                        $token = $request->header('X-Auth-Token') ?: $request->bearerToken();
                        if (is_string($token) && $token !== '') {
                            $hashedToken = User::hashToken($token);
                            $u = User::where('api_token', $hashedToken)->first();
                            $userId = $u?->id;
                        }
                    }

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
                        'url' => $request ? $request->fullUrl() : null,
                        'ip_address' => $request ? $request->ip() : null,
                        'user_agent' => $request ? $request->userAgent() : null,
                    ]);
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
}
