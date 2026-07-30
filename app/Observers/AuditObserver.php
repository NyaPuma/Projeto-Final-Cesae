<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Audit;
use LogicException;

final readonly class AuditObserver
{
    /**
     * Impede a alteração de qualquer registo de auditoria existente.
     *
     * @throws LogicException
     */
    public function updating(Audit $audit): void
    {
        throw new LogicException('Os registos de auditoria são imutáveis e não podem ser alterados.');
    }

    /**
     * Impede a remoção de qualquer registo de auditoria.
     *
     * @throws LogicException
     */
    public function deleting(Audit $audit): void
    {
        throw new LogicException('Os registos de auditoria são imutáveis e não podem ser eliminados.');
    }

    /**
     * Impede a remoção forçada da base de dados caso use SoftDeletes.
     *
     * @throws LogicException
     */
    public function forceDeleting(Audit $audit): void
    {
        throw new LogicException('Os registos de auditoria são imutáveis e não podem ser eliminados da base de dados.');
    }
}
