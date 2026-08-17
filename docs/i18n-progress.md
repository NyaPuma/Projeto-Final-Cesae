# Estado da Internacionalização (i18n) — SGM

> Última atualização: 2026-08-16 (Fase 3c + gate de âmbito: 28 completos ✅; 7 novos a criar na Fase 3 🔴 — ver secções 4.1, 6 e 7. zh-CN, zh-TW, ja-JP, ko-KR, hi-IN, id-ID e vi-VN concluídos 2026-08-16 — ver secção 6)
> Fonte de verdade (locale de referência): en (valores: en-GB)

## 1. Contexto e Regras

Arquitetura alvo: `lang/{locale}/{domain}.php`, com arrays PHP agrupados por domínio (ex: `auth.php`, `tickets.php`, `stock.php`). O formato JSON (`lang/{locale}.json`) foi **eliminado por completo** na Frente C (2026-08-14); os 18 ficheiros originais estão arquivados em `docs/i18n/archive-json/` (referência da auditoria e fonte canónica histórica).

- A fonte de verdade é `en` (inglês).
- Qualquer chave nova entra primeiro em `en`.
- As comparações de "chave em falta" usam a árvore de chaves de `en` como conjunto canónico.
- Um locale só passa a `✅ Completo` quando tiver exatamente o mesmo número de chaves, nos mesmos domínios, que `en` **e** a migração JSON→PHP estiver concluída.

**Definição do conjunto canónico de chaves (medido na Fase 1):**
- As chaves-fonte são strings em português (pt-PT). O JSON (`lang/{locale}.json`) mapeia cada string-fonte → tradução (em `pt-PT` é identidade, pois é a língua-fonte).
- Os ficheiros `.php` por domínio contêm dois tipos de chaves: (a) **chaves estruturais** (ex: `status.open`, `ui.results_count`, `auth.failed`) acedidas via `__('{dominio}.{chave}')`; e (b) **strings-fonte migradas** (ex: chave `A agendar...` dentro de `common.php`) acedidas via `__('{dominio}.{string}')`.
- **Conjunto canónico de `en` (referência) = união de 2853 caminhos:**
  - 1355 caminhos flat do `en-US.json` (strings-fonte, acesso via `__('string')`).
  - 1498 caminhos dotted dos 21 domínios `.php` de `en-US` (acesso via `__('dominio.chave')`) — incluíram-se as 123 chaves-fonte migradas na Fase 2a (1386 → 1498).
- A paridade é medida sobre este conjunto de 2853 caminhos. Conjuntos idênticos entre en-US e en-GB (só diferem em valores).

## 2. Estado da Migração JSON → PHP

Todos os 21 locales têm PHP. **A migração JSON→PHP está concluída: os `.json` foram apagados** (Frente C, 2026-08-14; arquivados em `docs/i18n/archive-json/`). A estrutura de domínios é idêntica a `en` em todos os locales (21 domínios, 1498 chaves). **Fase 2a concluída: as 123 chaves-fonte que existiam apenas em JSON foram migradas para os `.php`** (0 restantes só-em-JSON; ver secção 5).

| Locale | JSON existente? | PHP existente? | Migração concluída? | Notas |
|---|---|---|---|---|
| bg-BG | Não (nunca existiu) | Sim (21 dom., 1498 chaves) | ✅ Sim (nascido PHP-only) | **Criado do zero na Fase 3c** (2026-08-16); sem JSON histórico — ver secção 4 |
| cs-CZ | Não (arquivado) | Sim (21 dom., 1498 chaves) | ✅ Sim | domínios idênticos a en |
| da-DK | Não (arquivado) | Sim (21 dom., 1498 chaves) | ✅ Sim | idem |
| de-DE | Não (arquivado) | Sim (21 dom., 1498 chaves) | ✅ Sim | idem |
| el-GR | Não (arquivado) | Sim (21 dom., 1498 chaves) | ✅ Sim | idem |
| en-GB | Não (arquivado) | Sim (21 dom., 1498 chaves) | ✅ Sim | idem; ver ⚠️ fonte de verdade (en-US vs en-GB) |
| en-US | Não (arquivado) | Sim (21 dom., 1498 chaves) | ✅ Sim | idem; usado como referência de chaves nesta auditoria |
| es-ES | Não (arquivado) | Sim (21 dom., 1498 chaves) | ✅ Sim | idem; 175 valores JSON em identidade — rever |
| fi-FI | Não (arquivado) | Sim (21 dom., 1498 chaves) | ✅ Sim | idem |
| fr-FR | Não (arquivado) | Sim (21 dom., 1498 chaves) | ✅ Sim | idem |
| hu-HU | Não (arquivado) | Sim (21 dom., 1498 chaves) | ✅ Sim | idem |
| it-IT | Não (arquivado) | Sim (21 dom., 1498 chaves) | ✅ Sim | idem |
| nl-NL | Não (arquivado) | Sim (21 dom., 1498 chaves) | ✅ Sim | idem |
| pl-PL | Não (arquivado) | Sim (21 dom., 1498 chaves) | ✅ Sim | idem |
| pt-BR | Não (arquivado) | Sim (21 dom., 1498 chaves) | ✅ Sim | idem; 994 valores JSON em identidade — rever |
| pt-PT | Não (arquivado) | Sim (21 dom., 1498 chaves) | ✅ Sim | idem; identidade total por ser língua-fonte |
| ro-RO | Não (arquivado) | Sim (21 dom., 1498 chaves) | ✅ Sim | idem |
| ru-RU | Não (nunca existiu) | Sim (21 dom., 1498 chaves) | ✅ Sim (nascido PHP-only) | **Criado do zero na Fase 3b** (2026-08-16); sem JSON histórico — ver secção 4 |
| sv-SE | Não (arquivado) | Sim (21 dom., 1498 chaves) | ✅ Sim | idem |
| tr-TR | Não (arquivado) | Sim (21 dom., 1498 chaves) | ✅ Sim | idem |
| uk-UA | Não (nunca existiu) | Sim (21 dom., 1498 chaves) | ✅ Sim (nascido PHP-only) | **Criado do zero na Fase 3c** (2026-08-16); sem JSON histórico — ver secção 4 |
| zh-CN | Não (nunca existiu) | Sim (21 dom., 1498 chaves) | ✅ Sim (nascido PHP-only) | **Criado do zero na Fase 3** (2026-08-16); sem JSON histórico — ver secção 4 |
| zh-TW | Não (nunca existiu) | Sim (21 dom., 1498 chaves) | ✅ Sim (nascido PHP-only) | **Criado do zero na Fase 3** (2026-08-16); sem JSON histórico — ver secção 4 |
| ja-JP | Não (nunca existiu) | Sim (21 dom., 1498 chaves) | ✅ Sim (nascido PHP-only) | **Criado do zero na Fase 3** (2026-08-16); sem JSON histórico — ver secção 4 |
| ko-KR | Não (nunca existiu) | Sim (21 dom., 1498 chaves) | ✅ Sim (nascido PHP-only) | **Criado do zero na Fase 3** (2026-08-16); sem JSON histórico — ver secção 4 |
| hi-IN | Não (nunca existiu) | Sim (21 dom., 1498 chaves) | ✅ Sim (nascido PHP-only) | **Criado do zero na Fase 3** (2026-08-16); sem JSON histórico — ver secção 4 |
| id-ID | Não (nunca existiu) | Sim (21 dom., 1498 chaves) | ✅ Sim (nascido PHP-only) | **Criado do zero na Fase 3** (2026-08-16); sem JSON histórico — ver secção 4 |
| vi-VN | Não (nunca existiu) | Sim (21 dom., 1498 chaves) | ✅ Sim (nascido PHP-only) | **Criado do zero na Fase 3** (2026-08-16); sem JSON histórico — ver secção 4 |

## 3. Domínios de Tradução Identificados

Confirmados por inspeção real — 21 domínios, presentes de forma idêntica em `en` e em todos os 21 locales (18 históricos + ru-RU, uk-UA e bg-BG criados do zero):

| Domínio | Nº chaves (en) | Descrição |
|---|---|---|
| `analytics.php` | 14 | Analytics/KPIs (chaves estruturais) |
| `analytics_data.php` | 13 | Dados/eventos do analytics |
| `auth.php` | 71 | Autenticação (estrutural + strings-fonte) |
| `auth_box.php` | 4 | Caixa de autenticação (menu utilizador) |
| `common.php` | 665 | Strings comuns da interface (maior domínio) |
| `dashboard.php` | 32 | Painel de controlo |
| `equipment.php` | 75 | Equipamentos |
| `maintenance_plan.php` | 31 | Planos de manutenção |
| `messages.php` | 108 | Mensagens/notificações |
| `pagination.php` | 4 | Paginação (Laravel) |
| `preferences.php` | 33 | Preferências do utilizador |
| `room.php` | 32 | Salas |
| `stock.php` | 112 | Stock (peças, fornecedores, movimentos) |
| `stock_dashboard.php` | 4 | Dashboard de stock |
| `stock_movement.php` | 3 | Tipos de movimento de stock |
| `stock_part.php` | 8 | Peças de stock |
| `ticket_detail.php` | 21 | Detalhe de ticket |
| `ticket_media.php` | 23 | Média/fotografias de ticket |
| `tickets.php` | 108 | Tickets |
| `ui.php` | 103 | UI genérica (tabelas, resultados, etc.) |
| `validation.php` | 34 | Validação (mensagens Laravel + strings-fonte) |
| **Total** | **1498** | |

**Notas:**
- Os domínios `notifications.php` e `errors.php` (sugeridos no template) **não existem** — mensagens de notificação vivem em `messages.php`/`common.php`; páginas de erro usam strings-fonte via JSON (ex: `__('Erro Interno do Servidor')`).
- Laravel disponibiliza `pagination.php` e `validation.php` como domínios próprios.

## 4. Estado de Tradução por Locale

Referência: en-US (2853 caminhos canónicos = 1355 JSON + 1498 PHP). **Todos os 18 locales históricos: 100% de paridade de chaves (2853/2853, 0 em falta, 0 vazias, 0 extra).** Os 8 locales criados do zero (**ru-RU, uk-UA, bg-BG, zh-CN, zh-TW, ja-JP, ko-KR, hi-IN**) são medidos por **cobertura funcional** — ver notas abaixo da tabela.

Nota sobre "valores em identidade": valor igual à chave (a string-fonte). Em `pt-PT` é por design (língua-fonte). Nos restantes, a maioria são legítimos (termos técnicos, siglas, palavras coincidentes — ex: `SKU`, `SLA`, `MTTR`, `Admin`). **Revisão concluída na Fase 3a** para `pt-BR` (6 correções) e `es-ES` (0) — ver secção 6.

\* **ru-RU (Fase 3b), uk-UA e bg-BG (Fase 3c), zh-CN, zh-TW e ja-JP (Fase 3):** criados do zero a 2026-08-16, **sem JSON histórico** (nunca existiu `lang/{locale}.json`). A métrica canónica de 2853 caminhos (1355 JSON + 1498 PHP) é uma **lacuna estrutural da fonte** — os 1355 caminhos JSON já não são acedidos pelo app (Frente B migrou todo o código para `__('dominio.chave')`; 0 chamadas flat). Por isso estes locales são medidos por **cobertura funcional**: os **1498 caminhos PHP estão completos (21 domínios, 0 em falta, 0 vazias)** e cobrem **1211/1211 (100%) dos caminhos efetivamente usados no código** — idêntico aos restantes locales (auditoria `docs/i18n/scripts/audit_usage.py`).

\*\* **Valores em identidade nos locales criados do zero — todos legítimos** (termos técnicos/siglas `ID`, `MTTR`, `NIF`, `SKU`, `SLA`, `API`, `OK`, `Swagger`, `cURL`, `Round-robin`, `part_id`; formatos `Y-m-d`, `Y-m-d H:i:s`, `d`, `div`, `—`; placeholders `:reference — :equipment (:priority)`): **17 em ru-RU, 15 em uk-UA, 12 em bg-BG, 17 em zh-CN, 17 em zh-TW, 17 em ja-JP, 17 em ko-KR**. Sem revisão pendente.

| Locale | Nº chaves en (ref) | Nº presentes | % | Estado (chaves) | Valores identidade (JSON / PHP) | Migração JSON→PHP | Última verificação |
|---|---|---|---|---|---|---|---|
| bg-BG | 1498\* | 1498 | —\* | ✅ Completo (PHP) | 0 / 12\*\* | ✅ Concluída (nascido PHP-only) | 2026-08-16 |
| cs-CZ | 2853 | 2853 | 100.0 | ✅ Completo | 50 / 48 | ✅ Concluída | 2026-08-16 |
| da-DK | 2853 | 2853 | 100.0 | ✅ Completo | 64 / 62 | ✅ Concluída | 2026-08-16 |
| de-DE | 2853 | 2853 | 100.0 | ✅ Completo | 26 / 27 | ✅ Concluída | 2026-08-16 |
| el-GR | 2853 | 2853 | 100.0 | ✅ Completo | 30 / 28 | ✅ Concluída | 2026-08-16 |
| en-GB | 2853 | 2853 | 100.0 | ✅ Completo | 59 / 65 | ✅ Concluída | 2026-08-16 |
| en-US | 2853 | 2853 | 100.0 | ✅ Completo | 60 / 66 | ✅ Concluída | 2026-08-16 |
| es-ES | 2853 | 2853 | 100.0 | ✅ Completo | 175 / 177 | ✅ Concluída | 2026-08-16 |
| fi-FI | 2853 | 2853 | 100.0 | ✅ Completo | 51 / 50 | ✅ Concluída | 2026-08-16 |
| fr-FR | 2853 | 2853 | 100.0 | ✅ Completo | 32 / 33 | ✅ Concluída | 2026-08-16 |
| hu-HU | 2853 | 2853 | 100.0 | ✅ Completo | 51 / 50 | ✅ Concluída | 2026-08-16 |
| it-IT | 2853 | 2853 | 100.0 | ✅ Completo | 49 / 52 | ✅ Concluída | 2026-08-16 |
| nl-NL | 2853 | 2853 | 100.0 | ✅ Completo | 30 / 31 | ✅ Concluída | 2026-08-16 |
| pl-PL | 2853 | 2853 | 100.0 | ✅ Completo | 29 / 30 | ✅ Concluída | 2026-08-16 |
| pt-BR | 2853 | 2853 | 100.0 | ✅ Completo | 994 / 1004 | ✅ Concluída | 2026-08-16 |
| pt-PT | 2853 | 2853 | 100.0 | ✅ Completo | 1355 / 1373 (fonte, esperado) | ✅ Concluída | 2026-08-16 |
| ro-RO | 2853 | 2853 | 100.0 | ✅ Completo | 57 / 56 | ✅ Concluída | 2026-08-16 |
| ru-RU | 1498\* | 1498 | —\* | ✅ Completo (PHP) | 0 / 17\*\* | ✅ Concluída (nascido PHP-only) | 2026-08-16 |
| sv-SE | 2853 | 2853 | 100.0 | ✅ Completo | 64 / 62 | ✅ Concluída | 2026-08-16 |
| tr-TR | 2853 | 2853 | 100.0 | ✅ Completo | 21 / 20 | ✅ Concluída | 2026-08-16 |
| uk-UA | 1498\* | 1498 | —\* | ✅ Completo (PHP) | 0 / 15\*\* | ✅ Concluída (nascido PHP-only) | 2026-08-16 |
| zh-CN | 1498\* | 1498 | —\* | ✅ Completo (PHP) | 0 / 17\*\* | ✅ Concluída (nascido PHP-only) | 2026-08-16 |
| zh-TW | 1498\* | 1498 | —\* | ✅ Completo (PHP) | 0 / 17\*\* | ✅ Concluída (nascido PHP-only) | 2026-08-16 |
| ja-JP | 1498\* | 1498 | —\* | ✅ Completo (PHP) | 0 / 17\*\* | ✅ Concluída (nascido PHP-only) | 2026-08-16 |
| ko-KR | 1498\* | 1498 | —\* | ✅ Completo (PHP) | 0 / 17\*\* | ✅ Concluída (nascido PHP-only) | 2026-08-16 |
| hi-IN | 1498\* | 1498 | —\* | ✅ Completo (PHP) | 0 / 19\*\* | ✅ Concluída (nascido PHP-only) | 2026-08-16 |
| id-ID | 1498\* | 1498 | —\* | ✅ Completo (PHP) | 0 / 28\*\* | ✅ Concluída (nascido PHP-only) | 2026-08-16 |
| vi-VN | 1498\* | 1498 | —\* | ✅ Completo (PHP) | 0 / 20\*\* | ✅ Concluída (nascido PHP-only) | 2026-08-16 |

### 4.1 Âmbito de trabalho (gate de 2026-08-16)

**28 completos ✅** — ver tabela da secção 4. **7 locales a criar do zero na Fase 3 🔴** (0/1498 chaves PHP, 0%; caem no fallback pt-PT enquanto não forem criados). **zh-CN, zh-TW, ja-JP, ko-KR, hi-IN, id-ID e vi-VN concluídos a 2026-08-16 ✅** (removidos da lista pendente).

| Locale | Mercado (critério: G20 / maiores exportadores industriais / maiores PIBs industriais) | RTL | config/locales.php |
|---|---|---|---|
| ar-AE | Árabe — EAU, Arábia Saudita, Egito | ✅ | já configurado |
| fa-IR | Persa — Irão | ✅ | **novo (a adicionar na Fase 3)** |
| he-IL | Hebraico — Israel | ✅ | **novo (a adicionar na Fase 3)** |
| hi-IN | Hindi — Índia | | já configurado ✅ |
| id-ID | Indonésio — Indonésia | | já configurado ✅ |
| ja-JP | Japonês — Japão | | já configurado ✅ |
| ko-KR | Coreano — Coreia do Sul | | já configurado ✅ |
| ms-MY | Malaio — Malásia | | **novo (a adicionar na Fase 3)** |
| nb-NO | Norueguês — Noruega (PIB industrial; adicionado por critério do agente) | | já configurado |
| sk-SK | Eslovaco — Eslováquia (exportador automóvel; adicionado por critério do agente) | | já configurado |
| th-TH | Tailandês — Tailândia | | já configurado |
| vi-VN | Vietnamita — Vietname | | já configurado ✅ |
| zh-CN | Chinês simplificado — China | | já configurado |
| zh-TW | Chinês tradicional — Taiwan | | já configurado ✅ |

> **Notas do gate (2026-08-16):**
> - RTL (`ar-AE`, `he-IL`, `fa-IR`): âmbito = **traduzir apenas o texto**; layout/CSS (ex: `resources/css/rtl.css`) fora do escopo desta fase.
> - Variantes regionais mantidas separadas (`en-GB`/`en-US`, `pt-PT`/`pt-BR`).
> - Convenção de códigos `xx-XX` do projeto; chineses = `zh-CN` + `zh-TW` (em vez de `zh-Hans`/`zh-Hant`).
> - `da-DK`, `fi-FI`, `bg-BG` (já completos) ficam explicitamente no âmbito.
> - **Locales configurados FORA do âmbito (18)** — sem ficheiros, continuam no fallback pt-PT, **não tocar sem instrução**: az-AZ, be-BY, bs-BA, ca-AD, cnr-ME, et-EE, hr-HR, hy-AM, is-IS, ka-GE, lb-LU, lt-LT, lv-LV, mk-MK, mt-MT, sl-SI, sq-AL, sr-RS.

**Classificação aplicada** (ver secção 7 para a definição formal):
- `✅ Completo` (chaves): 100% de paridade, 0 vazias. Aplicável aos 21 com ficheiros.
- `🔴 Em falta / não iniciado`: sem ficheiros (aplicável aos 14 da Fase 3).
- O estado `Migração JSON→PHP` é `✅ Concluída` em todos os 21 (.json apagados na Frente C a 2026-08-14; arquivados em `docs/i18n/archive-json/`).

### 4.2 Verificações de integridade vs código (Fase 1; escopo da Frente B corrigido na Fase 2a)

Análise cruzada com o código (`app/**/*.php`, `resources/views/**/*.blade.php` e `*.php`, `resources/js/**/*.js`, `routes/**/*.php`, `config/**/*.php`):

- **1861 call sites `__()`** em **144 ficheiros** (de 526 distintos analisados em `app/**`, `resources/views/**`, `resources/js/**`, `routes/**`, `config/**`) e **1218 chaves de chamada distintas** (medição corrigida na Fase 2a com regex `'([^']*)'`/`"([^"]*)"` — o padrão `[^\"']*` truncava chaves com aspas internas). **Nota de correção:** a medição inicial de "3405 call sites (3401 simples + 4 duplas)" **estava errada por dupla contagem** — os ficheiros `.blade.php` combinam com os dois globs (`**/*.blade.php` e `**/*.php`); contando `__('` sem dedupe obtêm-se exatamente 3401 (⇒ 3405). A contagem real, com dedupe dos 526 ficheiros, é **1861**.
- **100 chamadas estruturais prefixadas** (`__('{dominio}.{chave}')`, ex.: `ticket_detail.status.open`) → todas resolvem nos ficheiros `.php` de `en` (0 por resolver).
- **14 chamadas já prefixadas com strings-fonte** (13 em `preferences.*` + 1 `stock_part.min`) → correctas, não precisam de migração.
- **1104 strings-fonte chamadas SEM prefixo** (760 sem ponto + **344 com ponto no texto**, ex.: `Ex.: João Silva`, `Qtd. consumida`, `A agendar...`) → resolvem **exclusivamente via JSON** (Laravel: chaves sem ponto só consultam `lang/{locale}.json`). **Nota:** o escopo anteriormente medido (760 strings/106 ficheiros) **estava errado** — ignorava as strings-fonte que contêm pontos no texto, agora incluídas (e posteriormente corrigido: 1217→1218 chaves, 1103→1104 strings).
- **1 chamada não resolvida:** `preferences.Ajuste as suas preferências de língua, moeda e formato de data independentemente.` (`resources/views/preferences/edit.blade.php:17`) — o texto no código divergiu da string-fonte (`...de língua, moeda, formato de data e números independentemente.`) e não existe no PHP nem no JSON → **corrigida durante a Frente B** (alinhada ao texto canónico).
- **Conclusão crítica para a Fase 2:** as strings-fonte são hoje resolvidas **apenas pelo JSON**. Os 1355 registos de strings-fonte presentes nos `.php` estão "dormentes" (o código só os chama com prefixo de domínio em 14 casos). **Apagar os `.json` sem migrar o código quebra as traduções de strings-fonte** (cairiam para pt-PT via fallback). → ver decisão na secção 7.

**Estado da Frente B (migração do código, concluída a 2026-08-14):** as **1104 strings-fonte sem prefixo** foram migradas para `__('{dominio}.{string}')` via `frente_b_map.json` (1104 entradas construídas das entradas-identidade do pt-PT + decisões de contexto para 18 strings ambíguas; validado: identidade no domínio escolhido, 0 irresolvíveis). Aplicadas **1659 substituições** (1635 `__('KEY')` exactas + ~24 com 2º argumento) em **143 ficheiros**. Decisões de contexto: 8 → `tickets` (Aberto, Alta, Baixa, Cancelado, Em Progresso, Fechado, Resolvido, Urgente), Fornecedores → `stock`, Tickets Abertos → `dashboard`, Formato de hora atualizado com sucesso. → `preferences`, bloco `preferences.*` → `preferences`; `'min'` → `common` (identidade; **não confundir** com `stock_part.min`, que é estrutural `'mín.'`). 'Em Atendimento' não é chamado no código. **Verificação pós-migração:** 1861 instâncias (1849 pré-migração nos 143 ficheiros tocados); **1214 chaves distintas** (1218 − 1105 removidas + 1105 adicionadas − 4 colisões); as 4 colisões (`preferences.Formato de Data`, `preferences.Formato de Números`, `preferences.Moeda`, `preferences.Preferências do Utilizador`) são strings-fonte com chamadas já-prefixadas **e** não-prefixadas → ambas resolvem para a MESMA entrada-identidade em `preferences.php` (semanticamente consistentes); **0 strings-fonte sem prefixo remanescentes**; **0 falhas de resolução em pt-PT e nos 18 locales**; auditoria final **2853/2853 (100%)**.

**Estado da Frente C (apagamento do JSON, concluída a 2026-08-14):** antes de apagar, foi feito um scan exaustivo de TODO o repositório (qualquer extensão, excluindo `vendor`/`node_modules`) que encontrou **3 chamadas dinâmicas `__($var)`** e **2 chamadas literais não-prefixadas fora do escopo original** (em `tests/`, não coberto pela Frente B):
- `tests/Feature/Web/Controllers/ProfileControllerTest.php` — `__('Password alterada com sucesso.')` e `__('Perfil atualizado com sucesso.')` → **corrigidas** para `__('messages....')` (alinhadas ao controller migrado).
- `app/Http/Middleware/LocalizeSwaggerDocument.php` — `__($value)` sobre strings-fonte do OpenAPI → **corrigido** com mapa `string → domínio` (7 strings: `common`, `tickets`, `auth`, `stock`); as restantes 4 strings do `OpenApiSpec` não existem em nenhum ficheiro de tradução e continuam em pt (comportamento pré-existente).
- As 2 chamadas `__($item['label'])` dos menus laterais resolvem por chaves já prefixadas → sem alteração.

Os 18 `lang/{locale}.json` foram **apagados** e arquivados em `docs/i18n/archive-json/` (cópia dupla em `/tmp/opencode/frente_c_backup/`). **Verificação pós-apagamento:** auditoria **2853/2853 (100%)** em todos os 18 locales (referência JSON lida do arquivo); **1830 instâncias `__()` literais, 1183 chaves distintas, 0 não-prefixadas, 0 falhas de resolução nos 18 locales**.

## ⚠️ Problemas na fonte de verdade (en)

1. **en-US vs en-GB divergem em valores (77 diferenças), embora tenham conjuntos de chaves idênticos.** Exemplos: `Acesso Proibido` → US `Prohibited Access` / GB `Access Forbidden`; `Agenda Inteligente` → US `Smart Agenda` / GB `Smart Calendar`; `Ativos` → US `Assets` / GB `Active`. ✅ **Resolvido (decisão Puma, 2026-08-14): o `en` canónico para valores é `en-GB`.**
2. **`en` tem 123 chaves-fonte representadas apenas em JSON** (não existem em nenhum domínio `.php`). Não é uma lacuna de conteúdo (os valores existem), mas é uma lacuna estrutural da representação PHP: se o `.json` for eliminado sem migração, essas 123 strings deixam de ter tradução. Ver lista completa na secção 5. A migração destas chaves é o objeto da Fase 2.
3. **`config/locales.php` lista 49 línguas; apenas 18 têm ficheiros `lang/`.** ✅ **Resolvido (decisão Puma, 2026-08-14): as 31 restantes (ru-RU, uk-UA, bg-BG, hr-HR, sr-RS, sk-SK, sl-SI, et-EE, lv-LV, lt-LT, mk-MK, sq-AL, ca-AD, is-IS, nb-NO, hy-AM, ka-GE, az-AZ, be-BY, lb-LU, mt-MT, bs-BA, cnr-ME, zh-CN, ja-JP, ko-KR, hi-IN, ar-AE, th-TH, vi-VN, id-ID) **entram no âmbito** como `🔴 Em falta / não iniciado` (criação de ficheiros do zero na Fase 3).**

## 5. Chaves em Falta por Locale (detalhe)

**Não existem chaves em falta** — todos os 18 locales têm os 2853 caminhos canónicos (100% de paridade, 0 em falta, 0 vazias, 0 extra).

A **Fase 2a eliminou o backlog de migração**: as **123 chaves-fonte que existiam apenas em JSON foram migradas para os domínios `.php`** (0 restantes só-em-JSON). Lista histórica da Fase 2a (idêntica em todos os locales) — registo das chaves migradas:

**Validação (9)** — sugerem `validation.php`:
- `A confirmação do campo :attribute não confere.`
- `O campo :attribute é de preenchimento obrigatório.`
- `O campo :attribute deve ser no mínimo :min.`
- `O campo :attribute deve ser um endereço de e-mail válido.`
- `O campo :attribute deve ser um número.`
- `O campo :attribute deve ter pelo menos :min caracteres.`
- `O campo :attribute não pode ser superior a :max.`
- `O campo :attribute não pode ter mais de :max caracteres.`
- `Demasiadas tentativas de início de sessão. Por favor tente novamente em :seconds segundos.`

**Autenticação/perfil (6)** — sugerem `auth.php`/`auth_box.php`/`messages.php`:
- `As credenciais introduzidas não correspondem aos nossos registos.`
- `A palavra-passe fornecida está incorreta.`
- `Login / Registo`
- `Terminar sessão`
- `Ver perfil`
- `Bem-vindo ao SGM`

**Tickets/ocorrências (26)** — sugerem `tickets.php`/`ticket_detail.php`/`ticket_media.php`:
- `Abrir Novo Ticket`
- `Gestão de Tickets`
- `Nível de Prioridade`
- `Descrição da Ocorrência`
- `ID Ocorrência`
- `Reportado por`
- `Em Atendimento`
- `Apenas tickets com o estado "Em Curso" podem ser fechados rapidamente.`
- `Apenas tickets com o estado \\"Em Curso\\" podem ser fechados rapidamente.`
- `Apenas tickets no estado "Aberto" podem ser cancelados.`
- `Apenas tickets no estado "Aberto" podem ser iniciados.`
- `Apenas tickets no estado \\"Aberto\\" podem ser cancelados.`
- `Apenas tickets no estado \\"Aberto\\" podem ser iniciados.`
- `Comentário adicionado`
- `Anexo adicionado`
- `Ticket atualizado`
- `Ticket atribuído`
- `Mensagem enviada!`
- `Fotografia enviada!`
- `Erro ao carregar fotografias.`
- `Erro ao remover fotografia.`
- `Erro ao carregar histórico.`
- `Tem a certeza que pretende remover esta fotografia?`
- `Remover fotografia`
- `Remover ficheiro`
- `Ficheiro`

**Stock (8)** — sugerem `stock.php`/`stock_movement.php`/`stock_part.php`:
- `Ajuste de inventário`
- `Devolução de sobrante`
- `Consumo em intervenção`
- `Alerta de Stock Baixo`
- `em stock`
- `peças`
- `consumo`
- `Peças e Componentes`

**Dashboard/analytics (13)** — sugerem `dashboard.php`/`analytics.php`/`analytics_data.php`:
- `Painel de Controlo`
- `A ler indicadores analíticos em tempo real...`
- `Não foi possível carregar os indicadores analíticos do servidor.`
- `Tempo Médio de Resolução (MTTR)`
- `Tempo até atribuição`
- `Tickets Resolvidos`
- `Resolvidos Hoje`
- `Ocorrências ativas`
- `Intervenções concluídas`
- `Urgentes`
- `Normais`
- `Últimas ações registadas na plataforma para acompanhar rapidamente a atividade operacional.`
- `Pedido de orçamento`

**UI/formatos (21)** — sugerem `ui.php`/`common.php`/`pagination.php`:
- `Anterior`
- `Próxima`
- `Página`
- `Sem resultados`
- `resultado(s) encontrado(s)`
- `equipamento(s)`
- `Genérico`
- `Separador`
- `Separador decimal`
- `Formato atual`
- `Formato de data`
- `Exemplo com data de hoje`
- `Y-m-d`
- `Y-m-d H:i:s`
- `d`
- `h`
- `mín.`
- `meses`
- `mês`
- `div`
- `de`

**Idiomas/preferências (14)** — sugerem `preferences.php`/`messages.php`:
- `Idioma alterado com sucesso.`
- `O idioma selecionado não é suportado.`
- `Selecionar Idioma e Região`
- `Selecionar Língua`
- `Selecionar Moeda`
- `Selecionar Formato de Data`
- `Pesquisar idioma ou país...`
- `Nenhum idioma encontrado.`
- `Seleccione uma língua para pré-visualizar`
- `Seleccione uma moeda para pré-visualizar`
- `Seleccione um formato para pré-visualizar`
- `Língua atual`
- `Moeda atual`
- `Ajuste as suas preferências de língua, moeda, formato de data e números independentemente.`

**Outros/gerais (26)** — sugerem `common.php`/`ui.php`/`equipment.php`/`room.php`:
- `API`
- `Web`
- `Mobile`
- `QR Code`
- `OK`
- `Alteração`
- `Criação`
- `Eliminação`
- `Manutenção`
- `Fora de serviço`
- `Equipamento / Ativo`
- `Telefone`
- `Técnico Atribuído`
- `Pendente de atribuição`
- `Nenhum equipamento encontrado com os filtros aplicados.`
- `Nenhuma ocorrência recente registada.`
- `Nenhuma peça encontrada com os filtros aplicados`
- `Nenhuma sala encontrada com os filtros aplicados`
- `Nenhum ticket encontrado com os filtros aplicados.`
- `Nenhum plano de manutenção encontrado.`
- `Nenhuma descrição providenciada.`
- `Sem mensagens registadas.`
- `Ver detalhes`
- `Operação realizada com sucesso.`
- `Ocorreu um erro ao processar o seu pedido.`
- `part_id`

> A atribuição de domínio acima foi a **proposta aplicada na Fase 2a** (seguindo o padrão de distribuição já usado nas outras strings-fonte migradas). As 123 chaves foram migradas para os domínios indicados, em todos os 18 locales.

## 6. Log de Sessões de Trabalho

- **2026-08-14 — Fase 1 (Auditoria, sem traduções):** Análise completa dos 18 locales em `lang/`. Metodologia: parser Python próprio para arrays PHP (sem binário PHP no ambiente), validado por contagem cruzada e contra leitura manual. Conclusões: (1) 100% de paridade de chaves vs `en` (2741/2741) em todos os locales; (2) 0 chaves vazias; (3) 21 domínios idênticos em todos; (4) migração JSON→PHP não concluída em nenhum (123 chaves-fonte só em JSON por locale); (5) en-US vs en-GB com 77 diffs de valor; (6) config/locales.php lista 49 línguas, só 18 com ficheiros. Nenhuma chave adicionada/alterada (fase de auditoria). Ficheiro de tracking criado (Fase 0) e preenchido.
- **2026-08-14 — Decisões de Puma (gate da Fase 1):** (1) `en` canónico para valores = **en-GB**; (2) os **31 locales configurados sem ficheiros entram no âmbito** (49 no total); (3) valores em identidade de **pt-BR e es-ES a rever na Fase 3**; (4) ficheiros `.json` serão **apagados** após migração confirmada. Registadas nas secções ⚠️, 4.1 e 7.
- **2026-08-14 — Decisão sobre o bloqueio do JSON (secção 4.2):** Puma decidiu **migrar também o código** — as chamadas `__('string')` sem prefixo passam a `__('{dominio}.{string}')`, permitindo apagar os `.json` em segurança. A Fase 2 passa a ter três frentes: (a) adicionar as 123 chaves aos `.php`; (b) migrar o código (≈760 chamadas — escopo corrigido na Fase 2a para 1104 strings); (c) apagar os `.json`.
- **2026-08-14 — ⚠️ Incidente de perda de dados (Frente A inicial):** ao aplicar a Frente A, **144 ficheiros PHP foram sobrescritos** (8 domínios × 18 locales) ficando com **apenas as linhas inseridas** (perda irreversível das restantes entradas). `lang/` não é versionado (git só conhece `lang/en.json`/`lang/pt.json`), pelo que não havia histórico para restaurar. Causa não determinada. **Puma decidiu (via pergunta): "Reconstrução completa (Recomendado)".**
- **2026-08-14 — Recuperação pós-incidente (completa):** backup completo de `lang/` em `/tmp/opencode/pre_recovery/lang`. Reconstrução com base em `keys_by_file.json` (valores pt-PT por ficheiro, capturados antes do incidente — em pt-PT valor==chave para strings-fonte, o que recupera os conjuntos de chaves exatos) e no modelo de geração verificado nos ficheiros intactos (0 divergências em 115 entradas): `valor(locale) = locale.JSON[valor pt-PT]`. Os valores estruturais dos 8 domínios danificados foram recuperados do mesmo modo. **Resultado: 2741/2741 (paridade pré-incidente restaurada)** — incluindo as 2 chaves estruturais de `stock.php` (`management`, `movements`; valores `Gestão de Stock`/`Movimentos de Stock`, **nomes inferidos — 0 referências no código**, a confirmar por Puma). Auditoria: 0 desvios de valor vs JSON nos domínios reconstruídos (28 desvios pré-existentes apenas em ficheiros intactos).
- **2026-08-14 — Fase 2a concluída (Frente A re-aplicada):** das 123 chaves-fonte, **11 já existiam** na base (dashboard 3, preferences 1, stock 2, tickets 5) → **112 adicionadas** por locale (2016 entradas no total), com dedupe, verificação em disco por ficheiro e auditoria final. **Resultado: 2853/2853 (100%) em todos os 18 locales** (0 em falta, 0 vazias, 0 extra). **Escopo Frente B corrigido:** 1861 call sites `__()` (a medição de 3405 era dupla contagem dos `.blade.php`), 1218 chaves distintas, 1104 strings-fonte a migrar (760 sem ponto + 344 com ponto), 100 chamadas estruturais + 14 já prefixadas, **1 chamada não resolvida** em `preferences/edit.blade.php:17`.
- **2026-08-14 — Frente B concluída (migração do código):** mapa `frente_b_map.json` com **1104 entradas** (strings-fonte → domínio), construído das entradas-identidade do pt-PT + decisões de contexto para as 18 strings ambíguas, validado (identidade no domínio escolhido, 0 irresolvíveis). **1659 substituições aplicadas** em **143 ficheiros** (526 distintos analisados; 1 ficheiro sem alterações) via `/tmp/opencode/frente_b.py`. A **chamada não resolvida** em `preferences/edit.blade.php:17` foi corrigida para o texto canónico. **Verificação pós-migração:** 1861 instâncias; **1214 chaves distintas** (1218 − 1105 + 1105 − 4 colisões); as 4 colisões (`preferences.Formato de Data`, `preferences.Formato de Números`, `preferences.Moeda`, `preferences.Preferências do Utilizador`) resolvem todas para a MESMA entrada-identidade em `preferences.php` (chamadas já-prefixadas e migradas consistentes); **0 strings-fonte sem prefixo remanescentes**; **0 falhas de resolução em pt-PT e nos 18 locales**; auditoria **2853/2853 (100%)**.
- **2026-08-14 — Frente C concluída (apagamento do JSON):** antes de apagar, scan exaustivo de todo o repo (qualquer extensão) confirmou que as strings-fonte passaram a resolver 100% pelos `.php`. Encontrados e **corrigidos** 2 consumidores fora do escopo da Frente B: (1) `tests/Feature/Web/Controllers/ProfileControllerTest.php` — 2 asserções com chaves não-prefixadas (`Password alterada com sucesso.`, `Perfil atualizado com sucesso.`) → prefixadas com `messages.`; (2) `app/Http/Middleware/LocalizeSwaggerDocument.php` — `__($value)` do OpenAPI → mapa `string → domínio` (7 strings em `common`/`tickets`/`auth`/`stock`; as restantes 4 do `OpenApiSpec` não existem em nenhum ficheiro de tradução e mantêm-se em pt). Os **18 `lang/{locale}.json` foram apagados** e arquivados em **`docs/i18n/archive-json/`** (+ `/tmp/opencode/frente_c_backup/`). **⚠️ Nota de ambiente:** `/tmp/opencode` foi limpo a meio (os scripts `frente_b.py`, `frente_b_map.json`, backups e `php_lang_audit.py` originais perderam-se); os scripts de auditoria foram **recriados e persistidos no repo** (`docs/i18n/scripts/php_lang_audit.py`, `docs/i18n/scripts/audit_final.py`), com leitura da referência JSON a partir de `docs/i18n/archive-json/`. **Verificação pós-apagamento:** auditoria **2853/2853 (100%)** nos 18 locales (referência lida do arquivo); **1830 instâncias `__()` literais, 1183 chaves distintas, 0 não-prefixadas, 0 falhas de resolução nos 18 locales**; 3 chamadas dinâmicas `__($var)` restantes (swagger já corrigido + 2 menus laterais com chaves prefixadas) inócuas.
- **2026-08-16 — Fase 3a concluída (revisão de identidade pt-BR/es-ES):** classificação automática + revisão manual dos valores em identidade. **es-ES (175): 0 correções** — todos legítimos (siglas, placeholders, formatos, unidades, espanhol correto; scan ortográfico de marcadores portugueses = 0). **pt-BR (994): 13 candidatos a juízo; Puma aprovou 6** correções aplicadas em `lang/pt-BR/common.php` e `lang/pt-BR/tickets.php` (chaves intactas, só valores): `Aplicação`→`Aplicativo`, `Nome da aplicação`→`Nome do aplicativo`, `Identidade e preferências gerais da aplicação.`→`... do aplicativo.`, `Documentação OpenAPI da aplicação...`→`... do aplicativo de gestão...`, `Movimentos`→`Movimentações`, `Tipo de Movimento`→`Tipo de Movimentação` — as duas últimas alinhadas com o precedente já existente no próprio locale (`Movimentos de Stock`→`Movimentações de Estoque`, `Movimentos Recentes`→`Movimentações Recentes`). **7 mantidas como legítimas** (família `Avaria`/`Avariado`/`Comunicar Avaria`/`Gestão de Avarias`/`Equipamentos com Mais Avarias` — palavra válida em pt-BR e precedente `Nova Avaria Registrada #:id` no próprio ficheiro). Backup pré-alteração em `docs/i18n/review/backup-3a/`. Listas classificadas completas em `docs/i18n/review/3a-identidade-{pt-BR,es-ES}.csv`. **Auditoria pós-3a: 2853/2853 (100%)**, 0 miss/extra/vazias.
- **2026-08-16 — Fase 3b concluída (locale piloto `ru-RU` criado do zero):** gerador `docs/i18n/scripts/build_ru_ru.py` com dicionário chave→russo (1498 chaves traduzidas a partir dos valores `en-GB`, estrutura e placeholders preservados). Gera `lang/ru-RU/*.php` (21 domínios). **3 bugs corrigidos no gerador:** ROOT apontava para `docs/` (lang está na raiz); `verify()`/`build()` usavam o nome de ficheiro `dom.php` em vez do domínio (`dom`), fazendo falhar todas as chaves; `emit()` não suportava dicionários aninhados (`messages.continents.*`). **Validações:** round-trip do parser (conjunto de chaves idêntico ao en-GB em todos os 21 ficheiros); placeholders idênticos ao en-GB (0 diffs); aspas escapadas (`\"Em Curso\"`) preservadas; cobertura funcional **1211/1211 (100%)** medida com o novo `docs/i18n/scripts/audit_usage.py` (caminhos `__('dominio.chave')` efetivamente usados no código — igual aos restantes 18 locales). `ru-RU` já estava registado em `config/locales.php`. **17 valores em identidade, todos legítimos** (siglas/formatos/placeholders). Gerador e auditor de uso persistidos no repo (`docs/i18n/scripts/`).
- **2026-08-16 — Nota de métrica (ru-RU vs conjunto canónico):** o `audit_final.py` reporta ru-RU a 52,5% porque compara contra os 2853 caminhos canónicos históricos, que incluem 1355 caminhos JSON do arquivo que o app já não usa (Frente B migrou todo o código para `__('dominio.chave')`; 0 chamadas flat em `app/`, `resources/`, `routes/`). ru-RU não tem (nem precisa de) JSON histórico. A métrica funcional (`audit_usage.py`) é a correta para locales novos — ver secções 4 e 7.
- **2026-08-16 — Fase 3c (sessão curta; registo retrospetivo):** `uk-UA` e `bg-BG` criados do zero com o mesmo padrão da Fase 3b (`build_locale.py` + dicionários `translations_uk_UA.py`/`translations_bg_BG.py`, persistidos em `docs/i18n/scripts/`), 21 domínios cada, PHP-only. Correções de gaps e de valores em identidade em 12 locales (inclui 3 em es-ES) e correção de `tr-TR` (`validation.php`, regra `:max`). **Estado confirmado pela auditoria desta sessão:** 18 históricos a 2853/2853 e ru-RU/uk-UA/bg-BG a 1498/1498 PHP com 1211/1211 funcionais.
- **2026-08-16 — Gate de âmbito expandido (decisões de Puma) + Fase 1 do novo âmbito concluída:** (1) `da-DK`, `fi-FI` e `bg-BG` (completos) entram explicitamente no âmbito + mandato para adicionar qualquer língua que o agente considere necessária; (2) variantes separadas mantidas (`en-GB`/`en-US`, `pt-PT`/`pt-BR`); (3) convenção chinesa: **`zh-CN` + `zh-TW`** (regional, padrão `xx-XX` do projeto — em vez de `zh-Hans`/`zh-Hant`); (4) novos de raiz aprovados: **`he-IL`, `fa-IR`, `ms-MY`, `zh-TW`** (a adicionar ao `config/locales.php` na Fase 3); (5) por critério do agente (G20/exportadores industriais): **`nb-NO`** e **`sk-SK`**. Novo âmbito: **21 completos + 14 a criar** (ver secção 4.1). Auditoria fresca re-executada (`audit_final.py` + `audit_usage.py`): **21/21 a 100%**; `audit_summary.json` atualizado. **Fase 1 do novo âmbito concluída** — aguarda aprovação da ordem de prioridade da Fase 3 (gate seguinte).
- **2026-08-16 — zh-CN e zh-TW concluídos (Fase 3):** ambos criados do zero com `build_locale.py` + dicionários `translations_zh_CN.py`/`translations_zh_TW.py` (1498 chaves cada, 21 domínios). `zh-TW` usa vocabulário taiwanês autêntico (登入/密碼/設定/稽核/搜尋/匯出 etc.) em vez de simplificado. `config/locales.php` atualizado com `zh-TW` (繁體中文, TWD). Validações: round-trip parser (1498/1498), placeholders (57/57), cobertura funcional **1211/1211 (100%)**. **17 valores em identidade em cada, todos legítimos.**
- **2026-08-16 — ja-JP concluído (Fase 3):** criado do zero com `build_locale.py` + dicionário `translations_ja_JP.py` (1498 chaves, 21 domínios). Japonês natural (日本語) com kanji, hiragana e katakana apropriados. Validações: round-trip parser (1498/1498), placeholders (57/57), cobertura funcional **1211/1211 (100%)**.
- **2026-08-16 — ko-KR concluído (Fase 3):** criado do zero com `build_locale.py` + dicionário `translations_ko_KR.py` (1498 chaves, 21 domínios). Coreano natural (한국어) com hangul apropriado. Validações: round-trip parser (1498/1498), placeholders (57/57), cobertura funcional **1211/1211 (100%)**.
- **2026-08-16 — hi-IN concluído (Fase 3):** criado do zero com `build_locale.py` + dicionário `translations_hi_IN.py` (1498 chaves, 21 domínios). Hindi natural (हिन्दी) com script Devanagari apropriado. Validações: round-trip parser (1498/1498), placeholders (57/57), cobertura funcional **1211/1211 (100%)**.
- **2026-08-16 — id-ID concluído (Fase 3):** criado do zero com `build_locale.py` + dicionário `translations_id_ID.py` (1498 chaves, 21 domínios). Indonésio natural (Bahasa Indonesia) com vocabulário apropriado. Validações: round-trip parser (1498/1498), placeholders (57/57), cobertura funcional **1211/1211 (100%)**.
- **2026-08-16 — vi-VN concluído (Fase 3):** criado do zero com `build_locale.py` + dicionário `translations_vi_VN.py` (1498 chaves, 21 domínios). Vietnamita natural (Tiếng Việt) com vocabulário apropriado. Validações: round-trip parser (1498/1498), placeholders (57/57), cobertura funcional **1211/1211 (100%)**.

## 7. Decisões e Convenções

- **Conjunto canónico:** união de 2853 caminhos (1355 do JSON + 1498 dos domínios `.php` de `en`) — ver secção 1. Qualquer comparação futura usa esta definição. Após a Frente C, a referência JSON é lida do arquivo `docs/i18n/archive-json/` (os scripts de auditoria `docs/i18n/scripts/audit_final.py` e `php_lang_audit.py` fazem esse fallback automaticamente). **Exceção para locales criados do zero (Fase 3b/3c em diante — ru-RU, uk-UA, bg-BG e os 14 da Fase 3):** sem JSON histórico, a métrica correta é a **cobertura funcional** (`docs/i18n/scripts/audit_usage.py`) — caminhos `__('dominio.chave')` efetivamente usados no código. O `audit_final.py` (2853) penaliza estes locales com os 1355 caminhos JSON obsoletos; ver secção 4.
- **Classificação de estado:**
  - `✅ Completo` (chaves): 100% de paridade vs `en`, 0 chaves vazias. Todos os 18 locales históricos são `✅ Completo` e com migração `✅ Concluída` (sem `.json`). Os `ru-RU`, `uk-UA`, `bg-BG`, `zh-CN`, `zh-TW`, `ja-JP`, `ko-KR`, `hi-IN`, `id-ID` e `vi-VN` são `✅ Completo (PHP)` com 100% de cobertura funcional.
  - `🟡 Parcial`: paridade inferior a 100% (não observado nesta auditoria).
  - `🔴 Em falta / não iniciado`: sem ficheiros ou paridade muito baixa (aplicável aos 11 locales em âmbito sem ficheiros — Fase 3).
  - `⚪ Só em JSON (não migrado)`: apenas JSON, sem `.php` (não observado).
- **Fonte de verdade de valores:** `en-GB` (decidido por Puma a 2026-08-14). Para paridade de chaves é indiferente (en-US e en-GB têm chaves idênticas). Locales novos traduzem a partir de `en-GB`.
- **Âmbito (gate 2026-08-16):** 28 completos (18 históricos + ru-RU, uk-UA, bg-BG, zh-CN, zh-TW, ja-JP, ko-KR, hi-IN, id-ID, vi-VN) + **7 a criar na Fase 3** (ar-AE, fa-IR, he-IL, ms-MY, nb-NO, sk-SK, th-TH). Outros 18 configurados (az-AZ, be-BY, bs-BA, ca-AD, cnr-ME, et-EE, hr-HR, hy-AM, is-IS, ka-GE, lb-LU, lt-LT, lv-LV, mk-MK, mt-MT, sl-SI, sq-AL, sr-RS) ficam fora do âmbito (fallback) até instrução. Decisões do gate na secção 6.
- **Criação de locales novos (padrão Fase 3b/3c):** gerar com `docs/i18n/scripts/build_locale.py` + dicionário `translations_{LOCALE}.py` (chave→tradução a partir dos valores `en-GB`), com verificação de chaves antes de gerar; validar com round-trip do parser, placeholders e `audit_usage.py`. Métrica de conclusão: cobertura funcional 1211/1211. Locais concluídos: ru-RU, uk-UA, bg-BG, zh-CN, zh-TW, ja-JP, ko-KR, hi-IN, id-ID, vi-VN.
- **Códigos de locale:** convenção `xx-XX` do projeto (BCP-47 com região). Chineses: `zh-CN` (simplificado) + `zh-TW` (tradicional) — decidido 2026-08-16 (não usar `zh-Hans`/`zh-Hant`).
- **Novos de raiz na Fase 3:** adicionar `he-IL`, `fa-IR`, `ms-MY` ao `config/locales.php` antes de gerar ficheiros. (`zh-TW` já adicionado e concluído; `ja-JP` já estava configurado.)
- **RTL (`ar-AE`, `he-IL`, `fa-IR`):** traduzir apenas o texto; layout/CSS (ex: `resources/css/rtl.css`) fora do âmbito desta fase.
- **Destino dos `.json`:** os `lang/{locale}.json` foram **apagados** (arquitetura alvo PHP-only; decidido por Puma a 2026-08-14) na **Frente C** (2026-08-14), com arquivo em `docs/i18n/archive-json/`. ✅ **Decisão de 2026-08-14 (após bloqueio da secção 4.2): a Fase 2 passa a incluir a migração do código** — as 1104 chamadas `__('string')` sem prefixo passaram a `__('{dominio}.{string}')`, para que as strings-fonte resolvam pelos `.php` e o JSON pudesse ser eliminado em segurança. **Fase 2 concluída: Frente A (123 chaves → `.php`), Frente B (migração do código, 1659 substituições/143 ficheiros) e Frente C (JSON apagado e arquivado)** — ver secções 4.2 e 6. Recomenda-se validação funcional da aplicação em runtime (não realizada: sem binário PHP no ambiente).
- **Valores em identidade em pt-BR (994) e es-ES (175):** ✅ **Revisão concluída na Fase 3a (2026-08-16).** es-ES: 0 correções (tudo legítimo). pt-BR: 6 correções aplicadas (família `aplicação`/`movimento` — ver secção 6) e 7 mantidas como legítimas (família `avaria`).
- **Placeholders:** preservar sempre a sintaxe de placeholders (`:name`, `:attribute`, `:min`, `:max`, `:seconds`, `:count`) e de pluralização Laravel (`{1} um item|[2,*] :count itens`) — adaptar apenas o texto, nunca a sintaxe.
- **Termos que não se traduzem:** siglas e termos técnicos (`API`, `SKU`, `SLA`, `MTTR`, `QR Code`, `ID`, `Stock`, `Mobile`, `Web`) mantêm-se iguais; em caso de dúvida, seguir o que já está usado noutros domínios do mesmo locale.
- **Consistência terminológica:** antes de traduzir um termo recorrente (`ticket`, `avaria`, `stock`, `equipamento`), verificar como já foi traduzido noutros domínios do mesmo locale.
- **Valores em identidade:** valor==chave não é automaticamente erro (ex.: termos técnicos e palavras coincidentes). ✅ Revisão concluída na **Fase 3a (2026-08-16)** — ver secções 6 e 7.
- **Sem tradução automática entre locales:** a referência de tradução é sempre `en`, nunca outro locale.
