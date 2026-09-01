# Unit — Testes

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
- **`BroadcastsTicketStatusTest`** (`tests/Unit/Concerns/BroadcastsTicketStatusTest.php`): Valida os cenários e fluxos correspondentes a BroadcastsTicketStatusTest.
- **`TelemetryCommandTest`** (`tests/Unit/Console/TelemetryCommandTest.php`): Valida os cenários e fluxos correspondentes a TelemetryCommandTest.
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
- **`TicketStatusChangedTest`** (`tests/Unit/Events/TicketStatusChangedTest.php`): Valida os cenários e fluxos correspondentes a TicketStatusChangedTest.
- **`TicketStatusUpdatedBroadcastTest`** (`tests/Unit/Events/TicketStatusUpdatedBroadcastTest.php`): Valida os cenários e fluxos correspondentes a TicketStatusUpdatedBroadcastTest.
- **`TicketsExportTest`** (`tests/Unit/Exports/TicketsExportTest.php`): Valida os cenários e fluxos correspondentes a TicketsExportTest.
- **`ResourcesTest`** (`tests/Unit/Http/Resources/ResourcesTest.php`): Valida os cenários e fluxos correspondentes a ResourcesTest.
- **`ExportJobsTest`** (`tests/Unit/Jobs/ExportJobsTest.php`): Valida os cenários e fluxos correspondentes a ExportJobsTest.
- **`ExportReportPdfJobsTest`** (`tests/Unit/Jobs/ExportReportPdfJobsTest.php`): Valida os cenários e fluxos correspondentes a ExportReportPdfJobsTest.
- **`GenerateAiRecommendationJobTest`** (`tests/Unit/Jobs/GenerateAiRecommendationJobTest.php`): Valida os cenários e fluxos correspondentes a GenerateAiRecommendationJobTest.
- **`LogTicketStatusChangeTest`** (`tests/Unit/Listeners/LogTicketStatusChangeTest.php`): Valida os cenários e fluxos correspondentes a LogTicketStatusChangeTest.
- **`LogTicketWorkflowChangeTest`** (`tests/Unit/Listeners/LogTicketWorkflowChangeTest.php`): Valida os cenários e fluxos correspondentes a LogTicketWorkflowChangeTest.
- **`NotifyAssignedTechnicianTest`** (`tests/Unit/Listeners/NotifyAssignedTechnicianTest.php`): Valida os cenários e fluxos correspondentes a NotifyAssignedTechnicianTest.
- **`MailablesTest`** (`tests/Unit/Mail/MailablesTest.php`): Valida os cenários e fluxos correspondentes a MailablesTest.
- **`SecurityHeadersTest`** (`tests/Unit/Middleware/SecurityHeadersTest.php`): Valida os cenários e fluxos correspondentes a SecurityHeadersTest.
- **`SetLocaleMiddlewareTest`** (`tests/Unit/Middleware/SetLocaleMiddlewareTest.php`): Valida os cenários e fluxos correspondentes a SetLocaleMiddlewareTest.
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
- **`ObserversTest`** (`tests/Unit/Observers/ObserversTest.php`): Valida os cenários e fluxos correspondentes a ObserversTest.
- **`AccessPoliciesTest`** (`tests/Unit/Policies/AccessPoliciesTest.php`): Valida os cenários e fluxos correspondentes a AccessPoliciesTest.
- **`TicketPolicyTest`** (`tests/Unit/Policies/TicketPolicyTest.php`): Valida os cenários e fluxos correspondentes a TicketPolicyTest.
- **`PreferenciasServiceTest`** (`tests/Unit/PreferenciasServiceTest.php`): Valida os cenários e fluxos correspondentes a PreferenciasServiceTest.
- **`ProvidersTest`** (`tests/Unit/Providers/ProvidersTest.php`): Valida os cenários e fluxos correspondentes a ProvidersTest.
- **`RepositoriesTest`** (`tests/Unit/Repositories/RepositoriesTest.php`): Valida os cenários e fluxos correspondentes a RepositoriesTest.
- **`AIServiceTest`** (`tests/Unit/Services/AIServiceTest.php`): Valida os cenários e fluxos correspondentes a AIServiceTest.
- **`AnalyticsDashboardServiceTest`** (`tests/Unit/Services/AnalyticsDashboardServiceTest.php`): Valida os cenários e fluxos correspondentes a AnalyticsDashboardServiceTest.
- **`AnalyticsExportServiceTest`** (`tests/Unit/Services/AnalyticsExportServiceTest.php`): Valida os cenários e fluxos correspondentes a AnalyticsExportServiceTest.
- **`AnalyticsServiceTest`** (`tests/Unit/Services/AnalyticsServiceTest.php`): Valida os cenários e fluxos correspondentes a AnalyticsServiceTest.
- **`BudgetCalculatorServiceTest`** (`tests/Unit/Services/BudgetCalculatorServiceTest.php`): Valida os cenários e fluxos correspondentes a BudgetCalculatorServiceTest.
- **`BudgetNotificationServiceTest`** (`tests/Unit/Services/BudgetNotificationServiceTest.php`): Valida os cenários e fluxos correspondentes a BudgetNotificationServiceTest.
- **`CalendarServiceTest`** (`tests/Unit/Services/CalendarServiceTest.php`): Valida os cenários e fluxos correspondentes a CalendarServiceTest.
- **`CircuitBreakerTest`** (`tests/Unit/Services/CircuitBreakerTest.php`): Valida os cenários e fluxos correspondentes a CircuitBreakerTest.
- **`EquipmentServiceTest`** (`tests/Unit/Services/EquipmentServiceTest.php`): Valida os cenários e fluxos correspondentes a EquipmentServiceTest.
- **`FeatureFlagServiceTest`** (`tests/Unit/Services/FeatureFlagServiceTest.php`): Valida os cenários e fluxos correspondentes a FeatureFlagServiceTest.
- **`LocaleServiceTest`** (`tests/Unit/Services/LocaleServiceTest.php`): Valida os cenários e fluxos correspondentes a LocaleServiceTest.
- **`LocalizationServiceTest`** (`tests/Unit/Services/LocalizationServiceTest.php`): Valida os cenários e fluxos correspondentes a LocalizationServiceTest.
- **`NotificationCreatorServiceTest`** (`tests/Unit/Services/NotificationCreatorServiceTest.php`): Valida os cenários e fluxos correspondentes a NotificationCreatorServiceTest.
- **`NotificationServiceTest`** (`tests/Unit/Services/NotificationServiceTest.php`): Valida os cenários e fluxos correspondentes a NotificationServiceTest.
- **`PartPriceCalculatorTest`** (`tests/Unit/Services/PartPriceCalculatorTest.php`): Valida os cenários e fluxos correspondentes a PartPriceCalculatorTest.
- **`PasswordResetServiceTest`** (`tests/Unit/Services/PasswordResetServiceTest.php`): Valida os cenários e fluxos correspondentes a PasswordResetServiceTest.
- **`ServicesTest`** (`tests/Unit/Services/ServicesTest.php`): Valida os cenários e fluxos correspondentes a ServicesTest.
- **`StockServicesTest`** (`tests/Unit/Services/StockServicesTest.php`): Valida os cenários e fluxos correspondentes a StockServicesTest.
- **`SystemSettingsServiceTest`** (`tests/Unit/Services/SystemSettingsServiceTest.php`): Valida os cenários e fluxos correspondentes a SystemSettingsServiceTest.
- **`TechnicianAssignmentServiceTest`** (`tests/Unit/Services/TechnicianAssignmentServiceTest.php`): Valida os cenários e fluxos correspondentes a TechnicianAssignmentServiceTest.
- **`ThemePresetServiceTest`** (`tests/Unit/Services/ThemePresetServiceTest.php`): Valida os cenários e fluxos correspondentes a ThemePresetServiceTest.
- **`TicketNotificationServiceTest`** (`tests/Unit/Services/TicketNotificationServiceTest.php`): Valida os cenários e fluxos correspondentes a TicketNotificationServiceTest.
- **`TicketSearchServiceTest`** (`tests/Unit/Services/TicketSearchServiceTest.php`): Valida os cenários e fluxos correspondentes a TicketSearchServiceTest.
- **`AuditableTraitTest`** (`tests/Unit/Traits/AuditableTraitTest.php`): Valida os cenários e fluxos correspondentes a AuditableTraitTest.
- **`BudgetPauseMinutesTest`** (`tests/Unit/ValueObjects/BudgetPauseMinutesTest.php`): Valida os cenários e fluxos correspondentes a BudgetPauseMinutesTest.
- **`EmailTest`** (`tests/Unit/ValueObjects/EmailTest.php`): Valida os cenários e fluxos correspondentes a EmailTest.
- **`MoneyTest`** (`tests/Unit/ValueObjects/MoneyTest.php`): Valida os cenários e fluxos correspondentes a MoneyTest.
- **`SerialNumberTest`** (`tests/Unit/ValueObjects/SerialNumberTest.php`): Valida os cenários e fluxos correspondentes a SerialNumberTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Unit
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Unit --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Unit --coverage
```