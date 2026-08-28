# User Guide: Integrated Maintenance Management System

This manual describes the main features available on the platform, organized by the three user profiles.

---

## 1. Operator Profile (Factory Worker)
The focus of this profile is the quick reporting of anomalies and operational failures in the factory.

* **Submit a Breakdown Report:**
    1. Go to the "New Ticket" menu.
    2. Select the Equipment and its respective Room.
    3. Describe the problem in detail (e.g., abnormal noise, sudden stoppage).
    4. **Evidence Upload:** Attach photographs of the breakdown to speed up the initial diagnosis.
* **Consult Tickets:**
    * View the status of your requests (Open, In Progress or Closed) through the "My Tickets" listing.
* **Communication:**
    * Use the comment system within each ticket you have created to clarify doubts or provide updates to the responsible technician.

---

## 2. Maintenance Technician Profile
The focus of this profile is repair efficiency, stock control and workflow updating.

* **Field Opening:**
    * Has the autonomy to immediately open a breakdown ticket on the platform if a mechanical or electrical failure is detected during rounds around the factory.
* **Breakdown Panel and Global Queue:**
    * Consult the list of pending tickets assigned or available for triage, with support for advanced filters by equipment, status or physical location.
* **Start Repair:**
    * When taking over an intervention, click "Start Repair". The status automatically transitions to "In Progress" and locks the route, starting time counting with a server timestamp (`NOW()`).
* **Report Progress & Comments:**
    * Add technical notes and upload photos of replaced components throughout the ticket's life cycle.
* **Budget Request:**
    * If the breakdown requires high-cost components, change the status to "Pending Budget" and attach the respective financial justification for review by Management.
* **Ticket Closure:**
    * Upon completing the physical repair, submit the technical report, the minutes spent and the cost of parts consumed from internal stock. The system calculates the MTTR and updates the statistical indicators.

---

## 3. Administrator Profile (Operations Director)
The focus of this profile is access management, intelligent dispatching, analytical control and strategic decision-making.

* **User and Security Management (Exclusive):**
    * Holds absolute control over the company's credentials and human resources. Public self-registration is disabled; the creation of new accounts and the assignment of profiles (*Roles*) is carried out exclusively through the restricted Backoffice menu.
* **AI-Assisted Dispatch:**
    * When triaging an incident, the Administrator is supported by the Artificial Intelligence assistant (`AIService`). The engine processes free text (NLP), categorizes the failure and suggests the ideal technician based on skills and current workload volume, allowing official allocation with just 1 click.
* **Inventory and Asset Management:**
    * Full backoffice control to manage (Create, Edit, Deactivate or apply Soft Delete) the tree of rooms, pavilions, brands and factory equipment.
* **Budget Management:**
    * Reviews the financial requisitions submitted by technicians for complex repairs, holding the power to approve or reject budgets.
* **Preventive Maintenance:**
    * Proactively schedules periodic interventions on equipment before a failure occurs, injecting planned work orders directly into the technician's calendar.
* **Analytical Dashboard and Audit:**
    * Monitors KPI charts in real time (MTTR, costs and team performance) updated via WebSockets and consults immutable audit logs to track any change made to the system.

---

## Usage Tips
* **Real-Time Notifications:** The system alerts you instantly on screen (via Laravel Echo) whenever a ticket changes status, receives a comment or triggers a reactive telemetry alert.
* **Advanced Search:** In any listing, use the search bar combined with filters to quickly isolate records by ID, serial number, priority or date range.
