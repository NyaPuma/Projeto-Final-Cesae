# Actions — Testes

## Descrição da Pasta
Testes funcionais e de integração de ponta a ponta (Feature/API/Web) cobrindo ciclo de vida de requisições HTTP, autenticação, autorização, validação de formulários e respostas JSON/Blade.

### Módulos e Ficheiros de Teste

- **`CreateTicketActionTest`** (`tests/Feature/Actions/CreateTicketActionTest.php`): Valida os cenários e fluxos correspondentes a CreateTicketActionTest.
- **`CreateUserActionTest`** (`tests/Feature/Actions/CreateUserActionTest.php`): Valida os cenários e fluxos correspondentes a CreateUserActionTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Feature/Actions
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Feature/Actions --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Feature/Actions --coverage
```