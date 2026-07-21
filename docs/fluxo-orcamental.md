# 💰 Especificação Técnica: Fluxo Orçamental (System Workflow)
**Projeto:** ACCEPT - PROJETO ACADÉMICO  
**Módulo:** Gestão e Aprovação Financeira de Avarias  
**Arquitetura:** In-House (Corporativo Interno)

---

## 1. Visão Geral do Conceito
No sistema **ACCEPT**, o Fluxo Orçamental é um mecanismo de controlo de custos e governação operacional. Permite regrar as intervenções técnicas que exigem investimento financeiro relevante, garantindo que reparações dispendiosas não arrancam sem o aval e aprovação prévia da Administração.

A lógica baseia-se num **Limiar Financeiro (*Threshold*)** parametrizado na plataforma:
- **Custo Estimado ≤ Threshold:** O Técnico tem autonomia para prosseguir imediatamente com a reparação.
- **Custo Estimado > Threshold:** O ticket é automaticamente trancado pelo sistema no estado **`Pendente Orçamento`**, aguardando decisão administrativa.

---

## 2. Diagrama de Sequência (Mermaid)

```mermaid
sequenceDiagram
    autonumber
    actor T as Técnico de Campo
    participant S as Sistema (Laravel Back-End)
    participant DB as Base de Dados (MySQL)
    actor A as Administrador

    T->>S: Introduz Custo Estimado ($estimatedBudget)
    S->>S: Avalia se $estimatedBudget >$threshold

    alt Valor Dentro da Autonomia (≤ Threshold)
        S->>DB: Atualiza status_id = "Em Curso"
        S-->>T: Permissão concedida (Reparação Prossegue)
    else Excede Limiar Financeiro (> Threshold)
        S->>DB: Atualiza status_id = "Pendente Orçamento"
        S->>DB: Define budget_requested = true & budget_amount = $estimatedBudget
        S-->>T: Ticket Bloqueado (Aguardar Aprovação)
        S->>A: Dispara Alerta / Notificação no Painel
    end

    opt Decisão do Administrador
        alt Caso Aprovado
            A->>S: Clique em [Aprovar Orçamento]
            S->>DB: Define budget_status = "approved" & budget_approved_by = Admin_ID
            S->>DB: Altera status_id = "Em Curso"
            S-->>T: Ticket Desbloqueado para Intervenção
        else Caso Recusado
            A->>S: Clique em [Recusar Orçamento] + Inserir Justificação (Feedback)
            S->>DB: Define budget_status = "rejected" & technical_report = Feedback
            S->>DB: Altera status_id = "Recusada"
            S-->>T: Ticket Encerrado (Reparação Abortada)
        end
    end