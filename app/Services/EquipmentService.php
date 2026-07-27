<?php

namespace App\Services;

use App\Models\Equipment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class EquipmentService
{
    public function listPaginated(?string $search = null, ?string $status = null): LengthAwarePaginator
    {
        $query = Equipment::with('room');

        if ($search !== null && $search !== '') {
            $safeSearch = str_replace(['%', '_'], ['\%', '\_'], $search);
            $query->where(function ($sub) use ($safeSearch) {
                $sub->where('name', 'like', "%{$safeSearch}%")
                    ->orWhere('serial', 'like', "%{$safeSearch}%");
            });
        }

        if ($status !== null && $status !== '') {
            $query->where('active', $status === 'active');
        }

        return $query->orderBy('name')->paginate(15);
    }
}
