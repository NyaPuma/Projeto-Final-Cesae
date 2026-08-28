# Meeting Minutes and Technical Decisions

This document records crucial decisions, sprint evolution, and resolution of technical impediments encountered during system development.

---

## Meeting Log

### Meeting #01: Stack Definition and Architecture
* **Date:** [Insert Date]
* **Decisions:**
    * Selection of Laravel 11 for its security ecosystem and ease of handling queues.
    * Decision to use Blade Templates + Tailwind CSS for prototyping agility.
* **Impediments:** Initial difficulty configuring `Laravel Echo` with Pusher.
* **Resolution:** Use of official documentation and review of environment variables (`.env`).

### Meeting #02: Process Refinement (As-Is vs To-Be)
* **Date:** [Insert Date]
* **Decisions:**
    * Mapping of the maintenance workflow to "Management by Exception" (only critical events trigger tickets).
    * Definition of three profiles (Operator, Technician, Administrator) with strict route isolation (RBAC).
* **Notes:** The need for an "Exceptional Budget" system was identified to prevent unjustified shutdowns due to missing parts.

### Meeting #03: Development and Integration
* **Date:** [Insert Date]
* **Decisions:**
    * Implementation of Service Providers for the AI engine (NLP) to keep controllers slim (*Slim Controllers*).
* **Impediments:** Write permission errors on storage directories.
* **Resolution:** Execution of the `php artisan storage:link` command and folder permission adjustment.

### Meeting #04: Quality and Documentation Review
* **Date:** [Insert Date]
* **Decisions:**
    * Standardization of all documentation in the `/docs` folder using Markdown.
    * Creation of the test script to ensure robustness of critical features.
* **Final State:** System stable, documented, and with unit tests configured (`php artisan test`).

---

## Team Tip
Whenever you encounter a complex bug during coding that takes 1 or 2 hours of work, add a short line here in the Meeting Minutes: *"Bug: X | Resolution: Y"*.
