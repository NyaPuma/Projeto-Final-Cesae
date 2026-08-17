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

### `app/Models` (22 files) — PENDING (0/22)
- [ ] `Audit.php`
- [ ] `Equipment.php`
- [ ] `EquipmentCategory.php`
- [ ] `MaintenancePlan.php`
- [ ] `Notification.php`
- [ ] `Part.php`
- [ ] `PartCategory.php`
- [ ] `Room.php`
- [ ] `StockMovement.php`
- [ ] `Supplier.php`
- [ ] `SystemSetting.php`
- [ ] `TaxRate.php`
- [ ] `ThemeSetting.php`
- [ ] `Ticket.php`
- [ ] `TicketAttachment.php`
- [ ] `TicketComment.php`
- [ ] `TicketStatus.php`
- [ ] `TicketType.php`
- [ ] `TicketWorkflowHistory.php`
- [ ] `User.php`
- [ ] `UserPreference.php`
- [ ] `UserProfile.php`
- Folder README: pending

### `app/DTOs` (21 files) — PENDING (0/21)
- [ ] `AssignTechnicianData.php`
- [ ] `BudgetDecisionData.php`
- [ ] `BudgetSubmissionData.php`
- [ ] `CloseTicketData.php`
- [ ] `CommentData.php`
- [ ] `CreateTicketData.php`
- [ ] `PasswordChangeData.php`
- [ ] `ProfileUpdateData.php`
- [ ] `ScheduleMaintenanceData.php`
- [ ] `ScheduleTicketData.php`
- [ ] `StoreEquipmentData.php`
- [ ] `StorePartData.php`
- [ ] `StoreRoomData.php`
- [ ] `StoreSupplierData.php`
- [ ] `StoreUserData.php`
- [ ] `TicketFilters.php`
- [ ] `UpdateEquipmentData.php`
- [ ] `UpdatePartData.php`
- [ ] `UpdateRoomData.php`
- [ ] `UpdateSupplierData.php`
- [ ] `UpdateUserData.php`
- Folder README: pending

### `app/ValueObjects` (3 files) — PENDING (0/3)
- [ ] `Email.php`
- [ ] `Money.php`
- [ ] `SerialNumber.php`
- Folder README: pending

### `app/Concerns` (1 files) — DONE (1/1)
- [x] `BroadcastsTicketStatus.php`
- Folder README: done

### `app/Actions` (21 files) — PENDING (0/21)
- [ ] `ApproveBudgetAction.php`
- [ ] `AssignTechnicianAction.php`
- [ ] `CreateEquipmentAction.php`
- [ ] `CreatePartAction.php`
- [ ] `CreatePreventiveTicketAction.php`
- [ ] `CreatePublicTicketAction.php`
- [ ] `CreateRoomAction.php`
- [ ] `CreateSupplierAction.php`
- [ ] `CreateTicketAction.php`
- [ ] `CreateUserAction.php`
- [ ] `MaintenancePlanActions.php`
- [ ] `PartCategoryActions.php`
- [ ] `ScheduleMaintenanceAction.php`
- [ ] `ScheduleTicketAction.php`
- [ ] `SubmitBudgetAction.php`
- [ ] `TaxRateActions.php`
- [ ] `UpdateEquipmentAction.php`
- [ ] `UpdatePartAction.php`
- [ ] `UpdateRoomAction.php`
- [ ] `UpdateSupplierAction.php`
- [ ] `UpdateUserAction.php`
- Folder README: pending

### `app/Domain/Ticket/Actions` (5 files) — PENDING (0/5)
- [ ] `CancelTicketAction.php`
- [ ] `CheckHigherPriorityAction.php`
- [ ] `CloseTicketAction.php`
- [ ] `ReopenTicketAction.php`
- [ ] `StartTicketAction.php`
- Folder README: pending

### `app/Domain/Ticket/Queries` (5 files) — PENDING (0/5)
- [ ] `MonthlyTicketsQuery.php`
- [ ] `ScheduledEventsQuery.php`
- [ ] `TicketKpiQuery.php`
- [ ] `TicketPriorityQuery.php`
- [ ] `TopEntitiesQuery.php`
- Folder README: pending

### `app/Domain/Ticket/Services` (1 files) — PENDING (0/1)
- [ ] `TicketStatusChecker.php`
- Folder README: pending

### `app/Domain/Ticket/ValueObjects` (1 files) — PENDING (0/1)
- [ ] `BudgetPauseMinutes.php`
- Folder README: pending

### `app/Services` (29 files) — PENDING (0/29)
- [ ] `AIService.php`
- [ ] `AnalyticsDashboardService.php`
- [ ] `AnalyticsExportService.php`
- [ ] `AnalyticsService.php`
- [ ] `AuthUserResolver.php`
- [ ] `BudgetCalculatorService.php`
- [ ] `BudgetNotificationService.php`
- [ ] `CalendarService.php`
- [ ] `EquipmentService.php`
- [ ] `LocaleService.php`
- [ ] `LocalizationService.php`
- [ ] `LowStockAlertService.php`
- [ ] `NotificationCreatorService.php`
- [ ] `NotificationService.php`
- [ ] `PartPriceCalculator.php`
- [ ] `PartService.php`
- [ ] `PasswordResetService.php`
- [ ] `PreferenciasService.php`
- [ ] `QrCodeService.php`
- [ ] `StockDashboardService.php`
- [ ] `StockMovementService.php`
- [ ] `SystemSettingsService.php`
- [ ] `TechnicianAssignmentService.php`
- [ ] `ThemePresetService.php`
- [ ] `TicketNotificationService.php`
- [ ] `TicketSearchService.php`
- [ ] `TicketStatusService.php`
- [ ] `TicketWorkflowService.php`
- [ ] `UserService.php`
- Folder README: pending

### `app/Repositories` (4 files) — PENDING (0/4)
- [ ] `EquipmentRepository.php`
- [ ] `RoomRepository.php`
- [ ] `TicketRepository.php`
- [ ] `UserRepository.php`
- Folder README: pending

### `app/Repositories/Contracts` (4 files) — PENDING (0/4)
- [ ] `EquipmentRepositoryInterface.php`
- [ ] `RoomRepositoryInterface.php`
- [ ] `TicketRepositoryInterface.php`
- [ ] `UserRepositoryInterface.php`
- Folder README: pending

### `app/Jobs` (8 files) — PENDING (0/8)
- [ ] `CheckLowStockJob.php`
- [ ] `ExportCsvJob.php`
- [ ] `ExportEquipmentQrPdfJob.php`
- [ ] `ExportExcelJob.php`
- [ ] `ExportPdfJob.php`
- [ ] `ExportStockCostsPdfJob.php`
- [ ] `GenerateAiRecommendationJob.php`
- [ ] `SendTestEmailJob.php`
- Folder README: pending

### `app/Listeners` (5 files) — PENDING (0/5)
- [ ] `LogTicketStatusChange.php`
- [ ] `LogTicketWorkflowChange.php`
- [ ] `NotifyAssignedTechnician.php`
- [ ] `SendTicketCreatedNotification.php`
- [ ] `SendTicketStatusNotification.php`
- Folder README: pending

### `app/Events` (3 files) — PENDING (0/3)
- [ ] `TicketCreated.php`
- [ ] `TicketStatusChanged.php`
- [ ] `TicketStatusUpdatedBroadcast.php`
- Folder README: pending

### `app/Mail` (3 files) — PENDING (0/3)
- [ ] `PasswordResetMail.php`
- [ ] `TestMail.php`
- [ ] `TicketCreated.php`
- Folder README: pending

### `app/Notifications` (3 files) — PENDING (0/3)
- [ ] `NewTicketNotification.php`
- [ ] `TicketNotification.php`
- [ ] `TicketStatusChanged.php`
- Folder README: pending

### `app/Observers` (3 files) — PENDING (0/3)
- [ ] `AuditObserver.php`
- [ ] `TicketObserver.php`
- [ ] `UserObserver.php`
- Folder README: pending

### `app/Policies` (12 files) — PENDING (0/12)
- [ ] `AuditPolicy.php`
- [ ] `EquipmentPolicy.php`
- [ ] `MaintenancePlanPolicy.php`
- [ ] `PartCategoryPolicy.php`
- [ ] `PartPolicy.php`
- [ ] `RoomPolicy.php`
- [ ] `StockMovementPolicy.php`
- [ ] `SupplierPolicy.php`
- [ ] `TaxRatePolicy.php`
- [ ] `TicketPolicy.php`
- [ ] `UserPolicy.php`
- [ ] `UserProfilePolicy.php`
- Folder README: pending

### `app/Exports` (1 files) — PENDING (0/1)
- [ ] `TicketsExport.php`
- Folder README: pending

### `app/OpenApi` (1 files) — PENDING (0/1)
- [ ] `OpenApiSpec.php`
- Folder README: pending

### `app/Http/Requests` (38 files) — PENDING (0/38)
- [ ] `AssignTechnicianToTicketRequest.php`
- [ ] `BudgetDecisionRequest.php`
- [ ] `ChangePasswordRequest.php`
- [ ] `CloseTicketRequest.php`
- [ ] `CloseTicketSimpleRequest.php`
- [ ] `LoginRequest.php`
- [ ] `PublicStoreTicketRequest.php`
- [ ] `RegisterRequest.php`
- [ ] `RequestBudgetRequest.php`
- [ ] `RescheduleEventRequest.php`
- [ ] `ResetPasswordRequest.php`
- [ ] `ScheduleMaintenanceRequest.php`
- [ ] `ScheduleTicketRequest.php`
- [ ] `SendResetLinkRequest.php`
- [ ] `StartTicketRequest.php`
- [ ] `StoreCommentRequest.php`
- [ ] `StoreEquipmentRequest.php`
- [ ] `StoreMaintenancePlanRequest.php`
- [ ] `StorePartCategoryRequest.php`
- [ ] `StorePartRequest.php`
- [ ] `StorePreventiveRequest.php`
- [ ] `StoreRoomRequest.php`
- [ ] `StoreStockMovementRequest.php`
- [ ] `StoreSupplierRequest.php`
- [ ] `StoreTaxRateRequest.php`
- [ ] `StoreTicketRequest.php`
- [ ] `StoreUserRequest.php`
- [ ] `SubmitBudgetRequest.php`
- [ ] `UpdateEquipmentRequest.php`
- [ ] `UpdateMaintenancePlanRequest.php`
- [ ] `UpdatePartCategoryRequest.php`
- [ ] `UpdatePartRequest.php`
- [ ] `UpdateProfileRequest.php`
- [ ] `UpdateRoomRequest.php`
- [ ] `UpdateSupplierRequest.php`
- [ ] `UpdateTaxRateRequest.php`
- [ ] `UpdateUserRequest.php`
- [ ] `UploadPhotoRequest.php`
- Folder README: pending

### `app/Http/Resources` (15 files) — PENDING (0/15)
- [ ] `AuditResource.php`
- [ ] `EquipmentResource.php`
- [ ] `MaintenancePlanResource.php`
- [ ] `NotificationResource.php`
- [ ] `PartCategoryResource.php`
- [ ] `PartResource.php`
- [ ] `RoomResource.php`
- [ ] `StockMovementResource.php`
- [ ] `SupplierResource.php`
- [ ] `TaxRateResource.php`
- [ ] `TicketAttachmentResource.php`
- [ ] `TicketCommentResource.php`
- [ ] `TicketResource.php`
- [ ] `UserProfileResource.php`
- [ ] `UserResource.php`
- Folder README: pending

### `app/Http/Middleware` (8 files) — PENDING (0/8)
- [ ] `CsrfMiddleware.php`
- [ ] `CustomAuthMiddleware.php`
- [ ] `LocalizeSwaggerDocument.php`
- [ ] `RateLimitMiddleware.php`
- [ ] `RoleMiddleware.php`
- [ ] `SecurityHeaders.php`
- [ ] `SetLocaleMiddleware.php`
- [ ] `SetUserPreferencesMiddleware.php`
- Folder README: pending

### `app/Http/Controllers` (35 files) — PENDING (0/35)
- [ ] `ActivityFeedController.php`
- [ ] `AdminController.php`
- [ ] `AdminEquipmentController.php`
- [ ] `AdminUserController.php`
- [ ] `AnalyticsController.php`
- [ ] `AuditController.php`
- [ ] `AuthController.php`
- [ ] `CalendarController.php`
- [ ] `Controller.php`
- [ ] `LocaleController.php`
- [ ] `MaintenancePlanController.php`
- [ ] `NotificationController.php`
- [ ] `PageController.php`
- [ ] `PartCategoryController.php`
- [ ] `PartController.php`
- [ ] `PasswordResetController.php`
- [ ] `PreferenciasController.php`
- [ ] `ProfileController.php`
- [ ] `PublicTicketController.php`
- [ ] `QrCodeController.php`
- [ ] `RegisterController.php`
- [ ] `RoomController.php`
- [ ] `StockDashboardController.php`
- [ ] `StockMovementController.php`
- [ ] `StockReportController.php`
- [ ] `StockUiController.php`
- [ ] `SupplierController.php`
- [ ] `SystemSettingsController.php`
- [ ] `TaxRateController.php`
- [ ] `ThemeController.php`
- [ ] `TicketAttachmentController.php`
- [ ] `TicketBudgetController.php`
- [ ] `TicketCommentController.php`
- [ ] `TicketController.php`
- [ ] `UiController.php`
- Folder README: pending

### `app/Http/Controllers/Ticket` (5 files) — PENDING (0/5)
- [ ] `TicketAssignmentController.php`
- [ ] `TicketCloseController.php`
- [ ] `TicketLifecycleController.php`
- [ ] `TicketScheduleController.php`
- [ ] `TicketStartController.php`
- Folder README: pending

### `app/Console/Commands` (4 files) — PENDING (0/4)
- [ ] `DatabaseBackup.php`
- [ ] `FixTicketEncoding.php`
- [ ] `PartitionAudits.php`
- [ ] `SimulateTelemetry.php`
- Folder README: pending

### `app/Providers` (2 files) — PENDING (0/2)
- [ ] `AppServiceProvider.php`
- [ ] `EventServiceProvider.php`
- Folder README: pending

### `app` (0 files) — PENDING (0/0)
- Folder README: pending

### `routes` (3 files) — PENDING (0/3)
- [ ] `api.php`
- [ ] `console.php`
- [ ] `web.php`
- Folder README: pending

### `config` (18 files) — PENDING (0/18)
- [ ] `app.php`
- [ ] `auth.php`
- [ ] `backup.php`
- [ ] `broadcasting.php`
- [ ] `cache.php`
- [ ] `database.php`
- [ ] `filesystems.php`
- [ ] `hashing.php`
- [ ] `l5-swagger.php`
- [ ] `locales.php`
- [ ] `logging.php`
- [ ] `mail.php`
- [ ] `openai.php`
- [ ] `queue.php`
- [ ] `sanctum.php`
- [ ] `services.custom.php`
- [ ] `services.php`
- [ ] `session.php`
- Folder README: pending

### `database/factories` (16 files) — PENDING (0/16)
- [ ] `EquipmentCategoryFactory.php`
- [ ] `EquipmentFactory.php`
- [ ] `MaintenancePlanFactory.php`
- [ ] `PartCategoryFactory.php`
- [ ] `PartFactory.php`
- [ ] `RoomFactory.php`
- [ ] `StockMovementFactory.php`
- [ ] `SupplierFactory.php`
- [ ] `TaxRateFactory.php`
- [ ] `TicketAttachmentFactory.php`
- [ ] `TicketCommentFactory.php`
- [ ] `TicketFactory.php`
- [ ] `TicketStatusFactory.php`
- [ ] `TicketTypeFactory.php`
- [ ] `UserFactory.php`
- [ ] `UserProfileFactory.php`
- Folder README: pending

### `database/seeders` (12 files) — PENDING (0/12)
- [ ] `ActivityFeedSeeder.php`
- [ ] `BulkOperationalDataSeeder.php`
- [ ] `DatabaseSeeder.php`
- [ ] `EquipmentCategoriesSeeder.php`
- [ ] `EquipmentsSeeder.php`
- [ ] `NotificationSeeder.php`
- [ ] `RoomsSeeder.php`
- [ ] `StockDataSeeder.php`
- [ ] `TicketLookupSeeder.php`
- [ ] `TicketsSeeder.php`
- [ ] `UserProfilesSeeder.php`
- [ ] `UsersSeeder.php`
- Folder README: pending

### `database/seeders/Data` (2 files) — PENDING (0/2)
- [ ] `OperationalData.php`
- [ ] `TicketDataset.php`
- Folder README: pending

### `database/migrations` (25 files) — PENDING (0/25)
- [ ] `0001_01_01_000000_create_users_table.php`
- [ ] `0001_01_01_000001_create_cache_table.php`
- [ ] `0001_01_01_000002_create_jobs_table.php`
- [ ] `0001_01_01_000003_create_rooms_table.php`
- [ ] `0001_01_01_000004_create_equipments_table.php`
- [ ] `0001_01_01_000005_create_tickets_table.php`
- [ ] `0001_01_01_000006_create_audits_table.php`
- [ ] `0001_01_01_000008_create_ticket_attachments_table.php`
- [ ] `0001_01_01_000009_create_ticket_comments_table.php`
- [ ] `2026_07_09_100000_create_notifications_table.php`
- [ ] `2026_07_24_152504_create_audits_append_only_trigger.php`
- [ ] `2026_07_31_000001_convert_ticket_tables_to_utf8mb4.php`
- [ ] `2026_08_03_000001_add_ai_recommendation_columns_to_tickets_table.php`
- [ ] `2026_08_05_000001_create_theme_settings_table.php`
- [ ] `2026_08_05_000002_create_system_settings_table.php`
- [ ] `2026_08_07_000001_add_reporter_fields_to_tickets_table.php`
- [ ] `2026_08_08_000001_create_stock_catalog_tables.php`
- [ ] `2026_08_08_000002_create_stock_movements_table.php`
- [ ] `2026_08_08_000003_create_maintenance_plans_table.php`
- [ ] `2026_08_08_000004_add_low_stock_notification_type.php`
- [ ] `2026_08_10_000001_add_locale_to_users_table.php`
- [ ] `2026_08_12_000001_create_user_preferences_table.php`
- [ ] `2026_08_12_000002_populate_user_preferences.php`
- [ ] `2026_08_12_000003_add_number_format_to_user_preferences.php`
- [ ] `2026_08_12_000004_add_time_format_to_user_preferences.php`
- Folder README: pending

### `database` (0 files) — PENDING (0/0)
- Folder README: pending

### `bootstrap` (2 files) — PENDING (0/2)
- [ ] `app.php`
- [ ] `providers.php`
- Folder README: pending

### `resources/views` (2 files) — PENDING (0/2)
- [ ] `calendar.blade.php`
- [ ] `main.blade.php`
- Folder README: pending

### `resources/views/components/ui/analytics` (10 files) — PENDING (0/10)
- [ ] `activity-timeline-card.blade.php`
- [ ] `aside-card.blade.php`
- [ ] `aside-pill.blade.php`
- [ ] `chart-card.blade.php`
- [ ] `equipment-distribution-card.blade.php`
- [ ] `export-actions.blade.php`
- [ ] `hero.blade.php`
- [ ] `list-card.blade.php`
- [ ] `metric-card.blade.php`
- [ ] `section-heading.blade.php`
- Folder README: pending

### `resources/views/components/ui/auth` (6 files) — PENDING (0/6)
- [ ] `form-header.blade.php`
- [ ] `message.blade.php`
- [ ] `password-field.blade.php`
- [ ] `shell.blade.php`
- [ ] `submit-button.blade.php`
- [ ] `text-field.blade.php`
- Folder README: pending

### `resources/views/components/ui/buttons` (3 files) — PENDING (0/3)
- [ ] `button.blade.php`
- [ ] `icon-button.blade.php`
- [ ] `submit.blade.php`
- Folder README: pending

### `resources/views/components/ui/dashboard` (1 files) — PENDING (0/1)
- [ ] `welcome-panel.blade.php`
- Folder README: pending

### `resources/views/components/ui/form` (5 files) — PENDING (0/5)
- [ ] `card.blade.php`
- [ ] `field.blade.php`
- [ ] `input.blade.php`
- [ ] `message.blade.php`
- [ ] `select.blade.php`
- Folder README: pending

### `resources/views/components/ui/listing` (4 files) — PENDING (0/4)
- [ ] `filter-field.blade.php`
- [ ] `filter-panel.blade.php`
- [ ] `pagination.blade.php`
- [ ] `table-card.blade.php`
- Folder README: pending

### `resources/views/components/ui/page-actions` (7 files) — PENDING (0/7)
- [ ] `action-button.blade.php`
- [ ] `back-button.blade.php`
- [ ] `base-button.blade.php`
- [ ] `base-link.blade.php`
- [ ] `create-link.blade.php`
- [ ] `export-link.blade.php`
- [ ] `group.blade.php`
- Folder README: pending

### `resources/views/components/ui/partials` (1 files) — PENDING (0/1)
- [ ] `page-header.blade.php`
- Folder README: pending

### `resources/views/components/ui/profile` (4 files) — PENDING (0/4)
- [ ] `delete-account-card.blade.php`
- [ ] `information-card.blade.php`
- [ ] `security-card.blade.php`
- [ ] `summary-card.blade.php`
- Folder README: pending

### `resources/views/components/ui/text` (2 files) — PENDING (0/2)
- [ ] `eyebrow.blade.php`
- [ ] `pill.blade.php`
- Folder README: pending

### `resources/views/emails` (3 files) — PENDING (0/3)
- [ ] `passwordReset.blade.php`
- [ ] `test-mail.blade.php`
- [ ] `ticketCreated.blade.php`
- Folder README: pending

### `resources/views/errors` (5 files) — PENDING (0/5)
- [ ] `402.blade.php`
- [ ] `403.blade.php`
- [ ] `404.blade.php`
- [ ] `500.blade.php`
- [ ] `minimal.blade.php`
- Folder README: pending

### `resources/views/layouts` (1 files) — PENDING (0/1)
- [ ] `layout.blade.php`
- Folder README: pending

### `resources/views/preferences` (1 files) — PENDING (0/1)
- [ ] `edit.blade.php`
- Folder README: pending

### `resources/views/reports` (3 files) — PENDING (0/3)
- [ ] `equipments-qr.blade.php`
- [ ] `stock-costs-by-equipment.blade.php`
- [ ] `tickets.blade.php`
- Folder README: pending

### `resources/views/ui` (15 files) — PENDING (0/15)
- [ ] `analytics.blade.php`
- [ ] `audits.blade.php`
- [ ] `auth-reset.blade.php`
- [ ] `auth.blade.php`
- [ ] `equipments.blade.php`
- [ ] `index.blade.php`
- [ ] `layout.blade.php`
- [ ] `profile.blade.php`
- [ ] `rooms.blade.php`
- [ ] `ticket-create.blade.php`
- [ ] `ticket-detail.blade.php`
- [ ] `tickets.blade.php`
- [ ] `users-create.blade.php`
- [ ] `users-edit.blade.php`
- [ ] `users.blade.php`
- Folder README: pending

### `resources/views/ui/definicoes` (2 files) — PENDING (0/2)
- [ ] `aparencia.blade.php`
- [ ] `sistema.blade.php`
- Folder README: pending

### `resources/views/ui/equipments` (4 files) — PENDING (0/4)
- [ ] `create.blade.php`
- [ ] `edit.blade.php`
- [ ] `qr.blade.php`
- [ ] `show.blade.php`
- Folder README: pending

### `resources/views/ui/partials` (17 files) — PENDING (0/17)
- [ ] `background-effects.blade.php`
- [ ] `currency-dropdown.blade.php`
- [ ] `currency-modal.blade.php`
- [ ] `date-format-dropdown.blade.php`
- [ ] `date-format-modal.blade.php`
- [ ] `desktop-sidebar.blade.php`
- [ ] `language-dropdown.blade.php`
- [ ] `language-modal.blade.php`
- [ ] `locale-config.blade.php`
- [ ] `locale-modal.blade.php`
- [ ] `locale-trigger.blade.php`
- [ ] `localization-modal.blade.php`
- [ ] `mobile-nav.blade.php`
- [ ] `number-format-dropdown.blade.php`
- [ ] `preferences-dropdowns-js.blade.php`
- [ ] `theme-meta.blade.php`
- [ ] `topbar.blade.php`
- Folder README: pending

### `resources/views/ui/rooms` (3 files) — PENDING (0/3)
- [ ] `create.blade.php`
- [ ] `edit.blade.php`
- [ ] `show.blade.php`
- Folder README: pending

### `resources/views/ui/stock` (7 files) — PENDING (0/7)
- [ ] `categories.blade.php`
- [ ] `dashboard.blade.php`
- [ ] `movements.blade.php`
- [ ] `parts.blade.php`
- [ ] `plans.blade.php`
- [ ] `suppliers.blade.php`
- [ ] `tax-rates.blade.php`
- Folder README: pending

### `resources/views/ui/stock/parts` (3 files) — PENDING (0/3)
- [ ] `create.blade.php`
- [ ] `edit.blade.php`
- [ ] `show.blade.php`
- Folder README: pending

### `resources/views/ui/stock/suppliers` (2 files) — PENDING (0/2)
- [ ] `create.blade.php`
- [ ] `edit.blade.php`
- Folder README: pending

### `resources/views/ui/tickets/public` (2 files) — PENDING (0/2)
- [ ] `create.blade.php`
- [ ] `success.blade.php`
- Folder README: pending

### `resources/css` (5 files) — PENDING (0/5)
- [ ] `app.css`
- [ ] `base.css`
- [ ] `layout.css`
- [ ] `rtl.css`
- [ ] `tokens.css`
- Folder README: pending

### `resources/css/components` (6 files) — PENDING (0/6)
- [ ] `badges.css`
- [ ] `forms.css`
- [ ] `locale-modal.css`
- [ ] `localization-modal.css`
- [ ] `navigation.css`
- [ ] `sidebar.css`
- Folder README: pending

### `resources/css/components/buttons` (2 files) — PENDING (0/2)
- [ ] `button-base.css`
- [ ] `button-variants.css`
- Folder README: pending

### `resources/css/components/cards` (1 files) — PENDING (0/1)
- [ ] `card-base.css`
- Folder README: pending

### `resources/css/pages` (6 files) — PENDING (0/6)
- [ ] `calendar.css`
- [ ] `definicoes.css`
- [ ] `listing.css`
- [ ] `login.css`
- [ ] `sistema-definicoes.css`
- [ ] `tickets.css`
- Folder README: pending

### `resources/css/swagger` (1 files) — PENDING (0/1)
- [ ] `swagger-theme.css`
- Folder README: pending

### `resources/css/theme` (1 files) — PENDING (0/1)
- [ ] `variables.css`
- Folder README: pending

### `resources/js` (5 files) — PENDING (0/5)
- [ ] `alpine.js`
- [ ] `analytics.js`
- [ ] `api-client.js`
- [ ] `app.js`
- [ ] `early-theme.js`
- Folder README: pending

### `resources/js/auth` (2 files) — PENDING (0/2)
- [ ] `login.js`
- [ ] `utils.js`
- Folder README: pending

### `resources/js/bootstrap` (1 files) — PENDING (0/1)
- [ ] `page-registry.js`
- Folder README: pending

### `resources/js/components` (2 files) — PENDING (0/2)
- [ ] `locale-modal.js`
- [ ] `localization-modal.js`
- Folder README: pending

### `resources/js/components/input` (4 files) — PENDING (0/4)
- [ ] `autocomplete.js`
- [ ] `combobox.js`
- [ ] `otp.js`
- [ ] `password-strength.js`
- Folder README: pending

### `resources/js/components/listing` (1 files) — PENDING (0/1)
- [ ] `feedback.js`
- Folder README: pending

### `resources/js/components/modal` (1 files) — PENDING (0/1)
- [ ] `base.js`
- Folder README: pending

### `resources/js/core` (9 files) — PENDING (0/9)
- [ ] `auth-box.js`
- [ ] `auth.js`
- [ ] `dropdown-manager.js`
- [ ] `layout.js`
- [ ] `navigation-manager.js`
- [ ] `notifications.js`
- [ ] `search-engine.js`
- [ ] `sidebar.js`
- [ ] `theme.js`
- Folder README: pending

### `resources/js/pages` (18 files) — PENDING (0/18)
- [ ] `audits.js`
- [ ] `auth-reset.js`
- [ ] `calendar.js`
- [ ] `dashboard.js`
- [ ] `definicoes-aparencia.js`
- [ ] `definicoes-sistema.js`
- [ ] `equipments-form.js`
- [ ] `equipments-management.js`
- [ ] `error-page.js`
- [ ] `profile.js`
- [ ] `rooms-form.js`
- [ ] `rooms-management.js`
- [ ] `swagger.js`
- [ ] `ticket-create.js`
- [ ] `ticket-detail.js`
- [ ] `tickets-management.js`
- [ ] `users-form.js`
- [ ] `users-management.js`
- Folder README: pending

### `resources/js/pages/analytics` (6 files) — PENDING (0/6)
- [ ] `activity.js`
- [ ] `charts.js`
- [ ] `export.js`
- [ ] `helpers.js`
- [ ] `index.js`
- [ ] `kpi.js`
- Folder README: pending

### `resources/js/pages/audits` (5 files) — PENDING (0/5)
- [ ] `api.js`
- [ ] `dom.js`
- [ ] `filters.js`
- [ ] `render.js`
- [ ] `state.js`
- Folder README: pending

### `resources/js/pages/equipments-management` (4 files) — PENDING (0/4)
- [ ] `api.js`
- [ ] `dom.js`
- [ ] `render.js`
- [ ] `state.js`
- Folder README: pending

### `resources/js/pages/rooms-management` (4 files) — PENDING (0/4)
- [ ] `api.js`
- [ ] `dom.js`
- [ ] `render.js`
- [ ] `state.js`
- Folder README: pending

### `resources/js/pages/stock` (9 files) — PENDING (0/9)
- [ ] `categories.js`
- [ ] `dashboard.js`
- [ ] `movements.js`
- [ ] `parts-form.js`
- [ ] `parts.js`
- [ ] `plans.js`
- [ ] `suppliers-form.js`
- [ ] `suppliers.js`
- [ ] `tax-rates.js`
- Folder README: pending

### `resources/js/pages/stock/movements` (4 files) — PENDING (0/4)
- [ ] `api.js`
- [ ] `dom.js`
- [ ] `render.js`
- [ ] `state.js`
- Folder README: pending

### `resources/js/pages/stock/parts` (4 files) — PENDING (0/4)
- [ ] `api.js`
- [ ] `dom.js`
- [ ] `render.js`
- [ ] `state.js`
- Folder README: pending

### `resources/js/pages/stock/plans` (4 files) — PENDING (0/4)
- [ ] `api.js`
- [ ] `dom.js`
- [ ] `render.js`
- [ ] `state.js`
- Folder README: pending

### `resources/js/pages/stock/suppliers` (4 files) — PENDING (0/4)
- [ ] `api.js`
- [ ] `dom.js`
- [ ] `render.js`
- [ ] `state.js`
- Folder README: pending

### `resources/js/pages/ticket-create` (5 files) — PENDING (0/5)
- [ ] `autocomplete.js`
- [ ] `dom.js`
- [ ] `file-upload.js`
- [ ] `form.js`
- [ ] `priority.js`
- Folder README: pending

### `resources/js/pages/ticket-detail` (10 files) — PENDING (0/10)
- [ ] `assignment.js`
- [ ] `budget.js`
- [ ] `comments.js`
- [ ] `details.js`
- [ ] `photos.js`
- [ ] `priority-modal.js`
- [ ] `start-actions.js`
- [ ] `state.js`
- [ ] `ui.js`
- [ ] `workflow.js`
- Folder README: pending

### `resources/js/pages/tickets-management` (4 files) — PENDING (0/4)
- [ ] `api.js`
- [ ] `dom.js`
- [ ] `render.js`
- [ ] `state.js`
- Folder README: pending

### `resources/js/pages/users-management` (4 files) — PENDING (0/4)
- [ ] `api.js`
- [ ] `dom.js`
- [ ] `render.js`
- [ ] `state.js`
- Folder README: pending

### `resources/js/services` (1 files) — PENDING (0/1)
- [ ] `autocomplete-service.js`
- Folder README: pending

### `resources/js/utils` (2 files) — PENDING (0/2)
- [ ] `api.js`
- [ ] `locale.js`
- Folder README: pending

### `resources/docs` (1 files) — PENDING (0/1)
- [ ] `design-notes.md`
- Folder README: pending

### `resources` (0 files) — PENDING (0/0)
- Folder README: pending

### `public` (4 files) — PENDING (0/4)
- [ ] `.htaccess`
- [ ] `favicon.ico`
- [ ] `index.php`
- [ ] `robots.txt`
- Folder README: pending

### `docs` (18 files) — PENDING (0/18)
- [ ] `Plano-Testes.md`
- [ ] `Requisitos.md`
- [ ] `Workflow.md`
- [ ] `analise-pocessos.md`
- [ ] `api-endpoints.md`
- [ ] `atas-reuniao.md`
- [ ] `atribuicao-prioridades.md`
- [ ] `dashboard-seed-report.md`
- [ ] `diagrama-arquitetura.md`
- [ ] `fase-13-final-report.md`
- [ ] `fluxo-orcamental.md`
- [ ] `guia-utilizador.md`
- [ ] `i18n-progress.md`
- [ ] `permissoes.md`
- [ ] `plano-projeto.md`
- [ ] `product-backlog.md`
- [ ] `tecnologias.md`
- [ ] `workflow-integracoes.md`
- Folder README: pending

### `docs/assets` (1 files) — PENDING (0/1)
- [ ] `Diagrama_fluxo_inteligente_ticket.png`
- Folder README: pending

### `docs/i18n/archive-json` (18 files) — PENDING (0/18)
- [ ] `cs-CZ.json`
- [ ] `da-DK.json`
- [ ] `de-DE.json`
- [ ] `el-GR.json`
- [ ] `en-GB.json`
- [ ] `en-US.json`
- [ ] `es-ES.json`
- [ ] `fi-FI.json`
- [ ] `fr-FR.json`
- [ ] `hu-HU.json`
- [ ] `it-IT.json`
- [ ] `nl-NL.json`
- [ ] `pl-PL.json`
- [ ] `pt-BR.json`
- [ ] `pt-PT.json`
- [ ] `ro-RO.json`
- [ ] `sv-SE.json`
- [ ] `tr-TR.json`
- Folder README: pending

### `docs/i18n/review` (3 files) — PENDING (0/3)
- [ ] `3a-identidade-es-ES.csv`
- [ ] `3a-identidade-pt-BR.csv`
- [ ] `audit_summary.json`
- Folder README: pending

### `docs/i18n/review/backup-3a` (2 files) — PENDING (0/2)
- [ ] `common.php`
- [ ] `tickets.php`
- Folder README: pending

### `docs/i18n/scripts` (19 files) — PENDING (0/19)
- [ ] `audit_final.py`
- [ ] `audit_usage.py`
- [ ] `build_locale.py`
- [ ] `build_ru_ru.py`
- [ ] `php_lang_audit.py`
- [ ] `th_part1.py`
- [ ] `th_part2.py`
- [ ] `th_part3.py`
- [ ] `translations_bg_BG.py`
- [ ] `translations_hi_IN.py`
- [ ] `translations_id_ID.py`
- [ ] `translations_ja_JP.py`
- [ ] `translations_ko_KR.py`
- [ ] `translations_ru_RU.py`
- [ ] `translations_th_TH.py`
- [ ] `translations_uk_UA.py`
- [ ] `translations_vi_VN.py`
- [ ] `translations_zh_CN.py`
- [ ] `translations_zh_TW.py`
- Folder README: pending

### `.github` (1 files) — PENDING (0/1)
- [ ] `dependabot.yml`
- Folder README: pending

### `.github/actions/setup-php-composer` (1 files) — PENDING (0/1)
- [ ] `action.yml`
- Folder README: pending

### `.github/workflows` (4 files) — PENDING (0/4)
- [ ] `ci.yml`
- [ ] `docker.yml`
- [ ] `release.yml`
- [ ] `security.yml`
- Folder README: pending

### `tools` (1 files) — PENDING (0/1)
- [ ] `generate_refactor_manifest.py`
- Folder README: pending

### `tests` (1 files) — PENDING (0/1)
- [ ] `TestCase.php`
- Folder README: pending

### `tests/Authentication` (5 files) — PENDING (0/5)
- [ ] `AuthEdgeCasesTest.php`
- [ ] `AuthFlowTest.php`
- [ ] `AuthenticationTest.php`
- [ ] `LoginFlowTest.php`
- [ ] `PasswordResetFlowTest.php`
- Folder README: pending

### `tests/Authorization` (1 files) — PENDING (0/1)
- [ ] `UiAuthorizationTest.php`
- Folder README: pending

### `tests/Base` (3 files) — PENDING (0/3)
- [ ] `DatabaseTestCase.php`
- [ ] `FeatureTestCase.php`
- [ ] `UnitTestCase.php`
- Folder README: pending

### `tests/Concerns` (10 files) — PENDING (0/10)
- [ ] `CreatesEquipment.php`
- [ ] `CreatesTickets.php`
- [ ] `CreatesUsers.php`
- [ ] `InteractsWithApi.php`
- [ ] `InteractsWithEvents.php`
- [ ] `InteractsWithMail.php`
- [ ] `InteractsWithNotifications.php`
- [ ] `InteractsWithQueue.php`
- [ ] `InteractsWithStorage.php`
- [ ] `SeedsLookupData.php`
- Folder README: pending

### `tests/Database/Constraints` (12 files) — PENDING (0/12)
- [ ] `AttachmentPersistenceTest.php`
- [ ] `AuditTrailTest.php`
- [ ] `BudgetCalculationTest.php`
- [ ] `CastIntegrityTest.php`
- [ ] `ConcurrencyTest.php`
- [ ] `DatabaseIntegrityTest.php`
- [ ] `DatabaseOptimizationTest.php`
- [ ] `ModelLifecycleTest.php`
- [ ] `NotificationPersistenceTest.php`
- [ ] `RelationshipIntegrityTest.php`
- [ ] `TokenIntegrityTest.php`
- [ ] `WorkflowPersistenceTest.php`
- Folder README: pending

### `tests/Database/Migrations` (1 files) — PENDING (0/1)
- [ ] `DatabaseSchemaValidationTest.php`
- Folder README: pending

### `tests/Database/Seeders` (1 files) — PENDING (0/1)
- [ ] `ComplianceSeedersTest.php`
- Folder README: pending

### `tests/Feature` (1 files) — PENDING (0/1)
- [ ] `UserPreferencesTest.php`
- Folder README: pending

### `tests/Feature/API/Controllers` (25 files) — PENDING (0/25)
- [ ] `AdminCrudFeatureTest.php`
- [ ] `AdminManagementTest.php`
- [ ] `AdminUserControllerTest.php`
- [ ] `AiTriagingFeatureTest.php`
- [ ] `AnalyticsFeatureTest.php`
- [ ] `ApiAuthTest.php`
- [ ] `AttachmentOperationFeatureTest.php`
- [ ] `AuditEndpointsTest.php`
- [ ] `AuditFeatureTest.php`
- [ ] `BudgetFeatureTest.php`
- [ ] `CalendarFeatureTest.php`
- [ ] `CommentOperationFeatureTest.php`
- [ ] `EquipmentAndRoomCrudFeatureTest.php`
- [ ] `ErrorScenarioFeatureTest.php`
- [ ] `NotificationFeatureTest.php`
- [ ] `NotificationFlowTest.php`
- [ ] `StockManagementFeatureTest.php`
- [ ] `TicketAssignmentFeatureTest.php`
- [ ] `TicketAuditLogTest.php`
- [ ] `TicketAuthorizationFeatureTest.php`
- [ ] `TicketOperationsTest.php`
- [ ] `TicketPhotoUploadTest.php`
- [ ] `TicketScheduleFeatureTest.php`
- [ ] `TicketSearchTest.php`
- [ ] `TicketWorkflowFeatureTest.php`
- Folder README: pending

### `tests/Feature/API/Routing` (1 files) — PENDING (0/1)
- [ ] `SwaggerDocumentationTest.php`
- Folder README: pending

### `tests/Feature/Actions` (2 files) — PENDING (0/2)
- [ ] `CreateTicketActionTest.php`
- [ ] `CreateUserActionTest.php`
- Folder README: pending

### `tests/Feature/Console` (1 files) — PENDING (0/1)
- [ ] `ConsoleCommandsTest.php`
- Folder README: pending

### `tests/Feature/Domain` (4 files) — PENDING (0/4)
- [ ] `CheckHigherPriorityActionTest.php`
- [ ] `TicketLifecycleActionsTest.php`
- [ ] `TicketQueriesTest.php`
- [ ] `TicketStatusCheckerTest.php`
- Folder README: pending

### `tests/Feature/Middleware` (6 files) — PENDING (0/6)
- [ ] `CsrfMiddlewareTest.php`
- [ ] `CustomAuthMiddlewareTest.php`
- [ ] `MiddlewareAuthTest.php`
- [ ] `RateLimitMiddlewareTest.php`
- [ ] `RoleMiddlewareTest.php`
- [ ] `SetLocaleMiddlewareTest.php`
- Folder README: pending

### `tests/Feature/Repositories` (1 files) — PENDING (0/1)
- [ ] `TicketRepositoryTest.php`
- Folder README: pending

### `tests/Feature/Validation` (1 files) — PENDING (0/1)
- [ ] `ValidationEdgeCaseTest.php`
- Folder README: pending

### `tests/Feature/Web` (1 files) — PENDING (0/1)
- [ ] `LocaleControllerTest.php`
- Folder README: pending

### `tests/Feature/Web/Controllers` (6 files) — PENDING (0/6)
- [ ] `DashboardRedirectTest.php`
- [ ] `PageControllerTest.php`
- [ ] `ProfileControllerTest.php`
- [ ] `RegisterControllerTest.php`
- [ ] `RoomControllerTest.php`
- [ ] `UiControllerTest.php`
- Folder README: pending

### `tests/Feature/Web/Views` (4 files) — PENDING (0/4)
- [ ] `AssetPipelineTest.php`
- [ ] `DesignSystemComponentsTest.php`
- [ ] `DesignSystemViewsTest.php`
- [ ] `UiUsabilityTest.php`
- Folder README: pending

### `tests/Fixtures/Builders` (2 files) — PENDING (0/2)
- [ ] `TicketBuilder.php`
- [ ] `UserBuilder.php`
- Folder README: pending

### `tests/Fixtures/Datasets` (3 files) — PENDING (0/3)
- [ ] `TicketPriorityDataset.php`
- [ ] `TicketStatusDataset.php`
- [ ] `UserRoleDataset.php`
- Folder README: pending

### `tests/Fixtures/Fakes` (1 files) — PENDING (0/1)
- [ ] `FakeNotificationService.php`
- Folder README: pending

### `tests/Fixtures/Helpers` (1 files) — PENDING (0/1)
- [ ] `TestHelper.php`
- Folder README: pending

### `tests/Integration/Broadcasting` (1 files) — PENDING (0/1)
- [ ] `BroadcastAndQueueTest.php`
- Folder README: pending

### `tests/Integration/Database` (5 files) — PENDING (0/5)
- [ ] `ForeignKeyIntegrityTest.php`
- [ ] `MassAssignmentProtectionTest.php`
- [ ] `ModelLifecycleTest.php`
- [ ] `RelationshipIntegrityTest.php`
- [ ] `SoftDeleteTest.php`
- Folder README: pending

### `tests/Integration/Mail` (1 files) — PENDING (0/1)
- [ ] `MailgunTestEmailTest.php`
- Folder README: pending

### `tests/Performance` (1 files) — PENDING (0/1)
- [ ] `PerformanceTestCase.php`
- Folder README: pending

### `tests/Performance/APIPerformance` (1 files) — PENDING (0/1)
- [ ] `TicketEndpointPerformanceTest.php`
- Folder README: pending

### `tests/Performance/Authentication` (1 files) — PENDING (0/1)
- [ ] `AuthPerformanceTest.php`
- Folder README: pending

### `tests/Performance/CachePerformance` (1 files) — PENDING (0/1)
- [ ] `CachePerformanceTest.php`
- Folder README: pending

### `tests/Performance/Dashboard` (1 files) — PENDING (0/1)
- [ ] `DashboardPerformanceTest.php`
- Folder README: pending

### `tests/Performance/DatabasePerformance` (5 files) — PENDING (0/5)
- [ ] `DatabasePerformanceTest.php`
- [ ] `LazyLoadingTest.php`
- [ ] `NPlusOneQueryTest.php`
- [ ] `PerformanceAndNPlusOneTest.php`
- [ ] `QueryCountTest.php`
- Folder README: pending

### `tests/Performance/MemoryPerformance` (2 files) — PENDING (0/2)
- [ ] `MemoryPerformanceTest.php`
- [ ] `MemoryUsageTest.php`
- Folder README: pending

### `tests/Performance/ReportsPerformance` (1 files) — PENDING (0/1)
- [ ] `ReportPerformanceTest.php`
- Folder README: pending

### `tests/Performance/ScalabilityPerformance` (1 files) — PENDING (0/1)
- [ ] `ScalabilityPerformanceTest.php`
- Folder README: pending

### `tests/Performance/SearchPerformance` (1 files) — PENDING (0/1)
- [ ] `SearchPerformanceTest.php`
- Folder README: pending

### `tests/Performance/UploadsPerformance` (1 files) — PENDING (0/1)
- [ ] `UploadPerformanceTest.php`
- Folder README: pending

### `tests/Security/APITokens` (1 files) — PENDING (0/1)
- [ ] `APITokenSecurityTest.php`
- Folder README: pending

### `tests/Security/Authentication` (3 files) — PENDING (0/3)
- [ ] `AuthenticationSecurityTest.php`
- [ ] `SecurityActiveTest.php`
- [ ] `SecurityAuthTest.php`
- Folder README: pending

### `tests/Security/Authorization` (1 files) — PENDING (0/1)
- [ ] `AuthorizationSecurityTest.php`
- Folder README: pending

### `tests/Security/CSRF` (2 files) — PENDING (0/2)
- [ ] `CsrfProtectionTest.php`
- [ ] `SecurityCsrfTest.php`
- Folder README: pending

### `tests/Security/FileUpload` (1 files) — PENDING (0/1)
- [ ] `FileUploadSecurityTest.php`
- Folder README: pending

### `tests/Security/Headers` (1 files) — PENDING (0/1)
- [ ] `SecurityHeadersTest.php`
- Folder README: pending

### `tests/Security/IDOR` (1 files) — PENDING (0/1)
- [ ] `IDORTest.php`
- Folder README: pending

### `tests/Security/MassAssignment` (1 files) — PENDING (0/1)
- [ ] `MassAssignmentTest.php`
- Folder README: pending

### `tests/Security/Password` (2 files) — PENDING (0/2)
- [ ] `PasswordSecurityTest.php`
- [ ] `SecurityPasswordPolicyTest.php`
- Folder README: pending

### `tests/Security/PathTraversal` (1 files) — PENDING (0/1)
- [ ] `PathTraversalTest.php`
- Folder README: pending

### `tests/Security/PrivilegeEscalation` (1 files) — PENDING (0/1)
- [ ] `PrivilegeEscalationTest.php`
- Folder README: pending

### `tests/Security/RateLimiting` (3 files) — PENDING (0/3)
- [ ] `RateLimitingTest.php`
- [ ] `SecurityBruteForceTest.php`
- [ ] `SecurityRateLimitTest.php`
- Folder README: pending

### `tests/Security/SQLInjection` (2 files) — PENDING (0/2)
- [ ] `SecurityVulnerabilitiesTest.php`
- [ ] `SqlInjectionTest.php`
- Folder README: pending

### `tests/Security/Session` (2 files) — PENDING (0/2)
- [ ] `SecuritySessionTest.php`
- [ ] `SessionSecurityTest.php`
- Folder README: pending

### `tests/Security/Tokens` (2 files) — PENDING (0/2)
- [ ] `SecurityTokenTest.php`
- [ ] `TokenSecurityTest.php`
- Folder README: pending

### `tests/Security/UserEnumeration` (1 files) — PENDING (0/1)
- [ ] `UserEnumerationTest.php`
- Folder README: pending

### `tests/Security/XSS` (2 files) — PENDING (0/2)
- [ ] `SecurityInputValidationTest.php`
- [ ] `XSSProtectionTest.php`
- Folder README: pending

### `tests/Unit` (1 files) — PENDING (0/1)
- [ ] `PreferenciasServiceTest.php`
- Folder README: pending

### `tests/Unit/Actions` (10 files) — PENDING (0/10)
- [ ] `ApproveBudgetActionTest.php`
- [ ] `AssignTechnicianActionTest.php`
- [ ] `CreateEquipmentActionTest.php`
- [ ] `CreatePreventiveTicketActionTest.php`
- [ ] `CreateRoomActionTest.php`
- [ ] `ScheduleTicketActionTest.php`
- [ ] `SubmitBudgetActionTest.php`
- [ ] `UpdateEquipmentActionTest.php`
- [ ] `UpdateRoomActionTest.php`
- [ ] `UpdateUserActionTest.php`
- Folder README: pending

### `tests/Unit/Concerns` (1 files) — PENDING (0/1)
- [ ] `BroadcastsTicketStatusTest.php`
- Folder README: pending

### `tests/Unit/Console` (1 files) — PENDING (0/1)
- [ ] `TelemetryCommandTest.php`
- Folder README: pending

### `tests/Unit/DTOs` (16 files) — PENDING (0/16)
- [ ] `AssignTechnicianDataTest.php`
- [ ] `BudgetDecisionDataTest.php`
- [ ] `BudgetSubmissionDataTest.php`
- [ ] `CloseTicketDataTest.php`
- [ ] `CommentDataTest.php`
- [ ] `CreateTicketDataTest.php`
- [ ] `PasswordChangeDataTest.php`
- [ ] `ProfileUpdateDataTest.php`
- [ ] `ScheduleTicketDataTest.php`
- [ ] `StoreEquipmentDataTest.php`
- [ ] `StoreRoomDataTest.php`
- [ ] `StoreUserDataTest.php`
- [ ] `TicketFiltersTest.php`
- [ ] `UpdateEquipmentDataTest.php`
- [ ] `UpdateRoomDataTest.php`
- [ ] `UpdateUserDataTest.php`
- Folder README: pending

### `tests/Unit/Enums` (10 files) — PENDING (0/10)
- [ ] `AuditEventEnumTest.php`
- [ ] `BudgetDecisionEnumTest.php`
- [ ] `BudgetStatusEnumTest.php`
- [ ] `FileTypeEnumTest.php`
- [ ] `NotificationPriorityEnumTest.php`
- [ ] `NotificationTypeEnumTest.php`
- [ ] `TicketPriorityEnumTest.php`
- [ ] `TicketStatusEnumTest.php`
- [ ] `TicketWorkflowStatusEnumTest.php`
- [ ] `UserRoleEnumTest.php`
- Folder README: pending

### `tests/Unit/Events` (2 files) — PENDING (0/2)
- [ ] `TicketStatusChangedTest.php`
- [ ] `TicketStatusUpdatedBroadcastTest.php`
- Folder README: pending

### `tests/Unit/Exports` (1 files) — PENDING (0/1)
- [ ] `TicketsExportTest.php`
- Folder README: pending

### `tests/Unit/Http/Resources` (1 files) — PENDING (0/1)
- [ ] `ResourcesTest.php`
- Folder README: pending

### `tests/Unit/Jobs` (3 files) — PENDING (0/3)
- [ ] `ExportJobsTest.php`
- [ ] `ExportReportPdfJobsTest.php`
- [ ] `GenerateAiRecommendationJobTest.php`
- Folder README: pending

### `tests/Unit/Listeners` (3 files) — PENDING (0/3)
- [ ] `LogTicketStatusChangeTest.php`
- [ ] `LogTicketWorkflowChangeTest.php`
- [ ] `NotifyAssignedTechnicianTest.php`
- Folder README: pending

### `tests/Unit/Mail` (1 files) — PENDING (0/1)
- [ ] `MailablesTest.php`
- Folder README: pending

### `tests/Unit/Middleware` (2 files) — PENDING (0/2)
- [ ] `SecurityHeadersTest.php`
- [ ] `SetLocaleMiddlewareTest.php`
- Folder README: pending

### `tests/Unit/Models` (16 files) — PENDING (0/16)
- [ ] `AuditTest.php`
- [ ] `CategoryTest.php`
- [ ] `EquipmentCategoryTest.php`
- [ ] `EquipmentTest.php`
- [ ] `ModelAccessorsTest.php`
- [ ] `NotificationModelTest.php`
- [ ] `RoomTest.php`
- [ ] `TicketAttachmentTest.php`
- [ ] `TicketAttributesTest.php`
- [ ] `TicketCommentTest.php`
- [ ] `TicketStatusTest.php`
- [ ] `TicketTypeTest.php`
- [ ] `TicketWorkflowHistoryTest.php`
- [ ] `TicketWorkflowTest.php`
- [ ] `UserProfileTest.php`
- [ ] `UserTest.php`
- Folder README: pending

### `tests/Unit/Observers` (1 files) — PENDING (0/1)
- [ ] `ObserversTest.php`
- Folder README: pending

### `tests/Unit/Policies` (2 files) — PENDING (0/2)
- [ ] `AccessPoliciesTest.php`
- [ ] `TicketPolicyTest.php`
- Folder README: pending

### `tests/Unit/Providers` (1 files) — PENDING (0/1)
- [ ] `ProvidersTest.php`
- Folder README: pending

### `tests/Unit/Repositories` (1 files) — PENDING (0/1)
- [ ] `RepositoriesTest.php`
- Folder README: pending

### `tests/Unit/Services` (18 files) — PENDING (0/18)
- [ ] `AIServiceTest.php`
- [ ] `AnalyticsDashboardServiceTest.php`
- [ ] `AnalyticsExportServiceTest.php`
- [ ] `AnalyticsServiceTest.php`
- [ ] `BudgetCalculatorServiceTest.php`
- [ ] `BudgetNotificationServiceTest.php`
- [ ] `CalendarServiceTest.php`
- [ ] `EquipmentServiceTest.php`
- [ ] `LocaleServiceTest.php`
- [ ] `LocalizationServiceTest.php`
- [ ] `NotificationCreatorServiceTest.php`
- [ ] `NotificationServiceTest.php`
- [ ] `PasswordResetServiceTest.php`
- [ ] `ServicesTest.php`
- [ ] `StockServicesTest.php`
- [ ] `TechnicianAssignmentServiceTest.php`
- [ ] `TicketNotificationServiceTest.php`
- [ ] `TicketSearchServiceTest.php`
- Folder README: pending

### `tests/Unit/Traits` (1 files) — PENDING (0/1)
- [ ] `AuditableTraitTest.php`
- Folder README: pending

### `tests/Unit/ValueObjects` (4 files) — PENDING (0/4)
- [ ] `BudgetPauseMinutesTest.php`
- [ ] `EmailTest.php`
- [ ] `MoneyTest.php`
- [ ] `SerialNumberTest.php`
- Folder README: pending

## NEEDS REVIEW

*(No items currently blocking. Escalate any ambiguous items here during execution.)*
