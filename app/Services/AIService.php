<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\TicketStatusEnum;
use App\Enums\UserRoleEnum;
use App\Models\Ticket;
use App\Models\User;
use Exception;
use OpenAI\Laravel\Facades\OpenAI;

final class AIService
{
    /**
     * @param TicketStatusService $statusService
     */
    public function __construct(
        private readonly TicketStatusService $statusService,
    ) {}

    /**
     * Recomenda o técnico mais qualificado com base em IA para resolver o ticket.
     *
     * @param Ticket $ticket
     * @return array{tecnico_id: int|null, justificacao: string}
     */
    public function recomendarTecnico(Ticket $ticket): array
    {
        $tecnicos = User::whereHas('profile', fn ($q) =>$q->where('name', UserRoleEnum::Technician->value))
            ->where('active', true)
            ->withCount(['assignedTickets as tickets_ativos' => function ($query) {$closedStatusId = $this->statusService->getByName(TicketStatusEnum::Closed);$cancelledStatusId = $this->statusService->getByName(TicketStatusEnum::Cancelled);$statusIds = array_filter([$closedStatusId,$cancelledStatusId]);

                if (! empty($statusIds)) {
                    $query->whereNotIn('status_id',$statusIds);
                }
            }])
            ->get(['id', 'name']);

        // Fallback imediato caso não haja equipa operacional disponível
        if ($tecnicos->isEmpty()) {
            return [
                'tecnico_id' => null,
                'justificacao' => 'De momento, não existem técnicos operacionais ativos para alocação automática.',
            ];
        }

        // Especialidades mapeadas estaticamente via código para enriquecer o contexto de negócio
        $especialidades = [
            1 => 'Eletricidade e Automação',
            2 => 'Mecânica e Hidráulica',
            3 => 'Sistemas e Redes Informáticas',
        ];

        // Engenharia de Prompt focada no Perfil de Decisão do Administrador
        $prompt = "Atuas como Consultor de Engenharia de Manutenção Industrial para o Administrador do sistema.\n";
        $prompt .= "O teu papel único é analisar o ticket de avaria e sugerir o técnico mais qualificado.\n\n";

        $prompt .= "--- TICKET SOB ANÁLISE ---\n";
        $prompt .= '- Descrição do Problema: ' . $ticket->description . "\n";
        $prompt .= '- Equipamento: ' . ($ticket->equipment->name ?? 'Não Especificado') . "\n";
        $prompt .= '- Categoria Técnica: ' . ($ticket->equipment->category->name ?? 'Geral') . "\n\n";

        $prompt .= "--- RECURSOS HUMANOS DISPONÍVEIS ---\n";
        foreach ($tecnicos as$tecnico) {
            $esp = $especialidades[($tecnico->id % 3) + 1];$prompt .= "- ID: {$tecnico->id} | Nome: {$tecnico->name} | Especialidade: {$esp} | Carga de Trabalho Atual: {$tecnico->tickets_ativos} tickets\n";
        }

        $prompt .= "\n--- CRITÉRIOS DE SELEÇÃO ---\n";
        $prompt .= "1. Encontra afinidade entre a Categoria do problema e a Especialidade do técnico.\n";
        $prompt .= "2. Escolhe o técnico menos sobrecarregado (menor Carga de Trabalho Atual) para balanceamento de equipa.\n";
        $prompt .= "3. Responde estritamente com o objeto JSON limpo abaixo, sem markdown (```json), sem introduções ou observações.\n\n";

        $prompt .= "--- FORMATO OBRIGATÓRIO DE RESPOSTA ---\n";
        $prompt .= "{\n";
        $prompt .= '  "tecnico_id": <inserir_apenas_o_id_numerico>,' . "\n";
        $prompt .= '  "justificacao": "<uma frase curta e profissional em português validando a escolha para o Diretor de Operações>"' . "\n";
        $prompt .= '}';

        try {
            $response = OpenAI::chat()->create([
                'model' => config('services.custom.ai.model'),
                'messages' => [
                    ['role' => 'user', 'content' => $prompt],
                ],
                'temperature' => (float) config('services.custom.ai.temperature', 0.2),
            ]);

            $content = trim($response->choices[0]->message->content ?? '');

            // Limpeza defensiva caso a IA adicione blocos de markdown à resposta JSON
            $content = preg_replace('/^```json\s*([\s\S]*?)\s*```$/i', '$1', $content);
            $content = preg_replace('/^```\s*([\s\S]*?)\s*```$/i', '$1', $content);

            $resultado = json_decode(trim($content), true);

            if (is_array($resultado) && isset($resultado['tecnico_id'])) {
                return [
                    'tecnico_id' => $resultado['tecnico_id'] !== null ? (int) $resultado['tecnico_id'] : null,
                    'justificacao' => (string) ($resultado['justificacao'] ?? 'Atribuição recomendada pelo assistente de IA.'),
                ];
            }

            throw new Exception('JSON Malformado ou estrutura inválida.');
        } catch (Exception $e) {
            return [
                'tecnico_id' => null,
                'justificacao' => 'Assistente de IA indisponível. Por favor, selecione um técnico manualmente através do Painel de Atribuição.',
            ];
        }
    }
}
