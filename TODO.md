# ✅ Prioridade "Crítica" Adicionada

## Concluído
- [x] `app/Models/Ticket.php` — Constante `PRIORITY_CRITICAL`
- [x] `app/Http/Controllers/TicketController.php` — Validação, filtro search, ordem prioridades (crítica=4)
- [x] `resources/views/ui/ticket-create.blade.php` — Card "Crítica" e cor roxa no JS
- [x] `resources/views/ui/tickets.blade.php` — Filtro "critica" e cores já presentes; mapeamento de estados internos pendente_orçamento → aberta, recusada → fechada
- [x] `resources/views/ui/ticket-detail.blade.php` — Cores "crítica" e labels já presentes; modal de aviso funcional
- [x] Traduções completas — 526 chaves no `en.json`
- [x] Apenas 3 status no filtro: **Aberta**, **Em Curso**, **Fechada**

## Status do filtro
O dropdown de estado já contém apenas:
- Todos
- Aberta
- Em Curso
- Fechada

Os estados internos (pendente orçamento, recusada, cancelada) são mapeados visualmente para as 3 opções principais nas badges e nos filtros.

