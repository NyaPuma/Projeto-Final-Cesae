# Process Analysis: As-Is vs To-Be Mapping

This document describes the operational transition between the traditional reactive (manual) management model and the new intelligent automated workflow implemented on the platform.

---

## 1. The Current Process: "As-Is" Mapping (The Problem)
In the current analogue or semi-digitalized scenario, the fault repair workflow is fragmented and inefficient:

* **Reactive Detection:** A critical piece of equipment fails (e.g. a machine stops due to overheating). The floor operator may take minutes or hours to notice the drop in performance.
* **Scattered Reporting:** The operator tries to contact maintenance by sending an email, making a phone call or leaving a paper note. Information is frequently lost or arrives without technical details (e.g. "the machine won't turn on").
* **Manual Triage:** The Operations Director receives the alert informally. They need to manually check which technicians master that specialty and who has less accumulated work in the week in order to dispatch.
* **Blind Diagnosis:** The technician travels to the site to understand the problem. They discover they need a specific part, return to the warehouse to validate stock and, if it is high-cost, must find the administrator to request verbal authorization.
* **Undocumented Closure:** After the repair, downtime and associated costs are not recorded or are kept in an isolated Excel spreadsheet, preventing any future statistical analysis.
* **Identity Vulnerability:** The previous system or manual processes did not isolate user records, allowing privilege escalation failures or uncontrolled self-registration of access to the organization's internal infrastructure.

---

## 2. The Proposed Process: "To-Be" Mapping (The Solution)
With the introduction of the integrated PHP Laravel platform and relational persistence in MySQL, the workflow becomes an optimized, secure and intelligent operation:

### Omnichannel Intake Workflow and AI-Assisted Triage
* **Submission Autonomy:** Any duly authenticated platform user (whether Operator, Technician or Administrator) can submit a fault ticket immediately after detecting a failure in the field (POST /tickets). The form collects the equipment selection, the room/location and a free-text problem description, assigning the initial "Open" status and recording the server timestamp.

* **Triage and Intelligent Allocation (SAD Module, Admin-Exclusive):** When accessing the occurrence details in the Backoffice, the Administrator is supported by the AI Allocation Assistant (AIService powered by the gpt-4o-mini model). The engine analyzes the free text of the fault using Natural Language Processing (NLP), cross-references the problem category with the specialties of active technicians and evaluates their current workload. The AI displays the ideal technician suggestion with a well-grounded operational justification.

* **1-Click Dispatch:** The Administrator validates the AI recommendation (or makes an alternative manual selection) and performs the official dispatch with 1 click (PATCH /admin/tickets/{id}/atribuir), transitioning the fault status and linking the technician in MySQL.

* **Hardened Security and Identity:** Public self-registration has been completely eliminated (/register disabled). User creation and role assignment (Roles) is a strictly restricted process, centralized in the Administrator's Backoffice through the protected route /admin/users/register.

### Resolution Workflow and KPI Monitoring (In-House)
* **Prescriptive On-Site Diagnosis:** The Technician takes over the ticket in their exclusive area, moving the status to "In Progress" with a tamper-proof timestamp captured by the server clock (`NOW()`). The system immediately provides warehouse part suggestions based on the asset's history.
* **Structured Closure:** Upon completing the physical intervention at the factory, the technician enters the time spent, internal material costs and closing note, updating the MySQL database.
* **Real-Time Reactivity:** Closing the ticket triggers synchronous broadcast events (`[Broadcast]` via WebSockets). Without needing to refresh the page, the Administrator's panel recalculates the chronological downtime averages of industrial assets and reactively updates the analytical charts (`Chart.js`).

---

## 3. Operational Impact Comparison Table

| Analyzed Dimension | Current Scenario (As-Is) | Future Scenario (To-Be) |
| :--- | :--- | :--- |
| **Identity Management** | Open or uncontrolled access; privilege escalation risks. | **Only the Administrator** can register new company employees via the restricted Backoffice. |
| **Incident Intake** | Scattered (email, paper), slow and restricted to bureaucratic processes. | **Omnichannel and global** (any Operator, Technician or Admin opens tickets on the platform). |
| **Fault Triage** | Manual, late and prone to human categorization errors. | **AI-Assisted** through Natural Language Processing (NLP) and automatic tags. |
| **Technician Allocation** | Subjective, based on instinct or time-consuming consultations. | **AI-Optimized** (`AIService`), cross-referencing skills and current workload volume. |
| **Diagnosis Time** | High (multiple trips and blind stock validations). | **Prescriptive** (suggestion of standard parts based on field history). |
| **Auditing and Metrics** | Nonexistent. Loss of historical cost and time data. | **Immutable**. Global audit logs, server timestamps and reactive dashboards. |
