# PathTraversal — Testes

## Descrição da Pasta
Testes dedicados à garantia de segurança da informação (OWASP Top 10), incluindo proteção contra XSS, SQL Injection, CSRF, IDOR, Privilege Escalation, Rate Limiting e força bruta.

### Módulos e Ficheiros de Teste

- **`PathTraversalTest`** (`tests/Security/PathTraversal/PathTraversalTest.php`): Valida os cenários e fluxos correspondentes a PathTraversalTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Security/PathTraversal
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Security/PathTraversal --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Security/PathTraversal --coverage
```