<?php

namespace App\Actions;

use App\Models\Ticket;
use App\Models\User;
use App\Services\TechnicianAssignmentService;

final readonly class AssignTechnicianAction
{
    public function __construct(
        private readonly TechnicianAssignmentService $assignmentService,
    ) {}

    public function execute(Ticket $ticket, ?int $technicianId): ?User
    {
        return $this->assignmentService->assignToTicket($ticket, $technicianId);
    }
}
