# Controllers — Testes

## Descrição da Pasta
Testes funcionais e de integração de ponta a ponta (Feature/API/Web) cobrindo ciclo de vida de requisições HTTP, autenticação, autorização, validação de formulários e respostas JSON/Blade.

### Módulos e Ficheiros de Teste

- **`DashboardRedirectTest`** (`tests/Feature/Web/Controllers/DashboardRedirectTest.php`): Valida os cenários e fluxos correspondentes a DashboardRedirectTest.
- **`PageControllerTest`** (`tests/Feature/Web/Controllers/PageControllerTest.php`): Valida os cenários e fluxos correspondentes a PageControllerTest.
- **`PreferencesControllerTest`** (`tests/Feature/Web/Controllers/PreferencesControllerTest.php`): Valida os cenários e fluxos correspondentes a PreferencesControllerTest.
- **`ProfileControllerTest`** (`tests/Feature/Web/Controllers/ProfileControllerTest.php`): Valida os cenários e fluxos correspondentes a ProfileControllerTest.
- **`RegisterControllerTest`** (`tests/Feature/Web/Controllers/RegisterControllerTest.php`): Valida os cenários e fluxos correspondentes a RegisterControllerTest.
- **`RoomControllerTest`** (`tests/Feature/Web/Controllers/RoomControllerTest.php`): Valida os cenários e fluxos correspondentes a RoomControllerTest.
- **`UiControllerTest`** (`tests/Feature/Web/Controllers/UiControllerTest.php`): Valida os cenários e fluxos correspondentes a UiControllerTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Feature/Web/Controllers
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Feature/Web/Controllers --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Feature/Web/Controllers --coverage
```