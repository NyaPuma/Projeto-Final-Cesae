# IDOR — Testes

## Descrição da Pasta
Testes dedicados à garantia de segurança da informação (OWASP Top 10), incluindo proteção contra XSS, SQL Injection, CSRF, IDOR, Privilege Escalation, Rate Limiting e força bruta.

### Módulos e Ficheiros de Teste

- **`IDORTest`** (`tests/Security/IDOR/IDORTest.php`): Valida os cenários e fluxos correspondentes a IDORTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Security/IDOR
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Security/IDOR --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Security/IDOR --coverage
```