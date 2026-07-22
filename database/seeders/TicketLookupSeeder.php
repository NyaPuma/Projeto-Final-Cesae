<?php

namespace Database\Seeders;

use App\Models\TicketStatus;
use Illuminate\Database\Seeder;

class TicketLookupSeeder extends Seeder
{
    public function run(): void
    {
        // Apenas 3 estados: Aberta, Em Curso, Fechada
        $this->ensureStatus('aberta', 'Ticket registado e a aguardar atribuição ou intervenção.');
        $this->ensureStatus('em curso', 'A avaria está a ser analisada ou reparada por um técnico.');
        $this->ensureStatus('fechada', 'A intervenção foi concluída e o problema foi resolvido.');
    }

    private function ensureStatus(string $name, string $description): TicketStatus
    {
        return TicketStatus::updateOrCreate(
            ['name' => $name],
            ['description' => $description, 'type_id' => null]
        );
    }
}
