# app/Jobs

Queued jobs for background processing of exports, alerts, AI recommendations, and email delivery.

## Files

| File | Purpose |
|---|---|
| `CheckLowStockJob.php` | Daily scheduled job that checks for low-stock parts and triggers admin notifications via `LowStockAlertService` |
| `ExportCsvJob.php` | Generates a CSV tickets report and creates a download notification |
| `ExportExcelJob.php` | Generates an Excel (.xlsx) tickets report using Maatwebsite/Excel |
| `ExportPdfJob.php` | Generates a PDF tickets report using DomPDF |
| `ExportEquipmentQrPdfJob.php` | Generates a PDF with QR codes for all active equipment |
| `ExportStockCostsPdfJob.php` | Generates a PDF report of stock costs grouped by equipment |
| `GenerateAiRecommendationJob.php` | Calls the AI service to recommend a technician for a ticket; uses unique lock to prevent duplicate calls |
| `SendTestEmailJob.php` | Sends a test email via the configured mailer |

## Notes for developers / AI

- All export jobs create a `Notification` record for the user upon completion/failure.
- User-facing notification strings (title/message) are in Portuguese — managed by the i18n project, not this refactor.
- `GenerateAiRecommendationJob` implements `ShouldBeUnique` with a 2-minute uniqueness window.
- `CheckLowStockJob` uses `Queueable` only (no Dispatchable) as it is scheduler-dispatched.
