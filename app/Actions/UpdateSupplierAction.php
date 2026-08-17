<?php

declare(strict_types=1);

namespace App\Actions;

use App\DTOs\UpdateSupplierData;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;

final readonly class UpdateSupplierAction
{
    public function execute(Supplier $supplier, UpdateSupplierData $data): Supplier
    {
        return DB::transaction(function () use ($supplier, $data) {
            $supplier->update([
                'name' => $data->name,
                'nif' => $data->nif,
                'contact' => $data->contact,
                'email' => $data->email,
                'address' => $data->address,
                'avg_lead_time_days' => $data->avgLeadTimeDays,
            ]);

            return $supplier->load('parts');
        });
    }
}
