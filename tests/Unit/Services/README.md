# Services — Testes

## Descrição da Pasta
Testes unitários isolados para validação atómica de componentes, classes de domínio, Actions, DTOs, Enums, Models, Services e Jobs sem dependências externas.

### Módulos e Ficheiros de Teste

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


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Unit/Services
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Unit/Services --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Unit/Services --coverage
```