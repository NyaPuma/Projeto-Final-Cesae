## Workflow & State Transition Rules and Auditing

The lifecycle of a fault is strictly managed via Eloquent ORM. All operational actions dispatch events that feed the background history through the system's migration infrastructure and audit tables, recording in the `audits` table the users, JSON-structured payloads with modified fields (`old_values` and `new_values`), and automatic control timestamps (`created_at`, `in_progress_at`, `closed_at`).

Each state transition or new comment additionally dispatches an **asynchronous Job** in the Queue to send real-time notifications via **WebSockets** (through Laravel Echo / Pusher) and formatted emails.

### Transition Details and Expected Behavior

#### 1. From [Open] to [In Progress]
* **Trigger:** The Administrator approves and submits the technical allocation in the AI-assisted interface (`PATCH /admin/tickets/{id}/atribuir`) or the Technician clicks "Start Repair" on their exclusive panel (`PUT /technician/tickets/{id}/start`).
* **Business Rule:**
  - The system associates the technician ID to the `assigned_to` field in the `tickets` table.
  - The server automatically injects the current timestamp into the `in_progress_at` column via the `now()` macro.
  - The ticket is locked for editing or reassignment by other users.
  - **Notification:** The ticket creator (`user_id`) receives a real-time alert via WebSockets and an email notification warning that the intervention has started.

#### 2. From [In Progress] to [Pending Budget] (Exceptional Workflow)
* **Trigger:** The Technician detects the need to acquire high-cost external components and dispatches route `PUT /technician/tickets/{id}/request-budget`.
* **Business Rule:**
  - The financial estimate (`budget_amount`) and technical justification become mandatory fields in the form.
  - The ticket state changes to the budget pause identifier and the operational resolution timer (SLA) is **suspended**.
  - **Notification:** The Administrator receives an instant warning on their dashboard and reactive counters increment the alert.

#### 3. From [Pending Budget] to [In Progress] or [Cancelled]
* **Trigger:** The Administrator takes a financial decision action on the budget at the protected route `PATCH /admin/tickets/{id}/approve-budget`.
* **Business Rule:**
  - **If Approved:** The ticket returns to the `In Progress` state, the `budget_approved_by` field records the administrator ID, the SLA is reactivated on the server, and the technician receives a real-time push to proceed with the repair.
  - **If Rejected:** The ticket is moved to the `Cancelled` state, requiring Administrator feedback. The `closed_at` timestamp is filled.

#### 4. From [In Progress] to [Closed]
* **Trigger:** The Technician completes the physical mechanical/electrical repair in the factory and clicks "Close Ticket" (`PUT /technician/tickets/{id}/close`).
* **Business Rule:**
  - The *Form Request* requires descriptive entry of the final technical report, minutes spent (`minutes_spent`), and a record of parts consumed from internal stock.
  - The system records the final timestamp in the `closed_at` column and reactively updates statistical dashboards (`Chart.js`) via WebSockets. The ticket is locked, preventing insertion of new operational comments.

#### 5. From [Open] to [Cancelled]
* **Trigger:** The operator decides to cancel the alert due to a registration error or duplication via route `POST /tickets/{id}/cancel`.
* **Business Rule:**
  - **Strict Security Condition:** The operation is only validated by the controller if the ticket remains in the original `Open` state and the `user_id` matches the record creator. If the ticket has already been claimed by a technician (`In Progress`), the controller blocks the request and returns an HTTP `403 Access Denied` exception.
