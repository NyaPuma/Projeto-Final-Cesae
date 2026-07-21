# Fluxo Orçamental Detalhado - 100% ✅

## ✅ 1. Database (Migração executada - Batch 2)
- `budget_details` (JSON) - itens detalhados do orçamento
- `budget_requested_at` / `budget_decided_at` - timestamps SLA
- `budget_feedback` - feedback do admin na recusa

## ✅ 2. Model (Ticket.php)
- `$casts` atualizado com `budget_details => json`
- `requestBudgetAuthorization()`, `approveBudget()`, `getBudgetPauseMinutesAttribute()`

## ✅ 3. Backend - TicketController.php
- `submitEstimatedBudget()` (POST /tickets/{id}/budget) - submissão com orçamento detalhado
- `requestBudget()` (PUT /technician/tickets/{id}/request-budget) - pedido com detalhes
- `closeTicketFinal()` (POST /tickets/{id}/close) - fechar com custo + relatório
- 🔔 `notifyBudgetEvent()` - notifica admins quando técnico submete orçamento

## ✅ 4. Backend - AdminController.php
- `approveBudget()` suporta `{decision, feedback}` e `{action, feedback}`
- Guarda feedback em `budget_feedback` na recusa
- 🔔 Notifica técnico + criador quando admin aprova/recusa

## ✅ 5. Routes (web.php)
- POST /tickets/{id}/budget → submitEstimatedBudget
- POST /tickets/{id}/close → closeTicketFinal
- POST /admin/tickets/{id}/budget-decision → approveBudget
- PATCH /admin/tickets/{id}/approve-budget → approveBudget

## ✅ 6. Frontend (ticket-detail.blade.php)
- Orçamento detalhado com adicionar/remover itens, cálculo automático do total
- Admin vê a lista detalhada de itens antes de decidir
- 🔔 Notificações aparecem no painel de notificações

## 🐛 7. Bugs Corrigidos
1. **[FIX] `@if` condições de role** → Troquei `auth()->check()` por `$user->isTechnician()` e `$user->isAdmin()` passados pela view
2. **[FIX] Status API como objeto** → `fetchTicket()` lê `ticket.status.name` quando status é objeto (como retorna da API)
3. **[FIX] `budget_requested` sempre true** → Marcado como `true` mesmo em auto-aprovação (<= threshold)
4. **[FIX] Cartão "Orçamento Aprovado" faltava** → Adicionado `techApprovedCard` com lógica de visibilidade
5. **[FIX] Orçamento "fechada" mostrava "Reparação Abortada"** → Separado `isRecusada` de `isClosed`
6. **[FIX] Lógica de visibilidade dos cartões** → Condições corrigidas para cada estado

## 🔔 Notificações Implementadas
| Evento | Quem Recebe | Tipo |
|--------|------------|------|
| Técnico submete orçamento (>50€) | Todos os Admins | `budget_request` 🔴 |
| Admin Aprova orçamento | Técnico + Criador | `budget_approved` ✅ |
| Admin Recusa orçamento | Técnico + Criador | `budget_rejected` ❌ |

## Fluxo Final
```
Aberto → Técnico preenche itens do orçamento detalhado
  ├→ Total ≤ 50€ → Auto-aprovado → "Concluir Intervenção"
  └→ Total > 50€ → Pendente Orçamento → 🔔 NOTIFICA Admin
                    └→ Admin vê itens detalhados
                        ├→ Aprova → 🔔 NOTIFICA Técnico → "Aprovado!" → Concluir
                        └→ Recusa + feedback → 🔔 NOTIFICA Técnico → "Recusada"
```

