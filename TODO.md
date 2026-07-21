# TODO - Implementação: Mão de Obra + Notificações Urgência

## Parte A - Campo de Mão de Obra no Orçamento Detalhado
- [x] **A.1** - Adicionar métodos helper no `Ticket.php` (getTotalLaborCost, getTotalMaterialCost, getBudgetTotal)
- [x] **A.2** - Atualizar HTML do formulário de orçamento detalhado no `ticket-detail.blade.php` (tipo: Material/Mão de Obra)
- [x] **A.3** - Atualizar JS: `addBudgetItem()`, `recalcBudgetTotal()`, `getBudgetDetails()`
- [x] **A.4** - Atualizar `renderBudgetDetailsForAdmin()` para mostrar breakdown material vs mão de obra
- [x] **A.5** - Atualizar controller para aceitar novos campos (submitEstimatedBudget / requestBudget)

## Parte B - Notificações de Urgência
- [x] **B.1** - Modificar `startTicket()` no `TicketController.php` com verificação de urgência
- [x] **B.2** - Adicionar modal de aviso no JS do `ticket-detail.blade.php`
- [x] **B.3** - Adicionar lógica de notificação para admin ao forçar início de ticket não prioritário
- [x] **B.4** - Adicionar rota para startTicket com suporte a `force`

## Testes
- [ ] Verificar que orçamento total calcula corretamente material + mão de obra
- [ ] Verificar que aviso de urgência aparece corretamente
- [ ] Verificar que admin recebe notificação ao forçar início

