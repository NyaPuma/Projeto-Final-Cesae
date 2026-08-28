# Technical Specification: Priority Assignment & AI Module
**Project:** ACCEPT - ACADEMIC PROJECT  
**Module:** Urgency Management, SLA and AI-Assisted Triage  
**Architecture:** In-House (Internal Corporate)

---

## 1. Concept Overview
The Priority Level in the **ACCEPT** system is the central metric for determining the urgency of technical intervention, resolution time limits (**SLA**) and the ordering of operational work queues.

### AI Module Delimitation (Current Version Scope)
To ensure greater stability, cost predictability and focus on the administrative ecosystem:
- **AI Assistance (Administrator-Exclusive):** NLP-based recommendation and intelligent triage (`AIService`) is active **exclusively in the Administrator's panel**.
- **Operators and Technicians:** Interact with the platform through direct, structured manual forms.
- **Backlog (Future Improvements):** AI assistance in the Operator's forms and in the Technician's field panel has been moved to the product evolution roadmap.

---

## 2. Priority Levels and Operational Impact

| Level | Visual Color | Operational Impact | Assignment Criterion |
| :--- | :--- | :--- | :--- |
| **High** | 🔴 Red | **Critical Downtime / Risk** | Production line fully inoperative. Safety risk or severe cascading damage. |
| **Medium** | 🟡 Yellow | **Partial Degradation** | Equipment works with limitations or an alternative exists in the room without stopping production. |
| **Low** | 🟢 Green | **Light Maintenance** | Cosmetic anomaly, lubrication needed or failure in a secondary component. |

---

## 3. Step-by-Step Workflow

```mermaid
sequenceDiagram
    autonumber
    actor O as Worker (Workstation)
    participant S as Sistema (Laravel Back-End)
    participant IA as AIService (NLP Engine)
    actor A as Administrador
    actor T as Field Technician

    O->>S: Reporta Avaria + Seleciona Prioridade Inicial (Manual)
    S->>IA: Processes incident text (Admin only)
    IA-->>A: Displays Priority Suggestion + Technician Recommendation
    
    alt Adjustment or Confirmation
        A->>S: Validates/Changes Final Priority and Assigns Technician
    end

    S->>T: Envia Ticket com a Prioridade Final Definida
    T->>S: Executes Intervention based on Priority SLA
