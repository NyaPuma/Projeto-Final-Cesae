# Análise de Processos: Mapeamento As-Is vs To-Be

Este documento descreve a transição operacional entre o modelo de gestão reativo tradicional (manual) e o novo fluxo automatizado inteligente implementado na plataforma.

---

## 1. O Processo Atual: Mapeamento "As-Is" (O Problema)
No cenário analógico ou semi-digitalizado atual, o fluxo de correção de uma avaria é fragmentado e ineficiente:

* **Deteção Reativa:** Um equipamento crítico falha (ex: uma máquina para por sobreaquecimento). O operário da sala pode demorar minutos ou horas a notar a quebra de rendimento.
* **Reporte Disperso:** O operário tenta contactar a manutenção enviando um e-mail, telefonando ou deixando uma nota em papel. A informação perde-se frequentemente ou chega sem detalhes técnicos (ex: "a máquina não liga").
* **Triagem Manual:** O Diretor de Operações recebe o alerta de forma informal. Precisa de consultar manualmente quais os técnicos que dominam aquela especialidade e quem tem menos trabalho acumulado na semana para efetuar o despacho.
* **Diagnóstico às Cegas:** O técnico desloca-se ao local para perceber o problema. Descobre que precisa de uma peça específica, regressa ao armazém para validar o stock e, se for de alto custo, tem de procurar o administrador para pedir autorização verbal.
* **Fecho Indocumentado:** Após a reparação, os tempos de paragem e os custos associados não são registados ou ficam guardados numa folha de Excel isolada, impedindo qualquer análise estatística futura.
* **Vulnerabilidade de Identidade:** O sistema anterior ou os processos manuais não isolavam o registo de utilizadores, permitindo falhas na elevação de privilégios ou o auto-registo descontrolado de acessos à infraestrutura interna da organização.

---

## 2. O Processo Proposto: Mapeamento "To-Be" (A Solução)
Com a introdução da plataforma integrada em PHP Laravel e persistência relacional em MySQL, o fluxo transforma-se numa operação otimizada, segura e inteligente:

### Fluxo de Abertura Omnicanal, Leitura Física por QR Code e Triagem Assistida
* **Autonomia de Submissão Direta e via QR Code:** Qualquer utilizador devidamente autenticado na plataforma (seja Operário, Técnico ou Administrador) pode submeter um ticket de avaria imediatamente após detetar uma falha no terreno (`POST /tickets`). Adicionalmente, através da nova funcionalidade de **etiquetagem física por QR Code** afixada nas máquinas e salas, a leitura imediata com dispositivo móvel abre automaticamente o formulário pré-preenchido para o ativo correspondente (`/ui/tickets/create?equipment_id=...`).

* **Triagem e Alocação Inteligente (Módulo SAD Exclusivo do Admin):** Ao aceder ao detalhe da ocorrência no Backoffice, o Administrador é apoiado pelo Assistente de Alocação IA (`AIService` alimentado pelo modelo `gpt-4o-mini`). O motor analisa o texto livre da avaria por Processamento de Linguagem Natural (NLP), cruza a categoria do problema com as especialidades dos técnicos ativos e avalia a respetiva carga de trabalho atual. A IA exibe a sugestão do técnico ideal com uma justificação operacional fundamentada.

* **Despacho em 1 Clique:** O Administrador valida a recomendação da IA (ou faz uma seleção manual alternativa) e efetua o despacho oficial com 1 clique (`PATCH /admin/tickets/{id}/atribuir`), transitando o estado da avaria e vinculando o técnico no MySQL.

* **Segurança e Identidade Blindadas:** O auto-registo público foi totalmente eliminado (`/register` desativado). A criação de utilizadores e atribuição de perfis (*Roles*) é um processo estritamente restrito e centralizado no Backoffice do Administrador através da rota protegida `/admin/users/register`.

### Fluxo de Resolução, Onboarding Contextual e Monitorização de KPIs
* **Onboarding e Guia por Perfil:** A plataforma integra um **Centro de Ajuda Dinâmico** acessível diretamente na barra superior (`layout.blade.php`), adaptando guias operacionais visuais de acordo com o perfil autenticado (Administrador, Técnico ou Utilizador).
* **Diagnóstico Prescritivo no Terreno:** O Técnico assume o ticket na sua área exclusiva, movendo o estado para "Em Curso" com carimbo de tempo inviolável capturado pelo relógio do servidor (`NOW()`). 
* **Encerramento Estruturado e Roadmap de Inovação:** Ao concluir a intervenção física, o técnico insere o tempo despendido, os custos e a nota de fecho. A visão estratégica de longo prazo encontra-se mapeada no novo módulo de **Roadmap (`/ui/roadmap`)**, antecipando as próximas evoluções arquiteturais (v2.1 a v2.4): Manutenção Preventiva Recorrente, Gestão de Stock de Peças, Inquéritos CSAT e Base de Conhecimento com IA.
* **Reatividade em Tempo Real:** O encerramento do ticket dispara eventos síncronos de transmissão (`[Broadcast]` via WebSockets). Sem necessidade de refrescar a página, o painel do Administrador recalcula as médias cronológicas de paragem de ativos industriais e atualiza reativamente os gráficos analíticos (`Chart.js`).

---

## 3. Tabela Comparativa de Impacto Operacional

| Dimensão Analisada | Cenário Atual (As-Is) | Cenário Futuro (To-Be) |
| :--- | :--- | :--- |
| **Gestão de Identidade** | Acesso aberto ou descontrolado; riscos de elevação de privilégios. | **Apenas o Administrador** pode registar novos funcionários na empresa via Backoffice restrito. |
| **Abertura de Incidentes** | Dispersa (e-mail, papel), lenta e restrita a processos burocráticos. | **Omnicanal, global e via QR Code físico** (leitura direta em máquinas e salas). |
| **Triagem de Avarias** | Manual, tardia e sujeita a erros humanos de categorização. | **Assistida por IA** através de Processamento de Linguagem Natural (NLP) e tags automáticas. |
| **Alocação de Técnicos** | Subjetiva, baseada no instinto ou em consultas demoradas. | **Otimizada por IA** (`AIService`), cruzando competências e volumetria de carga de trabalho atual. |
| **Suporte ao Utilizador** | Inexistente ou documentação estática desatualizada. | **Guia Rápido Dinâmico por Perfil** integrado diretamente na interface da plataforma. |
| **Auditoria e Métricas** | Inexistente. Perda de dados históricos de custos e de tempos. | **Imutável**. Logs globais de auditoria, carimbos do servidor e dashboards reativos. |