# Listeners — Testes

## Descrição da Pasta
Testes unitários isolados para validação atómica de componentes, classes de domínio, Actions, DTOs, Enums, Models, Services e Jobs sem dependências externas.

### Módulos e Ficheiros de Teste

- **`LogTicketStatusChangeTest`** (`tests/Unit/Listeners/LogTicketStatusChangeTest.php`): Valida os cenários e fluxos correspondentes a LogTicketStatusChangeTest.
- **`LogTicketWorkflowChangeTest`** (`tests/Unit/Listeners/LogTicketWorkflowChangeTest.php`): Valida os cenários e fluxos correspondentes a LogTicketWorkflowChangeTest.
- **`NotifyAssignedTechnicianTest`** (`tests/Unit/Listeners/NotifyAssignedTechnicianTest.php`): Valida os cenários e fluxos correspondentes a NotifyAssignedTechnicianTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Unit/Listeners
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Unit/Listeners --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Unit/Listeners --coverage
```