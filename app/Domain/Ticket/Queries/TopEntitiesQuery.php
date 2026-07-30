<?php

namespace App\Domain\Ticket\Queries;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

final readonly class TopEntitiesQuery
{
    public function __construct(
        private Builder $baseQuery,
    ) {}

    public function getTopEquipments(): Collection
    {
        return (clone $this->baseQuery)
            ->join('equipments', 'tickets.equipment_id', '=', 'equipments.id')
            ->select('equipments.id', 'equipments.name', DB::raw('COUNT(*) as total'))
            ->whereNotNull('tickets.equipment_id')
            ->groupBy('equipments.id', 'equipments.name')
            ->orderByDesc('total')
            ->limit(5)
            ->get()
            ->map(fn ($row) => [
                'name' => $row->name,
                'total' => (int) $row->total,
                'subtitle' => 'intervenções',
            ]);
    }

    public function getTopRooms(): Collection
    {
        return (clone $this->baseQuery)
            ->join('rooms', 'tickets.room_id', '=', 'rooms.id')
            ->select('rooms.id', 'rooms.name', DB::raw('COUNT(*) as total'))
            ->whereNotNull('tickets.room_id')
            ->groupBy('rooms.id', 'rooms.name')
            ->orderByDesc('total')
            ->limit(5)
            ->get()
            ->map(fn ($row) => [
                'name' => $row->name,
                'total' => (int) $row->total,
                'subtitle' => 'tickets',
            ]);
    }

    public function getTopTechnicians(): Collection
    {
        return (clone $this->baseQuery)
            ->join('users', 'tickets.assigned_to', '=', 'users.id')
            ->select('users.id', 'users.name', DB::raw('COUNT(*) as total'))
            ->whereNotNull('tickets.assigned_to')
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('total')
            ->limit(5)
            ->get()
            ->map(fn ($row) => [
                'name' => $row->name,
                'total' => (int) $row->total,
                'subtitle' => 'ações',
            ]);
    }
}
