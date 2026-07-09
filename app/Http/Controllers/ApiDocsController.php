<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiDocsController extends Controller
{
    /**
     * Retorna a especificação OpenAPI/Swagger para a documentação da API.
     */
    public function swagger(Request $request)
    {
        // Esta resposta é gerada manualmente para servir como fallback simples da documentação.
        $spec = [
            'openapi' => '3.0.0',
            'info' => [
                'title'       => 'Gestão de Avarias API',
                'version'     => '1.0.0',
                'description' => 'Documentação OpenAPI para gestão de tickets, equipamentos, salas e relatórios analíticos.',
            ],
            // Esquemas de autenticação suportados pela aplicação e pela documentação.
            'components' => [
                'securitySchemes' => [
                    'X-Auth-Token' => [
                        'type'        => 'apiKey',
                        'in'          => 'header',
                        'name'        => 'X-Auth-Token',
                        'description' => 'Autenticação por Token Customizado. Forneça o token gerado após o login.',
                    ],
                    'BearerAuth' => [
                        'type'         => 'http',
                        'scheme'       => 'bearer',
                        'bearerFormat' => 'JWT',
                        'description'  => 'Autenticação alternativa via Bearer Token.',
                    ],
                ],
            ],
            // Segurança global: as rotas públicas sobrescrevem isto quando necessário.
            'security' => [
                ['X-Auth-Token' => []],
                ['BearerAuth'   => []],
            ],
            'paths' => [
                '/auth/login' => [
                    'post' => [
                        'summary'     => 'Iniciar sessão',
                        'description' => 'Autentica um utilizador e retorna o respetivo API Token.',
                        // Rota pública: não exige token.
                        'security'    => [],
                        'responses'   => [
                            '200' => ['description' => 'Autenticado com sucesso.'],
                            '401' => ['description' => 'Credenciais inválidas.'],
                        ],
                    ],
                ],
                '/tickets' => [
                    'get' => [
                        'summary'     => 'Listar tickets',
                        // A visibilidade dos tickets depende do papel do utilizador autenticado.
                        'description' => 'Retorna a lista de todos os tickets associados ou geridos conforme o perfil do utilizador.',
                        'responses'   => [
                            '200' => ['description' => 'Lista de tickets obtida com sucesso.'],
                            '401' => ['description' => 'Não autenticado.'],
                        ],
                    ],
                    'post' => [
                        'summary'     => 'Criar ticket',
                        'description' => 'Regista uma nova avaria no sistema (exclusivo para utilizadores comuns).',
                        'responses'   => [
                            '201' => ['description' => 'Ticket criado com sucesso.'],
                            '422' => ['description' => 'Erro de validação dos dados fornecidos.'],
                        ],
                    ],
                ],
                '/analytics/stats' => [
                    'get' => [
                        'summary'     => 'Obter métricas e estatísticas',
                        'description' => 'Retorna os indicadores de performance (KPIs) relativos aos tempos de resolução e volumes de tickets.',
                        'responses'   => [
                            '200' => ['description' => 'Métricas calculadas com sucesso.'],
                            '401' => ['description' => 'Não autenticado.'],
                            '403' => ['description' => 'Acesso proibido para o perfil atual.'],
                        ],
                    ],
                ],
            ],
        ];

        return response()->json($spec);
    }
}
