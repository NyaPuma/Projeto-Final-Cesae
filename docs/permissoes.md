# 🔐 Authorization & Permissions Matrix (RBAC)

This document strictly defines the Role-Based Access Control (RBAC) applied to the system's routes, controllers, and middleware to ensure data security.

## 1. Operator (Worker)
* **Change Password:** Autonomous management of their platform access security.
* **Consult Asset Catalog (Read-Only):** List active rooms and equipment, using search and advanced filters.
* **Open Ticket (Corrective Maintenance):** Report an actual fault by associating room, machine, description, and photo uploads.
* **View Your Tickets:** Restricted listing of your faults with support for filters by state, date, and criticality.
* **Comment Interaction:** Send and receive messages in comment format on tickets created by the user themselves.
* **Notifications:** Receive real-time and email alerts when your ticket changes state.
* **Cancel Ticket (Conditional):** Ability to cancel your own alert, provided it is still in the initial "Open" state.

## 2. Maintenance Technician
* **Change Password:** Autonomous management of their access security.
* **Open Tickets in the Field:** Autonomy to register a new fault order (`POST /tickets`) immediately when detecting a mechanical or electrical fault in the field.
* **View Active Faults Panel:** View the global ticket queue with search tools and advanced filters.
* **View Asset History:** Access the technical record and historical log of past interventions for any machine.
* **Start Repair:** Take responsibility for a ticket (changes state to "In Progress", starts the server operational timer, and sends notification).
* **Upload Evidence:** Add photos from the repair process or damaged components to the technical report.
* **Request Budget Authorization (Exceptional Workflow):** Moves the ticket to "Pending Budget", suspends the SLA, and attaches a financial justification.
* **Close Ticket:** Submit closure (state "Closed"), with mandatory fields for minutes of labor spent, final technical report, internal stock parts consumption record, and individual report generation.

## 3. Administrator (Operations Director)
* **Exclusive User & Human Resources Management:** Absolute control (CRUD) over account creation and role assignment in the corporate Backoffice. Public self-registration has been disabled; new user entry is restricted to administration.
* **AI-Assisted Dispatch:** Access to the decision interface where the fault is cross-referenced with real-time `AIService` (NLP) recommendations, saving the suggested technician allocation with 1 click.
* **Total Inventory, Assets & Infrastructure Management:** Structural operations (CRUD) on Equipment, Rooms, Categories, and Physical Locations with Soft Delete support.
* **Schedule Preventive Maintenance:** Generate proactive and chronologically planned work orders directly on the calendar.
* **Approve/Reject Budgets:** Decide on high-value requests submitted by technicians for repair release.
* **View Reactive Analytics Dashboard with Charts:** Exclusive access to dynamic charts (Chart.js) showing MTTR, MTBF, technical team efficiency, and overall costs updated automatically via WebSockets.
* **View Global Audit Log:** View the complete and immutable system change history (who changed which field, old and new values stored in JSON).
* **Advanced Report Export:** Download consolidated reports in Excel (.xlsx) or PDF format based on temporal and operational filters.
* **Access Interactive Documentation:** Browse and test endpoints through the Swagger UI interface.
