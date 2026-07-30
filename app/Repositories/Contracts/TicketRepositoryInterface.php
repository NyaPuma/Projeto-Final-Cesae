<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\DTOs\TicketFilters;
use App\Models\Ticket;
use Illuminate\Pagination\LengthAwarePaginator;

interface TicketRepositoryInterface
{
    /**
     * Encontra um ticket pelo seu ID.
     *
     * @param int $id
     * @return Ticket|null
     */
    public function findById(int $id): ?Ticket;

    /**
     * Encontra um ticket pelo seu ID carregando relações específicas.
     *
     * @param int $id
     * @param array<int, string> $relations
     * @return Ticket|null
     */
    public function findWithRelations(int $id, array $relations = []): ?Ticket;

    /**
     * Retorna uma listagem paginada de tickets.
     *
     * @param array<int, string> $relations
     * @return LengthAwarePaginator<Ticket>
     */
    public function getAll(array $relations = []): LengthAwarePaginator;

    /**
     * Pesquisa tickets com base em filtros estruturados (DTO).
     *
     * @param TicketFilters $filters
     * @return LengthAwarePaginator<Ticket>
     */
    public function search(TicketFilters $filters): LengthAwarePaginator;

    /**
     * Cria um novo ticket.
     *
     * @param array<string, mixed> $data
     * @return Ticket
     */
    public function create(array $data): Ticket;

    /**
     * Atualiza um ticket existente.
     *
     * @param Ticket $ticket
     * @param array<string, mixed> $data
     * @return bool
     */
    public function update(Ticket $ticket, array $data): bool;

    /**
     * Elimina um ticket da base de dados.
     *
     * @param Ticket $ticket
     * @return bool
     */
    public function delete(Ticket $ticket): bool;

    /**
     * Retorna todos os tickets abertos de forma paginada.
     *
     * @return LengthAwarePaginator<Ticket>
     */
    public function getOpenTickets(): LengthAwarePaginator;

    /**
     * Retorna os tickets atribuídos a um técnico específico.
     *
     * @param int $technicianId
     * @return LengthAwarePaginator<Ticket>
     */
    public function getTicketsByTechnician(int $technicianId): LengthAwarePaginator;

    /**
     * Retorna os tickets criados por um utilizador específico.
     *
     * @param int $userId
     * @return LengthAwarePaginator<Ticket>
     */
    public function getTicketsByUser(int $userId): LengthAwarePaginator;
}
