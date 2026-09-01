# Actions — Testes

## Descrição da Pasta
Testes unitários isolados para validação atómica de componentes, classes de domínio, Actions, DTOs, Enums, Models, Services e Jobs sem dependências externas.

### Módulos e Ficheiros de Teste

- **`ApproveBudgetActionTest`** (`tests/Unit/Actions/ApproveBudgetActionTest.php`): Valida os cenários e fluxos correspondentes a ApproveBudgetActionTest.
- **`AssignTechnicianActionTest`** (`tests/Unit/Actions/AssignTechnicianActionTest.php`): Valida os cenários e fluxos correspondentes a AssignTechnicianActionTest.
- **`CreateEquipmentActionTest`** (`tests/Unit/Actions/CreateEquipmentActionTest.php`): Valida os cenários e fluxos correspondentes a CreateEquipmentActionTest.
- **`CreatePreventiveTicketActionTest`** (`tests/Unit/Actions/CreatePreventiveTicketActionTest.php`): Valida os cenários e fluxos correspondentes a CreatePreventiveTicketActionTest.
- **`CreateRoomActionTest`** (`tests/Unit/Actions/CreateRoomActionTest.php`): Valida os cenários e fluxos correspondentes a CreateRoomActionTest.
- **`PartActionsTest`** (`tests/Unit/Actions/PartActionsTest.php`): Valida os cenários e fluxos correspondentes a PartActionsTest.
- **`PartCategoryActionsTest`** (`tests/Unit/Actions/PartCategoryActionsTest.php`): Valida os cenários e fluxos correspondentes a PartCategoryActionsTest.
- **`ScheduleMaintenanceActionTest`** (`tests/Unit/Actions/ScheduleMaintenanceActionTest.php`): Valida os cenários e fluxos correspondentes a ScheduleMaintenanceActionTest.
- **`ScheduleTicketActionTest`** (`tests/Unit/Actions/ScheduleTicketActionTest.php`): Valida os cenários e fluxos correspondentes a ScheduleTicketActionTest.
- **`SubmitBudgetActionTest`** (`tests/Unit/Actions/SubmitBudgetActionTest.php`): Valida os cenários e fluxos correspondentes a SubmitBudgetActionTest.
- **`SupplierActionsTest`** (`tests/Unit/Actions/SupplierActionsTest.php`): Valida os cenários e fluxos correspondentes a SupplierActionsTest.
- **`TaxRateActionsTest`** (`tests/Unit/Actions/TaxRateActionsTest.php`): Valida os cenários e fluxos correspondentes a TaxRateActionsTest.
- **`UpdateEquipmentActionTest`** (`tests/Unit/Actions/UpdateEquipmentActionTest.php`): Valida os cenários e fluxos correspondentes a UpdateEquipmentActionTest.
- **`UpdateRoomActionTest`** (`tests/Unit/Actions/UpdateRoomActionTest.php`): Valida os cenários e fluxos correspondentes a UpdateRoomActionTest.
- **`UpdateUserActionTest`** (`tests/Unit/Actions/UpdateUserActionTest.php`): Valida os cenários e fluxos correspondentes a UpdateUserActionTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Unit/Actions
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Unit/Actions --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Unit/Actions --coverage
```