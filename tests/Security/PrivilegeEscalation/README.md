# PrivilegeEscalation — Testes

## Descrição da Pasta
Testes dedicados à garantia de segurança da informação (OWASP Top 10), incluindo proteção contra XSS, SQL Injection, CSRF, IDOR, Privilege Escalation, Rate Limiting e força bruta.

### Módulos e Ficheiros de Teste

- **`PrivilegeEscalationTest`** (`tests/Security/PrivilegeEscalation/PrivilegeEscalationTest.php`): Valida os cenários e fluxos correspondentes a PrivilegeEscalationTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Security/PrivilegeEscalation
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Security/PrivilegeEscalation --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Security/PrivilegeEscalation --coverage
```