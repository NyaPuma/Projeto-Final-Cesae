
## Workflow & Regras de Transição de Estados e Auditoria

O ciclo de vida de uma avaria é gerido de forma estrita via Eloquent ORM. Todas as ações disparam eventos que alimentam o histórico em background através do trait `Auditable.php`, registando os utilizadores, os campos modificados e os timestamps de controlo (`opened_at`, `in_progress_at`, `closed_at`). 

Cada transição de estado ou novo comentário introduzido dispara adicionalmente um **Job assíncrono** na fila (*Queue*) para despachar notificações em tempo real via **WebSockets** e e-mails formatados.

### Detalhe das Transições e Comportamento Esperado

#### 1. De [Aberta] para [Em Curso]
* **Gatilho:** O Técnico clica em "Iniciar Reparação" no seu painel.
* **Regra de Negócio:**
  - O sistema associa o ID do técnico ao campo `tecnico_atribuido_id`.
  - Regista o timestamp em `in_progress_at` para cálculo do SLA.
  - O ticket fica bloqueado para edição por outros técnicos.
  - **Notificação:** O Funcionário recebe um alerta em tempo real e um e-mail a avisar que a reparação começou.

#### 2. De [Em Curso] para [Pendente de Orçamento] (Fluxo Excecional)
* **Gatilho:** O Técnico deteta a necessidade de peças de alto custo e clica em "Solicitar Aprovação".
* **Regra de Negócio:**
  - A justificativa financeira, estimativa de custo e o upload de uma foto da peça danificada tornam-se obrigatórios.
  - O cronómetro de tempo de resolução (SLA) é **suspenso**.
  - **Notificação:** O Administrador recebe um aviso instantâneo no seu painel analítico.

#### 3. De [Pendente de Orçamento] para [Em Curso] ou [Recusada]
* **Gatilho:** O Administrador toma uma ação sobre o orçamento pendente.
* **Regra de Negócio:**
  - **Se Aprovado:** Regressa a "Em Curso", o SLA é reativado e o técnico é notificado em tempo real para prosseguir.
  - **Se Rejeitado:** Passa para "Recusada/Cancelada", exigindo feedback descritivo do Administrador. O funcionário original é avisado por e-mail.

#### 4. De [Em Curso] para [Fechada]
* **Gatilho:** O Técnico conclui a reparação física e clica em "Encerrar Ticket".
* **Regra de Negócio:**
  - Torna-se obrigatória a introdução das horas de mão de obra e do relatório técnico.
  - O sistema injeta o timestamp em `closed_at` e calcula o MTTR.
  - **Notificação:** O Funcionário recebe um e-mail com o sumário e o relatório da reparação. O ticket é trancado para novos comentários.

#### 5. De [Aberta] para [Cancelada]
* **Gatilho:** O Funcionário decide anular o ticket por erro ou duplicação.
* **Regra de Negócio:**
  - **Condição Estrita:** Só é permitido se o ticket estiver em "Aberto". Se já estiver "Em Curso", a rota bloqueia a ação (403).
