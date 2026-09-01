<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        if (app()->environment('production')) {
            $this->command->error('ABORTADO: Este seeder não deve ser executado em produção!');

            return;
        }

        if (DB::table('notifications')->exists()) {
            $this->command?->info('Notificações já semeadas anteriormente.');

            return;
        }

        $userIds = DB::table('users')->whereNull('deleted_at')->pluck('id')->all();

        if (empty($userIds)) {
            $this->command->error('Sem utilizadores para associar às notificações.');

            return;
        }

        $templates = [
            'ticket_created' => ['title' => 'Novo ticket registado', 'message' => 'Foi registado um novo pedido de intervenção aguardando triagem.'],
            'ticket_updated' => ['title' => 'Ticket atualizado', 'message' => 'O estado de um ticket foi atualizado pela equipa de manutenção.'],
            'ticket_assigned' => ['title' => 'Intervenção atribuída', 'message' => 'Foi-lhe atribuída uma nova intervenção para resolução.'],
            'ticket_closed' => ['title' => 'Ticket encerrado', 'message' => 'A intervenção foi concluída e o ticket encerrado com sucesso.'],
            'comment_added' => ['title' => 'Novo comentário', 'message' => 'Foi adicionado um comentário ao ticket da sua responsabilidade.'],
            'attachment_added' => ['title' => 'Novo anexo', 'message' => 'Foram adicionadas fotografias de apoio ao registo da avaria.'],
            'budget_requested' => ['title' => 'Pedido de orçamento', 'message' => 'A intervenção requer orçamento antes de prosseguir.'],
            'budget_approved' => ['title' => 'Orçamento aprovado', 'message' => 'O orçamento solicitado foi aprovado pela direção.'],
            'budget_rejected' => ['title' => 'Orçamento rejeitado', 'message' => 'O orçamento solicitado foi rejeitado pela direção.'],
            'budget_submitted' => ['title' => 'Orçamento submetido', 'message' => 'O orçamento foi submetido para aprovação.'],
            'priority_override' => ['title' => 'Prioridade alterada', 'message' => 'A prioridade do ticket foi alterada manualmente.'],
            'low_stock' => ['title' => 'Stock baixo', 'message' => 'Uma peça atingiu o nível mínimo de stock.'],
            'system' => ['title' => 'Aviso do sistema', 'message' => 'Ocorreu um evento automático relevante para a operação.'],
        ];

        $typeWeights = [
            'ticket_created' => 30,
            'ticket_assigned' => 22,
            'ticket_closed' => 18,
            'ticket_updated' => 10,
            'comment_added' => 6,
            'attachment_added' => 4,
            'budget_requested' => 3,
            'budget_approved' => 2,
            'budget_rejected' => 1,
            'budget_submitted' => 1,
            'priority_override' => 1,
            'low_stock' => 1,
            'system' => 1,
        ];

        $types = array_keys($typeWeights);
        $typeTotal = array_sum($typeWeights);
        $now = Carbon::now();

        $rows = [];

        for ($i = 1; $i <= 600; $i++) {
            $type = $this->weightedPick($types, array_values($typeWeights), $typeTotal);
            $template = $templates[$type];

            $createdAt = $now->copy()
                ->subDays(random_int(0, 180))
                ->subMinutes(random_int(0, 1439));

            $isRead = $createdAt->lt($now->copy()->subDays(1)) || random_int(1, 100) <= 15;

            $priority = match ($type) {
                'budget_approved', 'budget_rejected' => 'high',
                'priority_override', 'budget_requested' => 'critical',
                'low_stock' => 'high',
                default => 'normal',
            };

            $rows[] = [
                'user_id' => $userIds[random_int(0, count($userIds) - 1)],
                'title' => $template['title'],
                'message' => $template['message'],
                'type' => $type,
                'priority' => $priority,
                'is_read' => $isRead,
                'read_at' => $isRead ? $createdAt->copy()->addHours(random_int(1, 12)) : null,
                'data' => json_encode(['seed' => true, 'ticket_id' => $i]),
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
        }

        foreach (array_chunk($rows, 500) as $chunk) {
            DB::table('notifications')->insert($chunk);
        }

        $this->command?->info('Notificações semeadas com sucesso.');
    }

    /**
     * @param  array<int, string>  $items
     * @param  array<int, int>  $weights
     */
    private function weightedPick(array $items, array $weights, int $total): string
    {
        $roll = random_int(1, $total);
        $running = 0;

        foreach ($items as $index => $item) {
            $running += $weights[$index];
            if ($roll <= $running) {
                return $item;
            }
        }

        return $items[array_key_last($items)];
    }
}
