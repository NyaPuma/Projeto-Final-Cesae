# app/Models

Eloquent ORM models representing the persistence layer and domain entities of the SGM system.

## Models & Database Mappings

| Model | Table | Key Relationships | Purpose |
|---|---|---|---|
| [`Audit.php`](file:///home/nyapuma/Transferências/Projeto-Final-Cesae/app/Models/Audit.php) | `audits` | `belongsTo(User)`, `morphTo(auditable)` | Immutable audit trail capturing changes to models, acting user, IP address, and URLs. |
| [`Equipment.php`](file:///home/nyapuma/Transferências/Projeto-Final-Cesae/app/Models/Equipment.php) | `equipments` | `belongsTo(EquipmentCategory)`, `belongsTo(Room)`, `hasMany(Ticket)`, `hasMany(MaintenancePlan)` | Hardware assets, serial numbers, warranty tracking, and physical location allocations. |
| [`EquipmentCategory.php`](file:///home/nyapuma/Transferências/Projeto-Final-Cesae/app/Models/EquipmentCategory.php) | `equipment_categories` | `hasMany(Equipment)` | Grouping classification for hardware equipment assets. |
| [`MaintenancePlan.php`](file:///home/nyapuma/Transferências/Projeto-Final-Cesae/app/Models/MaintenancePlan.php) | `maintenance_plans` | `belongsTo(Equipment)`, `belongsToMany(Part)` | Preventive maintenance routines, recurrence intervals, and expected part consumption. |
| [`Notification.php`](file:///home/nyapuma/Transferências/Projeto-Final-Cesae/app/Models/Notification.php) | `notifications` | `belongsTo(User)`, `morphTo(notifiable)` | In-app, email, and system alert notifications with read/unread tracking. |
| [`Part.php`](file:///home/nyapuma/Transferências/Projeto-Final-Cesae/app/Models/Part.php) | `parts` | `belongsTo(PartCategory)`, `belongsTo(TaxRate)`, `belongsToMany(Supplier)`, `hasMany(StockMovement)` | Inventory stock items, SKU references, pricing, stock levels, and threshold limits. |
| [`PartCategory.php`](file:///home/nyapuma/Transferências/Projeto-Final-Cesae/app/Models/PartCategory.php) | `part_categories` | `hasMany(Part)` | Taxonomy grouping for spare parts and consumable stock items. |
| [`Room.php`](file:///home/nyapuma/Transferências/Projeto-Final-Cesae/app/Models/Room.php) | `rooms` | `hasMany(Equipment)`, `hasMany(Ticket)` | Physical facility rooms, buildings, and floors where equipment is stationed. |
| [`StockMovement.php`](file:///home/nyapuma/Transferências/Projeto-Final-Cesae/app/Models/StockMovement.php) | `stock_movements` | `belongsTo(Part)`, `belongsTo(Ticket)`, `belongsTo(Equipment)`, `belongsTo(User)` | Inventory transactions (stock in, stock out, consumption in ticket interventions, adjustments). |
| [`Supplier.php`](file:///home/nyapuma/Transferências/Projeto-Final-Cesae/app/Models/Supplier.php) | `suppliers` | `belongsToMany(Part)` | External vendors and parts suppliers, tracking tax IDs (NIF) and lead times. |
| [`SystemSetting.php`](file:///home/nyapuma/Transferências/Projeto-Final-Cesae/app/Models/SystemSetting.php) | `system_settings` | None | Key-value application runtime configuration overrides. |
| [`TaxRate.php`](file:///home/nyapuma/Transferências/Projeto-Final-Cesae/app/Models/TaxRate.php) | `tax_rates` | `hasMany(Part)` | VAT / sales tax rates applied to spare parts catalog pricing. |
| [`ThemeSetting.php`](file:///home/nyapuma/Transferências/Projeto-Final-Cesae/app/Models/ThemeSetting.php) | `theme_settings` | None | UI appearance settings and CSS customization variables. |
| [`Ticket.php`](file:///home/nyapuma/Transferências/Projeto-Final-Cesae/app/Models/Ticket.php) | `tickets` | `belongsTo(User)`, `belongsTo(User, technician)`, `belongsTo(TicketStatus)`, `belongsTo(Equipment)`, `belongsTo(Room)`, `hasMany(TicketWorkflowHistory)`, `hasMany(TicketComment)`, `hasMany(TicketAttachment)` | Core incident and maintenance ticket entity with lifecycle timestamps, budgets, and SLAs. |
| [`TicketAttachment.php`](file:///home/nyapuma/Transferências/Projeto-Final-Cesae/app/Models/TicketAttachment.php) | `ticket_attachments` | `belongsTo(Ticket)`, `belongsTo(User)` | Uploaded evidence, photos, and documents attached to tickets. Automatically deletes files on model deletion. |
| [`TicketComment.php`](file:///home/nyapuma/Transferências/Projeto-Final-Cesae/app/Models/TicketComment.php) | `ticket_comments` | `belongsTo(Ticket)`, `belongsTo(User)`, `belongsTo(TicketComment, parent)` | Communication thread messages and internal notes on tickets. |
| [`TicketStatus.php`](file:///home/nyapuma/Transferências/Projeto-Final-Cesae/app/Models/TicketStatus.php) | `ticket_statuses` | `belongsTo(TicketType)`, `hasMany(Ticket)` | Configurable lookup status entries for ticket workflows. |
| [`TicketType.php`](file:///home/nyapuma/Transferências/Projeto-Final-Cesae/app/Models/TicketType.php) | `ticket_types` | `hasMany(TicketStatus)`, `hasManyThrough(Ticket)` | Categorization types for tickets and incident workflows. |
| [`TicketWorkflowHistory.php`](file:///home/nyapuma/Transferências/Projeto-Final-Cesae/app/Models/TicketWorkflowHistory.php) | `ticket_workflow_history` | `belongsTo(Ticket)`, `belongsTo(TicketStatus, origin)`, `belongsTo(TicketStatus, destination)`, `belongsTo(User, technician)` | State transition audit log documenting stage changes and acting technician. |
| [`User.php`](file:///home/nyapuma/Transferências/Projeto-Final-Cesae/app/Models/User.php) | `users` | `belongsTo(UserProfile)`, `hasMany(Ticket, created)`, `hasMany(Ticket, assigned)` | Application authentication and user model with RBAC role helpers and API token support. |
| [`UserPreference.php`](file:///home/nyapuma/Transferências/Projeto-Final-Cesae/app/Models/UserPreference.php) | `user_preferences` | `belongsTo(User)` | User-specific localization options (language locale, currency, date/time/number formats). |
| [`UserProfile.php`](file:///home/nyapuma/Transferências/Projeto-Final-Cesae/app/Models/UserProfile.php) | `user_profiles` | `hasMany(User)` | Role profile group (Admin, Technician, User) determining access permissions. |

## Notes for Developers & AI

- **Auditing Integration:** Core models (`Equipment`, `Part`, `Room`, `Ticket`) include the `Auditable` trait, automatically recording lifecycle mutations to the `audits` table.
- **Immutability Protection:** The `Audit` model explicitly throws `LogicException` on `updating` and `deleting` hooks to maintain a tamper-proof audit trail.
- **Storage Lifecycle Hooks:** `TicketAttachment` automatically deletes the associated file from disk when deleted from the database.
- **Soft Deletes:** Most domain entities (`Equipment`, `Part`, `Room`, `Ticket`, `User`, `Notification`, `Supplier`, etc.) use Laravel's `SoftDeletes` trait. Check soft delete interactions before writing raw SQL queries.
