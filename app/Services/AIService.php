<?php

namespace App\Services;

use App\Models\Ticket; 
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AIService
{
    /**
     * Analisa o texto da avaria (NLP) e sugere o técnico ideal com base na sua especialidade.
     * Funciona como o vosso "Sistema de Apoio à Decisão (SAD)".
     */
    public function analyzeTicketAndSuggestTechnician(Ticket $ticket)
    {
        
        $problemDescription = $ticket->description;

        if (empty($problemDescription)) {
            return null;
        }

        try {
            // Passo 1: O motor IA analisa o texto livre e identifica a especialidade necessária
            $suggestedSpecialty = $this->extractSpecialtyFromText($problemDescription);

            if ($suggestedSpecialty) {
                // Passo 2: O sistema vai à Base de Dados buscar os Técnicos que têm essa mesma especialidade.
                
                $technicians = User::where('role', 'Tecnico') // Ou o ID do perfil técnico, consoante a lógica de Roles
                                   ->where('especialidade', $suggestedSpecialty)
                                   ->get();

                return [
                    'status' => 'success',
                    'specialty_required' => $suggestedSpecialty,
                    'recommended_technicians' => $technicians,
                    'message' => 'IA: Sugerimos alocar um técnico da área de ' . $suggestedSpecialty
                ];
            }

            return [
                'status' => 'warning',
                'message' => 'IA: Não foi possível determinar uma especialidade específica para esta avaria.'
            ];

        } catch (\Exception $e) {
            // Em caso de falha da IA, o Laravel guarda o erro discretamente e o sistema continua a funcionar
            Log::error('Erro Crítico no AIService: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Motor interno de Processamento de Linguagem Natural (NLP).
     * Nota para a equipa: Podem evoluir isto mais tarde para ligar à API da OpenAI (ChatGPT),
     * mas por agora usamos um motor de triagem por palavras-chave (Keywords) para a Prova de Conceito.
     */
    private function extractSpecialtyFromText(string $text)
    {
        $text = strtolower($text); 

        // Dicionário de Triagem da IA (Podem adicionar mais no futuro)
        if (str_contains($text, 'fumo') || str_contains($text, 'choque') || str_contains($text, 'curto-circuito') || str_contains($text, 'quadro elétrico') || str_contains($text, 'luz')) {
            return 'Eletricidade';
        }

        if (str_contains($text, 'fuga') || str_contains($text, 'cano') || str_contains($text, 'inundação') || str_contains($text, 'água')) {
            return 'Canalização';
        }

        if (str_contains($text, 'filtro') || str_contains($text, 'óleo') || str_contains($text, 'ruído') || str_contains($text, 'motor')) {
            return 'Mecânica Industrial';
        }

        if (str_contains($text, 'windows') || str_contains($text, 'pc') || str_contains($text, 'monitor') || str_contains($text, 'internet') || str_contains($text, 'rede')) {
            return 'Informática';
        }

        return 'Geral'; // Se a IA não conseguir perceber a prioridade, envia para Manutenção Geral
    }
}