# API — Testes

## Descrição da Pasta
Testes funcionais e de integração de ponta a ponta (Feature/API/Web) cobrindo ciclo de vida de requisições HTTP, autenticação, autorização, validação de formulários e respostas JSON/Blade.

### Módulos e Ficheiros de Teste

- **`ActivityFeedFeatureTest`** (`tests/Feature/API/Controllers/ActivityFeedFeatureTest.php`): Valida os cenários e fluxos correspondentes a ActivityFeedFeatureTest.
- **`AdminCrudFeatureTest`** (`tests/Feature/API/Controllers/AdminCrudFeatureTest.php`): Valida os cenários e fluxos correspondentes a AdminCrudFeatureTest.
- **`AdminManagementTest`** (`tests/Feature/API/Controllers/AdminManagementTest.php`): Valida os cenários e fluxos correspondentes a AdminManagementTest.
- **`AdminUserControllerTest`** (`tests/Feature/API/Controllers/AdminUserControllerTest.php`): Valida os cenários e fluxos correspondentes a AdminUserControllerTest.
- **`AiTriagingFeatureTest`** (`tests/Feature/API/Controllers/AiTriagingFeatureTest.php`): Valida os cenários e fluxos correspondentes a AiTriagingFeatureTest.
- **`AnalyticsFeatureTest`** (`tests/Feature/API/Controllers/AnalyticsFeatureTest.php`): Valida os cenários e fluxos correspondentes a AnalyticsFeatureTest.
- **`ApiAuthTest`** (`tests/Feature/API/Controllers/ApiAuthTest.php`): Valida os cenários e fluxos correspondentes a ApiAuthTest.
- **`AttachmentOperationFeatureTest`** (`tests/Feature/API/Controllers/AttachmentOperationFeatureTest.php`): Valida os cenários e fluxos correspondentes a AttachmentOperationFeatureTest.
- **`AuditEndpointsTest`** (`tests/Feature/API/Controllers/AuditEndpointsTest.php`): Valida os cenários e fluxos correspondentes a AuditEndpointsTest.
- **`AuditFeatureTest`** (`tests/Feature/API/Controllers/AuditFeatureTest.php`): Valida os cenários e fluxos correspondentes a AuditFeatureTest.
- **`BudgetFeatureTest`** (`tests/Feature/API/Controllers/BudgetFeatureTest.php`): Valida os cenários e fluxos correspondentes a BudgetFeatureTest.
- **`CalendarFeatureTest`** (`tests/Feature/API/Controllers/CalendarFeatureTest.php`): Valida os cenários e fluxos correspondentes a CalendarFeatureTest.
- **`CommentOperationFeatureTest`** (`tests/Feature/API/Controllers/CommentOperationFeatureTest.php`): Valida os cenários e fluxos correspondentes a CommentOperationFeatureTest.
- **`EquipmentAndRoomCrudFeatureTest`** (`tests/Feature/API/Controllers/EquipmentAndRoomCrudFeatureTest.php`): Valida os cenários e fluxos correspondentes a EquipmentAndRoomCrudFeatureTest.
- **`ErrorScenarioFeatureTest`** (`tests/Feature/API/Controllers/ErrorScenarioFeatureTest.php`): Valida os cenários e fluxos correspondentes a ErrorScenarioFeatureTest.
- **`NotificationFeatureTest`** (`tests/Feature/API/Controllers/NotificationFeatureTest.php`): Valida os cenários e fluxos correspondentes a NotificationFeatureTest.
- **`NotificationFlowTest`** (`tests/Feature/API/Controllers/NotificationFlowTest.php`): Valida os cenários e fluxos correspondentes a NotificationFlowTest.
- **`PublicTicketFeatureTest`** (`tests/Feature/API/Controllers/PublicTicketFeatureTest.php`): Valida os cenários e fluxos correspondentes a PublicTicketFeatureTest.
- **`QrCodeFeatureTest`** (`tests/Feature/API/Controllers/QrCodeFeatureTest.php`): Valida os cenários e fluxos correspondentes a QrCodeFeatureTest.
- **`StockManagementFeatureTest`** (`tests/Feature/API/Controllers/StockManagementFeatureTest.php`): Valida os cenários e fluxos correspondentes a StockManagementFeatureTest.
- **`SystemSettingsFeatureTest`** (`tests/Feature/API/Controllers/SystemSettingsFeatureTest.php`): Valida os cenários e fluxos correspondentes a SystemSettingsFeatureTest.
- **`ThemeFeatureTest`** (`tests/Feature/API/Controllers/ThemeFeatureTest.php`): Valida os cenários e fluxos correspondentes a ThemeFeatureTest.
- **`TicketAssignmentFeatureTest`** (`tests/Feature/API/Controllers/TicketAssignmentFeatureTest.php`): Valida os cenários e fluxos correspondentes a TicketAssignmentFeatureTest.
- **`TicketAuditLogTest`** (`tests/Feature/API/Controllers/TicketAuditLogTest.php`): Valida os cenários e fluxos correspondentes a TicketAuditLogTest.
- **`TicketAuthorizationFeatureTest`** (`tests/Feature/API/Controllers/TicketAuthorizationFeatureTest.php`): Valida os cenários e fluxos correspondentes a TicketAuthorizationFeatureTest.
- **`TicketOperationsTest`** (`tests/Feature/API/Controllers/TicketOperationsTest.php`): Valida os cenários e fluxos correspondentes a TicketOperationsTest.
- **`TicketPhotoUploadTest`** (`tests/Feature/API/Controllers/TicketPhotoUploadTest.php`): Valida os cenários e fluxos correspondentes a TicketPhotoUploadTest.
- **`TicketScheduleFeatureTest`** (`tests/Feature/API/Controllers/TicketScheduleFeatureTest.php`): Valida os cenários e fluxos correspondentes a TicketScheduleFeatureTest.
- **`TicketSearchTest`** (`tests/Feature/API/Controllers/TicketSearchTest.php`): Valida os cenários e fluxos correspondentes a TicketSearchTest.
- **`TicketWorkflowFeatureTest`** (`tests/Feature/API/Controllers/TicketWorkflowFeatureTest.php`): Valida os cenários e fluxos correspondentes a TicketWorkflowFeatureTest.
- **`SwaggerDocumentationTest`** (`tests/Feature/API/Routing/SwaggerDocumentationTest.php`): Valida os cenários e fluxos correspondentes a SwaggerDocumentationTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Feature/API
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Feature/API --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Feature/API --coverage
```