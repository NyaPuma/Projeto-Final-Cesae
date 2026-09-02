# API Endpoints & Documentacao Interativa

A documentacao interativa completa (onde podes inspecionar schemas, testar parametros e verificar as respostas JSON da API) encontra-se estritamente restrita ao perfil **Developer / Integrador** atraves da rota protegida:
`http://localhost:8000/docs/openapi` (Interface Swagger UI com schema JSON em `/docs/openapi.json`).

---

### 1. Documentacao & Ferramentas de Integracao API (Developer)
| Metodo | Endpoint | Permissao Exigida | Descricao / Regras de Acesso |
| :--- | :--- | :--- | :--- |
| **GET** | `/docs/openapi` | `role:developer` | **Interface Swagger UI:** Acesso reservado e protegido via middleware ao explorador grafico de endpoints e contratos da API. |
| **GET** | `/docs/openapi.json` | `role:developer` | **Schema OpenAPI 3.0:** Retorna a especificacao estruturada da API em formato JSON para importacao e testes externos. |

---

### 2. Autenticacao & Gestao de Perfil
| Metodo | Endpoint | Protecao | Descricao / Comportamento |
| :--- | :--- | :--- | :--- |
| **POST** | `/login` | `guest` | Valida credenciais (com rate limit) e injeta o Cookie/Token de Autenticacao (`api_token`). |
| **POST** | `/logout` | `custom.auth` | Destroi a sessao, invalida o token e limpa os cookies de forma segura. |
| **POST** | `/password/change` | `custom.auth` | Altera autonomamente a palavra-passe do utilizador autenticado com hash Bcrypt. |
| **POST** | `/profile/update` | `custom.auth` | Atualiza os dados cadastrais de perfil do utilizador autenticado. |

---

### 3. Fluxo de Tickets, Fotos e Comentarios (Operacional)
Todos os endpoints de listagem (`GET`) suportam parametros de **pesquisa e filtros avancados** (ex: `?search=motor&status=em_curso&sala_id=5`).

| Metodo | Endpoint | Permissao Exigida | Regras de Negocio & Efeitos |
| :--- | :--- | :--- | :--- |
| **POST** | `/tickets` | `custom.auth` | **Criar Ticket (Fluxo Global In-House):** Permite a abertura de avarias por qualquer utilizador autenticado com perfil associado (Operario, Tecnico ou Admin). Suporta parametros de QR Code (`?equipment_id=...` ou `?room_id=...`). |
| **GET** | `/tickets` | `custom.auth` | **Listagem Geral:** Retorna os tickets e avarias com paginacao e suporte a filtros avancados. |
| **GET** | `/tickets/my` | `custom.auth` | **Tickets Pessoais:** Retorna o historico de avarias registadas pelo utilizador com a sessao ativa. |
| **GET** | `/tickets/{id}` | `custom.auth` | **Detalhe Contextualizado:** Retorna os dados do ticket, relacionamentos (`equipment`, `room`, `user`, `assignedUser`) e recomendacao operacional do `AIService` quando consultado por perfis com permissao de despacho. |
| **POST** | `/tickets/{id}/cancel` | `custom.auth` | **Cancelar Ticket:** Permite ao criador anular a avaria submetida por si, desde que esta ainda se encontre no estado inicial "Aberto". |
| **GET** | `/technician/tickets/open` | `role:admin` | **Fila de Avarias Livres:** Lista todas as avarias em estado aberto disponiveis para despacho administrativo ou alocacao. |
| **POST/PUT**| `/technician/tickets/{id}/start` | `role:technician,admin` | **Iniciar Reparacao:** Transita o estado do ticket para "Em Curso", associa o tecnico e regista o carimbo de data/hora no servidor (`in_progress_at`). |
| **POST/PUT**| `/technician/tickets/{id}/close` | `role:technician,admin` | **Encerrar Intervencao:** Conclui o ticket ("Fechado"), exigindo relatorio tecnico, minutos gastos e custos reais apurados. |
| **POST/PUT**| `/technician/tickets/{id}/request-budget` | `role:technician,admin` | **Requisicao Orcamental:** Move o ticket para "Pendente de Orcamento", suspende o SLA e anexa a justificacao financeira para analise. |
| **POST** | `/tickets/{id}/submit-budget` | `custom.auth` | **Submissao de Estimativa:** Envia a discriminacao orcamental detalhada do tecnico com mao de obra e materiais. |
| **POST** | `/tickets/{id}/comments` | `custom.auth` | **Sistema de Comentarios:** Adiciona mensagem ao ticket. Operadores interagem nos seus proprios tickets; Tecnicos e Admins interagem globalmente. |
| **GET** | `/tickets/{id}/comments` | `custom.auth` | **Historico de Dialogo:** Lista o historico de comunicacoes e notas tecnicas associadas a ocorrencia. |
| **POST** | `/tickets/{id}/photos` | `custom.auth` | **Upload de Evidencias:** Permite anexar ficheiros de imagem (multipart/form-data) documentando a avaria ou a intervencao. |
| **GET** | `/tickets/{id}/photos` | `custom.auth` | **Galeria de Evidencias:** Retorna a listagem estruturada de anexos fotograficos vinculados ao ticket. |
| **DELETE** | `/tickets/{id}/photos/{photoId}` | `custom.auth` | **Eliminar Evidencia:** Remove o registo e o ficheiro fisico da fotografia associada. |
| **POST** | `/tickets/{id}/release` | `custom.auth` | **Libertar Ticket:** Remove o vinculo do tecnico e devolve o ticket ao estado "Aberto" (bloqueado para criticidade Critica). |
| **POST** | `/tickets/{id}/reopen` | `custom.auth` | **Reabrir Ticket:** Reativa um ticket previamente encerrado para nova intervencao. |

---

### 4. Administracao, Backoffice, IA & Relatorios
| Metodo | Endpoint | Protecao | Descricao / Acoes Estruturais |
| :--- | :--- | :--- | :--- |
| **POST** | `/admin/users/register` | `role:admin` | **Registo Centralizado:** Criacao exclusiva de colaboradores e atribuicao de perfis corporativos (`admin`, `technician`, `user`, `developer`) com o auto-registo publico desativado. |
| **PATCH/POST**| `/admin/tickets/{id}/assign` | `role:admin` | **Despacho Assistido / Manual:** Atribui formalmente o tecnico responsavel por decisao manual ou com 1 clique atraves da recomendacao do motor de IA (`AIService`). |
| **POST/PATCH**| `/admin/tickets/{id}/budget-decision` | `role:admin` | **Validacao Orcamental:** Analisa, aprova ou rejeita a requisicao orcamental enviada pela equipa tecnica para libertacao da intervencao. |
| **GET** | `/admin/budgets/data` | `role:admin` | **Painel de Orcamentos:** Retorna os dados consolidados de orcamentos pendentes e aprovados com filtros operacionais. |
| **POST** | `/admin/preventive` | `role:admin` | **Manutencao Preventiva:** Agenda e injeta ordens de trabalho planeadas diretamente na calendarizacao tecnica. |
| **GET** | `/admin/users` | `role:admin` | **Gestao de Contas:** Lista todos os utilizadores registados e respetivos perfis para administracao de acessos. |
| **POST** | `/admin/users` | `role:admin` | **Criar Utilizador (Admin):** Endpoint complementar para persistir novas contas a partir do painel. |
| **MATCH** | `/admin/users/{id}` | `role:admin` | **Atualizacao de Utilizador:** Altera credenciais, dados cadastrais e avatar (aceita POST, PUT e PATCH). |
| **PATCH** | `/admin/users/{id}/inactive` | `role:admin` | **Inativacao de Contas:** Revoga o acesso a plataforma alterando logicamente o estado do utilizador para inativo. |
| **GET** | `/admin/audits` | `role:admin` | **Logs de Auditoria:** Retorna o rasto imutavel estruturado em JSON com as operacoes (`old_values` e `new_values`) efetuadas no sistema. |
| **CRUD** | `/admin/rooms/*` e `/api/rooms/*` | `role:admin` | **Gestao de Infraestrutura:** Cria, atualiza, inativa e lista as salas, pavilhoes e localizacoes fisicas da instalacao. |
| **CRUD** | `/admin/equipment/*` e `/equipments/*` | `role:admin` | **Gestao de Inventario:** Controlo integral de criacao, edicao, detalhe e remocao de ativos tecnicos, codigos e categorias. |
| **GET** | `/analytics` e `/analytics/*` | `role:admin` | **Modulo Analitico:** Consome estatisticas agregadas (MTTR, MTBF, distribuicao de ocorrencias) e exportacoes em CSV, PDF e Excel. |

---

### 5. Notificacoes & Servicos de Suporte
| Metodo | Endpoint | Protecao | Descricao / Regras de Negocio |
| :--- | :--- | :--- | :--- |
| **GET** | `/notifications` | `custom.auth` | Retorna o lote das ultimas notificacoes do utilizador autenticado (aprovacoes, comentarios e mudancas de estado). |
| **PATCH** | `/notifications/{id}` | `custom.auth` | Marca uma notificacao especifica como lida (`read_at`). |
| **POST** | `/notifications/test-email`| `custom.auth` | Despacha e-mail de verificacao de conectividade SMTP. |
| **GET** | `/calendar/events` | `custom.auth` | Fornece eventos de manutencao agendados em formato compativil com calendarios dinamicos (FullCalendar). |
| **GET** | `/lang/{locale}` | `guest` | Rota publica para alternancia de idioma da interface entre Portugues (`pt`) e Ingles (`en`). |
| **GET** | `/ui/roadmap` | `custom.auth` | Visualizacao do plano estrategico de futuras versoes e inovacoes da plataforma. |