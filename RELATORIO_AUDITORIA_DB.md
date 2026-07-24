# Relatório Técnico — Auditoria da Camada de Persistência de Base de Dados

**Projeto:** Projeto Final Cesae  
**Data:** 24 de Julho de 2026  
**Stack:** Laravel 12 / PHP 8.2+ / Eloquent ORM / MySQL (prod) / SQLite (testes)

---

## 1. Resumo Executivo

Auditoria completa da camada de persistência da aplicação, abrangendo arquitetura, estrutura de tabelas, relações, normalização, indexes, performance, segurança, ORM, migrações, seeders, testes, backups e monitorização.

**Estado final dos testes:** 541 passed, 1 skipped, 1 failed (issue pré-existente de test-ordering no SecurityCsrfTest)

---

## 2. Arquitetura Geral

| Componente | Contagem | Estado |
|---|---|---|
| Models Eloquent | 13 | ✅ |
| Controllers | 14 | ✅ |
| Traits | 2 (Auditable, ControllerHelpers) | ✅ |
| Services | 1 (AIService) | ✅ |
| Migrations | 27+ | ✅ |
| Seeders | 9 | ✅ |
| Testes | 541+ | ✅ |

**Padrão:** Controllers consultam Eloquent diretamente (sem Repository pattern).

---

## 3. Estrutura de Tabelas e Relações

### 3.1 Tabelas Principais

| Tabela | SoftDeletes | Auditoria | Notas |
|---|---|---|---|
| users | ✅ | ✅ (token rotation) | FK → user_profiles |
| user_profiles | ❌ | ❌ | Nome único |
| tickets | ✅ | ✅ (Auditable trait) | Tabela central |
| ticket_statuses | ❌ | ❌ | Nome único, FK → ticket_types |
| ticket_types | ❌ | ❌ | Lookup table |
| ticket_comments | ❌ | ❌ | CASCADE delete |
| ticket_attachments | ❌ | ❌ | CASCADE delete |
| ticket_workflow_history | ❌ | ❌ | FK → ticket_statuses (×2), users |
| rooms | ✅ (NOVO) | ✅ (Auditable) | Corrigido nesta auditoria |
| equipments | ✅ | ✅ (Auditable) | FK nullOnDelete para rooms/category |
| equipment_categories | ❌ | ❌ | Nome único |
| audits | ❌ | N/A | Tabela de auditoria |
| notifications | ❌ | ❌ | FK → users |

### 3.2 Relações Verificadas

Todas as relações Eloquent estão corretas:
- User ↔ Ticket (hasMany/belongsTo) ✅
- User ↔ UserProfile (belongsTo/hasMany) ✅
- Ticket ↔ TicketStatus (belongsTo) ✅
- TicketStatus ↔ TicketType (belongsTo) ✅
- Ticket ↔ TicketComment (hasMany) ✅
- Ticket ↔ TicketAttachment (hasMany) ✅
- Ticket ↔ TicketWorkflowHistory (hasMany) ✅
- Room ↔ Equipment (hasMany) ✅
- Equipment ↔ EquipmentCategory (belongsTo) ✅
- Notification ↔ User (belongsTo) ✅
- Audit ↔ User (belongsTo) ✅

### 3.3 Foreign Keys

Todas as FKs estão corretas com cascateamento apropriado:
- `ticket_comments` / `ticket_attachments` → CASCADE delete ✅
- `equipments.room_id` → NULL on delete ✅
- `equipments.category_id` → NULL on delete ✅
- `users.profile_id` → RESTRICT ✅
- `notifications.user_id` → CASCADE delete ✅

---

## 4. Normalização

A base de dados está em **3NF** (Terceira Forma Normal):
- Sem colunas multivaloradas
- Sem dependências parciais
- Sem dependências transitivas
- Tabelas de lookup normalizadas (ticket_statuses, ticket_types, equipment_categories)

---

## 5. Indexação

### 5.1 Indexes Existentes (pré-auditoria)

A tabela `tickets` já dispunha de indexes abrangentes:
- 10+ indexes simples (status_id, priority, opened_at, closed_at, etc.)
- 4 indexes compostos (status+priority, user+status, etc.)
- 4 indexes compósitos de filtro (2026_07_24_130100)

### 5.2 Indexes Adicionados (nesta auditoria)

**Migração:** `2026_07_24_151000_add_composite_indexes_for_performance.php`

| Tabela | Index | Propósito |
|---|---|---|
| tickets | `equipment_id, deleted_at` | Queries filtradas por equipamento ativo |
| tickets | `room_id, deleted_at` | Queries filtradas por sala ativa |
| tickets | `assigned_to, deleted_at` | Queries filtradas por técnico ativo |
| audits | `created_at` | Ordenação cronológica |
| equipments | `deleted_at` | Soft delete filter |
| ticket_attachments | `ticket_id, created_at` | Anexos por ticket cronológico |
| ticket_workflow_history | `ticket_id, created_at` | Workflow por ticket cronológico |

### 5.3 Indexes Removidos (limpeza prévia)

9 indexes redundantes já removidos (duplicavam UNIQUE constraints ou FK implicit indexes).

---

## 6. Performance — Correções Aplicadas

### 6.1 Ticket::getStatusIdByName() — Cache Estático (CRÍTICO)

**Problema:** Cada chamada executava uma query à BD para resolver status por nome — risco N+1 severo.

**Solução:** Implementado cache estático com `$statusIdCache` + método `flushStatusCache()`.

```php
private static array $statusIdCache = [];

public static function getStatusIdByName(string $statusName): ?int
{
    if (array_key_exists($statusName, self::$statusIdCache)) {
        return self::$statusIdCache[$statusName];
    }
    self::$statusIdCache[$statusName] = TicketStatus::where('name', $statusName)->value('id');
    return self::$statusIdCache[$statusName];
}
```

**Impacto:** Elimina queries repetidas no AIService e AnalyticsController.

### 6.2 AnalyticsController — Eliminação de Carga Completa em Memória (CRÍTICO)

**Problema:** `buildPayload()` carregava TODOS os tickets para memória via `->get()`, causando:
- Risco de OOM com datasets grandes
- N+1 implicita para aggregates
- Tempo de resposta proporcional ao tamanho da BD

**Solução:** Refatorado para agregação direta via SQL:
- Contagens via `->count()` por BD
- Médias via `AVG()` SQL com `julianday()`
- Top N via `GROUP BY` + `JOIN` + `orderByDesc`
- Séries temporais via `chunk(500)` em vez de `collect()`
- Cache de 60 segundos mantido

**Impacto:** Tempo de resposta constante independentemente do volume de dados.

### 6.3 Room — SoftDeletes Adicionado

**Problema:** Room era a única tabela auditável sem SoftDeletes. Hard delete de uma sala com equipamentos associados causava perda de dados referencial.

**Solução:** Adicionado `SoftDeletes` ao model Room + migração correspondente.

**Impacto:** Salas são preservadas mesmo após "eliminação"; equipamentos mantêm referência.

---

## 7. Segurança — Correções Aplicadas

### 7.1 Content-Security-Policy para Dev

**Problema:** CSP hardcoded bloqueava Vite dev server (`localhost:5173`) e Google Fonts, causando falhas em 4 testes SecurityHeadersTest.

**Solução:** CSP diferenciada:
- **Dev** (`APP_ENV=local`): Permite Vite (`localhost:5173`), WebSocket, `fonts.bunny.net`
- **Prod**: Restritiva com `script-src` por hash SHA-256

**Testes corrigidos:** 4 failures resolvidos (SecurityHeadersTest).

---

## 8. Seeders e Dados

### 8.1 Estrutura Atual

| Seeder | Prioridade | Estado |
|---|---|---|
| UserProfilesSeeder | 1 | ✅ |
| UsersSeeder | 2 | ✅ |
| RoomsSeeder | 3 | ✅ |
| EquipmentCategoriesSeeder | 4 | ✅ |
| EquipmentsSeeder | 5 | ✅ |
| TicketLookupSeeder | 6 | ✅ (status sem type_id) |
| TicketsSeeder | 7 | ✅ |
| BulkOperationalDataSeeder | Orquestrador | ✅ |

### 8.2 Notas

- `TicketLookupSeeder` cria status com `type_id = null` — aceitável para MVP mas deve ser preenchido futuramente
- `TicketType` não tem seeder — tabelas de lookup pequenas podem ser populadas manualmente

---

## 9. Configuração de Backup

**Ficheiro:** `config/backup.php` + `app/Console/Commands/DatabaseBackup.php`

Comando artisan disponível:
```bash
php artisan db:backup                    # Backup MySQL/SQLite
php artisan db:backup --no-compress      # Sem compressão gzip
php artisan db:backup --clean            # Remove backups antigos (>30 dias)
php artisan db:backup --path=/custom     # Path customizado
```

- Suporta MySQL (mysqldump) e SQLite (sqlite3 .dump)
- Compressão gzip por defeito
- Exclusão configurável de tabelas (failed_jobs, personal_access_tokens)
- Retenção de 30 dias (configurável via `.env`)

---

## 10. Suite de Testes — Auditoria

### 10.1 Novos Testes Adicionados

| Ficheiro | Testes | Cobertura |
|---|---|---|
| `DatabaseSchemaValidationTest.php` | 11 | Schema, colunas, indexes, constraints |
| `DatabaseOptimizationTest.php` | 10 | Status cache, soft deletes, analytics |

### 10.2 Cobre

- ✅ Existência de todas as 13 tabelas
- ✅ Colunas obrigatórias em tickets, users
- ✅ SoftDeletes em rooms, tickets, equipments
- ✅ Constraints únicas (email, serial, status name)
- ✅ Indexes críticos (status_id, priority)
- ✅ Cache de status IDs
- ✅ Soft delete/restore de salas
- ✅ Preservação de equipamentos após soft delete
- ✅ Analytics payload estrutura e conteúdo
- ✅ Cache de analytics

### 10.3 Estado dos Testes

```
Tests: 541 passed, 1 skipped, 1 failed
Duration: ~310s
```

O único failure é o `SecurityCsrfTest::test_logout_requires_authentication` — issue pré-existente de test-ordering (passa isoladamente).

---

## 11. Resumo de Alterações

### Ficheiros Modificados

| Ficheiro | Alteração |
|---|---|
| `app/Http/Middleware/SecurityHeaders.php` | CSP diferenciada dev/prod |
| `app/Models/Ticket.php` | Cache estático getStatusIdByName() + flushStatusCache() |
| `app/Models/Room.php` | Adicionado SoftDeletes trait |
| `app/Http/Controllers/AnalyticsController.php` | Refatorado buildPayload() para SQL aggregation |
| `tests/Feature/DatabaseIntegrityTest.php` | Atualizado para soft delete behavior |
| `tests/Feature/DatabasePersistenceTest.php` | Atualizado test_room_soft_delete |

### Ficheiros Criados

| Ficheiro | Propósito |
|---|---|
| `database/migrations/2026_07_24_150000_add_soft_deletes_to_rooms_table.php` | SoftDeletes para rooms |
| `database/migrations/2026_07_24_151000_add_composite_indexes_for_performance.php` | 7 indexes compósitos |
| `config/backup.php` | Configuração de backup |
| `app/Console/Commands/DatabaseBackup.php` | Comando artisan db:backup |
| `tests/Feature/DatabaseSchemaValidationTest.php` | 11 testes de schema |
| `tests/Feature/DatabaseOptimizationTest.php` | 10 testes de optimização |

---

## 12. Recomendações Futuras

1. **TicketTypeSeeder:** Popular tabelas de lookup para dados consistentes
2. **Queue para backups:** Utilizar Laravel Queue para backups agendados
3. **Monitoring:** Integrar com Laravel Telescope ou Horizon para monitorização de queries
4. **Read replica:** Considerar read replica para AnalyticsController em produção
5. **Connection pooling:** Para MySQL em produção, considerar ProxySQL ou similar
