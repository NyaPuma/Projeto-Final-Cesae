<?php

declare(strict_types=1);

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Info(
    title: 'Fault Management API',
    version: '1.0.0',
    description: 'OpenAPI documentation for the ticket, equipment, audit, and reporting management application.',
    contact: new OA\Contact(
        name: 'Maintenance and IT Department',
        email: 'suporte@manutencao.local'
    )
)]
#[OA\Server(
    url: '/api',
    description: 'Main API Server'
)]
#[OA\SecurityScheme(
    securityScheme: 'X-Auth-Token',
    type: 'apiKey',
    in: 'header',
    name: 'X-Auth-Token',
    description: 'Custom header-based authentication token'
)]
#[OA\SecurityScheme(
    securityScheme: 'BearerAuth',
    type: 'http',
    scheme: 'bearer',
    bearerFormat: 'JWT',
    description: 'JWT token based authentication'
)]
#[OA\Tag(
    name: 'Tickets',
    description: 'Ticket management, history, statuses and comments'
)]
#[OA\Tag(
    name: 'Users',
    description: 'User management, profiles and authentication'
)]
#[OA\Tag(
    name: 'Attachments',
    description: 'File attachment management and upload'
)]
#[OA\Tag(
    name: 'Analytics',
    description: 'Maintenance performance reports and metrics'
)]
#[OA\Tag(
    name: 'Stock',
    description: 'Parts catalogue, suppliers, stock movements, dashboard and reports'
)]
#[OA\Tag(
    name: 'Admin Stock',
    description: 'Administrative management of parts, suppliers, VAT rates, categories and maintenance plans'
)]
final class OpenApiSpec
{
    // This class serves only as a container for the global OpenAPI specification annotations.
}
