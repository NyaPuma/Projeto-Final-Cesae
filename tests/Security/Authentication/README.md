# Authentication — Testes

## Descrição da Pasta
Testes dedicados à garantia de segurança da informação (OWASP Top 10), incluindo proteção contra XSS, SQL Injection, CSRF, IDOR, Privilege Escalation, Rate Limiting e força bruta.

### Módulos e Ficheiros de Teste

- **`AuthenticationSecurityTest`** (`tests/Security/Authentication/AuthenticationSecurityTest.php`): Valida os cenários e fluxos correspondentes a AuthenticationSecurityTest.
- **`SecurityActiveTest`** (`tests/Security/Authentication/SecurityActiveTest.php`): Valida os cenários e fluxos correspondentes a SecurityActiveTest.
- **`SecurityAuthTest`** (`tests/Security/Authentication/SecurityAuthTest.php`): Valida os cenários e fluxos correspondentes a SecurityAuthTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Security/Authentication
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Security/Authentication --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Security/Authentication --coverage
```