# Technical Specification: Budget Workflow (System Workflow)
**Project:** Financial Management and Approval of Repairs     
**Architecture:** In-House (Internal Corporate)

---

## 1. Concept Overview
In the **ACCEPT** system, the Budget Workflow is a cost control and operational governance mechanism. It regulates technical interventions that require significant financial investment, ensuring that costly repairs do not start without prior review and approval by the Administration.

The logic is based on a **Financial Threshold (*Threshold*)** parameterized on the platform:
- **Estimated Cost ≤ Threshold:** The Technician has the autonomy to proceed immediately with the repair.
- **Estimated Cost > Threshold:** The ticket is automatically locked by the system in the **`Pendente Orçamento`** (Pending Budget) status, awaiting an administrative decision.

---

## 2. Sequence Diagram (Mermaid)

```mermaid
sequenceDiagram
    autonumber
    actor T as Field Technician
    participant S as Sistema (Laravel Back-End)
    participant DB as Base de Dados (MySQL)
    actor A as Administrador

    T->>S: Introduz Custo Estimado ($estimatedBudget)
    S->>S: Avalia se $estimatedBudget >$threshold

    alt Valor Dentro da Autonomia (≤ Threshold)
        S->>DB: Atualiza status_id = "Em Curso"
        S-->>T: Permission granted (Repair Proceeds)
    else Excede Limiar Financeiro (> Threshold)
        S->>DB: Updates status_id = "Pending Budget"
        S->>DB: Define budget_requested = true & budget_amount = $estimatedBudget
        S-->>T: Ticket Locked (Awaiting Approval)
        S->>A: Dispatches Alert / Notification on Dashboard
    end

    opt Administrator Decision
        alt Caso Aprovado
            A->>S: Click [Approve Budget]
            S->>DB: Define budget_status = "approved" & budget_approved_by = Admin_ID
            S->>DB: Altera status_id = "Em Curso"
            S-->>T: Ticket Unlocked for Intervention
        else Caso Recusado
            A->>S: Click [Reject Budget] + Enter Justification (Feedback)
            S->>DB: Define budget_status = "rejected" & technical_report = Feedback
            S->>DB: Altera status_id = "Recusada"
            S-->>T: Ticket Closed (Repair Aborted)
        end
    end
