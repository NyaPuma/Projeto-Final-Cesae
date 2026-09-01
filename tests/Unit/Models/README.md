# Models — Testes

## Descrição da Pasta
Testes unitários isolados para validação atómica de componentes, classes de domínio, Actions, DTOs, Enums, Models, Services e Jobs sem dependências externas.

### Módulos e Ficheiros de Teste

- **`AuditTest`** (`tests/Unit/Models/AuditTest.php`): Valida os cenários e fluxos correspondentes a AuditTest.
- **`CategoryTest`** (`tests/Unit/Models/CategoryTest.php`): Valida os cenários e fluxos correspondentes a CategoryTest.
- **`EquipmentCategoryTest`** (`tests/Unit/Models/EquipmentCategoryTest.php`): Valida os cenários e fluxos correspondentes a EquipmentCategoryTest.
- **`EquipmentTest`** (`tests/Unit/Models/EquipmentTest.php`): Valida os cenários e fluxos correspondentes a EquipmentTest.
- **`ModelAccessorsTest`** (`tests/Unit/Models/ModelAccessorsTest.php`): Valida os cenários e fluxos correspondentes a ModelAccessorsTest.
- **`NotificationModelTest`** (`tests/Unit/Models/NotificationModelTest.php`): Valida os cenários e fluxos correspondentes a NotificationModelTest.
- **`RoomTest`** (`tests/Unit/Models/RoomTest.php`): Valida os cenários e fluxos correspondentes a RoomTest.
- **`TicketAttachmentTest`** (`tests/Unit/Models/TicketAttachmentTest.php`): Valida os cenários e fluxos correspondentes a TicketAttachmentTest.
- **`TicketAttributesTest`** (`tests/Unit/Models/TicketAttributesTest.php`): Valida os cenários e fluxos correspondentes a TicketAttributesTest.
- **`TicketCommentTest`** (`tests/Unit/Models/TicketCommentTest.php`): Valida os cenários e fluxos correspondentes a TicketCommentTest.
- **`TicketStatusTest`** (`tests/Unit/Models/TicketStatusTest.php`): Valida os cenários e fluxos correspondentes a TicketStatusTest.
- **`TicketTypeTest`** (`tests/Unit/Models/TicketTypeTest.php`): Valida os cenários e fluxos correspondentes a TicketTypeTest.
- **`TicketWorkflowHistoryTest`** (`tests/Unit/Models/TicketWorkflowHistoryTest.php`): Valida os cenários e fluxos correspondentes a TicketWorkflowHistoryTest.
- **`TicketWorkflowTest`** (`tests/Unit/Models/TicketWorkflowTest.php`): Valida os cenários e fluxos correspondentes a TicketWorkflowTest.
- **`UserProfileTest`** (`tests/Unit/Models/UserProfileTest.php`): Valida os cenários e fluxos correspondentes a UserProfileTest.
- **`UserTest`** (`tests/Unit/Models/UserTest.php`): Valida os cenários e fluxos correspondentes a UserTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Unit/Models
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Unit/Models --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Unit/Models --coverage
```