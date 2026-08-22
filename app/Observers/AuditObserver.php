<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Audit;
use LogicException;

final readonly class AuditObserver
{
    /**
     * Prevents modification of any existing audit record.
     *
     * @throws LogicException
     */
    public function updating(Audit $audit): void
    {
        throw new LogicException('Audit records are immutable and cannot be modified.');
    }

    /**
     * Prevents deletion of any audit record.
     *
     * @throws LogicException
     */
    public function deleting(Audit $audit): void
    {
        throw new LogicException('Audit records are immutable and cannot be deleted.');
    }

    /**
     * Prevents force-deletion from the database when using SoftDeletes.
     *
     * @throws LogicException
     */
    public function forceDeleting(Audit $audit): void
    {
        throw new LogicException('Audit records are immutable and cannot be permanently deleted from the database.');
    }
}
