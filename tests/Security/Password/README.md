# Password — Testes

## Descrição da Pasta
Testes dedicados à garantia de segurança da informação (OWASP Top 10), incluindo proteção contra XSS, SQL Injection, CSRF, IDOR, Privilege Escalation, Rate Limiting e força bruta.

### Módulos e Ficheiros de Teste

- **`PasswordSecurityTest`** (`tests/Security/Password/PasswordSecurityTest.php`): Valida os cenários e fluxos correspondentes a PasswordSecurityTest.
- **`SecurityPasswordPolicyTest`** (`tests/Security/Password/SecurityPasswordPolicyTest.php`): Valida os cenários e fluxos correspondentes a SecurityPasswordPolicyTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Security/Password
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Security/Password --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Security/Password --coverage
```