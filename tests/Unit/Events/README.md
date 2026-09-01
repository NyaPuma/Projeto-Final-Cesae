# Events — Testes

## Descrição da Pasta
Testes unitários isolados para validação atómica de componentes, classes de domínio, Actions, DTOs, Enums, Models, Services e Jobs sem dependências externas.

### Módulos e Ficheiros de Teste

- **`TicketStatusChangedTest`** (`tests/Unit/Events/TicketStatusChangedTest.php`): Valida os cenários e fluxos correspondentes a TicketStatusChangedTest.
- **`TicketStatusUpdatedBroadcastTest`** (`tests/Unit/Events/TicketStatusUpdatedBroadcastTest.php`): Valida os cenários e fluxos correspondentes a TicketStatusUpdatedBroadcastTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Unit/Events
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Unit/Events --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Unit/Events --coverage
```