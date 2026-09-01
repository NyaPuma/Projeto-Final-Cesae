<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Equipment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class EquipmentService
{
    /**
     * Returns a paginated listing of equipment based on search terms and status.
     *
     * @return LengthAwarePaginator<int, Equipment>
     */
    public function listPaginated(?string $search = null, ?string $status = null): LengthAwarePaginator
    {
        $query = Equipment::with('room');

        if ($search !== null && $search !== '') {
            $safeSearch = str_replace(['%', '_'], ['\%', '\_'], $search);
            $query->where(function ($sub) use ($safeSearch): void {
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
