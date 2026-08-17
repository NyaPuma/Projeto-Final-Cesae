<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\Audit;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

trait Auditable
{
    /**
     * ID do utilizador armazenado em cache por pedido.
     * Nota: O cache é estático por processo; em long-running processes
     * (filas, Octane) deve ser reiniciado com resetResolvedUserId() para
     * garantir que cada job/request usa o ID correto.
     *
     * @var int|null
     */
    private static ?int $resolvedUserId = null;

    /**
     * Reinicia o cache do ID do utilizador — útil em long-running processes
     * (filas, Octane) para garantir que cada job/request usa o ID correto.
     */
    public static function resetResolvedUserId(): void
    {
        self::$resolvedUserId = null;
    }

    /**
     * Regista os ouvintes de eventos do modelo para auditoria.
     */
    public static function bootAuditable(): void
    {
        foreach (['created', 'updated', 'deleted'] as $event) {
            call_user_func([static::class, $event], function (Model $model) use ($event): void {
                try {
                    self::createAudit($model, $event);
                } catch (Throwable $e) {
                    Log::warning('Audit trail failed', [
                        'model' => get_class($model),
                        'event' => $event,
                        'error' => $e->getMessage(),
                    ]);
                }
            });
        }
    }

    /**
     * Cria o registo de auditoria para o modelo e evento especificados.
     *
     * @param Model $model
     * @param string $event
     */
    private static function createAudit(Model $model, string $event): void
    {
        /** @var Request|null $request */
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

    /**
     * Resolve e armazena em cache o ID do utilizador associado ao pedido atual.
     *
     * @param Request|null $request
     * @return int|null
     */
    private static function resolveUserId(?Request $request): ?int
    {
        if (self::$resolvedUserId !== null) {
            return self::$resolvedUserId;
        }

        $userId = null;

        if (function_exists('auth')) {
            $authUser = auth()->user();
            if ($authUser) {
                /** @var mixed $authUser */
                $userId = $authUser->id ?? $authUser->getKey();
            }
        }

        if ($userId === null && $request) {
            $token = $request->header('X-Auth-Token') ?: $request->bearerToken();
            if (is_string($token) && $token !== '') {
                $hashedToken = User::hashToken($token);
                /** @var int|null $userId */
                $userId = User::where('api_token', $hashedToken)->value('id');
            }
        }

        self::$resolvedUserId = $userId !== null ? (int) $userId : null;

        return self::$resolvedUserId;
    }
}
