# Dashboard Centro Analítico — Dados de Seed & Correções

Relatório do trabalho de povoamento do dashboard analítico com dados
realistas e internamente coerentes, e das correções de bugs que produziam
KPIs a zero (SLA, custos) e a secção "Atividade Recente" vazia.

## Problema

- `Tempo Médio de Resolução`, `SLA` e `Custo Mensal` apareciam a zero.
- A "Atividade Recente" nunca mostrava eventos.

### Causas-raiz confirmadas

1. **Dados**, não queries: as queries analíticas (`TicketKpiQuery`,
   `MonthlyTicketsQuery`, `costByEquipment`) só somam tickets com
   `closed_at` + `actual_cost` não-nulos e SLA com `opened_at→closed_at`
   ≤ 480 min. Os seeders anteriores não gravavam estes campos, logo tudo
   ficava a zero.
2. **Atividade Recente**: o componente `activity-timeline-card.blade.php`
   usava o endpoint `/api/activities` (rota inexistente → 404) e os
   seeders raw não criavam auditorias (a trait `Auditable` só dispara via
   Eloquent), pelo que `audits` ficava vazio.

## Regras de coerência aplicadas (aprovadas)

- **Volume**: ~1500 tickets ao longo dos últimos 6 meses, com tendência
  crescente (~150 → ~400/mês).
- **Estados**: fechada 62%, em curso 18%, aberta 12%, pendente de
  orçamento 5%, cancelada 2%, recusada 1%.
- **Prioridades**: baixa 30%, média 40%, alta 25%, crítica 5%.
- **Origem**: web 55%, QR 25%, telefone 10%, API 7%, mobile 3%.
- **SLA**: ~80% dos tickets fechados cumprem o SLA de 480 min
  (MTTR médio ≈ 350 min).
- **Custos**: apenas em tickets fechados; `actual_cost` ≥ `estimated_cost`;
  mão-de-obra a 35 €/h × `minutes_spent` + peças.
- **Horário**: 90% dos tickets entre as 8h e as 18h, de segunda a sexta.
- **Pareto**: o catálogo de equipamentos tem `weight` de avaria; as salas
  seguem um peso decrescente (as primeiras 40 com mais ocorrências).
- **Stock**: movimentos com `stock_after` em cadeia e ~12–18 peças em
  low stock.

## Seeders

| Ficheiro | Descrição |
| --- | --- |
| `database/seeders/Data/OperationalData.php` | Domínio industrial PT: 40 salas, 30 equipamentos (pesos/descrições), cenários de avaria por categoria, peças com `manufacturer_ref` e faixas de custo, nomes de técnicos/reportantes. |
| `database/seeders/Data/TicketDataset.php` | Motor determinístico (`mt_srand(20260701)`) que gera 1500 tickets com as regras acima. |
| `database/seeders/TicketsSeeder.php` | Carga via `DB::insertOrIgnore` em chunks de 500; aborta em produção. |
| `database/seeders/RoomsSeeder.php` | 3 salas manuais + 40 do catálogo + zonas genéricas (100 salas). |
| `database/seeders/EquipmentsSeeder.php` | 4 manuais + catálogo com `notes` + genéricos `EQ-NNN-NNNN` (100). |
| `database/seeders/UsersSeeder.php` | Técnicos com nomes PT reais; perfis admin/technician/user. |
| `database/seeders/ActivityFeedSeeder.php` | ~40 auditorias nos últimos ~22h (marcador `url='seed:operational'`), idempotente. |
| `database/seeders/NotificationSeeder.php` | 600 notificações ponderadas por tipo/prioridade. |
| `database/seeders/StockDataSeeder.php` | Peças por categoria (sem lorem), movimentos `stock_after` em cadeia, low-stock coerente, planos de manutenção. |

Ordem no `DatabaseSeeder`:
`TicketLookupSeeder` → `BulkOperationalDataSeeder`
(→ `UserProfilesSeeder`, `UsersSeeder`, `RoomsSeeder`,
`EquipmentCategoriesSeeder`, `EquipmentsSeeder`, `TicketsSeeder`)
→ `StockDataSeeder` → `ActivityFeedSeeder` → `NotificationSeeder`.

## Correções de código

- **`routes/api.php`**: registada a rota `GET /api/activities`
  (`ActivityFeedController@index`), que alimenta o componente
  `activity-timeline-card`.
- **`app/Http/Controllers/ActivityFeedController.php`**: novo — feed JSON
  (`title`, `description`, `time_ago`, `icon_bg`, `dot_color`) a partir de
  `audits`.
- **`app/Domain/Ticket/Queries/TicketKpiQuery.php`**: `avg_waiting` passa a
  `diff(opened_at→assigned_at)` com `assigned_at` não-nulo (era
  `diff(opened_at→NOW)`, distorcido com dados de 6 meses); removida a
  expressão `nowExpression` agora não usada.
- **`app/Services/AnalyticsDashboardService.php`**:
  - `system_availability` lido de `services.analytics.*` (a chave antiga
    `services.custom.analytics.*` não existia);
  - `sla_target_minutes` da config passado ao `TicketKpiQuery` e usado em
    `monthlyPerformanceData`.
- **`database/seeders/NotificationSeeder.php`**: prioridade `urgent` →
  `critical` (valor aceite pelo enum da coluna `notifications.priority`).

## Melhorias de design

- **`resources/js/pages/analytics/charts.js`**: empty states "Sem dados
  para apresentar" em todos os gráficos quando os datasets estão vazios.
- **`resources/js/pages/analytics/kpi.js`**: formatação pt-PT
  (`Intl.NumberFormat`) e minutos legíveis (`5h 50m`, `3d 4h`).
- **`resources/views/components/ui/analytics/equipment-distribution-card.blade.php`**:
  título/descrição corrigidos para refletirem o conteúdo real (prioridade
  dos tickets) em vez de "Equipamentos".

## Validação

Ambiente sem `php`/`composer`/`npm` executáveis — a validação foi estática:

- Confronto de todas as colunas usadas pelos seeders com as migrações
  (`tickets`, `audits`, `notifications`, `parts`, `stock_movements`,
  `equipments`, `rooms`).
- Confronto dos enums (estados, prioridades, orçamento, stock, notificações)
  com os valores gerados.
- Balanceamento de chavetas/parênteses dos ficheiros alterados.
- A rota `/api/activities` foi adicionada fora do grupo `custom.auth`
  (o componente envia `authHeader()` quando a store existe).

Comandos para validar localmente:

```bash
php artisan migrate:fresh --seed
php artisan route:list --path=api
```
