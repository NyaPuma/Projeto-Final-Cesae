## Workflow & Regras de Transição de Estados e Auditoria

O ciclo de vida de uma avaria é gerido de forma estrita via Eloquent ORM. Todas as ações operacionais disparam eventos que alimentam o histórico em background através da infraestrutura de migrações e tabelas de auditoria do sistema, registando na tabela `audits` os utilizadores, os payloads estruturados em JSON com os campos modificados (`old_values` e `new_values`) e os timestamps automáticos de controlo (`created_at`, `in_progress_at`, `closed_at`). 

Cada transição de estado ou novo comentário introduzido dispara adicionalmente um **Job assíncrono** na fila (*Queue*) para despachar notificações em tempo real via **WebSockets** (através do Laravel Echo / Pusher) e e-mails formatados.

### Detalhe das Transições e Comportamento Esperado

#### 1. De [Aberto] para [Em Curso]
* **Gatilho:** O Administrador aprova e submete a alocação técnica na interface assistida por IA (`PATCH /admin/tickets/{id}/atribuir`) ou o Técnico clica em "Iniciar Reparação" no seu painel exclusivo (`PUT /technician/tickets/{id}/start`).
* **Regra de Negócio:**
  - O sistema associa o ID do técnico ao campo `assigned_to` na tabela `tickets`.
  - O servidor injeta automaticamente o carimbo de data/hora atual na coluna `in_progress_at` via macro `now()`.
  - O ticket fica bloqueado para edição ou reatribuição por outros utilizadores.
  - **Notificação:** O criador do ticket (`user_id`) recebe um alerta em tempo real via WebSockets e uma notificação por e-mail a avisar que a intervenção começou.

#### 2. De [Em Curso] para [Pendente de Orçamento] (Fluxo Excecional)
* **Gatilho:** O Técnico deteta a necessidade de adquirir componentes externos de alto custo e dispara a rota `PUT /technician/tickets/{id}/request-budget`.
* **Regra de Negócio:**
  - A inclusão da estimativa financeira (`budget_amount`) e a justificação técnica tornam-se campos obrigatórios no formulário.
  - O estado do ticket muda para o identificador de pausa orçamental e o cronómetro operacional de resolução (SLA) é **suspenso**.
  - **Notificação:** O Administrador recebe um aviso instantâneo no seu dashboard e os contadores reativos incrementam o alerta.

#### 3. De [Pendente de Orçamento] para [Em Curso] ou [Cancelado]
* **Gatilho:** O Administrador toma uma ação de decisão financeira sobre o orçamento na rota protegida `PATCH /admin/tickets/{id}/approve-budget`.
* **Regra de Negócio:**
  - **Se Aprovado:** O ticket regressa ao estado `Em Curso`, o campo `budget_approved_by` grava o ID do administrador, o SLA é reativado no servidor e o técnico recebe um push em tempo real para prosseguir com a reparação.
  - **Se Rejeitado:** O ticket é movido para o estado `Cancelado`, exigindo feedback do Administrador. A timestamp `closed_at` é preenchida.

#### 4. De [Em Curso] para [Fechado]
* **Gatilho:** O Técnico conclui a reparação mecânica/elétrica física na fábrica e clica em "Encerrar Ticket" (`PUT /technician/tickets/{id}/close`).
* **Regra de Negócio:**
  - O *Form Request* obriga à introdução descritiva do relatório técnico final, dos minutos gastos (`minutes_spent`) e do registo das peças consumidas do stock interno.
  - O sistema grava a timestamp final na coluna `closed_at` e atualiza reativamente os dashboards estatísticos (`Chart.js`) via WebSockets. O ticket é trancado, impedindo a inserção de novos comentários operacionais.

#### 5. De [Aberto] para [Cancelado]
* **Gatilho:** O operador decide anular o alerta por erro de registo ou duplicação via rota `POST /tickets/{id}/cancel`.
* **Regra de Negócio:**
  - **Condição Estrita de Segurança:** A operação só é validada pelo controlador se o ticket permanecer com o estado original `Aberto` e se o `user_id` corresponder ao criador do registo. Se o ticket já tiver sido assumido por um técnico (`Em Curso`), o controlador bloqueia a requisição e devolve uma exceção HTTP `403 Access Denied`.