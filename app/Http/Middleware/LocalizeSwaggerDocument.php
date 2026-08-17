<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Localiza os campos humanos do documento OpenAPI no locale atual.
 * Paths, operationIds, schemas, propriedades e valores técnicos permanecem
 * estáveis para não quebrar clientes nem exemplos da API.
 */
final class LocalizeSwaggerDocument
{
    /** @var list<string> */
    private const TRANSLATABLE_FIELDS = [
        'title',
        'summary',
        'description',
    ];

    /** @var array<string, string> strings-fonte do OpenApiSpec → domínio */
    private const SOURCE_DOMAINS = [
        'Gestão de Avarias API' => 'common',
        'Documentação OpenAPI da aplicação de gestão de tickets, equipamentos, auditoria e relatórios.' => 'tickets',
        'Servidor Principal da API' => 'common',
        'Token de autenticação personalizado baseado em cabeçalho' => 'auth',
        'Autenticação baseada em Token JWT' => 'auth',
        'Catálogo de peças, fornecedores, movimentos de stock, dashboard e relatórios' => 'stock',
        'Gestão administrativa de peças, fornecedores, taxas de IVA, categorias e planos de manutenção' => 'stock',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (! str_ends_with($request->path(), 'docs/openapi-json')) {
            return $response;
        }

        $document = json_decode($response->getContent(), true);
        if (is_array($document)) {
            $this->translateFields($document);
            $response->setContent(json_encode($document, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            $response->headers->set('Content-Type', 'application/json');
        }

        return $response;
    }

    /** @param array<string|int, mixed> $node */
    private function translateFields(array &$node): void
    {
        foreach ($node as $key => &$value) {
            if (is_array($value)) {
                $this->translateFields($value);
                continue;
            }

            if (is_string($value) && in_array((string) $key, self::TRANSLATABLE_FIELDS, true)) {
                $domain = self::SOURCE_DOMAINS[$value] ?? null;
                $value = $domain !== null ? __($domain . '.' . $value) : $value;
            }
        }
    }
}
