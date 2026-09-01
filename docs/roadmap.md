
```markdown
# Roadmap de Evolução e Próximos Passos — SIGMA

> **Projeto Académico:** SIGMA (Sistema Integrado de Gestão de Manutenção Avançada)  
> **Curso:** Software Developer — Digital Reskilling (CESAE Digital)  
> **Documento:** Visão Estratégica e Planeamento de Versões Futuras

---

## Visão Geral

O **SIGMA** encontra-se na sua versão estável de lançamento (**v1.0**), cobrindo de ponta a ponta o ciclo de vida reativo e assistido da manutenção industrial: reporte omnicanal com leitura física via QR Code, triagem assistida por Inteligência Artificial (NLP), controlo orçamental estrito, WebSockets em tempo real, auditoria imutável e métricas analíticas de MTTR.

Este documento estabelece o planeamento estratégico e as próximas expansões arquiteturais da plataforma para responder aos desafios de manutenção preditiva, integração de hardware e excelência operacional.

---

## Linha Temporal de Lançamentos


```

[ v1.0 - Core Estável ] ──> [ v2.1 - Preventiva ] ──> [ v2.2 - Gestão de Stock ] ──> [ v2.3 - CSAT & Qualidade ] ──> [ v2.4 - IA & RAG ]

```

---

## Detalhe dos Módulos e Funcionalidades Futuras

### Versão 2.1 — Manutenção Preventiva, Recorrente & Planos de Trabalho
* **Objetivo:** Transição progressiva do modelo reativo para uma abordagem proativa e programada.
* **Funcionalidades Planeadas:**
  * Criação de planos de manutenção periódica (diária, semanal, mensal ou por horas de operação) associados a equipamentos específicos.
  * Automação de abertura de ordens de trabalho através de tarefas agendadas no Laravel (`cron jobs` / `Task Scheduling`) sem necessidade de intervenção humana.
  * Listas de verificação (*checklists*) digitais interativas para inspeção, calibração e lubrificação de máquinas com validação obrigatória por etapa.
* **Impacto Operacional:** Redução expressiva do MTTR (*Mean Time To Repair*) e diminuição de paragens não planeadas na linha de produção.

---

### Versão 2.2 — Catálogo de Peças, Consumíveis & Gestão de Stock
* **Objetivo:** Rastreabilidade física e controlo de inventário em armazém central associado a cada intervenção técnica.
* **Funcionalidades Planeadas:**
  * Catálogo de peças de substituição com controlo de SKU, fabricante, custo unitário e localização física em prateleira.
  * Abate automático de peças e consumíveis no ato de conclusão e encerramento de um ticket por parte do Técnico.
  * Sistema de alertas inteligentes para níveis de stock mínimo (ponto de encomenda) com notificação automática ao Administrador / Gestor de Compras.
  * Associação de custos de material ao orçamento final da avaria para cálculo preciso do custo total de manutenção por máquina.
* **Impacto Operacional:** Eliminação de ruturas de stock de peças críticas e transparência financeira nos custos operacionais.

---

### Versão 2.3 — Inquéritos de Satisfação (CSAT), SLAs Dinâmicos & Qualidade
* **Objetivo:** Medição contínua da qualidade do serviço prestado pelo departamento técnico aos operários e chefias.
* **Funcionalidades Planeadas:**
  * Envio automático de micro-inquérito de satisfação (escala de 1 a 5 estrelas com campo breve de feedback) ao utilizador requerente assim que o ticket passa ao estado **Concluído**.
  * Painel analítico de avaliação técnica e índice CSAT integrado no dashboard do Administrador.
  * Configuração de múltiplos patamares de SLA (*Service Level Agreement*) com regras de escalamento automático em caso de atraso na primeira resposta ou na conclusão.
* **Impacto Operacional:** Monitorização da perceção de serviço interno e introdução de métricas objetivas de desempenho da equipa de manutenção.

---

### Versão 2.4 — Base de Conhecimento com RAG & Diagnóstico por IA
* **Objetivo:** Aceleração do diagnóstico técnico através de uma base de conhecimento enriquecida por IA generativa.
* **Funcionalidades Planeadas:**
  * Repositório centralizado de Procedimentos Operacionais Padrão (SOPs), diagramas elétricos e manuais em PDF indexados por equipamento.
  * Módulo avançado de diagnóstico por IA (*Retrieval-Augmented Generation* - RAG): o técnico submete os sintomas da avaria e o sistema sugere a causa provável e o passo a passo de reparação com base no histórico de avarias e manuais técnicos.
  * Histórico de resolução colaborativo: conversão de tickets resolvidos de alta complexidade em artigos permanentes de base de conhecimento.
* **Impacto Operacional:** Redução drástica da curva de aprendizagem de novos técnicos e diminuição do tempo médio de diagnóstico.

---

### Versão 3.0 — Expansão Industrial: Telemetria IoT & App Nativa Offline
* **Integração com Sensores IoT (MQTT/Modbus):** Leitura em tempo real de vibração, temperatura e corrente elétrica de máquinas industriais para disparo automático de alertas antes da ocorrência da falha (Manutenção Preditiva).
* **Aplicação Mobile com Modo Offline:** Sincronização em segundo plano para intervenções em áreas de fábrica ou armazém sem cobertura Wi-Fi/rede móvel.
* **Webhooks & Integrações ERP:** Conectores bidirecionais com sistemas ERP (SAP, Primavera, PHC) para sincronização de faturas, ativos e ordens de compra.

---

## Resumo de Priorização e Complexidade

| Versão | Módulo Principal | Complexidade Técnica | Valor para o Negócio |
| :--- | :--- | :---: | :---: |
| **v2.1** | Manutenção Preventiva & Rotinas Agendadas | Média | Alto |
| **v2.2** | Gestão de Stock e Inventário de Peças | Média | Elevado |
| **v2.3** | Inquéritos CSAT & Métricas de Qualidade | Baixa | Médio |
| **v2.4** | Base de Conhecimento com RAG & IA | Alta | Elevado |
| **v3.0** | Sensores IoT (Preditiva) & App Offline | Muito Alta | Estratégico |

```