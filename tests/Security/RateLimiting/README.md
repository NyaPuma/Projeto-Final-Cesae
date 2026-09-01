# RateLimiting — Testes

## Descrição da Pasta
Testes dedicados à garantia de segurança da informação (OWASP Top 10), incluindo proteção contra XSS, SQL Injection, CSRF, IDOR, Privilege Escalation, Rate Limiting e força bruta.

### Módulos e Ficheiros de Teste

- **`RateLimitingTest`** (`tests/Security/RateLimiting/RateLimitingTest.php`): Valida os cenários e fluxos correspondentes a RateLimitingTest.
- **`SecurityBruteForceTest`** (`tests/Security/RateLimiting/SecurityBruteForceTest.php`): Valida os cenários e fluxos correspondentes a SecurityBruteForceTest.
- **`SecurityRateLimitTest`** (`tests/Security/RateLimiting/SecurityRateLimitTest.php`): Valida os cenários e fluxos correspondentes a SecurityRateLimitTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Security/RateLimiting
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Security/RateLimiting --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Security/RateLimiting --coverage
```