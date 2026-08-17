<?php

declare(strict_types=1);

namespace App\Actions;

use App\DTOs\StoreSupplierData;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;

final readonly class CreateSupplierAction
{
    public function execute(StoreSupplierData $data): Supplier
    {
        return DB::transaction(function () use ($data) {
            $supplier = Supplier::create([
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
