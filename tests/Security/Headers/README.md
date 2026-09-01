# Headers — Testes

## Descrição da Pasta
Testes dedicados à garantia de segurança da informação (OWASP Top 10), incluindo proteção contra XSS, SQL Injection, CSRF, IDOR, Privilege Escalation, Rate Limiting e força bruta.

### Módulos e Ficheiros de Teste

- **`SecurityHeadersTest`** (`tests/Security/Headers/SecurityHeadersTest.php`): Valida os cenários e fluxos correspondentes a SecurityHeadersTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Security/Headers
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Security/Headers --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Security/Headers --coverage
```