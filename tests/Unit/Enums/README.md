# Enums — Testes

## Descrição da Pasta
Testes unitários isolados para validação atómica de componentes, classes de domínio, Actions, DTOs, Enums, Models, Services e Jobs sem dependências externas.

### Módulos e Ficheiros de Teste

- **`AuditEventEnumTest`** (`tests/Unit/Enums/AuditEventEnumTest.php`): Valida os cenários e fluxos correspondentes a AuditEventEnumTest.
- **`BudgetDecisionEnumTest`** (`tests/Unit/Enums/BudgetDecisionEnumTest.php`): Valida os cenários e fluxos correspondentes a BudgetDecisionEnumTest.
- **`BudgetStatusEnumTest`** (`tests/Unit/Enums/BudgetStatusEnumTest.php`): Valida os cenários e fluxos correspondentes a BudgetStatusEnumTest.
- **`FileTypeEnumTest`** (`tests/Unit/Enums/FileTypeEnumTest.php`): Valida os cenários e fluxos correspondentes a FileTypeEnumTest.
- **`NotificationPriorityEnumTest`** (`tests/Unit/Enums/NotificationPriorityEnumTest.php`): Valida os cenários e fluxos correspondentes a NotificationPriorityEnumTest.
- **`NotificationTypeEnumTest`** (`tests/Unit/Enums/NotificationTypeEnumTest.php`): Valida os cenários e fluxos correspondentes a NotificationTypeEnumTest.
- **`TicketPriorityEnumTest`** (`tests/Unit/Enums/TicketPriorityEnumTest.php`): Valida os cenários e fluxos correspondentes a TicketPriorityEnumTest.
- **`TicketStatusEnumTest`** (`tests/Unit/Enums/TicketStatusEnumTest.php`): Valida os cenários e fluxos correspondentes a TicketStatusEnumTest.
- **`TicketWorkflowStatusEnumTest`** (`tests/Unit/Enums/TicketWorkflowStatusEnumTest.php`): Valida os cenários e fluxos correspondentes a TicketWorkflowStatusEnumTest.
- **`UserRoleEnumTest`** (`tests/Unit/Enums/UserRoleEnumTest.php`): Valida os cenários e fluxos correspondentes a UserRoleEnumTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Unit/Enums
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Unit/Enums --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Unit/Enums --coverage
```