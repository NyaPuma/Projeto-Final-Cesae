<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;

final class TicketPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Ticket $ticket): bool
    {
        return $this->canAccessTicket($user, $ticket);
    }

    public function comment(User $user, Ticket $ticket): bool
    {
        return $this->canAccessTicket($user, $ticket);
    }

    public function attachPhoto(User $user, Ticket $ticket): bool
    {
        return $this->canAccessTicket($user, $ticket);
    }

    public function deletePhoto(User $user, Ticket $ticket): bool
    {
        return $this->canAccessTicket($user, $ticket);
    }

    public function cancel(User $user, Ticket $ticket): bool
    {
        if (! $user->isCommonUser()) {
            return false;
        }

        return (int) $ticket->user_id === (int) $user->id;
    }

    public function start(User $user, Ticket $ticket): bool
    {
        return $user->isTechnician();
    }

    public function close(User $user, Ticket $ticket): bool
    {
        return $user->isTechnician();
    }

    public function reopen(User $user, Ticket $ticket): bool
    {
        return $user->isTechnician() || $user->isAdmin();
    }

    public function schedule(User $user, Ticket $ticket): bool
    {
        return $this->canAccessTicket($user, $ticket);
    }

    public function submitBudget(User $user, Ticket $ticket): bool
    {
        return $user->isTechnician() || $user->isAdmin();
    }

    public function approveBudget(User $user, Ticket $ticket): bool
    {
        return $user->isAdmin();
    }

    private function canAccessTicket(User $user, Ticket $ticket): bool
    {
        if ($user->isAdmin() || $user->isTechnician()) {
            return true;
        }

        return (int) $ticket->user_id === (int) $user->id;
    }
}
