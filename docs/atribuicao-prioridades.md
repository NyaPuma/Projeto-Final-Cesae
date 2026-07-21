# Especificação Técnica: Atribuição de Prioridades & Módulo de IA
**Projeto:** ACCEPT - PROJETO ACADÉMICO  
**Módulo:** Gestão de Urgência, SLA e Triagem Assistida por IA  
**Arquitetura:** In-House (Corporativo Interno)

---

## 1. Visão Geral do Conceito
O Nível de Prioridade no sistema **ACCEPT** é a métrica central para determinar a urgência de intervenção técnica, os tempos limite de resolução (**SLA**) e a ordenação das filas de trabalho operacionais.

### Delimitação do Módulo de IA (Âmbito da Versão Atual)
Para garantir maior estabilidade, previsibilidade de custos e foco no ecossistema administrativo:
- **Assistência por IA (Exclusiva do Administrador):** A recomendação por NLP e triagem inteligente (`AIService`) está ativa **exclusivamente no painel do Administrador**.
- **Operários e Técnicos:** Interagem com a plataforma através de formulários manuais diretos e estruturados.
- **Backlog (Melhorias Futuras):** A assistência por IA nos formulários do Operário e no painel de campo do Técnico foi deslocalizada para o roteiro de evolução do produto.

---

## 2. Níveis de Prioridade e Impacto Operacional

| Nível | Cor Visual | Impacto Operacional | Critério de Atribuição |
| :--- | :--- | :--- | :--- |
| **Alta** | 🔴 Vermelho | **Paragem Crítica / Risco** | Linha de produção totalmente inoperacional. Risco de segurança ou danos graves em cadeia. |
| **Média** | 🟡 Amarelo | **Degradação Parcial** | Equipamento funciona com limitações ou existe alternativa na sala sem parar a produção. |
| **Baixa** | 🟢 Verde | **Manutenção Ligeira** | Anomalia estética, necessidade de lubrificação ou falha em componente secundário. |

---

## 3. Passo a Passo do Fluxo de Trabalho

```mermaid
sequenceDiagram
    autonumber
    actor O as Operário (Posto de Trabalho)
    participant S as Sistema (Laravel Back-End)
    participant IA as AIService (NLP Engine)
    actor A as Administrador
    actor T as Técnico de Campo

    O->>S: Reporta Avaria + Seleciona Prioridade Inicial (Manual)
    S->>IA: Processa texto da ocorrência (Apenas no Admin)
    IA-->>A: Exibe Sugestão de Prioridade + Recomendação de Técnico
    
    alt Ajuste ou Confirmação
        A->>S: Valida/Altera a Prioridade Final e Atribui Técnico
    end

    S->>T: Envia Ticket com a Prioridade Final Definida
    T->>S: Executa Intervenção com base no SLA da Prioridade