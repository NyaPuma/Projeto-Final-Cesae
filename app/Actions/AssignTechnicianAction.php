<?php

namespace App\Actions;

use App\Models\Ticket;
use App\Models\User;
use App\Services\TechnicianAssignmentService;

final readonly class AssignTechnicianAction
{
    public function __construct(
        private TechnicianAssignmentService $assignmentService,
    ) {}

    /**
     * Atribui (ou remove) um técnico a um ticket e devolve o modelo atualizado.
     */
    public function execute(Ticket $ticket, User|int|null $technician): Ticket
    {
        $technicianId = $technician instanceof User ? $technician->id : $technician;

        $this->assignmentService->assignToTicket($ticket, $technicianId);

        return $ticket->load('technician');
    }
}
