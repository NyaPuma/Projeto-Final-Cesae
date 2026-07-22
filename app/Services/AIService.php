<?php

namespace App\Services;

use App\Models\Ticket;
use App\Models\User;
use OpenAI\Laravel\Facades\OpenAI;

class AIService
{
    /**
     * Motor de IA exclusivo para apoiar o Administrador na alocação de recursos.
     */
    public function recomendarTecnico(Ticket $ticket)
    {
        // 1. Procurar técnicos ativos no sistema e calcular dinamicamente a sua carga de trabalho
        $tecnicos = User::whereHas('profile', function ($query) {
            $query->where('name', User::ROLE_TECHNICIAN);
        })
            ->where('active', true)
            ->withCount(['assignedTickets as tickets_ativos' => function ($query) {
                // Conta apenas os tickets em aberto ou progresso (IDs de estados não concluídos)
                $query->whereNotIn('status_id', [3, 4]); // Ex: 3 = Fechado, 4 = Cancelado
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

        // 2. Engenharia de Prompt focada no Perfil de Decisão do Administrador
        $prompt = "Atuas como Consultor de Engenharia de Manutenção Industrial para o Administrador do sistema.\n";
        $prompt .= "O teu papel único é analisar o ticket de avaria e sugerir o técnico mais qualificado.\n\n";

        $prompt .= "--- TICKET SOB ANÁLISE ---\n";
        $prompt .= '- Descrição do Problema: '.$ticket->description."\n";
        $prompt .= '- Equipamento: '.($ticket->equipment->name ?? 'Não Especificado')."\n";

        // Uso do operador null-safe (?->) para evitar quebras se o equipamento ou categoria não existirem
        $prompt .= '- Categoria Técnica: '.($ticket->equipment->category->name ?? 'Geral')."\n\n";

        $prompt .= "--- RECURSOS HUMANOS DISPONÍVEIS ---\n";
        foreach ($tecnicos as $tecnico) {
            $esp = $especialidades[($tecnico->id % 3) + 1];
            $prompt .= "- ID: {$tecnico->id} | Nome: {$tecnico->name} | Especialidade: {$esp} | Carga de Trabalho Atual: {$tecnico->tickets_ativos} tickets\n";
        }

        $prompt .= "\n--- CRITÉRIOS DE SELEÇÃO ---\n";
        $prompt .= "1. Encontra afinidade entre a Categoria do problema e a Especialidade do técnico.\n";
        $prompt .= "2. Escolhe o técnico menos sobrecarregado (menor Carga de Trabalho Atual) para balanceamento de equipa.\n";
        $prompt .= "3. Responde estritamente com o objeto JSON limpo abaixo, sem markdown (```json), sem introduções ou observações.\n\n";

        $prompt .= "--- FORMATO OBRIGATÓRIO DE RESPOSTA ---\n";
        $prompt .= "{\n";
        $prompt .= "  \"tecnico_id\": <inserir_apenas_o_id_numerico>,\n";
        $prompt .= "  \"justificacao\": \"<uma frase curta e profissional em português validando a escolha para o Diretor de Operações>\"\n";
        $prompt .= '}';

        try {
            $response = OpenAI::chat()->create([
                'model' => 'gpt-4o-mini',
                'messages' => [
                    ['role' => 'user', 'content' => $prompt],
                ],
                'temperature' => 0.1, // Manter previsível e lógico
            ]);

            $resultado = json_decode(trim($response->choices[0]->message->content), true);

            if (isset($resultado['tecnico_id'])) {
                return $resultado;
            }

            throw new \Exception('JSON Malformado');
        } catch (\Exception $e) {
            return [
                'tecnico_id' => null,
                'justificacao' => 'Assistente de IA indisponível. Por favor, selecione um técnico manualmente através do Painel de Atribuição.',
            ];
        }
    }
}
