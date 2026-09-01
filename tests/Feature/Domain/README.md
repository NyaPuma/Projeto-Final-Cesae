# Domain — Testes

## Descrição da Pasta
Testes funcionais e de integração de ponta a ponta (Feature/API/Web) cobrindo ciclo de vida de requisições HTTP, autenticação, autorização, validação de formulários e respostas JSON/Blade.

### Módulos e Ficheiros de Teste

- **`CheckHigherPriorityActionTest`** (`tests/Feature/Domain/CheckHigherPriorityActionTest.php`): Valida os cenários e fluxos correspondentes a CheckHigherPriorityActionTest.
- **`TicketLifecycleActionsTest`** (`tests/Feature/Domain/TicketLifecycleActionsTest.php`): Valida os cenários e fluxos correspondentes a TicketLifecycleActionsTest.
- **`TicketQueriesTest`** (`tests/Feature/Domain/TicketQueriesTest.php`): Valida os cenários e fluxos correspondentes a TicketQueriesTest.
- **`TicketStatusCheckerTest`** (`tests/Feature/Domain/TicketStatusCheckerTest.php`): Valida os cenários e fluxos correspondentes a TicketStatusCheckerTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Feature/Domain
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Feature/Domain --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Feature/Domain --coverage
```