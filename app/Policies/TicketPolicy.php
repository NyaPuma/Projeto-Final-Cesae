<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;

final class TicketPolicy
{
    /**
     * Determines whether the user can list tickets.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determines whether the user can view a specific ticket.
     */
    public function view(User $user, Ticket $ticket): bool
    {
        return $this->canAccessTicket($user, $ticket);
    }

    /**
     * Determines whether the user can create new tickets.
     *
     * Technicians resolve and close tickets; they do not open new ones.
     * Only admins and regular users create tickets.
     */
    public function create(User $user): bool
    {
        return ! $user->isTechnician();
    }

    /**
     * Determines whether the user can update a ticket.
     */
    public function update(User $user, Ticket $ticket): bool
    {
        return $user->isAdmin() || $user->isTechnician();
    }

    /**
     * Determines whether the user can delete a ticket.
     */
    public function delete(User $user, Ticket $ticket): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determines whether the user can comment on a ticket.
     */
    public function comment(User $user, Ticket $ticket): bool
    {
        return $this->canAccessTicket($user, $ticket);
    }

    /**
     * Determines whether the user can attach photos to a ticket.
     */
    public function attachPhoto(User $user, Ticket $ticket): bool
    {
        return $this->canAccessTicket($user, $ticket);
    }

    /**
     * Determines whether the user can remove photos from a ticket.
     */
    public function deletePhoto(User $user, Ticket $ticket): bool
    {
        return $this->canAccessTicket($user, $ticket);
    }

    /**
     * Determines whether the user can cancel their own ticket.
     */
    public function cancel(User $user, Ticket $ticket): bool
    {
        if (! $user->isCommonUser()) {
            return false;
        }

        return (int) $ticket->user_id === (int) $user->id;
    }

    /**
     * Determines whether the technician can start working on the ticket.
     */
    public function start(User $user, Ticket $ticket): bool
    {
        return $user->isTechnician();
    }

    /**
     * Determines whether the technician can close the ticket.
     */
    public function close(User $user, Ticket $ticket): bool
    {
        return $user->isTechnician();
    }

    /**
     * Determines whether the user can reopen the ticket.
     */
    public function reopen(User $user, Ticket $ticket): bool
    {
        return $user->isTechnician() || $user->isAdmin();
    }

    /**
     * Determines whether the user can schedule an intervention.
     */
    public function schedule(User $user, Ticket $ticket): bool
    {
        return $this->canAccessTicket($user, $ticket);
    }

    /**
     * Determines whether the technician or admin can submit a budget/quote.
     */
    public function submitBudget(User $user, Ticket $ticket): bool
    {
        return $user->isTechnician() || $user->isAdmin();
    }

    /**
     * Determines whether the admin can approve the budget/quote.
     */
    public function approveBudget(User $user, Ticket $ticket): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determines whether the technician can start the repair.
     */
    public function startRepair(User $user, Ticket $ticket): bool
    {
        return $user->isTechnician();
    }

    /**
     * Determines whether the assigned technician can request a budget/quote.
     */
    public function requestBudget(User $user, Ticket $ticket): bool
    {
        return $user->isTechnician() && (int) $ticket->assigned_to === (int) $user->id;
    }

    /**
     * Determines whether the admin can assign the ticket to a technician.
     */
    public function assign(User $user, Ticket $ticket): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determines whether the user can access analytics.
     */
    public function viewAnalytics(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determines whether the user can export analytics data.
     */
    public function exportAnalytics(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determines whether the admin can create preventive maintenance.
     */
    public function createPreventive(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Checks whether the user has general access to the ticket (Admin/Technician or Creator).
     */
    private function canAccessTicket(User $user, Ticket $ticket): bool
    {
        if ($user->isAdmin() || $user->isTechnician()) {
            return true;
        }

        return (int) $ticket->user_id === (int) $user->id;
    }
}
