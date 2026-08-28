# Codebase Normalization & Documentation Progress

> Total in-scope folders: 184 | Total in-scope files: 917
> Generated: 2026-08-17 12:58:23 UTC

## Summary Checklist by Directory (Ordered by Dependency Hierarchy)

### `app/Enums` (14 files) — DONE (14/14)
- [x] `AuditEventEnum.php`
- [x] `BudgetDecisionEnum.php`
- [x] `BudgetStatusEnum.php`
- [x] `FileTypeEnum.php`
- [x] `MaintenancePlanIntervalTypeEnum.php`
- [x] `NotificationPriorityEnum.php`
- [x] `NotificationTypeEnum.php`
- [x] `PartUnitOfMeasureEnum.php`
- [x] `PublicTicketProblemTypeEnum.php`
- [x] `StockMovementTypeEnum.php`
- [x] `TicketPriorityEnum.php`
- [x] `TicketStatusEnum.php`
- [x] `TicketWorkflowStatusEnum.php`
- [x] `UserRoleEnum.php`
- Folder README: done

### `app/Traits` (1 files) — DONE (1/1)
- [x] `Auditable.php`
- Folder README: done

### `app/Models` (22 files) — DONE (22/22)
- [x] `Audit.php`
- [x] `Equipment.php`
- [x] `EquipmentCategory.php`
- [x] `MaintenancePlan.php`
- [x] `Notification.php`
- [x] `Part.php`
- [x] `PartCategory.php`
- [x] `Room.php`
- [x] `StockMovement.php`
- [x] `Supplier.php`
- [x] `SystemSetting.php`
- [x] `TaxRate.php`
- [x] `ThemeSetting.php`
- [x] `Ticket.php`
- [x] `TicketAttachment.php`
- [x] `TicketComment.php`
- [x] `TicketStatus.php`
- [x] `TicketType.php`
- [x] `TicketWorkflowHistory.php`
- [x] `User.php`
- [x] `UserPreference.php`
- [x] `UserProfile.php`
- Folder README: done

### `app/DTOs` (21 files) — DONE (21/21)
- [x] `AssignTechnicianData.php`
- [x] `BudgetDecisionData.php`
- [x] `BudgetSubmissionData.php`
- [x] `CloseTicketData.php`
- [x] `CommentData.php`
- [x] `CreateTicketData.php`
- [x] `PasswordChangeData.php`
- [x] `ProfileUpdateData.php`
- [x] `ScheduleMaintenanceData.php`
- [x] `ScheduleTicketData.php`
- [x] `StoreEquipmentData.php`
- [x] `StorePartData.php`
- [x] `StoreRoomData.php`
- [x] `StoreSupplierData.php`
- [x] `StoreUserData.php`
- [x] `TicketFilters.php`
- [x] `UpdateEquipmentData.php`
- [x] `UpdatePartData.php`
- [x] `UpdateRoomData.php`
- [x] `UpdateSupplierData.php`
- [x] `UpdateUserData.php`
- Folder README: done

### `app/ValueObjects` (3 files) — DONE (3/3)
- [x] `Email.php` — no changes needed (already English)
- [x] `Money.php` — Portuguese docblocks translated to English
- [x] `SerialNumber.php` — Portuguese docblocks translated to English
- Folder README: done

### `app/Concerns` (1 files) — DONE (1/1)
- [x] `BroadcastsTicketStatus.php`
- Folder README: done

### `app/Actions` (21 files) — DONE (21/21)
- [x] `ApproveBudgetAction.php` — PT comments/strings translated to English
- [x] `AssignTechnicianAction.php` — PT docblock translated
- [x] `CreateEquipmentAction.php` — removed commented-out event stub
- [x] `CreatePartAction.php` — PT comment block translated
- [x] `CreatePreventiveTicketAction.php` — PT exception/description translated, removed event stub
- [x] `CreatePublicTicketAction.php` — PT docblock/exception translated
- [x] `CreateRoomAction.php` — removed commented-out event stub
- [x] `CreateSupplierAction.php` — already clean
- [x] `CreateTicketAction.php` — PT exception translated, removed event stub
- [x] `CreateUserAction.php` — PT comments translated, removed event stub
- [x] `MaintenancePlanActions.php` — PT error message translated
- [x] `PartCategoryActions.php` — already clean
- [x] `ScheduleMaintenanceAction.php` — PT class docblock/exception/priority translated
- [x] `ScheduleTicketAction.php` — PT comments/exceptions translated, removed event stub
- [x] `SubmitBudgetAction.php` — PT comments/exceptions translated, removed event stub
- [x] `TaxRateActions.php` — already clean
- [x] `UpdateEquipmentAction.php` — removed commented-out event stub
- [x] `UpdatePartAction.php` — already clean
- [x] `UpdateRoomAction.php` — removed commented-out event stub
- [x] `UpdateSupplierAction.php` — already clean
- [x] `UpdateUserAction.php` — removed commented-out event stub
- Folder README: done

### `app/Domain/Ticket/Actions` (5 files) — DONE (5/5)
- [x] `CancelTicketAction.php` — PT docblock/comments translated
- [x] `CheckHigherPriorityAction.php` — PT comments removed
- [x] `CloseTicketAction.php` — PT comments removed, event stub removed
- [x] `ReopenTicketAction.php` — PT comments/exception translated, event stub removed
- [x] `StartTicketAction.php` — PT comments/exception translated, event stub removed
- Folder README: done

### `app/Domain/Ticket/Queries` (5 files) — DONE (5/5)
- [x] `MonthlyTicketsQuery.php` — PT comment translated
- [x] `ScheduledEventsQuery.php` — already clean
- [x] `TicketKpiQuery.php` — already clean
- [x] `TicketPriorityQuery.php` — PT comment translated
- [x] `TopEntitiesQuery.php` — already clean (user-facing subtitle strings excluded per §3)
- Folder README: done

### `app/Domain/Ticket/Services` (1 files) — DONE (1/1)
- [x] `TicketStatusChecker.php` — PT docblock translated
- Folder README: done

### `app/Domain/Ticket/ValueObjects` (1 files) — DONE (1/1)
- [x] `BudgetPauseMinutes.php` — PT docblocks/comments translated
- Folder README: done

### `app/Services` (29 files) — DONE (29/29)
- [x] `AIService.php`
- [x] `AnalyticsDashboardService.php`
- [x] `AnalyticsExportService.php`
- [x] `AnalyticsService.php`
- [x] `AuthUserResolver.php`
- [x] `BudgetCalculatorService.php`
- [x] `BudgetNotificationService.php`
- [x] `CalendarService.php`
- [x] `EquipmentService.php`
- [x] `LocaleService.php`
- [x] `LocalizationService.php`
- [x] `LowStockAlertService.php`
- [x] `NotificationCreatorService.php`
- [x] `NotificationService.php`
- [x] `PartPriceCalculator.php`
- [x] `PartService.php`
- [x] `PasswordResetService.php`
- [x] `PreferencesService.php` (renamed from PreferenciasService.php)
- [x] `QrCodeService.php`
- [x] `StockDashboardService.php`
- [x] `StockMovementService.php`
- [x] `SystemSettingsService.php`
- [x] `TechnicianAssignmentService.php`
- [x] `ThemePresetService.php`
- [x] `TicketNotificationService.php`
- [x] `TicketSearchService.php`
- [x] `TicketStatusService.php`
- [x] `TicketWorkflowService.php`
- [x] `UserService.php`
- Folder README: done

### `app/Repositories` (4 files) — DONE (4/4)
- [x] `EquipmentRepository.php` — already clean
- [x] `RoomRepository.php` — already clean
- [x] `TicketRepository.php` — already clean
- [x] `UserRepository.php` — already clean
- Folder README: done

### `app/Repositories/Contracts` (4 files) — DONE (4/4)
- [x] `EquipmentRepositoryInterface.php` — PT docblocks translated
- [x] `RoomRepositoryInterface.php` — PT docblocks translated
- [x] `TicketRepositoryInterface.php` — PT docblocks translated
- [x] `UserRepositoryInterface.php` — PT docblocks translated
- Folder README: done

### `app/Jobs` (8 files) — DONE (8/8)
- [x] `CheckLowStockJob.php` — PT docblock/log messages translated
- [x] `ExportCsvJob.php` — PT docblocks/comments translated; user-facing notification strings left as-is (i18n)
- [x] `ExportEquipmentQrPdfJob.php` — PT docblocks/comments translated; user-facing notification strings left as-is (i18n)
- [x] `ExportExcelJob.php` — PT docblocks/comments translated; user-facing notification strings left as-is (i18n)
- [x] `ExportPdfJob.php` — PT docblocks/comments translated; user-facing notification strings left as-is (i18n)
- [x] `ExportStockCostsPdfJob.php` — PT docblocks/comments translated; user-facing notification strings left as-is (i18n)
- [x] `GenerateAiRecommendationJob.php` — already clean
- [x] `SendTestEmailJob.php` — PT docblocks translated
- Folder README: done

### `app/Listeners` (5 files) — DONE (5/5)
- [x] `LogTicketStatusChange.php` — PT docblocks/comments translated
- [x] `LogTicketWorkflowChange.php` — PT docblocks translated
- [x] `NotifyAssignedTechnician.php` — PT docblocks translated
- [x] `SendTicketCreatedNotification.php` — PT docblocks translated
- [x] `SendTicketStatusNotification.php` — PT docblocks translated
- Folder README: done

### `app/Events` (3 files) — DONE (3/3)
- [x] `TicketCreated.php` — PT docblocks translated
- [x] `TicketStatusChanged.php` — PT docblocks translated
- [x] `TicketStatusUpdatedBroadcast.php` — PT docblocks translated
- Folder README: done

### `app/Mail` (3 files) — DONE (3/3)
- [x] `PasswordResetMail.php` — already clean (subject line is user-facing, i18n domain)
- [x] `TestMail.php` — PT comment translated; subject line is user-facing (i18n)
- [x] `TicketCreated.php` — PT docblocks translated; subject line is user-facing (i18n)
- Folder README: done

### `app/Notifications` (3 files) — DONE (3/3)
- [x] `NewTicketNotification.php` — PT docblocks translated; user-facing notification strings left as-is (i18n)
- [x] `TicketNotification.php` — PT docblocks translated
- [x] `TicketStatusChanged.php` — PT docblocks translated; user-facing notification strings left as-is (i18n)
- Folder README: done

### `app/Observers` (3 files) — DONE (3/3)
- [x] `AuditObserver.php` — PT docblocks/exception messages translated
- [x] `TicketObserver.php` — PT docblock/comments translated
- [x] `UserObserver.php` — PT docblock/comments translated
- Folder README: done

### `app/Policies` (12 files) — DONE (12/12)
- [x] `AuditPolicy.php` — already clean
- [x] `EquipmentPolicy.php` — PT docblocks translated
- [x] `MaintenancePlanPolicy.php` — already clean
- [x] `PartCategoryPolicy.php` — already clean
- [x] `PartPolicy.php` — already clean
- [x] `RoomPolicy.php` — PT docblocks translated
- [x] `StockMovementPolicy.php` — already clean
- [x] `SupplierPolicy.php` — already clean
- [x] `TaxRatePolicy.php` — already clean
- [x] `TicketPolicy.php` — PT docblocks translated (20 methods)
- [x] `UserPolicy.php` — PT docblocks translated
- [x] `UserProfilePolicy.php` — PT docblock translated
- Folder README: done

### `app/Exports` (1 files) — DONE (1/1)
- [x] `TicketsExport.php` — PT docblocks translated; heading labels/title left as-is (i18n)
- Folder README: done

### `app/OpenApi` (1 files) — DONE (1/1)
- [x] `OpenApiSpec.php` — PT class comment translated; OA attribute values left as-is (L5-Swagger / i18n)
- Folder README: done

### `app/Http/Requests` (38 files) — DONE (38/38)
- [x] `AssignTechnicianToTicketRequest.php`
- [x] `BudgetDecisionRequest.php`
- [x] `ChangePasswordRequest.php`
- [x] `CloseTicketRequest.php`
- [x] `CloseTicketSimpleRequest.php`
- [x] `LoginRequest.php`
- [x] `PublicStoreTicketRequest.php`
- [x] `RegisterRequest.php`
- [x] `RequestBudgetRequest.php`
- [x] `RescheduleEventRequest.php`
- [x] `ResetPasswordRequest.php`
- [x] `ScheduleMaintenanceRequest.php`
- [x] `ScheduleTicketRequest.php`
- [x] `SendResetLinkRequest.php`
- [x] `StartTicketRequest.php`
- [x] `StoreCommentRequest.php`
- [x] `StoreEquipmentRequest.php`
- [x] `StoreMaintenancePlanRequest.php`
- [x] `StorePartCategoryRequest.php`
- [x] `StorePartRequest.php`
- [x] `StorePreventiveRequest.php`
- [x] `StoreRoomRequest.php`
- [x] `StoreStockMovementRequest.php`
- [x] `StoreSupplierRequest.php`
- [x] `StoreTaxRateRequest.php`
- [x] `StoreTicketRequest.php`
- [x] `StoreUserRequest.php`
- [x] `SubmitBudgetRequest.php`
- [x] `UpdateEquipmentRequest.php`
- [x] `UpdateMaintenancePlanRequest.php`
- [x] `UpdatePartCategoryRequest.php`
- [x] `UpdatePartRequest.php`
- [x] `UpdateProfileRequest.php`
- [x] `UpdateRoomRequest.php`
- [x] `UpdateSupplierRequest.php`
- [x] `UpdateTaxRateRequest.php`
- [x] `UpdateUserRequest.php`
- [x] `UploadPhotoRequest.php`
- Folder README: done

### `app/Http/Resources` (15 files) — DONE (15/15)
- [x] `AuditResource.php`
- [x] `EquipmentResource.php`
- [x] `MaintenancePlanResource.php`
- [x] `NotificationResource.php`
- [x] `PartCategoryResource.php`
- [x] `PartResource.php`
- [x] `RoomResource.php`
- [x] `StockMovementResource.php`
- [x] `SupplierResource.php`
- [x] `TaxRateResource.php`
- [x] `TicketAttachmentResource.php`
- [x] `TicketCommentResource.php`
- [x] `TicketResource.php`
- [x] `UserProfileResource.php`
- [x] `UserResource.php`
- Folder README: done

### `app/Http/Middleware` (8 files) — DONE (8/8)
- [x] `CsrfMiddleware.php`
- [x] `CustomAuthMiddleware.php`
- [x] `LocalizeSwaggerDocument.php`
- [x] `RateLimitMiddleware.php`
- [x] `RoleMiddleware.php`
- [x] `SecurityHeaders.php`
- [x] `SetLocaleMiddleware.php`
- [x] `SetUserPreferencesMiddleware.php`
- Folder README: done
- Folder README: pending

### `app/Http/Controllers` (35 files) — DONE (35/35)
- [x] `ActivityFeedController.php`
- [x] `AdminController.php`
- [x] `AdminEquipmentController.php`
- [x] `AdminUserController.php`
- [x] `AnalyticsController.php`
- [x] `AuditController.php`
- [x] `AuthController.php`
- [x] `CalendarController.php`
- [x] `Controller.php`
- [x] `LocaleController.php`
- [x] `MaintenancePlanController.php`
- [x] `NotificationController.php`
- [x] `PageController.php`
- [x] `PartCategoryController.php`
- [x] `PartController.php`
- [x] `PasswordResetController.php`
- [x] `PreferencesController.php` (renamed from PreferenciasController.php) — class + file + route refs updated
- [x] `ProfileController.php`
- [x] `PublicTicketController.php`
- [x] `QrCodeController.php`
- [x] `RegisterController.php`
- [x] `RoomController.php`
- [x] `StockDashboardController.php`
- [x] `StockMovementController.php`
- [x] `StockReportController.php`
- [x] `StockUiController.php`
- [x] `SupplierController.php`
- [x] `SystemSettingsController.php`
- [x] `TaxRateController.php`
- [x] `ThemeController.php`
- [x] `TicketAttachmentController.php`
- [x] `TicketBudgetController.php`
- [x] `TicketCommentController.php`
- [x] `TicketController.php`
- [x] `UiController.php`
- Folder README: done

### `app/Http/Controllers/Ticket` (5 files) — DONE (5/5)
- [x] `TicketAssignmentController.php`
- [x] `TicketCloseController.php`
- [x] `TicketLifecycleController.php`
- [x] `TicketScheduleController.php`
- [x] `TicketStartController.php`
- Folder README: done

### `app/Console/Commands` (4 files) — DONE (4/4)
- [x] `DatabaseBackup.php`
- [x] `FixTicketEncoding.php`
- [x] `PartitionAudits.php`
- [x] `SimulateTelemetry.php`
- Folder README: done

### `app/Providers` (2 files) — DONE (2/2)
- [x] `AppServiceProvider.php`
- [x] `EventServiceProvider.php`
- Folder README: done

### `app` (0 files) — DONE (0/0)
- Folder README: done

### `routes` (3 files) — DONE (3/3)
- [x] `api.php`
- [x] `console.php`
- [x] `web.php`
- Folder README: done

### `config` (18 files) — DONE (18/18)
- [x] `app.php`
- [x] `auth.php`
- [x] `backup.php`
- [x] `broadcasting.php`
- [x] `cache.php`
- [x] `database.php`
- [x] `filesystems.php`
- [x] `hashing.php`
- [x] `l5-swagger.php`
- [x] `locales.php`
- [x] `logging.php`
- [x] `mail.php`
- [x] `openai.php`
- [x] `queue.php`
- [x] `sanctum.php`
- [x] `services.custom.php`
- [x] `services.php`
- [x] `session.php`
- Folder README: done

### `database/factories` (16 files) — DONE (16/16)
- [x] `EquipmentCategoryFactory.php`
- [x] `EquipmentFactory.php`
- [x] `MaintenancePlanFactory.php`
- [x] `PartCategoryFactory.php`
- [x] `PartFactory.php`
- [x] `RoomFactory.php`
- [x] `StockMovementFactory.php`
- [x] `SupplierFactory.php`
- [x] `TaxRateFactory.php`
- [x] `TicketAttachmentFactory.php`
- [x] `TicketCommentFactory.php`
- [x] `TicketFactory.php`
- [x] `TicketStatusFactory.php`
- [x] `TicketTypeFactory.php`
- [x] `UserFactory.php`
- [x] `UserProfileFactory.php`
- Folder README: done

### `database/seeders` (12 files) — DONE (12/12)
- [x] `ActivityFeedSeeder.php`
- [x] `BulkOperationalDataSeeder.php`
- [x] `DatabaseSeeder.php`
- [x] `EquipmentCategoriesSeeder.php`
- [x] `EquipmentsSeeder.php`
- [x] `NotificationSeeder.php`
- [x] `RoomsSeeder.php`
- [x] `StockDataSeeder.php`
- [x] `TicketLookupSeeder.php`
- [x] `TicketsSeeder.php`
- [x] `UserProfilesSeeder.php`
- [x] `UsersSeeder.php`
- Folder README: done

### `database/seeders/Data` (2 files) — DONE (2/2)
- [x] `OperationalData.php`
- [x] `TicketDataset.php`
- Folder README: done

### `database/migrations` (25 files) — DONE (25/25)
- [x] `0001_01_01_000000_create_users_table.php`
- [x] `0001_01_01_000001_create_cache_table.php`
- [x] `0001_01_01_000002_create_jobs_table.php`
- [x] `0001_01_01_000003_create_rooms_table.php`
- [x] `0001_01_01_000004_create_equipments_table.php`
- [x] `0001_01_01_000005_create_tickets_table.php`
- [x] `0001_01_01_000006_create_audits_table.php`
- [x] `0001_01_01_000008_create_ticket_attachments_table.php`
- [x] `0001_01_01_000009_create_ticket_comments_table.php`
- [x] `2026_07_09_100000_create_notifications_table.php`
- [x] `2026_07_24_152504_create_audits_append_only_trigger.php`
- [x] `2026_07_31_000001_convert_ticket_tables_to_utf8mb4.php`
- [x] `2026_08_03_000001_add_ai_recommendation_columns_to_tickets_table.php`
- [x] `2026_08_05_000001_create_theme_settings_table.php`
- [x] `2026_08_05_000002_create_system_settings_table.php`
- [x] `2026_08_07_000001_add_reporter_fields_to_tickets_table.php`
- [x] `2026_08_08_000001_create_stock_catalog_tables.php`
- [x] `2026_08_08_000002_create_stock_movements_table.php`
- [x] `2026_08_08_000003_create_maintenance_plans_table.php`
- [x] `2026_08_08_000004_add_low_stock_notification_type.php`
- [x] `2026_08_10_000001_add_locale_to_users_table.php`
- [x] `2026_08_12_000001_create_user_preferences_table.php`
- [x] `2026_08_12_000002_populate_user_preferences.php`
- [x] `2026_08_12_000003_add_number_format_to_user_preferences.php`
- [x] `2026_08_12_000004_add_time_format_to_user_preferences.php`
- Folder README: done

### `database` (0 files) — DONE (0/0)
- Folder README: done

### `bootstrap` (2 files) — DONE (2/2)
- [x] `app.php`
- [x] `providers.php`
- Folder README: done

### `resources/views` (2 files) — DONE (2/2)
- [x] `calendar.blade.php` — translated 4 PT Blade comments to English; i18n strings excluded
- [x] `main.blade.php` — already clean (all strings use `__()`)
- Folder README: done

### `resources/views/components/ui/analytics` (10 files) — DONE (10/10)
- [x] `activity-timeline-card.blade.php` — translated header docblock, 4 Blade comments, 3 inline JS comments to English
- [x] `aside-card.blade.php` — translated header docblock to English
- [x] `aside-pill.blade.php` — translated header docblock to English
- [x] `chart-card.blade.php` — translated header docblock to English
- [x] `equipment-distribution-card.blade.php` — translated header docblock to English; i18n strings excluded
- [x] `export-actions.blade.php` — translated header docblock to English; i18n strings excluded
- [x] `hero.blade.php` — translated header docblock, 3 Blade comments to English; i18n strings excluded
- [x] `list-card.blade.php` — translated header docblock to English
- [x] `metric-card.blade.php` — translated header docblock to English
- [x] `section-heading.blade.php` — translated header docblock to English
- Folder README: done

### `resources/views/components/ui/auth` (6 files) — DONE (6/6)
- [x] `form-header.blade.php` — translated header docblock to English
- [x] `message.blade.php` — translated header docblock to English
- [x] `password-field.blade.php` — translated header docblock + 1 inline comment to English
- [x] `shell.blade.php` — translated header docblock + 3 Blade comments to English
- [x] `submit-button.blade.php` — translated header docblock to English
- [x] `text-field.blade.php` — translated header docblock to English
- Folder README: done

### `resources/views/components/ui/buttons` (3 files) — DONE (3/3)
- [x] `button.blade.php` — translated header docblock to English
- [x] `icon-button.blade.php` — translated header docblock to English
- [x] `submit.blade.php` — translated header docblock to English
- Folder README: done

### `resources/views/components/ui/dashboard` (1 files) — DONE (1/1)
- [x] `welcome-panel.blade.php` — translated header docblock to English
- Folder README: done

### `resources/views/components/ui/form` (5 files) — DONE (5/5)
- [x] `card.blade.php` — translated header docblock to English
- [x] `field.blade.php` — translated header docblock to English
- [x] `input.blade.php` — translated header docblock to English
- [x] `message.blade.php` — translated header docblock to English
- [x] `select.blade.php` — translated header docblock to English
- Folder README: done

### `resources/views/components/ui/listing` (4 files) — DONE (4/4)
- [x] `filter-field.blade.php` — translated header docblock to English
- [x] `filter-panel.blade.php` — translated header docblock to English
- [x] `pagination.blade.php` — translated header docblock to English
- [x] `table-card.blade.php` — translated header docblock to English
- Folder README: done

### `resources/views/components/ui/page-actions` (7 files) — DONE (7/7)
- [x] `action-button.blade.php` — translated header docblock to English
- [x] `back-button.blade.php` — translated header docblock + inline comment
- [x] `base-button.blade.php` — translated header docblock to English
- [x] `base-link.blade.php` — translated header docblock to English
- [x] `create-link.blade.php` — translated header docblock to English
- [x] `export-link.blade.php` — translated header docblock to English
- [x] `group.blade.php` — translated header docblock to English
- Folder README: done

### `resources/views/components/ui/partials` (1 files) — DONE (1/1)
- [x] `page-header.blade.php` — translated header docblock to English
- Folder README: done

### `resources/views/components/ui/profile` (4 files) — DONE (4/4)
- [x] `delete-account-card.blade.php` — translated header docblock to English
- [x] `information-card.blade.php` — translated header docblock to English
- [x] `security-card.blade.php` — translated header docblock to English
- [x] `summary-card.blade.php` — translated header docblock to English
- Folder README: done

### `resources/views/components/ui/text` (2 files) — DONE (2/2)
- [x] `eyebrow.blade.php` — translated header docblock to English
- [x] `pill.blade.php` — translated header docblock to English
- Folder README: done

### `resources/views/emails` (3 files) — DONE (3/3)
- [x] `passwordReset.blade.php` — translated CSS comments and Blade comments to English
- [x] `test-mail.blade.php` — translated CSS comments and Blade comments to English
- [x] `ticketCreated.blade.php` — already clean (no PT comments; match on PT DB values is business logic)
- Folder README: done

### `resources/views/errors` (5 files) — DONE (5/5)
- [x] `402.blade.php` — already clean (only `__()` calls)
- [x] `403.blade.php` — already clean (only `__()` calls)
- [x] `404.blade.php` — already clean (only `__()` calls)
- [x] `500.blade.php` — already clean (only `__()` calls)
- [x] `minimal.blade.php` — translated 5 PT Blade comments to English
- Folder README: done

### `resources/views/layouts` (1 files) — DONE (1/1)
- [x] `layout.blade.php` — already clean (only `__()` calls and `@include` directives)
- Folder README: done

### `resources/views/preferences` (1 files) — DONE (1/1)
- [x] `edit.blade.php` — translated 5 HTML comments and 3 JS comments to English
- Folder README: done

### `resources/views/reports` (3 files) — DONE (3/3)
- [x] `equipments-qr.blade.php` — already clean (no PT comments)
- [x] `stock-costs-by-equipment.blade.php` — already clean (no PT comments)
- [x] `tickets.blade.php` — translated 4 PT CSS section comments to English
- Folder README: done

### `resources/views/ui` (15 files) — DONE (15/15)
- [x] `analytics.blade.php` — already clean
- [x] `audits.blade.php` — translated 3 PT Blade comments
- [x] `auth-reset.blade.php` — already clean
- [x] `auth.blade.php` — already clean
- [x] `equipments.blade.php` — already clean
- [x] `index.blade.php` — already clean
- [x] `layout.blade.php` — translated 4 PT comments (1 JS + 3 Blade)
- [x] `profile.blade.php` — already clean
- [x] `rooms.blade.php` — already clean
- [x] `ticket-create.blade.php` — translated 15 PT Blade comments
- [x] `ticket-detail.blade.php` — already clean
- [x] `tickets.blade.php` — already clean
- [x] `users-create.blade.php` — already clean
- [x] `users-edit.blade.php` — translated 1 PT Blade comment
- [x] `users.blade.php` — translated 3 PT Blade comments
- Folder README: done

### `resources/views/ui/definicoes` (2 files) — DONE (2/2)
- [x] `aparencia.blade.php` — already clean
- [x] `sistema.blade.php` — already clean
- Folder README: done

### `resources/views/ui/equipments` (4 files) — DONE (4/4)
- [x] `create.blade.php` — already clean
- [x] `edit.blade.php` — already clean
- [x] `qr.blade.php` — translated 1 PT Blade comment
- [x] `show.blade.php` — translated 8 PT comments (1 PHP + 7 Blade)
- Folder README: done

### `resources/views/ui/partials` (17 files) — DONE (17/17)
- [x] `background-effects.blade.php` — already clean
- [x] `currency-dropdown.blade.php` — already clean
- [x] `currency-modal.blade.php` — translated PT docblock + 1 PHP comment
- [x] `date-format-dropdown.blade.php` — already clean
- [x] `date-format-modal.blade.php` — translated PT docblock + 2 PHP comments
- [x] `desktop-sidebar.blade.php` — translated 3 PT Blade comments
- [x] `language-dropdown.blade.php` — already clean
- [x] `language-modal.blade.php` — translated PT docblock
- [x] `locale-config.blade.php` — translated 1 PT Blade comment
- [x] `locale-modal.blade.php` — translated PT docblock
- [x] `locale-trigger.blade.php` — already clean
- [x] `localization-modal.blade.php` — translated PT docblock
- [x] `mobile-nav.blade.php` — translated 5 PT Blade comments
- [x] `number-format-dropdown.blade.php` — already clean
- [x] `preferences-dropdowns-js.blade.php` — translated 10 PT JS comments
- [x] `theme-meta.blade.php` — translated PT docblock + 1 PHP comment
- [x] `topbar.blade.php` — already clean
- Folder README: done

### `resources/views/ui/rooms` (3 files) — DONE (3/3)
- [x] `create.blade.php` — already clean
- [x] `edit.blade.php` — already clean
- [x] `show.blade.php` — translated 9 PT comments (1 PHP + 8 Blade)
- Folder README: done

### `resources/views/ui/stock` (7 files) — DONE (7/7)
- [x] `categories.blade.php` — translated 2 PT Blade comments
- [x] `dashboard.blade.php` — translated 4 PT Blade comments
- [x] `movements.blade.php` — translated 1 PT Blade comment
- [x] `parts.blade.php` — already clean
- [x] `plans.blade.php` — translated 1 PT Blade comment
- [x] `suppliers.blade.php` — already clean
- [x] `tax-rates.blade.php` — translated 2 PT Blade comments
- Folder README: done

### `resources/views/ui/stock/parts` (3 files) — DONE (3/3)
- [x] `create.blade.php` — already clean
- [x] `edit.blade.php` — already clean
- [x] `show.blade.php` — translated 4 PT Blade comments
- Folder README: done

### `resources/views/ui/stock/suppliers` (2 files) — DONE (2/2)
- [x] `create.blade.php` — already clean
- [x] `edit.blade.php` — already clean
- Folder README: done

### `resources/views/ui/tickets/public` (2 files) — DONE (2/2)
- [x] `create.blade.php` — translated 9 PT Blade comments
- [x] `success.blade.php` — translated 1 PT Blade comment
- Folder README: done

### `resources/css` (5 files) — DONE (5/5)
- [x] `app.css` — already clean
- [x] `base.css` — translated 3 PT comments
- [x] `layout.css` — already clean
- [x] `rtl.css` — translated 1 PT comment
- [x] `tokens.css` — translated 16 PT comments
- Folder README: done

### `resources/css/components` (6 files) — DONE (6/6)
- [x] `badges.css` — already clean
- [x] `forms.css` — already clean
- [x] `locale-modal.css` — translated 1 PT docblock
- [x] `localization-modal.css` — already clean
- [x] `navigation.css` — translated 2 PT comments
- [x] `sidebar.css` — translated 2 PT comments
- Folder README: done

### `resources/css/components/buttons` (2 files) — DONE (2/2)
- [x] `button-base.css` — already clean
- [x] `button-variants.css` — already clean
- Folder README: done

### `resources/css/components/cards` (1 files) — DONE (1/1)
- [x] `card-base.css` — already clean
- Folder README: done

### `resources/css/pages` (6 files) — DONE (6/6)
- [x] `calendar.css` — translated 17 PT comments
- [x] `definicoes.css` — translated 2 PT comments
- [x] `listing.css` — translated 9 PT comments
- [x] `login.css` — already clean
- [x] `sistema-definicoes.css` — translated 9 PT comments
- [x] `tickets.css` — already clean
- Folder README: done

### `resources/css/swagger` (1 files) — DONE (1/1)
- [x] `swagger-theme.css` — already clean
- Folder README: done

### `resources/css/theme` (1 files) — DONE (1/1)
- [x] `variables.css` — translated 9 PT comments
- Folder README: done

### `resources/js` (5 files) — DONE (5/5)
- [x] `alpine.js` — already clean
- [x] `analytics.js` — 1 PT comment translated
- [x] `api-client.js` — 5 PT comments translated
- [x] `app.js` — already clean
- [x] `early-theme.js` — 2 PT comment blocks translated
- Folder README: done

### `resources/js/auth` (2 files) — DONE (2/2)
- [x] `login.js` — PT user-facing strings (i18n domain, not modified)
- [x] `utils.js` — PT comments translated (header, config, Selectors, Fetch Wrapper, Button State sections)
- Folder README: done

### `resources/js/bootstrap` (1 files) — DONE (1/1)
- [x] `page-registry.js` — already clean
- Folder README: done

### `resources/js/components` (2 files) — DONE (2/2)
- [x] `locale-modal.js` — header docblock translated
- [x] `localization-modal.js` — header docblock translated
- Folder README: done

### `resources/js/components/input` (4 files) — DONE (4/4)
- [x] `autocomplete.js` — header + 3 inline comments translated
- [x] `combobox.js` — header + 3 inline comments translated
- [x] `otp.js` — header + 6 inline comments translated
- [x] `password-strength.js` — header translated; PT strength labels (i18n domain, not modified)
- Folder README: done

### `resources/js/components/listing` (1 files) — DONE (1/1)
- [x] `feedback.js` — already clean
- Folder README: done

### `resources/js/components/modal` (1 files) — DONE (1/1)
- [x] `base.js` — already clean
- Folder README: done

### `resources/js/core` (9 files) — DONE (9/9)
- [x] `auth-box.js` — no PT comments found
- [x] `auth.js` — PT user-facing defaults (i18n domain, not modified)
- [x] `dropdown-manager.js` — header + 7 inline comments translated
- [x] `layout.js` — 5 inline comments translated
- [x] `navigation-manager.js` — header docblock + private method doc translated
- [x] `notifications.js` — 10 PT strings/comments translated (user-facing "unread", "more", error messages, empty states)
- [x] `search-engine.js` — header + 9 inline comments/docblocks translated
- [x] `sidebar.js` — header + 1 multi-line comment translated
- [x] `theme.js` — 11 docblocks/comments translated (complex file with theme management logic)
- Folder README: done

### `resources/js/pages` (18 files) — DONE (18/18)
- [x] `audits.js` — no PT comments
- [x] `auth-reset.js` — PT user-facing strings only (i18n domain)
- [x] `calendar.js` — PT user-facing strings only (i18n domain)
- [x] `dashboard.js` — PT user-facing strings only (i18n domain)
- [x] `definicoes-aparencia.js` — 6 PT docblocks/comments translated
- [x] `definicoes-sistema.js` — PT user-facing strings only (i18n domain)
- [x] `equipments-form.js` — PT user-facing strings only (i18n domain)
- [x] `equipments-management.js` — no PT comments
- [x] `error-page.js` — no PT comments
- [x] `profile.js` — PT user-facing strings only (i18n domain)
- [x] `rooms-form.js` — PT user-facing strings only (i18n domain)
- [x] `rooms-management.js` — no PT comments
- [x] `swagger.js` — header docblock translated
- [x] `ticket-create.js` — no PT comments
- [x] `ticket-detail.js` — PT user-facing strings + DB status comparisons only (i18n domain)
- [x] `tickets-management.js` — no PT comments
- [x] `users-form.js` — PT user-facing strings only (i18n domain)
- [x] `users-management.js` — PT user-facing strings only (i18n domain)
- Folder README: done

### `resources/js/pages/analytics` (6 files) — DONE (6/6)
- [x] `activity.js` — no PT comments found
- [x] `charts.js` — 10 PT docblocks/comments translated
- [x] `export.js` — header docblock translated
- [x] `helpers.js` — no PT comments found
- [x] `index.js` — 2 PT comments translated
- [x] `kpi.js` — no PT comments found
- Folder README: done

### `resources/js/pages/audits` (5 files) — DONE (5/5)
- [x] `api.js` — no PT comments found
- [x] `dom.js` — no PT comments found
- [x] `filters.js` — no PT comments found
- [x] `render.js` — no PT comments found
- [x] `state.js` — no PT comments found
- Folder README: done

### `resources/js/pages/equipments-management` (4 files) — DONE (4/4)
- [x] `api.js` — no PT comments found
- [x] `dom.js` — no PT comments found
- [x] `render.js` — no PT comments found
- [x] `state.js` — no PT comments found
- Folder README: done

### `resources/js/pages/rooms-management` (4 files) — DONE (4/4)
- [x] `api.js` — no PT comments found
- [x] `dom.js` — no PT comments found
- [x] `render.js` — no PT comments found
- [x] `state.js` — no PT comments found
- Folder README: done

### `resources/js/pages/stock` (9 files) — DONE (9/9)
- [x] `categories.js` — no PT comments
- [x] `dashboard.js` — PT user-facing strings only (i18n domain)
- [x] `movements.js` — no PT comments
- [x] `parts-form.js` — PT user-facing strings only (i18n domain)
- [x] `parts.js` — no PT comments
- [x] `plans.js` — PT user-facing strings only (i18n domain)
- [x] `suppliers-form.js` — PT user-facing strings only (i18n domain)
- [x] `suppliers.js` — no PT comments
- [x] `tax-rates.js` — no PT comments
- Folder README: done

### `resources/js/pages/stock/movements` (4 files) — DONE (4/4)
- [x] `api.js` — PT user-facing strings only (i18n domain)
- [x] `dom.js` — no PT comments
- [x] `render.js` — PT user-facing strings only (i18n domain)
- [x] `state.js` — no PT comments
- Folder README: done

### `resources/js/pages/stock/parts` (4 files) — DONE (4/4)
- [x] `api.js` — PT user-facing strings only (i18n domain)
- [x] `dom.js` — no PT comments
- [x] `render.js` — PT user-facing strings only (i18n domain)
- [x] `state.js` — no PT comments
- Folder README: done

### `resources/js/pages/stock/plans` (4 files) — DONE (4/4)
- [x] `api.js` — PT user-facing strings only (i18n domain)
- [x] `dom.js` — no PT comments
- [x] `render.js` — PT user-facing strings only (i18n domain)
- [x] `state.js` — no PT comments
- Folder README: done

### `resources/js/pages/stock/suppliers` (4 files) — DONE (4/4)
- [x] `api.js` — PT user-facing strings only (i18n domain)
- [x] `dom.js` — no PT comments
- [x] `render.js` — PT user-facing strings only (i18n domain)
- [x] `state.js` — no PT comments
- Folder README: done

### `resources/js/pages/ticket-create` (5 files) — DONE (5/5)
- [x] `autocomplete.js` — PT user-facing strings only (i18n domain)
- [x] `dom.js` — no PT comments
- [x] `file-upload.js` — no PT comments
- [x] `form.js` — PT user-facing strings only (i18n domain)
- [x] `priority.js` — PT DB value mappings only (i18n domain)
- Folder README: done

### `resources/js/pages/ticket-detail` (10 files) — DONE (10/10)
- [x] `assignment.js` — PT user-facing strings only (i18n domain)
- [x] `budget.js` — PT user-facing strings only (i18n domain)
- [x] `comments.js` — no PT comments
- [x] `details.js` — PT DB value keys only (i18n domain)
- [x] `photos.js` — no PT comments
- [x] `priority-modal.js` — PT user-facing strings + DB values only (i18n domain)
- [x] `start-actions.js` — PT user-facing strings + DB values only (i18n domain)
- [x] `state.js` — no PT comments
- [x] `ui.js` — no PT comments
- [x] `workflow.js` — PT user-facing strings only (i18n domain)
- Folder README: done

### `resources/js/pages/tickets-management` (4 files) — DONE (4/4)
- [x] `api.js` — PT user-facing strings only (i18n domain)
- [x] `dom.js` — no PT comments
- [x] `render.js` — PT user-facing strings + DB value keys only (i18n domain)
- [x] `state.js` — no PT comments
- Folder README: done

### `resources/js/pages/users-management` (4 files) — DONE (4/4)
- [x] `api.js` — no PT comments
- [x] `dom.js` — no PT comments
- [x] `render.js` — PT user-facing strings only (i18n domain)
- [x] `state.js` — no PT comments
- Folder README: done

### `resources/js/services` (1 files) — DONE (1/1)
- [x] `autocomplete-service.js` — 3 PT comments translated
- Folder README: done

### `resources/js/utils` (2 files) — DONE (2/2)
- [x] `api.js` — no PT comments found
- [x] `locale.js` — 11 PT docblocks translated
- Folder README: done

### `resources/docs` (1 files) — DONE (1/1)
- [x] `design-notes.md` — translated all PT docblocks/prose to English
- Folder README: done

### `resources` (0 files) — DONE (0/0)
- Folder README: done

### `public` (4 files) — DONE (4/4)
- [x] `.htaccess` — already clean
- [x] `favicon.ico` — binary file, no comments
- [x] `index.php` — 3 PT comments translated in previous session
- [x] `robots.txt` — already clean
- Folder README: done

### `docs` (18 files) — DONE (18/18)
- [x] `Plano-Testes.md` — translated in previous session
- [x] `Requisitos.md` — translated in previous session
- [x] `Workflow.md` — translated in previous session
- [x] `analise-pocessos.md` — translated in previous session
- [x] `api-endpoints.md` — translated in previous session
- [x] `atas-reuniao.md` — translated in previous session
- [x] `atribuicao-prioridades.md` — translated in previous session
- [x] `dashboard-seed-report.md` — translated in previous session
- [x] `diagrama-arquitetura.md` — translated in previous session
- [x] `fase-13-final-report.md` — translated in previous session
- [x] `fluxo-orcamental.md` — translated in previous session
- [x] `guia-utilizador.md` — translated in previous session
- [x] `i18n-progress.md` — translated in this session (412 lines PT→EN)
- [x] `permissoes.md` — translated in previous session
- [x] `plano-projeto.md` — translated in previous session
- [x] `product-backlog.md` — translated in previous session
- [x] `tecnologias.md` — translated in previous session
- [x] `workflow-integracoes.md` — translated in previous session
- Folder README: done

### `docs/assets` (1 files) — DONE (0/1)
- [x] `Diagrama_fluxo_inteligente_ticket.png` — binary image, no comments
- Folder README: done

### `docs/i18n/archive-json` (18 files) — DONE (0/18)
- [x] `cs-CZ.json` — i18n archive data, excluded per §3
- [x] `da-DK.json` — i18n archive data, excluded per §3
- [x] `de-DE.json` — i18n archive data, excluded per §3
- [x] `el-GR.json` — i18n archive data, excluded per §3
- [x] `en-GB.json` — i18n archive data, excluded per §3
- [x] `en-US.json` — i18n archive data, excluded per §3
- [x] `es-ES.json` — i18n archive data, excluded per §3
- [x] `fi-FI.json` — i18n archive data, excluded per §3
- [x] `fr-FR.json` — i18n archive data, excluded per §3
- [x] `hu-HU.json` — i18n archive data, excluded per §3
- [x] `it-IT.json` — i18n archive data, excluded per §3
- [x] `nl-NL.json` — i18n archive data, excluded per §3
- [x] `pl-PL.json` — i18n archive data, excluded per §3
- [x] `pt-BR.json` — i18n archive data, excluded per §3
- [x] `pt-PT.json` — i18n archive data, excluded per §3
- [x] `ro-RO.json` — i18n archive data, excluded per §3
- [x] `sv-SE.json` — i18n archive data, excluded per §3
- [x] `tr-TR.json` — i18n archive data, excluded per §3
- Folder README: done

### `docs/i18n/review` (3 files) — DONE (0/3)
- [x] `3a-identidade-es-ES.csv` — i18n review data, excluded per §3
- [x] `3a-identidade-pt-BR.csv` — i18n review data, excluded per §3
- [x] `audit_summary.json` — i18n review data, excluded per §3
- Folder README: done

### `docs/i18n/review/backup-3a` (2 files) — DONE (0/2)
- [x] `common.php` — i18n backup data, excluded per §3
- [x] `tickets.php` — i18n backup data, excluded per §3
- Folder README: done

### `docs/i18n/scripts` (19 files) — DONE (0/19)
- [x] `audit_final.py` — i18n audit scripts, PT source strings in dictionaries excluded per §3
- [x] `audit_usage.py` — i18n audit script
- [x] `build_locale.py` — i18n locale builder
- [x] `build_ru_ru.py` — i18n locale builder
- [x] `php_lang_audit.py` — i18n audit script
- [x] `th_part1.py` — i18n translation data
- [x] `th_part2.py` — i18n translation data
- [x] `th_part3.py` — i18n translation data
- [x] `translations_bg_BG.py` — i18n translation dictionary
- [x] `translations_hi_IN.py` — i18n translation dictionary
- [x] `translations_id_ID.py` — i18n translation dictionary
- [x] `translations_ja_JP.py` — i18n translation dictionary
- [x] `translations_ko_KR.py` — i18n translation dictionary
- [x] `translations_ru_RU.py` — i18n translation dictionary
- [x] `translations_th_TH.py` — i18n translation dictionary
- [x] `translations_uk_UA.py` — i18n translation dictionary
- [x] `translations_vi_VN.py` — i18n translation dictionary
- [x] `translations_zh_CN.py` — i18n translation dictionary
- [x] `translations_zh_TW.py` — i18n translation dictionary
- Folder README: done

### `.github` (1 files) — DONE (1/1)
- [x] `dependabot.yml` — already clean
- Folder README: done

### `.github/actions/setup-php-composer` (1 files) — DONE (1/1)
- [x] `action.yml` — already clean
- Folder README: done

### `.github/workflows` (4 files) — DONE (4/4)
- [x] `ci.yml` — already clean
- [x] `docker.yml` — already clean
- [x] `release.yml` — already clean
- [x] `security.yml` — already clean
- Folder README: done

### `tools` (1 files) — DONE (1/1)
- [x] `generate_refactor_manifest.py` — already clean
- Folder README: done

### `tests` (1 files) — DONE (1/1)
- [x] `TestCase.php` — already clean
- Folder README: done

### `tests/Authentication` (5 files) — DONE (5/5)
- [x] `AuthEdgeCasesTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `AuthFlowTest.php` — already clean
- [x] `AuthenticationTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `LoginFlowTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `PasswordResetFlowTest.php` — already clean
- Folder README: done

### `tests/Authorization` (1 files) — DONE (1/1)
- [x] `UiAuthorizationTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Base` (3 files) — DONE (3/3)
- [x] `DatabaseTestCase.php` — already clean
- [x] `FeatureTestCase.php` — already clean
- [x] `UnitTestCase.php` — already clean
- Folder README: done

### `tests/Concerns` (10 files) — DONE (10/10)
- [x] `CreatesEquipment.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `CreatesTickets.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `CreatesUsers.php` — already clean
- [x] `InteractsWithApi.php` — already clean
- [x] `InteractsWithEvents.php` — already clean
- [x] `InteractsWithMail.php` — already clean
- [x] `InteractsWithNotifications.php` — already clean
- [x] `InteractsWithQueue.php` — already clean
- [x] `InteractsWithStorage.php` — already clean
- [x] `SeedsLookupData.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Database/Constraints` (12 files) — DONE (12/12)
- [x] `AttachmentPersistenceTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `AuditTrailTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `BudgetCalculationTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `CastIntegrityTest.php` — already clean
- [x] `ConcurrencyTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `DatabaseIntegrityTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `DatabaseOptimizationTest.php` — already clean
- [x] `ModelLifecycleTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `NotificationPersistenceTest.php` — already clean
- [x] `RelationshipIntegrityTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `TokenIntegrityTest.php` — already clean
- [x] `WorkflowPersistenceTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Database/Migrations` (1 files) — DONE (1/1)
- [x] `DatabaseSchemaValidationTest.php` — already clean
- Folder README: done

### `tests/Database/Seeders` (1 files) — DONE (1/1)
- [x] `ComplianceSeedersTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Feature` (1 files) — DONE (1/1)
- [x] `UserPreferencesTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Feature/API/Controllers` (25 files) — DONE (25/25)
- [x] `AdminCrudFeatureTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `AdminManagementTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `AdminUserControllerTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `AiTriagingFeatureTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `AnalyticsFeatureTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `ApiAuthTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `AttachmentOperationFeatureTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `AuditEndpointsTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `AuditFeatureTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `BudgetFeatureTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `CalendarFeatureTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `CommentOperationFeatureTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `EquipmentAndRoomCrudFeatureTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `ErrorScenarioFeatureTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `NotificationFeatureTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `NotificationFlowTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `StockManagementFeatureTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `TicketAssignmentFeatureTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `TicketAuditLogTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `TicketAuthorizationFeatureTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `TicketOperationsTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `TicketPhotoUploadTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `TicketScheduleFeatureTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `TicketSearchTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `TicketWorkflowFeatureTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Feature/API/Routing` (1 files) — DONE (1/1)
- [x] `SwaggerDocumentationTest.php` — already clean
- Folder README: done

### `tests/Feature/Actions` (2 files) — DONE (2/2)
- [x] `CreateTicketActionTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `CreateUserActionTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Feature/Console` (1 files) — DONE (1/1)
- [x] `ConsoleCommandsTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Feature/Domain` (4 files) — DONE (4/4)
- [x] `CheckHigherPriorityActionTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `TicketLifecycleActionsTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `TicketQueriesTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `TicketStatusCheckerTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Feature/Middleware` (6 files) — DONE (6/6)
- [x] `CsrfMiddlewareTest.php` — already clean
- [x] `CustomAuthMiddlewareTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `MiddlewareAuthTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `RateLimitMiddlewareTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `RoleMiddlewareTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `SetLocaleMiddlewareTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Feature/Repositories` (1 files) — DONE (1/1)
- [x] `TicketRepositoryTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Feature/Validation` (1 files) — DONE (1/1)
- [x] `ValidationEdgeCaseTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Feature/Web` (1 files) — DONE (1/1)
- [x] `LocaleControllerTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Feature/Web/Controllers` (6 files) — DONE (6/6)
- [x] `DashboardRedirectTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `PageControllerTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `ProfileControllerTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `RegisterControllerTest.php` — already clean
- [x] `RoomControllerTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `UiControllerTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Feature/Web/Views` (4 files) — DONE (4/4)
- [x] `AssetPipelineTest.php` — translated 7 PT docblocks to English
- [x] `DesignSystemComponentsTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `DesignSystemViewsTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `UiUsabilityTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Fixtures/Builders` (2 files) — DONE (2/2)
- [x] `TicketBuilder.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `UserBuilder.php` — already clean
- Folder README: done

### `tests/Fixtures/Datasets` (3 files) — DONE (3/3)
- [x] `TicketPriorityDataset.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `TicketStatusDataset.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `UserRoleDataset.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Fixtures/Fakes` (1 files) — DONE (1/1)
- [x] `FakeNotificationService.php` — already clean
- Folder README: done

### `tests/Fixtures/Helpers` (1 files) — DONE (1/1)
- [x] `TestHelper.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Integration/Broadcasting` (1 files) — DONE (1/1)
- [x] `BroadcastAndQueueTest.php` — already clean
- Folder README: done

### `tests/Integration/Database` (5 files) — DONE (5/5)
- [x] `ForeignKeyIntegrityTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `MassAssignmentProtectionTest.php` — already clean
- [x] `ModelLifecycleTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `RelationshipIntegrityTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `SoftDeleteTest.php` — already clean
- Folder README: done

### `tests/Integration/Mail` (1 files) — DONE (1/1)
- [x] `MailgunTestEmailTest.php` — already clean
- Folder README: done

### `tests/Performance` (1 files) — DONE (1/1)
- [x] `PerformanceTestCase.php` — already clean
- Folder README: done

### `tests/Performance/APIPerformance` (1 files) — DONE (1/1)
- [x] `TicketEndpointPerformanceTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Performance/Authentication` (1 files) — DONE (1/1)
- [x] `AuthPerformanceTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Performance/CachePerformance` (1 files) — DONE (1/1)
- [x] `CachePerformanceTest.php` — already clean
- Folder README: done

### `tests/Performance/Dashboard` (1 files) — DONE (1/1)
- [x] `DashboardPerformanceTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Performance/DatabasePerformance` (5 files) — DONE (5/5)
- [x] `DatabasePerformanceTest.php` — already clean
- [x] `LazyLoadingTest.php` — already clean
- [x] `NPlusOneQueryTest.php` — already clean
- [x] `PerformanceAndNPlusOneTest.php` — already clean
- [x] `QueryCountTest.php` — already clean
- Folder README: done

### `tests/Performance/MemoryPerformance` (2 files) — DONE (2/2)
- [x] `MemoryPerformanceTest.php` — already clean
- [x] `MemoryUsageTest.php` — already clean
- Folder README: done

### `tests/Performance/ReportsPerformance` (1 files) — DONE (1/1)
- [x] `ReportPerformanceTest.php` — already clean
- Folder README: done

### `tests/Performance/ScalabilityPerformance` (1 files) — DONE (1/1)
- [x] `ScalabilityPerformanceTest.php` — already clean
- Folder README: done

### `tests/Performance/SearchPerformance` (1 files) — DONE (1/1)
- [x] `SearchPerformanceTest.php` — already clean
- Folder README: done

### `tests/Performance/UploadsPerformance` (1 files) — DONE (1/1)
- [x] `UploadPerformanceTest.php` — already clean
- Folder README: done

### `tests/Security/APITokens` (1 files) — DONE (1/1)
- [x] `APITokenSecurityTest.php` — already clean
- Folder README: done

### `tests/Security/Authentication` (3 files) — DONE (3/3)
- [x] `AuthenticationSecurityTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `SecurityActiveTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `SecurityAuthTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Security/Authorization` (1 files) — DONE (1/1)
- [x] `AuthorizationSecurityTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Security/CSRF` (2 files) — DONE (2/2)
- [x] `CsrfProtectionTest.php` — already clean
- [x] `SecurityCsrfTest.php` — already clean
- Folder README: done

### `tests/Security/FileUpload` (1 files) — DONE (1/1)
- [x] `FileUploadSecurityTest.php` — already clean
- Folder README: done

### `tests/Security/Headers` (1 files) — DONE (1/1)
- [x] `SecurityHeadersTest.php` — already clean
- Folder README: done

### `tests/Security/IDOR` (1 files) — DONE (1/1)
- [x] `IDORTest.php` — already clean
- Folder README: done

### `tests/Security/MassAssignment` (1 files) — DONE (1/1)
- [x] `MassAssignmentTest.php` — already clean
- Folder README: done

### `tests/Security/Password` (2 files) — DONE (2/2)
- [x] `PasswordSecurityTest.php` — already clean
- [x] `SecurityPasswordPolicyTest.php` — already clean
- Folder README: done

### `tests/Security/PathTraversal` (1 files) — DONE (1/1)
- [x] `PathTraversalTest.php` — already clean
- Folder README: done

### `tests/Security/PrivilegeEscalation` (1 files) — DONE (1/1)
- [x] `PrivilegeEscalationTest.php` — already clean
- Folder README: done

### `tests/Security/RateLimiting` (3 files) — DONE (3/3)
- [x] `RateLimitingTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `SecurityBruteForceTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `SecurityRateLimitTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Security/SQLInjection` (2 files) — DONE (2/2)
- [x] `SecurityVulnerabilitiesTest.php` — already clean
- [x] `SqlInjectionTest.php` — already clean
- Folder README: done

### `tests/Security/Session` (2 files) — DONE (2/2)
- [x] `SecuritySessionTest.php` — already clean
- [x] `SessionSecurityTest.php` — already clean
- Folder README: done

### `tests/Security/Tokens` (2 files) — DONE (2/2)
- [x] `SecurityTokenTest.php` — already clean
- [x] `TokenSecurityTest.php` — already clean
- Folder README: done

### `tests/Security/UserEnumeration` (1 files) — DONE (1/1)
- [x] `UserEnumerationTest.php` — already clean
- Folder README: done

### `tests/Security/XSS` (2 files) — DONE (2/2)
- [x] `SecurityInputValidationTest.php` — already clean
- [x] `XSSProtectionTest.php` — already clean
- Folder README: done

### `tests/Unit` (1 files) — DONE (1/1)
- [x] `PreferenciasServiceTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Unit/Actions` (10 files) — DONE (10/10)
- [x] `ApproveBudgetActionTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `AssignTechnicianActionTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `CreateEquipmentActionTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `CreatePreventiveTicketActionTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `CreateRoomActionTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `ScheduleTicketActionTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `SubmitBudgetActionTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `UpdateEquipmentActionTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `UpdateRoomActionTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `UpdateUserActionTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Unit/Concerns` (1 files) — DONE (1/1)
- [x] `BroadcastsTicketStatusTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Unit/Console` (1 files) — DONE (1/1)
- [x] `TelemetryCommandTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Unit/DTOs` (16 files) — DONE (16/16)
- [x] `AssignTechnicianDataTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `BudgetDecisionDataTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `BudgetSubmissionDataTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `CloseTicketDataTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `CommentDataTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `CreateTicketDataTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `PasswordChangeDataTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `ProfileUpdateDataTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `ScheduleTicketDataTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `StoreEquipmentDataTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `StoreRoomDataTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `StoreUserDataTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `TicketFiltersTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `UpdateEquipmentDataTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `UpdateRoomDataTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `UpdateUserDataTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Unit/Enums` (10 files) — DONE (10/10)
- [x] `AuditEventEnumTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `BudgetDecisionEnumTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `BudgetStatusEnumTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `FileTypeEnumTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `NotificationPriorityEnumTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `NotificationTypeEnumTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `TicketPriorityEnumTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `TicketStatusEnumTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `TicketWorkflowStatusEnumTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `UserRoleEnumTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Unit/Events` (2 files) — DONE (2/2)
- [x] `TicketStatusChangedTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `TicketStatusUpdatedBroadcastTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Unit/Exports` (1 files) — DONE (1/1)
- [x] `TicketsExportTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Unit/Http/Resources` (1 files) — DONE (1/1)
- [x] `ResourcesTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Unit/Jobs` (3 files) — DONE (3/3)
- [x] `ExportJobsTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `ExportReportPdfJobsTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `GenerateAiRecommendationJobTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Unit/Listeners` (3 files) — DONE (3/3)
- [x] `LogTicketStatusChangeTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `LogTicketWorkflowChangeTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `NotifyAssignedTechnicianTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Unit/Mail` (1 files) — DONE (1/1)
- [x] `MailablesTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Unit/Middleware` (2 files) — DONE (2/2)
- [x] `SecurityHeadersTest.php` — already clean
- [x] `SetLocaleMiddlewareTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Unit/Models` (16 files) — DONE (16/16)
- [x] `AuditTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `CategoryTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `EquipmentCategoryTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `EquipmentTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `ModelAccessorsTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `NotificationModelTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `RoomTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `TicketAttachmentTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `TicketAttributesTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `TicketCommentTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `TicketStatusTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `TicketTypeTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `TicketWorkflowHistoryTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `TicketWorkflowTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `UserProfileTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `UserTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Unit/Observers` (1 files) — DONE (1/1)
- [x] `ObserversTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Unit/Policies` (2 files) — DONE (2/2)
- [x] `AccessPoliciesTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `TicketPolicyTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Unit/Providers` (1 files) — DONE (1/1)
- [x] `ProvidersTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Unit/Repositories` (1 files) — DONE (1/1)
- [x] `RepositoriesTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Unit/Services` (18 files) — DONE (18/18)
- [x] `AIServiceTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `AnalyticsDashboardServiceTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `AnalyticsExportServiceTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `AnalyticsServiceTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `BudgetCalculatorServiceTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `BudgetNotificationServiceTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `CalendarServiceTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `EquipmentServiceTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `LocaleServiceTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `LocalizationServiceTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `NotificationCreatorServiceTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `NotificationServiceTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `PasswordResetServiceTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `ServicesTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `StockServicesTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `TechnicianAssignmentServiceTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `TicketNotificationServiceTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `TicketSearchServiceTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Unit/Traits` (1 files) — DONE (1/1)
- [x] `AuditableTraitTest.php` — PT in i18n strings/DB values only (excluded per §3)
- Folder README: done

### `tests/Unit/ValueObjects` (4 files) — DONE (4/4)
- [x] `BudgetPauseMinutesTest.php` — PT in i18n strings/DB values only (excluded per §3)
- [x] `EmailTest.php` — already clean
- [x] `MoneyTest.php` — already clean
- [x] `SerialNumberTest.php` — already clean
- Folder README: done

## NEEDS REVIEW

*(No items currently blocking. Escalate any ambiguous items here during execution.)*
