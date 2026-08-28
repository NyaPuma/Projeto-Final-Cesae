## 1. Scope and General Objectives

The main objective of this project is to transform reactive or manual processes into a fully optimized, integrated industrial operation through:
* **Centralized and Omnichannel Communication:** Direct, reactive channel between whoever detects the fault (operative), whoever repairs it (Technician) and whoever manages the infrastructure (Administrator), allowing any authenticated profile to report failures in the field.
* **Assisted Operational Intelligence (DSS):** Integration of the `AIService` engine (OpenAI `gpt-4o-mini`) as a Decision Support System for automatic categorical triage via NLP and analytical recommendation of technician allocation based on specialties and workload volume.
* **Security, Auditing and Control:** Removal of public user self-registration to shield the corporate infrastructure. Automatic recording of tamper-proof server *timestamps* (`NOW()`) on each ticket status change, storage of logs in JSON with the modified states (`old_values` and `new_values`) and reactive dashboards via WebSockets for monitoring costs and Management KPIs.

---

## 2. Division of Roles in the Technical Team

To simulate the dynamics of a real software development team, the 4 group members take on leadership focuses in Trello:

* **Team Leader & Product Owner:** Project management, agile planning (Sprints), requirements control, semantic versioning in Git and pedagogical interface.
* **Dev-End Developer (Frontend Lead):** Building responsive interfaces in Blade, asset compilation via Vite, scheduling in the Agenda (FullCalendar v6) and reactive chart components (Chart.js).
* **Back-End Developer (Core Engineer):** Orchestration of API/Web routes, permission isolation via role-based access control middlewares (RBAC), refined controllers and injection of the Artificial Intelligence service.
* **Database Administrator (DBA):** Relational data modeling in MySQL, ERD design, advanced key indexing for complex query performance and physical execution via Laravel Migrations.

---

## 3. Development Schedule (Sprint Structure)

The project was planned in a cycle of **4 Weekly Sprints** to ensure incremental and stable deliveries:

### Sprint 1: Requirements Engineering and Data Modeling
* Complete gathering of Functional Requirements (FR) and Non-Functional Requirements (NFR).
* Design and finalization of the Entity-Relationship Diagram (ERD) adjusted to the departmental *In-House* model.
* Configuration of the corporate Git repository and creation of the task board in Trello (Product Backlog and Sprint Backlog).
* Physical execution of the relational database in MySQL using **Laravel Migrations**.

### Sprint 2: Workflow Core, Global Routes and RBAC Security
* Implementation of the customized authentication system and route protection based on role middlewares (`role:user,technician,admin`).
* **Identity Hardening:** Removal of the public `/register` endpoint and implementation of restricted user creation in the Administrator's Backoffice (`/admin/users/register`).
* **Global In-House Flow:** Creation of the omnichannel ticket intake logic (`POST /tickets`), allowing detailed fault reporting by any authenticated employee in the field.
* Development of ticket status transitions with automatic recording of temporal stamps on the server.

### Sprint 3: Artificial Intelligence Layer and Operational Agenda
* Dependency injection and decoupling of `AIService` in the central controller (`TicketController`).
* Construction of the context-aware prompt in Portuguese (NLP) for automatic classification and well-grounded suggestion of the ideal mechanic with the lowest active task volume.
* Integration of the **Agenda** visual interface using **FullCalendar v6** for dynamic, synchronous reading of scheduled work orders from MySQL.

### Sprint 4: Reactive Analytical Panel, Reports and Closure
* Development of the Administrator's Management Dashboard with reactive analytical charts (`Chart.js`) fed in real time via broadcast events (`[Broadcast]` via WebSockets) upon intervention closure.
* Implementation of the photographic evidence upload module (`Storage`) and operational comments with logical restrictions per user.
* Execution of the global Test Plan (concurrency validation, mitigation of variable errors on the server and exception handling in the API) and compilation of the technical user manual.

---

## 4. Risk Matrix and Operational Mitigation

| Identified Risk | Impact | Technical Mitigation Strategy |
| :--- | :---: | :--- |
| **Data Integrity Errors** (e.g. deleting a room or category with actively linked equipment) | High | Rigorous configuration of foreign keys with physical deletion restriction (`onDelete('restrict')` or `nullOnDelete()`) in MySQL migrations. |
| **Privilege Escalation or Ghost Accounts** (e.g. uncontrolled creation of administrative profiles by external users) | High | **Self-registration disabled.** Elimination of public registration routes and isolation of the identity creation controller strictly behind the Administrator's bus middleware. |
| **Session Failure / Expired Token** (authentication warnings in AJAX requests from the calendar or form submissions) | Medium | HTTP exception handling in Laravel controllers and controlled CSRF exemption on specific API routes (`withoutMiddleware`), ensuring visual resilience and clean fallbacks. |
| **Administrative Bottleneck in Task Distribution** (human errors or delays in manual incident allocation at the factory) | High | **AI Decision Module.** Assisted triage in `AIService`, which processes the free text and automates the recommendation of the ideal technician, reducing average response time (SLA) through a 1-click dispatch. |
