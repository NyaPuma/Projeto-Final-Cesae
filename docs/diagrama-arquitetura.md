# Data Architecture - ER Diagram

This diagram presents the relational database modeling for the Maintenance Management System.

![Entity-Relationship Diagram](../docs/Diagrama_Base_Dados.drawio.svg)

## Technical Notes
* **Approach:** Relational Model (MySQL).
* **Integrity:** Foreign Keys with referential integrity constraints (`ON DELETE RESTRICT`) were applied to prevent accidental deletion of associated data.
* **Telemetry:** The model focuses on fault persistence and maintenance history, treating telemetry as an exception flow (Management by Exception).
