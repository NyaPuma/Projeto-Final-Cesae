<?php

namespace App\Observers;

use App\Models\Audit;

final readonly class AuditObserver
{
    public function creating(Audit $audit): void
    {
        // Ensure audit records are immutable
    }

    public function updating(Audit $audit): void
    {
        throw new \LogicException('Audit records are immutable and cannot be updated.');
    }

    public function deleting(Audit $audit): void
    {
        throw new \LogicException('Audit records are immutable and cannot be deleted.');
    }
}
