# XSS — Testes

## Descrição da Pasta
Testes dedicados à garantia de segurança da informação (OWASP Top 10), incluindo proteção contra XSS, SQL Injection, CSRF, IDOR, Privilege Escalation, Rate Limiting e força bruta.

### Módulos e Ficheiros de Teste

- **`SecurityInputValidationTest`** (`tests/Security/XSS/SecurityInputValidationTest.php`): Valida os cenários e fluxos correspondentes a SecurityInputValidationTest.
- **`XSSProtectionTest`** (`tests/Security/XSS/XSSProtectionTest.php`): Valida os cenários e fluxos correspondentes a XSSProtectionTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Security/XSS
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Security/XSS --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Security/XSS --coverage
```