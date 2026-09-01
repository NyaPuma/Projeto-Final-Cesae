# Session — Testes

## Descrição da Pasta
Testes dedicados à garantia de segurança da informação (OWASP Top 10), incluindo proteção contra XSS, SQL Injection, CSRF, IDOR, Privilege Escalation, Rate Limiting e força bruta.

### Módulos e Ficheiros de Teste

- **`SecuritySessionTest`** (`tests/Security/Session/SecuritySessionTest.php`): Valida os cenários e fluxos correspondentes a SecuritySessionTest.
- **`SessionSecurityTest`** (`tests/Security/Session/SessionSecurityTest.php`): Valida os cenários e fluxos correspondentes a SessionSecurityTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Security/Session
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Security/Session --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Security/Session --coverage
```