# app/Exports

Excel export classes using Maatwebsite/Excel for generating spreadsheet reports.

## Files

| File | Purpose |
|---|---|
| `TicketsExport.php` | Exports tickets to Excel with dynamic filtering, native currency/date formatting, chunked reading, zebra striping, and frozen header |

## Notes for developers / AI

- Accepts an optional `Builder` via constructor for filtered exports from controllers.
- Heading labels and sheet title are user-facing (Portuguese) — managed by i18n project.
- Implements 9 Excel concern interfaces for full control over formatting and performance.
- Uses chunked reading (1000 records) for memory-efficient large exports.
