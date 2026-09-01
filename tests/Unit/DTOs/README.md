# DTOs — Testes

## Descrição da Pasta
Testes unitários isolados para validação atómica de componentes, classes de domínio, Actions, DTOs, Enums, Models, Services e Jobs sem dependências externas.

### Módulos e Ficheiros de Teste

- **`AssignTechnicianDataTest`** (`tests/Unit/DTOs/AssignTechnicianDataTest.php`): Valida os cenários e fluxos correspondentes a AssignTechnicianDataTest.
- **`BudgetDecisionDataTest`** (`tests/Unit/DTOs/BudgetDecisionDataTest.php`): Valida os cenários e fluxos correspondentes a BudgetDecisionDataTest.
- **`BudgetSubmissionDataTest`** (`tests/Unit/DTOs/BudgetSubmissionDataTest.php`): Valida os cenários e fluxos correspondentes a BudgetSubmissionDataTest.
- **`CloseTicketDataTest`** (`tests/Unit/DTOs/CloseTicketDataTest.php`): Valida os cenários e fluxos correspondentes a CloseTicketDataTest.
- **`CommentDataTest`** (`tests/Unit/DTOs/CommentDataTest.php`): Valida os cenários e fluxos correspondentes a CommentDataTest.
- **`CreateTicketDataTest`** (`tests/Unit/DTOs/CreateTicketDataTest.php`): Valida os cenários e fluxos correspondentes a CreateTicketDataTest.
- **`PasswordChangeDataTest`** (`tests/Unit/DTOs/PasswordChangeDataTest.php`): Valida os cenários e fluxos correspondentes a PasswordChangeDataTest.
- **`ProfileUpdateDataTest`** (`tests/Unit/DTOs/ProfileUpdateDataTest.php`): Valida os cenários e fluxos correspondentes a ProfileUpdateDataTest.
- **`ScheduleTicketDataTest`** (`tests/Unit/DTOs/ScheduleTicketDataTest.php`): Valida os cenários e fluxos correspondentes a ScheduleTicketDataTest.
- **`StoreEquipmentDataTest`** (`tests/Unit/DTOs/StoreEquipmentDataTest.php`): Valida os cenários e fluxos correspondentes a StoreEquipmentDataTest.
- **`StoreRoomDataTest`** (`tests/Unit/DTOs/StoreRoomDataTest.php`): Valida os cenários e fluxos correspondentes a StoreRoomDataTest.
- **`StoreUserDataTest`** (`tests/Unit/DTOs/StoreUserDataTest.php`): Valida os cenários e fluxos correspondentes a StoreUserDataTest.
- **`TicketFiltersTest`** (`tests/Unit/DTOs/TicketFiltersTest.php`): Valida os cenários e fluxos correspondentes a TicketFiltersTest.
- **`UpdateEquipmentDataTest`** (`tests/Unit/DTOs/UpdateEquipmentDataTest.php`): Valida os cenários e fluxos correspondentes a UpdateEquipmentDataTest.
- **`UpdateRoomDataTest`** (`tests/Unit/DTOs/UpdateRoomDataTest.php`): Valida os cenários e fluxos correspondentes a UpdateRoomDataTest.
- **`UpdateUserDataTest`** (`tests/Unit/DTOs/UpdateUserDataTest.php`): Valida os cenários e fluxos correspondentes a UpdateUserDataTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Unit/DTOs
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Unit/DTOs --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Unit/DTOs --coverage
```