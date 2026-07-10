<?php

namespace Database\Seeders;

use App\Models\TicketStatus;
use App\Models\TicketType;
use Illuminate\Database\Seeder;

class TicketLookupSeeder extends Seeder
{
    public function run(): void
    {
        $hardware = $this->ensureType('Hardware', 'Problemas físicos em computadores, impressoras, periféricos ou componentes.');
        $software = $this->ensureType('Software', 'Problemas com o Sistema Operativo, aplicações, licenças ou lentidão de software.');
        $rede = $this->ensureType('Rede / Internet', 'Falhas de ligação, cablagem, Wi-Fi, routers ou acesso a servidores locais.');

        $this->ensureStatus('aberta', 'Ticket registado com sucesso e a aguardar triagem ou atribuição de técnico.', null);
        $this->ensureStatus('em curso', 'A avaria está a ser analisada ou reparada por um técnico responsável.', null);
        $this->ensureStatus('fechada', 'A intervenção foi concluída e o problema foi dado como resolvido.', null);
        $this->ensureStatus('aguarda peças', 'A reparação física está suspensa até que os componentes necessários cheguem.', $hardware->id);
        $this->ensureStatus('cancelada', 'O ticket foi cancelado pelo utilizador antes da intervenção começar.', null);
        $this->ensureStatus('pendente orçamento', 'A reparação aguardou aprovação orçamental por parte da direção.', null);
        $this->ensureStatus('recusada', 'O pedido de orçamento foi rejeitado e o processo não prosseguiu.', null);

        $this->ensureStatus('em revisão', 'Estado de validação complementar para tickets com informação incompleta.', $software->id);
        $this->ensureStatus('sem rede', 'Estado usado para reportar falhas de conectividade temporárias.', $rede->id);
    }

    private function ensureType(string $name, string $description): TicketType
    {
        return TicketType::updateOrCreate(
            ['name' => $name],
            ['description' => $description]
        );
    }

    private function ensureStatus(string $name, string $description, ?int $typeId): TicketStatus
    {
        return TicketStatus::updateOrCreate(
            ['name' => $name],
            ['description' => $description, 'type_id' => $typeId]
        );
    }
}
