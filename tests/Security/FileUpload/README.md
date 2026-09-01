# FileUpload — Testes

## Descrição da Pasta
Testes dedicados à garantia de segurança da informação (OWASP Top 10), incluindo proteção contra XSS, SQL Injection, CSRF, IDOR, Privilege Escalation, Rate Limiting e força bruta.

### Módulos e Ficheiros de Teste

- **`FileUploadSecurityTest`** (`tests/Security/FileUpload/FileUploadSecurityTest.php`): Valida os cenários e fluxos correspondentes a FileUploadSecurityTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Security/FileUpload
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Security/FileUpload --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Security/FileUpload --coverage
```