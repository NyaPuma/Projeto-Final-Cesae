<?php

declare(strict_types=1);

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Info(
    title: 'Gestão de Avarias API',
    version: '1.0.0',
    description: 'Documentação OpenAPI da aplicação de gestão de tickets, equipamentos, auditoria e relatórios.',
    contact: new OA\Contact(
        name: 'Departamento de Manutenção e TI',
        email: 'suporte@manutencao.local'
    )
)]
#[OA\Server(
    url: '/api',
    description: 'Servidor Principal da API'
)]
#[OA\SecurityScheme(
    securityScheme: 'X-Auth-Token',
    type: 'apiKey',
    in: 'header',
    name: 'X-Auth-Token',
    description: 'Token de autenticação personalizado baseado em cabeçalho'
)]
#[OA\SecurityScheme(
    securityScheme: 'BearerAuth',
    type: 'http',
    scheme: 'bearer',
    bearerFormat: 'JWT',
    description: 'Autenticação baseada em Token JWT'
)]
#[OA\Tag(
    name: 'Tickets',
    description: 'Gestão, histórico, estados e comentários de chamados de manutenção'
)]
#[OA\Tag(
    name: 'Users',
    description: 'Gestão de utilizadores, perfis e autenticação'
)]
#[OA\Tag(
    name: 'Attachments',
    description: 'Gestão e upload de anexos de ficheiros'
)]
#[OA\Tag(
    name: 'Analytics',
    description: 'Relatórios e métricas de desempenho de manutenção'
)]
final class OpenApiSpec
{
    // Esta classe serve apenas como contentor para as anotações globais da especificação OpenAPI.
}
