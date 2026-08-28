# System Requirements List

### 1. Functional Requirements (FR)

#### 1.1 Authentication, Roles and Identity Security
* **RF01:** The system must support three distinct and isolated user profiles: Operator (operative), Technician and Administrator.
* **RF02:** Any duly authenticated and validated platform user (whether operative, technician or administrator) must have the autonomy to submit new operational faults to the system (**In-House Omnichannel Flow**).
* **RF14 (Critical Security Requirement):** The system must block public, anonymous account self-registration. Creation, enrollment and role assignment (*Roles*) of new company employees must be a restricted feature exclusive to the Administrator via the `/admin/users/register` route.

#### 1.2 Asset and Infrastructure Management
* **RF03:** Full CRUD (Create, Read, Update, Delete) of equipment, categories and rooms by the Administrator, with support for *Soft Deletes* in the Eloquent ORM.
* **RF04:** The system must allow associating an equipment item with a specific room (optional/nullable association in the database).

#### 1.3 Fault Workflow (Core Business)
* **RF05:** The user must fill in a detailed record (Equipment, Room and free-text Description) when opening a fault, optionally allowing image file uploads as evidence.
* **RF06:** After intake, the ticket must be automatically routed to a global queue and triage panel visible to technicians and administrators.
* **RF07:** The life cycle of a fault must necessarily pass through 3 immutable logical states: Open (`Aberto`), In Progress (`Em Curso`) and Closed (`Fechado`).
* **RF08:** The system must automatically capture and record in MySQL the *timestamp* of each transition between the three states using server time (`NOW()`).
* **RF09:** When closing a ticket, the technician is required to enter the final technical report, minutes spent and the record of **parts consumed from internal stock** of the factory for automatic cost calculation.

#### 1.4 Data Intelligence, AI and Reactivity
* **RF10:** Provide statistical data and analytical charts (MTTR, MTBF and costs) updated reactively on the Administrator's screen (via WebSockets and Laravel Echo) whenever a ticket is closed.
* **RF11:** AI engine (`AIService`) integrated as a Decision Support System (DSS) for automatic recommendation of the ideal technician based on semantic cross-referencing of specialties and the lowest current workload volume in MySQL.
* **RF12:** Automatic triage and classification of the technical category (Mechanical, Electrical, IT) through Natural Language Processing (NLP) applied to the free text typed in the fault description.
* **RF13:** Provision of prescriptive diagnoses based on the asset's maintenance history and past reports, displaying standard parts suggestions to the technician.

---

### 2. Non-Functional Requirements (NFR)

#### 2.1 Security and Auditing
* **RNF01:** All user passwords must be encrypted one-way with secure *hashing* using the standard Bcrypt algorithm.
* **RNF02:** Immutable audit log records (`audits`) of all structural changes to the system, storing in JSON format the payloads corresponding to the modified states (`old_values` and `new_values`).
* **RNF03:** Role-Based Access Control (RBAC) through middlewares injected into the Laravel route bus, ensuring complete isolation between profiles.

#### 2.2 Performance and Availability
* **RNF04:** The response time of `AIService` processing in calls to the OpenAI API (`gpt-4o-mini` model) for generating the triage and technical recommendation JSON must not exceed 2 seconds.
* **RNF05:** The system must ensure full transactional integrity and persistence in the MySQL database, preventing data loss in concurrent submissions through foreign key constraints.

#### 2.3 Usability and Maintainability
* **RNF06:** Responsive interface developed in Blade/CSS, fully adapted to modern browsers and optimized for the VS Code/school development environment.
* **RNF07:** PHP source code compliance with PSR standards of the Laravel ecosystem, using the MVC pattern and dependency injection for service decoupling.
* **RNF08:** MySQL database optimized with efficient indexing on foreign keys and frequently searched fields (`status_id`, `assigned_to`, `email`), preventing the *N+1 queries* problem through *Eager Loading* (`with()`).

---

### 3. Business Rules and Operational Flow

### 3.1 Reactivity and In-House Distribution
* The system operates in a closed departmental circuit. The creation or closure of any ticket triggers asynchronous broadcasts (*Broadcasts*) via WebSockets to immediately update management screens and alert counters without reloading the page.
* Ticket closure requires deduction and accounting of parts from internal stock, whose financial impact is added to labor costs for immediate update of the Administrator's analytical KPIs.

### 3.2 Status Transition Rules and SLA
* **Start of Intervention:** The technician takes ownership of the ticket by moving the status to `Em Curso`, which locks the editing route and stores the `in_progress_at` timestamp via the Back-End to start the chronological downtime count of the asset.
* **Exceptional Budget Approval:** If a repair requires expensive components, the technician requests authorization. The ticket transitions to the paused status and suspends SLA calculation until the Administrator approves (`approveBudget`) or rejects the financial request.
* **Cancellation:** The ticket cancellation operation is strictly conditional; it is only allowed to the operator who created it and only if the record is still in its original `Aberto` state.
