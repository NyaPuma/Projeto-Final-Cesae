# Middleware — Testes

## Descrição da Pasta
Testes funcionais e de integração de ponta a ponta (Feature/API/Web) cobrindo ciclo de vida de requisições HTTP, autenticação, autorização, validação de formulários e respostas JSON/Blade.

### Módulos e Ficheiros de Teste

- **`CsrfMiddlewareTest`** (`tests/Feature/Middleware/CsrfMiddlewareTest.php`): Valida os cenários e fluxos correspondentes a CsrfMiddlewareTest.
- **`CustomAuthMiddlewareTest`** (`tests/Feature/Middleware/CustomAuthMiddlewareTest.php`): Valida os cenários e fluxos correspondentes a CustomAuthMiddlewareTest.
- **`MiddlewareAuthTest`** (`tests/Feature/Middleware/MiddlewareAuthTest.php`): Valida os cenários e fluxos correspondentes a MiddlewareAuthTest.
- **`RateLimitMiddlewareTest`** (`tests/Feature/Middleware/RateLimitMiddlewareTest.php`): Valida os cenários e fluxos correspondentes a RateLimitMiddlewareTest.
- **`RoleMiddlewareTest`** (`tests/Feature/Middleware/RoleMiddlewareTest.php`): Valida os cenários e fluxos correspondentes a RoleMiddlewareTest.
- **`SetLocaleMiddlewareTest`** (`tests/Feature/Middleware/SetLocaleMiddlewareTest.php`): Valida os cenários e fluxos correspondentes a SetLocaleMiddlewareTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Feature/Middleware
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Feature/Middleware --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Feature/Middleware --coverage
```