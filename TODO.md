# TODO: Sistema de Aviso de Prioridade ao Técnico

## Plano Aprovado

## Passos a Implementar:

- [x] **Passo 0**: Análise do código existente ✓
- [x] **Passo 1**: Planeamento ✓

- [x] **Passo 2**: Adicionar cartão "Iniciar Reparação" no HTML (`ticket-detail.blade.php`)
   - ✅ Adicionar div `#techStartCard` no painel do técnico (visível quando status = "Aberta")
  - ✅ Botão "Iniciar Intervenção" + "Forçar Início (ignorar prioritários)"

- [x] **Passo 3**: Adicionar lógica JavaScript no `fetchTicket()`
  - ✅ Mostrar/esconder `techStartCard` baseado no status do ticket
  - ✅ Handler para "Iniciar Intervenção" que chama `PUT /technician/tickets/{id}/start`
  - ✅ Tratamento de 409 com o modal de aviso de prioridade
  - ✅ Botão "Forçar Início" com `force: true` e notificação ao admin
  - ✅ Atualização do `showPriorityWarning` para mostrar `my_urgent_tickets_count`

- [x] **Passo 4**: Melhoria no backend (`TicketController@startTicket`)
  - ✅ Verificação de tickets mais prioritários atribuídos ao próprio técnico (`myHigherPriorityTickets`)
  - ✅ Mensagem mais detalhada no warning informando quantos estão atribuídos ao técnico
  - ✅ Notificação ao admin com contagem de tickets do técnico

- [x] **Passo 5**: Adicionar traduções (pt.json e en.json)
  - ✅ 12 novas entradas de tradução

