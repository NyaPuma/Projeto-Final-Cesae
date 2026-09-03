<?php

namespace Database\Seeders;

use App\Enums\TicketStatusEnum;
use App\Models\TicketStatus;
use App\Models\TicketType;
use Illuminate\Database\Seeder;

class TicketLookupSeeder extends Seeder
{
    public function run(): void
    {
        $hardware = $this->ensureType('HARDWARE', 'Hardware', 'Problemas físicos em computadores, impressoras, periféricos ou componentes.');
        $software = $this->ensureType('SOFTWARE', 'Software', 'Problemas com o Sistema Operativo, aplicações, licenças ou lentidão de software.');
        $rede = $this->ensureType('REDE', 'Rede / Internet', 'Falhas de ligação, cablagem, Wi-Fi, routers ou acesso a servidores locais.');

        $this->ensureStatus('ABERTA', TicketStatusEnum::Open->value, 'Ticket registado com sucesso e a aguardar triagem ou atribuição de técnico.', null);
        $this->ensureStatus('EM_CURSO', TicketStatusEnum::InProgress->value, 'A avaria está a ser analisada ou reparada por um técnico responsável.', null);
        $this->ensureStatus('FECHADA', TicketStatusEnum::Closed->value, 'A intervenção foi concluída e o problema foi dado como resolvido.', null);
        $this->ensureStatus('AGUARDA_PECAS', 'aguarda peças', 'A reparação física está suspensa até que os componentes necessários cheguem.', $hardware->id);
        $this->ensureStatus('CANCELADA', TicketStatusEnum::Cancelled->value, 'O ticket foi cancelado pelo utilizador antes da intervenção começar.', null);
        $this->ensureStatus('PENDENTE_ORCAMENTO', TicketStatusEnum::PendingBudget->value, 'A reparação aguardou aprovação orçamental por parte da direção.', null);
        $this->ensureStatus('RECUSADA', TicketStatusEnum::Rejected->value, 'O pedido de orçamento foi rejeitado e o processo não prosseguiu.', null);

        $this->ensureStatus('EM_REVISAO', 'em revisão', 'Estado de validação complementar para tickets com informação incompleta.', $software->id);
        $this->ensureStatus('SEM_REDE', 'sem rede', 'Estado usado para reportar falhas de conectividade temporárias.', $rede->id);
    }

    private function ensureType(string $code, string $name, string $description): TicketType
    {
        return TicketType::updateOrCreate(
            ['name' => $name],
            ['code' => $code, 'description' => $description]
        );
    }

    private function ensureStatus(string $code, string $name, string $description, ?int $typeId): TicketStatus
    {
        return TicketStatus::updateOrCreate(
            ['name' => $name],
            ['code' => $code, 'description' => $description, 'type_id' => $typeId]
        );
    }
}
