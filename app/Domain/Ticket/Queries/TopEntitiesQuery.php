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
            ->select('equipments.name', DB::raw('COUNT(*) as total'))
            ->whereNotNull('tickets.equipment_id')
            ->groupBy('equipments.name')
            ->orderByDesc('total')
            ->limit(5)
            ->pluck('total', 'name')
            ->map(fn (int|string $total, string $name) => ['name' => $name, 'total' => (int) $total, 'subtitle' => 'intervenções'])
            ->values();
    }

    public function getTopRooms(): Collection
    {
        return (clone $this->baseQuery)
            ->join('rooms', 'tickets.room_id', '=', 'rooms.id')
            ->select('rooms.name', DB::raw('COUNT(*) as total'))
            ->whereNotNull('tickets.room_id')
            ->groupBy('rooms.name')
            ->orderByDesc('total')
            ->limit(5)
            ->pluck('total', 'name')
            ->map(fn (int|string $total, string $name) => ['name' => $name, 'total' => (int) $total, 'subtitle' => 'tickets'])
            ->values();
    }

    public function getTopTechnicians(): Collection
    {
        return (clone $this->baseQuery)
            ->join('users', 'tickets.assigned_to', '=', 'users.id')
            ->select('users.name', DB::raw('COUNT(*) as total'))
            ->whereNotNull('tickets.assigned_to')
            ->groupBy('users.name')
            ->orderByDesc('total')
            ->limit(5)
            ->pluck('total', 'name')
            ->map(fn (int|string $total, string $name) => ['name' => $name, 'total' => (int) $total, 'subtitle' => 'ações'])
            ->values();
    }
}
