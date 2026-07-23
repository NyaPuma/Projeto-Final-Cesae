<?php

namespace Database\Seeders;

use App\Models\TicketStatus;
use Illuminate\Database\Seeder;

class TicketLookupSeeder extends Seeder
{
    public function run(): void
    {
        $this->ensureStatus('aberta', 'Ticket registado e a aguardar atribuição ou intervenção.');
        $this->ensureStatus('em curso', 'A avaria está a ser analisada ou reparada por um técnico.');
        $this->ensureStatus('fechada', 'A intervenção foi concluída e o problema foi resolvido.');
        $this->ensureStatus('cancelada', 'Ticket cancelado pelo administrador ou utilizador.');
        $this->ensureStatus('pendente orçamento', 'Aguarda aprovação orçamental do administrador.');
        $this->ensureStatus('recusada', 'Orçamento recusado pelo administrador.');
    }

    private function ensureStatus(string $name, string $description): TicketStatus
    {
        return TicketStatus::updateOrCreate(
            ['name' => $name],
            ['description' => $description, 'type_id' => null]
        );
    }
}
