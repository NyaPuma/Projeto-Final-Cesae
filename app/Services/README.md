# app/Services

Business logic service layer for the SGM maintenance management platform.

## Services

### AI Services
- `AIService` - AI-powered technician recommendation using OpenAI
- `TicketStatusService` - Ticket status resolution with caching

### Analytics Services
- `AnalyticsService` - Main analytics facade
- `AnalyticsDashboardService` - Dashboard data aggregation
- `AnalyticsExportService` - CSV/PDF export functionality

### Budget Services
- `BudgetCalculatorService` - Budget calculation and breakdown
- `BudgetNotificationService` - Budget-related notifications

### Notification Services
- `NotificationService` - Notification facade
- `NotificationCreatorService` - In-app notification creation
- `TicketNotificationService` - Ticket-specific notifications
- `LowStockAlertService` - Low stock alert notifications

### User & Auth Services
- `UserService` - User management and token generation
- `PasswordResetService` - Password reset token management
- `AuthUserResolver` - Authentication user resolution

### Localization Services
- `LocaleService` - Locale resolution and formatting
- `LocalizationService` - Localized presentation (dates, numbers, currency)
- `PreferencesService` - User preferences (language, currency, date format)

### Stock Services
- `StockDashboardService` - Stock statistics and reports
- `StockMovementService` - Stock movement tracking

### Equipment & Parts Services
- `EquipmentService` - Equipment listing and search
- `PartService` - Parts listing and filtering
- `PartPriceCalculator` - Part price calculations

### Workflow Services
- `TicketWorkflowService` - Ticket lifecycle management
- `TicketSearchService` - Ticket search and filtering

### UI Services
- `ThemePresetService` - Theme presets (28 themes: 14 families × light/dark)
- `CalendarService` - Scheduled events for calendar view
- `SystemSettingsService` - System configuration management
- `TechnicianAssignmentService` - Technician assignment logic

## Conventions

- All docblocks and comments in English
- Static methods preferred for stateless services
- `final` classes only
- Type declarations required on all parameters and return types
- Exception messages in English
