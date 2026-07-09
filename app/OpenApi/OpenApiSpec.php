<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Info(
    title: 'Gestão de Avarias API',
    version: '1.0.0',
    description: 'Documentação OpenAPI da aplicação de gestão de tickets, equipamentos, auditoria e relatórios.'
)]
#[OA\Server(url: '/')]
#[OA\SecurityScheme(
    securityScheme: 'X-Auth-Token',
    type: 'apiKey',
    in: 'header',
    name: 'X-Auth-Token'
)]
#[OA\SecurityScheme(
    securityScheme: 'BearerAuth',
    type: 'http',
    scheme: 'bearer',
    bearerFormat: 'JWT'
)]
final class OpenApiSpec
{
}
