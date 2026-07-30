<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;

final class TicketPolicy
{
    /**
     * Determina se o utilizador pode listar os tickets.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determina se o utilizador pode visualizar um ticket específico.
     */
    public function view(User $user, Ticket $ticket): bool
    {
        return $this->canAccessTicket($user, $ticket);
    }

    /**
     * Determina se o utilizador pode criar novos tickets.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determina se o utilizador pode atualizar um ticket.
     */
    public function update(User $user, Ticket $ticket): bool
    {
        return $user->isAdmin() || $user->isTechnician();
    }

    /**
     * Determina se o utilizador pode eliminar um ticket.
     */
    public function delete(User $user, Ticket $ticket): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determina se o utilizador pode comentar num ticket.
     */
    public function comment(User $user, Ticket $ticket): bool
    {
        return $this->canAccessTicket($user, $ticket);
    }

    /**
     * Determina se o utilizador pode anexar fotografias ao ticket.
     */
    public function attachPhoto(User $user, Ticket $ticket): bool
    {
        return $this->canAccessTicket($user, $ticket);
    }

    /**
     * Determina se o utilizador pode remover fotografias do ticket.
     */
    public function deletePhoto(User $user, Ticket $ticket): bool
    {
        return $this->canAccessTicket($user, $ticket);
    }

    /**
     * Determina se o utilizador pode cancelar o seu próprio ticket.
     */
    public function cancel(User $user, Ticket $ticket): bool
    {
        if (! $user->isCommonUser()) {
            return false;
        }

        return (int) $ticket->user_id === (int) $user->id;
    }

    /**
     * Determina se o técnico pode iniciar o atendimento do ticket.
     */
    public function start(User $user, Ticket $ticket): bool
    {
        return $user->isTechnician();
    }

    /**
     * Determina se o técnico pode fechar o ticket.
     */
    public function close(User $user, Ticket $ticket): bool
    {
        return $user->isTechnician();
    }

    /**
     * Determina se o utilizador pode reabrir o ticket.
     */
    public function reopen(User $user, Ticket $ticket): bool
    {
        return $user->isTechnician() || $user->isAdmin();
    }

    /**
     * Determina se o utilizador pode agendar a intervenção.
     */
    public function schedule(User $user, Ticket $ticket): bool
    {
        return $this->canAccessTicket($user, $ticket);
    }

    /**
     * Determina se o técnico ou administrador pode submeter um orçamento.
     */
    public function submitBudget(User $user, Ticket $ticket): bool
    {
        return $user->isTechnician() || $user->isAdmin();
    }

    /**
     * Determina se o administrador pode aprovar o orçamento.
     */
    public function approveBudget(User $user, Ticket $ticket): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determina se o técnico pode iniciar a reparação.
     */
    public function startRepair(User $user, Ticket $ticket): bool
    {
        return $user->isTechnician();
    }

    /**
     * Determina se o técnico atribuído pode solicitar orçamento.
     */
    public function requestBudget(User $user, Ticket $ticket): bool
    {
        return $user->isTechnician() && (int) $ticket->assigned_to === (int) $user->id;
    }

    /**
     * Determina se o administrador pode atribuir o ticket a um técnico.
     */
    public function assign(User $user, Ticket $ticket): bool
    {
        return $user->isAdmin();
    }

    /**
     * Verifica se o utilizador tem acesso geral ao ticket (Admin/Técnico ou Criador).
     */
    private function canAccessTicket(User $user, Ticket $ticket): bool
    {
        if ($user->isAdmin() || $user->isTechnician()) {
            return true;
        }

        return (int) $ticket->user_id === (int) $user->id;
    }
}
