<?php

namespace Tests\Concerns;

use App\Models\TicketStatus;

trait SeedsLookupData
{
    protected function seedLookupData(): void
    {
        TicketStatus::firstOrCreate(['name' => 'aberta'], ['code' => 'ABERTA', 'description' => 'Aberta']);
        TicketStatus::firstOrCreate(['name' => 'em curso'], ['code' => 'EM_CURSO', 'description' => 'Em curso']);
        TicketStatus::firstOrCreate(['name' => 'fechada'], ['code' => 'FECHADA', 'description' => 'Fechada']);
        TicketStatus::firstOrCreate(['name' => 'cancelada'], ['code' => 'CANCELADA', 'description' => 'Cancelada']);
        TicketStatus::firstOrCreate(['name' => 'pendente orçamento'], ['code' => 'PENDENTE_ORCAMENTO', 'description' => 'Pendente']);
        TicketStatus::firstOrCreate(['name' => 'recusada'], ['code' => 'RECUSADA', 'description' => 'Recusada']);
    }
}
