# SQLInjection — Testes

## Descrição da Pasta
Testes dedicados à garantia de segurança da informação (OWASP Top 10), incluindo proteção contra XSS, SQL Injection, CSRF, IDOR, Privilege Escalation, Rate Limiting e força bruta.

### Módulos e Ficheiros de Teste

- **`SecurityVulnerabilitiesTest`** (`tests/Security/SQLInjection/SecurityVulnerabilitiesTest.php`): Valida os cenários e fluxos correspondentes a SecurityVulnerabilitiesTest.
- **`SqlInjectionTest`** (`tests/Security/SQLInjection/SqlInjectionTest.php`): Valida os cenários e fluxos correspondentes a SqlInjectionTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Security/SQLInjection
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Security/SQLInjection --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Security/SQLInjection --coverage
```