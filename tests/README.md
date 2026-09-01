# tests — Testes

## Descrição da Pasta
Suite principal de testes automatizados do sistema de Gestão de Avarias (Laravel), compreendendo testes unitários, de integração, funcionais (feature), segurança, performance e banco de dados.

### Módulos e Ficheiros de Teste

- **`AuthEdgeCasesTest`** (`tests/Authentication/AuthEdgeCasesTest.php`): Valida os cenários e fluxos correspondentes a AuthEdgeCasesTest.
- **`AuthenticationTest`** (`tests/Authentication/AuthenticationTest.php`): Valida os cenários e fluxos correspondentes a AuthenticationTest.
- **`AuthFlowTest`** (`tests/Authentication/AuthFlowTest.php`): Valida os cenários e fluxos correspondentes a AuthFlowTest.
- **`LoginFlowTest`** (`tests/Authentication/LoginFlowTest.php`): Valida os cenários e fluxos correspondentes a LoginFlowTest.
- **`PasswordResetFlowTest`** (`tests/Authentication/PasswordResetFlowTest.php`): Valida os cenários e fluxos correspondentes a PasswordResetFlowTest.
- **`UiAuthorizationTest`** (`tests/Authorization/UiAuthorizationTest.php`): Valida os cenários e fluxos correspondentes a UiAuthorizationTest.
- **`AttachmentPersistenceTest`** (`tests/Database/Constraints/AttachmentPersistenceTest.php`): Valida os cenários e fluxos correspondentes a AttachmentPersistenceTest.
- **`AuditTrailTest`** (`tests/Database/Constraints/AuditTrailTest.php`): Valida os cenários e fluxos correspondentes a AuditTrailTest.
- **`BudgetCalculationTest`** (`tests/Database/Constraints/BudgetCalculationTest.php`): Valida os cenários e fluxos correspondentes a BudgetCalculationTest.
- **`CastIntegrityTest`** (`tests/Database/Constraints/CastIntegrityTest.php`): Valida os cenários e fluxos correspondentes a CastIntegrityTest.
- **`ConcurrencyTest`** (`tests/Database/Constraints/ConcurrencyTest.php`): Valida os cenários e fluxos correspondentes a ConcurrencyTest.
- **`DatabaseIntegrityTest`** (`tests/Database/Constraints/DatabaseIntegrityTest.php`): Valida os cenários e fluxos correspondentes a DatabaseIntegrityTest.
- **`DatabaseOptimizationTest`** (`tests/Database/Constraints/DatabaseOptimizationTest.php`): Valida os cenários e fluxos correspondentes a DatabaseOptimizationTest.
- **`ModelLifecycleTest`** (`tests/Database/Constraints/ModelLifecycleTest.php`): Valida os cenários e fluxos correspondentes a ModelLifecycleTest.
- **`NotificationPersistenceTest`** (`tests/Database/Constraints/NotificationPersistenceTest.php`): Valida os cenários e fluxos correspondentes a NotificationPersistenceTest.
- **`RelationshipIntegrityTest`** (`tests/Database/Constraints/RelationshipIntegrityTest.php`): Valida os cenários e fluxos correspondentes a RelationshipIntegrityTest.
- **`TokenIntegrityTest`** (`tests/Database/Constraints/TokenIntegrityTest.php`): Valida os cenários e fluxos correspondentes a TokenIntegrityTest.
- **`WorkflowPersistenceTest`** (`tests/Database/Constraints/WorkflowPersistenceTest.php`): Valida os cenários e fluxos correspondentes a WorkflowPersistenceTest.
- **`DatabaseSchemaValidationTest`** (`tests/Database/Migrations/DatabaseSchemaValidationTest.php`): Valida os cenários e fluxos correspondentes a DatabaseSchemaValidationTest.
- **`ComplianceSeedersTest`** (`tests/Database/Seeders/ComplianceSeedersTest.php`): Valida os cenários e fluxos correspondentes a ComplianceSeedersTest.
- **`CreateTicketActionTest`** (`tests/Feature/Actions/CreateTicketActionTest.php`): Valida os cenários e fluxos correspondentes a CreateTicketActionTest.
- **`CreateUserActionTest`** (`tests/Feature/Actions/CreateUserActionTest.php`): Valida os cenários e fluxos correspondentes a CreateUserActionTest.
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
- **`ConsoleCommandsTest`** (`tests/Feature/Console/ConsoleCommandsTest.php`): Valida os cenários e fluxos correspondentes a ConsoleCommandsTest.
- **`CheckHigherPriorityActionTest`** (`tests/Feature/Domain/CheckHigherPriorityActionTest.php`): Valida os cenários e fluxos correspondentes a CheckHigherPriorityActionTest.
- **`TicketLifecycleActionsTest`** (`tests/Feature/Domain/TicketLifecycleActionsTest.php`): Valida os cenários e fluxos correspondentes a TicketLifecycleActionsTest.
- **`TicketQueriesTest`** (`tests/Feature/Domain/TicketQueriesTest.php`): Valida os cenários e fluxos correspondentes a TicketQueriesTest.
- **`TicketStatusCheckerTest`** (`tests/Feature/Domain/TicketStatusCheckerTest.php`): Valida os cenários e fluxos correspondentes a TicketStatusCheckerTest.
- **`CsrfMiddlewareTest`** (`tests/Feature/Middleware/CsrfMiddlewareTest.php`): Valida os cenários e fluxos correspondentes a CsrfMiddlewareTest.
- **`CustomAuthMiddlewareTest`** (`tests/Feature/Middleware/CustomAuthMiddlewareTest.php`): Valida os cenários e fluxos correspondentes a CustomAuthMiddlewareTest.
- **`MiddlewareAuthTest`** (`tests/Feature/Middleware/MiddlewareAuthTest.php`): Valida os cenários e fluxos correspondentes a MiddlewareAuthTest.
- **`RateLimitMiddlewareTest`** (`tests/Feature/Middleware/RateLimitMiddlewareTest.php`): Valida os cenários e fluxos correspondentes a RateLimitMiddlewareTest.
- **`RoleMiddlewareTest`** (`tests/Feature/Middleware/RoleMiddlewareTest.php`): Valida os cenários e fluxos correspondentes a RoleMiddlewareTest.
- **`SetLocaleMiddlewareTest`** (`tests/Feature/Middleware/SetLocaleMiddlewareTest.php`): Valida os cenários e fluxos correspondentes a SetLocaleMiddlewareTest.
- **`TicketRepositoryTest`** (`tests/Feature/Repositories/TicketRepositoryTest.php`): Valida os cenários e fluxos correspondentes a TicketRepositoryTest.
- **`UserPreferencesTest`** (`tests/Feature/UserPreferencesTest.php`): Valida os cenários e fluxos correspondentes a UserPreferencesTest.
- **`ValidationEdgeCaseTest`** (`tests/Feature/Validation/ValidationEdgeCaseTest.php`): Valida os cenários e fluxos correspondentes a ValidationEdgeCaseTest.
- **`DashboardRedirectTest`** (`tests/Feature/Web/Controllers/DashboardRedirectTest.php`): Valida os cenários e fluxos correspondentes a DashboardRedirectTest.
- **`PageControllerTest`** (`tests/Feature/Web/Controllers/PageControllerTest.php`): Valida os cenários e fluxos correspondentes a PageControllerTest.
- **`PreferencesControllerTest`** (`tests/Feature/Web/Controllers/PreferencesControllerTest.php`): Valida os cenários e fluxos correspondentes a PreferencesControllerTest.
- **`ProfileControllerTest`** (`tests/Feature/Web/Controllers/ProfileControllerTest.php`): Valida os cenários e fluxos correspondentes a ProfileControllerTest.
- **`RegisterControllerTest`** (`tests/Feature/Web/Controllers/RegisterControllerTest.php`): Valida os cenários e fluxos correspondentes a RegisterControllerTest.
- **`RoomControllerTest`** (`tests/Feature/Web/Controllers/RoomControllerTest.php`): Valida os cenários e fluxos correspondentes a RoomControllerTest.
- **`UiControllerTest`** (`tests/Feature/Web/Controllers/UiControllerTest.php`): Valida os cenários e fluxos correspondentes a UiControllerTest.
- **`LocaleControllerTest`** (`tests/Feature/Web/LocaleControllerTest.php`): Valida os cenários e fluxos correspondentes a LocaleControllerTest.
- **`AssetPipelineTest`** (`tests/Feature/Web/Views/AssetPipelineTest.php`): Valida os cenários e fluxos correspondentes a AssetPipelineTest.
- **`DesignSystemComponentsTest`** (`tests/Feature/Web/Views/DesignSystemComponentsTest.php`): Valida os cenários e fluxos correspondentes a DesignSystemComponentsTest.
- **`DesignSystemViewsTest`** (`tests/Feature/Web/Views/DesignSystemViewsTest.php`): Valida os cenários e fluxos correspondentes a DesignSystemViewsTest.
- **`UiUsabilityTest`** (`tests/Feature/Web/Views/UiUsabilityTest.php`): Valida os cenários e fluxos correspondentes a UiUsabilityTest.
- **`BroadcastAndQueueTest`** (`tests/Integration/Broadcasting/BroadcastAndQueueTest.php`): Valida os cenários e fluxos correspondentes a BroadcastAndQueueTest.
- **`ForeignKeyIntegrityTest`** (`tests/Integration/Database/ForeignKeyIntegrityTest.php`): Valida os cenários e fluxos correspondentes a ForeignKeyIntegrityTest.
- **`MassAssignmentProtectionTest`** (`tests/Integration/Database/MassAssignmentProtectionTest.php`): Valida os cenários e fluxos correspondentes a MassAssignmentProtectionTest.
- **`ModelLifecycleTest`** (`tests/Integration/Database/ModelLifecycleTest.php`): Valida os cenários e fluxos correspondentes a ModelLifecycleTest.
- **`RelationshipIntegrityTest`** (`tests/Integration/Database/RelationshipIntegrityTest.php`): Valida os cenários e fluxos correspondentes a RelationshipIntegrityTest.
- **`SoftDeleteTest`** (`tests/Integration/Database/SoftDeleteTest.php`): Valida os cenários e fluxos correspondentes a SoftDeleteTest.
- **`MailgunTestEmailTest`** (`tests/Integration/Mail/MailgunTestEmailTest.php`): Valida os cenários e fluxos correspondentes a MailgunTestEmailTest.
- **`TicketEndpointPerformanceTest`** (`tests/Performance/APIPerformance/TicketEndpointPerformanceTest.php`): Valida os cenários e fluxos correspondentes a TicketEndpointPerformanceTest.
- **`AuthPerformanceTest`** (`tests/Performance/Authentication/AuthPerformanceTest.php`): Valida os cenários e fluxos correspondentes a AuthPerformanceTest.
- **`CachePerformanceTest`** (`tests/Performance/CachePerformance/CachePerformanceTest.php`): Valida os cenários e fluxos correspondentes a CachePerformanceTest.
- **`DashboardPerformanceTest`** (`tests/Performance/Dashboard/DashboardPerformanceTest.php`): Valida os cenários e fluxos correspondentes a DashboardPerformanceTest.
- **`DatabasePerformanceTest`** (`tests/Performance/DatabasePerformance/DatabasePerformanceTest.php`): Valida os cenários e fluxos correspondentes a DatabasePerformanceTest.
- **`LazyLoadingTest`** (`tests/Performance/DatabasePerformance/LazyLoadingTest.php`): Valida os cenários e fluxos correspondentes a LazyLoadingTest.
- **`NPlusOneQueryTest`** (`tests/Performance/DatabasePerformance/NPlusOneQueryTest.php`): Valida os cenários e fluxos correspondentes a NPlusOneQueryTest.
- **`PerformanceAndNPlusOneTest`** (`tests/Performance/DatabasePerformance/PerformanceAndNPlusOneTest.php`): Valida os cenários e fluxos correspondentes a PerformanceAndNPlusOneTest.
- **`QueryCountTest`** (`tests/Performance/DatabasePerformance/QueryCountTest.php`): Valida os cenários e fluxos correspondentes a QueryCountTest.
- **`MemoryPerformanceTest`** (`tests/Performance/MemoryPerformance/MemoryPerformanceTest.php`): Valida os cenários e fluxos correspondentes a MemoryPerformanceTest.
- **`MemoryUsageTest`** (`tests/Performance/MemoryPerformance/MemoryUsageTest.php`): Valida os cenários e fluxos correspondentes a MemoryUsageTest.
- **`ReportPerformanceTest`** (`tests/Performance/ReportsPerformance/ReportPerformanceTest.php`): Valida os cenários e fluxos correspondentes a ReportPerformanceTest.
- **`ScalabilityPerformanceTest`** (`tests/Performance/ScalabilityPerformance/ScalabilityPerformanceTest.php`): Valida os cenários e fluxos correspondentes a ScalabilityPerformanceTest.
- **`SearchPerformanceTest`** (`tests/Performance/SearchPerformance/SearchPerformanceTest.php`): Valida os cenários e fluxos correspondentes a SearchPerformanceTest.
- **`UploadPerformanceTest`** (`tests/Performance/UploadsPerformance/UploadPerformanceTest.php`): Valida os cenários e fluxos correspondentes a UploadPerformanceTest.
- **`APITokenSecurityTest`** (`tests/Security/APITokens/APITokenSecurityTest.php`): Valida os cenários e fluxos correspondentes a APITokenSecurityTest.
- **`AuthenticationSecurityTest`** (`tests/Security/Authentication/AuthenticationSecurityTest.php`): Valida os cenários e fluxos correspondentes a AuthenticationSecurityTest.
- **`SecurityActiveTest`** (`tests/Security/Authentication/SecurityActiveTest.php`): Valida os cenários e fluxos correspondentes a SecurityActiveTest.
- **`SecurityAuthTest`** (`tests/Security/Authentication/SecurityAuthTest.php`): Valida os cenários e fluxos correspondentes a SecurityAuthTest.
- **`AuthorizationSecurityTest`** (`tests/Security/Authorization/AuthorizationSecurityTest.php`): Valida os cenários e fluxos correspondentes a AuthorizationSecurityTest.
- **`CsrfProtectionTest`** (`tests/Security/CSRF/CsrfProtectionTest.php`): Valida os cenários e fluxos correspondentes a CsrfProtectionTest.
- **`SecurityCsrfTest`** (`tests/Security/CSRF/SecurityCsrfTest.php`): Valida os cenários e fluxos correspondentes a SecurityCsrfTest.
- **`FileUploadSecurityTest`** (`tests/Security/FileUpload/FileUploadSecurityTest.php`): Valida os cenários e fluxos correspondentes a FileUploadSecurityTest.
- **`SecurityHeadersTest`** (`tests/Security/Headers/SecurityHeadersTest.php`): Valida os cenários e fluxos correspondentes a SecurityHeadersTest.
- **`IDORTest`** (`tests/Security/IDOR/IDORTest.php`): Valida os cenários e fluxos correspondentes a IDORTest.
- **`MassAssignmentTest`** (`tests/Security/MassAssignment/MassAssignmentTest.php`): Valida os cenários e fluxos correspondentes a MassAssignmentTest.
- **`PasswordSecurityTest`** (`tests/Security/Password/PasswordSecurityTest.php`): Valida os cenários e fluxos correspondentes a PasswordSecurityTest.
- **`SecurityPasswordPolicyTest`** (`tests/Security/Password/SecurityPasswordPolicyTest.php`): Valida os cenários e fluxos correspondentes a SecurityPasswordPolicyTest.
- **`PathTraversalTest`** (`tests/Security/PathTraversal/PathTraversalTest.php`): Valida os cenários e fluxos correspondentes a PathTraversalTest.
- **`PrivilegeEscalationTest`** (`tests/Security/PrivilegeEscalation/PrivilegeEscalationTest.php`): Valida os cenários e fluxos correspondentes a PrivilegeEscalationTest.
- **`RateLimitingTest`** (`tests/Security/RateLimiting/RateLimitingTest.php`): Valida os cenários e fluxos correspondentes a RateLimitingTest.
- **`SecurityBruteForceTest`** (`tests/Security/RateLimiting/SecurityBruteForceTest.php`): Valida os cenários e fluxos correspondentes a SecurityBruteForceTest.
- **`SecurityRateLimitTest`** (`tests/Security/RateLimiting/SecurityRateLimitTest.php`): Valida os cenários e fluxos correspondentes a SecurityRateLimitTest.
- **`SecuritySessionTest`** (`tests/Security/Session/SecuritySessionTest.php`): Valida os cenários e fluxos correspondentes a SecuritySessionTest.
- **`SessionSecurityTest`** (`tests/Security/Session/SessionSecurityTest.php`): Valida os cenários e fluxos correspondentes a SessionSecurityTest.
- **`SecurityVulnerabilitiesTest`** (`tests/Security/SQLInjection/SecurityVulnerabilitiesTest.php`): Valida os cenários e fluxos correspondentes a SecurityVulnerabilitiesTest.
- **`SqlInjectionTest`** (`tests/Security/SQLInjection/SqlInjectionTest.php`): Valida os cenários e fluxos correspondentes a SqlInjectionTest.
- **`SecurityTokenTest`** (`tests/Security/Tokens/SecurityTokenTest.php`): Valida os cenários e fluxos correspondentes a SecurityTokenTest.
- **`TokenSecurityTest`** (`tests/Security/Tokens/TokenSecurityTest.php`): Valida os cenários e fluxos correspondentes a TokenSecurityTest.
- **`UserEnumerationTest`** (`tests/Security/UserEnumeration/UserEnumerationTest.php`): Valida os cenários e fluxos correspondentes a UserEnumerationTest.
- **`SecurityInputValidationTest`** (`tests/Security/XSS/SecurityInputValidationTest.php`): Valida os cenários e fluxos correspondentes a SecurityInputValidationTest.
- **`XSSProtectionTest`** (`tests/Security/XSS/XSSProtectionTest.php`): Valida os cenários e fluxos correspondentes a XSSProtectionTest.
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
php artisan test --testsuite=Feature
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests --coverage
```