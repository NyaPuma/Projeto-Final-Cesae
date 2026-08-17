# Plano de Tokens e Decisões de Design

## Paleta de Cores

- `--color-primary`: #ea580c — laranja industrial (visibilidade/sinalética de segurança). Hover: #c2410c; light (dark): #f97316.
- `--color-secondary`: #14213d — aço profundo para navegação e superfícies densas.
- `--color-surface`: #ffffff — superfície principal (cartões e painéis).
- `--color-surface-2`: #f8fafc — fundo de página e alternância discreta de painéis.
- `--color-border`: #cbd5e1 — linha neutra para separar sem competir.
- `--color-text`: #0f172a — texto primário escuro com boa legibilidade.
- `--color-text-soft`: #475569 — texto secundário para contextos menos proeminentes.

Estados de ticket (personalizáveis em Definições → Aparência):
- `--color-ticket-open`: #2563eb — azul operacional para tickets abertos.
- `--color-ticket-in-progress`: #f59e0b — âmbar ativo para tickets em progresso.
- `--color-ticket-resolved`: #10b981 — verde técnico para resolvido.
- `--color-ticket-urgent`: #dc2626 — vermelho de aviso para urgentes.

Semânticas: `--color-success: #16a34a; --color-warning: #d97706; --color-danger: #b91c1c; --color-info: #2563eb` (com variantes claras para dark mode).

**Justificação:** a escolha mantém a identidade da equipa (laranja) em vez de cair no "default terracota" de design de IA — o laranja é lido como cor de segurança/avaria, coerente com o contexto industrial, e não é acompanhado por fundo creme nem serifa. O dark mode usa o mesmo matiz com luminância ajustada.

## Tipografia

- `--font-sans`: Inter (carregada via fonts.bunny.net) / system-ui — corpo moderno e neutro para ambientes técnicos.
- `--font-mono`: JetBrains Mono / Cascadia Code / monospace — IDs de ticket, tabelas e dados tabulares (`.font-mono`, `font-feature-settings: "tnum"`).
- Escala tipográfica fluida com `clamp()`, mínimos nunca abaixo de ~0.8rem (WCAG legibilidade). Headings com `text-wrap: balance`.

## Layout

Painel industrial com navegação lateral persistente, top bar de estado (sticky, com blur) e áreas de conteúdo em cartões. Densidade moderada: espaçamento suficiente para legibilidade, mas compacto para visualização operacional. Responsivo a partir de 360px — a sidebar vira drawer em <1024px.

## Elemento de Assinatura

O brilho de acento laranja (`color-mix` sobre `--color-primary`) aplicado a cartões de destaque e bordas de secção — transmite "painel de controlo industrial" sem interface saturada nem SaaS genérico. Os badges de estado dos tickets usam a cor do estado como texto sobre fundo tintado da mesma cor.

## Personalização de Tema

Página de definições de aparência (admin-only, `role:admin`):
- Tabela `theme_settings` (key/value); rota `GET /theme/custom.css` gera CSS dinamicamente com ETag e cache (`stale-while-revalidate`).
- O layout liga `/theme/custom.css` **depois** do `app.css`, sobrepondo apenas os tokens `--color-*`.
- `--on-primary` (texto legível sobre a primária) é calculado por luminância no servidor — nunca fixo.
- Pré-visualização em tempo real via `resources/js/pages/definicoes-aparencia.js` (manipulação de propriedades CSS via JS externo; zero estilos inline).
- **Guardar automático:** não existe botão "Guardar" — clicar num preset persiste imediatamente via AJAX (`POST ui.definicoes.aparencia.update`, que devolve JSON quando o pedido o espera); edições de cor guardam após debounce. O endpoint mantém a correção de contraste no servidor, por isso o tema guardado nunca diverge do que está no ecrã (sem temas híbridos). Um indicador "A guardar…/Guardado" mostra o estado.
- Temas pré-definidos (WCAG AA verificada) preenchem os campos avançados; cada cor é ainda **corrigida automaticamente** (no cliente e no servidor) para cumprir texto/soft ≥4.5:1 sobre superfície, texto do botão primário ≥4.5:1 e primária vs superfície ≥3:1. Nunca bloqueia o guardar — ajusta os valores em falta (o texto dos botões usa preto/branco puro, que garante ≥4.5:1 contra qualquer cor).

**Presets emparelhados claro/escuro (14 famílias × 2 = 28 temas):** `app/Services/ThemePresetService.php` é a fonte única dos 28 temas (laranja, azul, verde, vinho, roxo, teal, dourado, grafite, rosa, limão, índigo, ciano, fúcsia, castanho). Cada família partilha o matiz e tem um par `claro-*`/`escuro-*`. O botão de modo do painel (`data-action="toggle-theme"` → `resources/js/core/theme.js`) troca para o **equivalente da mesma família** e, em contas admin, persiste-o via `POST /theme/switch` (`ThemeController::switchTheme` grava as cores + `theme_name`). Em contas não-admin a alternância é local (CSS + `localStorage`).

**Servidor é a fonte da verdade:** o layout emite metas `theme-mode`, `active-theme` e `user-role` (`ui/partials/theme-meta.blade.php`) que o `early-theme.js` usa para aplicar o modo sem flash. Para admins, um `localStorage.theme` antigo que contradiga o servidor é limpo — evita que temas claros "desconfigurem" ao alternar.

**As cores de base vêm sempre do preset (`/theme/custom.css`):** o bloco `.dark` do `tokens.css` já **não redefine** primária/superfície/texto/bordas/tickets — esses tokens são exclusivos do preset ativo. O `.dark` limita-se ao chrome e derivados estáticos (surface-2/3, muted, shadows, `color-scheme`). Assim, um preset escuro mantém a cor da família (ex.: azul noturno com primária azul, não laranja).

## Arquitetura CSS

- `resources/css/tokens.css` — **fonte única** de todos os valores (cores, tipografia, espaço, raios, sombras, transições, métricas) + bloco `@theme inline` que faz a ponte com o Tailwind v4, para as utilities (`bg-primary`, `rounded-xl`, `shadow-md`…) resolverem para os tokens em runtime (seguem dark mode e tema personalizado).
- `resources/css/theme/variables.css` — camada de aliases semânticos (`--primary`, `--surface`, `--text`…) que referenciam os tokens; nunca define valores primários.
- Componentes semânticos: `forms.css`, `badges.css`, `navigation.css`, `sidebar.css`, `buttons/`, `cards/`, `layout.css`.
- Tintas derivadas usam `color-mix(in srgb, var(--color-primary) X%, transparent)` para seguirem o tema personalizado (nunca valores hex fixos nos componentes).
- Ficheiros legados duplicados foram fundidos no `tokens.css`/`base.css` (antigos `theme/spacing.css`, `theme/radius.css`, `theme/typography.css`, `theme/shadows.css`, `theme/semantic.css`, `base/variables.css`).

## Acessibilidade (WCAG 2.1 AA)

- `:focus-visible` global (outline 2px `--primary`); nunca `outline: none` sem substituto.
- Skip-link para o conteúdo em todos os layouts.
- Labels ligadas a inputs; erros com `role="alert"` e `aria-describedby`.
- `prefers-reduced-motion` respeitado (transições/scroll desativados).
- Validação de contraste na personalização de tema (servidor + cliente).

## Configurações do Sistema

Página de definições do sistema (admin-only, `role:admin`, `/ui/definicoes/sistema`):
- No menu admin, "Tema" (`/ui/definicoes/aparencia`) é a página de aparência e "Definições" (`/ui/definicoes/sistema`) é a página de configurações do sistema.
- Expõe uma lista **curada** de opções (`app/Services/SystemSettingsService.php`), cada uma mapeada a uma chave `config()` real com pontos (ex.: `<input name="services.custom.ai.model">`). Segredos, credenciais e drivers de infraestrutura **não** são expostos — `openai.php`/`mail.php` mantêm-se apenas como config, consumidos indiretamente pelas opções (`services.custom.ai.*`, `services.custom.notification.mailer`).
- Persistência em `system_settings` (key/value, migração `2026_08_05_000002`); `SystemSettingsService::applyOverrides()` é chamado no boot do `AppServiceProvider` e sobrepõe o repositório `config()` com os valores da BD antes de os consumidores os lerem (inclui `date_default_timezone_set` para `app.timezone`). Só aplica chaves conhecidas dos grupos; watchdog se a tabela não existir.
- **Guardar:** selects, números e interruptores guardam automaticamente no `change` (via `resources/js/pages/definicoes-sistema.js`, debounce 300ms); grupos com campos de texto mostram um botão "Guardar" que submete o grupo inteiro; cada grupo tem ainda "Repor" para apagar os overrides e voltar aos valores dos ficheiros `config/*.php`.
- Fluxo AJAX JSON (`POST ui.definicoes.sistema.update`) aceita `{updates: {chave: valor}}` ou `{reset: groupId}`, devolvendo os valores efetivos normalizados para o ecrã.
