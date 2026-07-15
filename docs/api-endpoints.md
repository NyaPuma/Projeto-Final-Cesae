# API Endpoints & Documentação Interativa

A documentação interativa completa (onde podes testar os parâmetros e ver as respostas JSON) está disponível localmente na rota pública:
 `http://localhost:8000/api/documentation` (Interface Swagger UI).

### 1. Autenticação & Gestão de Perfil
| Método | Endpoint | Proteção | Descrição / Comportamento |
| :--- | :--- | :--- | :--- |
| **POST** | `/api/login` | `guest` | Valida credenciais e injeta o Cookie/Token de Autenticação. |
| **POST** | `/api/logout` | `auth` | Destrói a sessão, invalida o token e limpa os cookies de forma segura. |
| **POST** | `/api/password/change` | `auth` | Altera autonomamente a palavra-passe do utilizador autenticado. |
| **POST** | `/api/profile/update` | `auth` | Atualiza os dados cadastrais de perfil do utilizador autenticado. |

### 2. Fluxo de Tickets, Fotos e Comentários (Operacional)
Todos os endpoints de listagem (`GET`) suportam parâmetros de **pesquisa e filtros avançados** (ex: `?search=motor&status=em_curso&sala_id=5`).

| Método | Endpoint | Permissão Exigida | Regras de Negócio & Efeitos |
| :--- | :--- | :--- | :--- |
| **POST** | `/api/tickets` | `auth` | **Criar Ticket (Fluxo Global In-House):** Permite que qualquer utilizador logado (Operário, Técnico ou Admin) abra avarias. Associa `Auth::id()` e define o estado como 'Aberto'. |
| **GET** | `/api/tickets` | `auth` | **Listagem Geral:** Retorna os tickets e avarias ativas com paginação e suporte a filtros de busca. |
| **GET** | `/api/tickets/{id}` | `auth` | **Detalhe Contextualizado:** Retorna os dados puros do ticket, trazendo os relacionamentos (`equipment.category`, `room`, `user`) e injetando a sugestão em tempo real do `AIService`. |
| **POST** | `/api/tickets/{id}/cancel` | `role:user` | **Cancelar Ticket:** Permite ao operário anular o ticket criado por si, desde que este permaneça com o estado 'Aberto'. |
| **GET** | `/api/technician/tickets/open` | `role:technician,admin`| **Fila Global:** Lista todas as avarias em estado aberto prontas para triagem e atribuição técnica. |
| **PUT** | `/api/technician/tickets/{id}/start` | `role:technician` | **Iniciar Reparação:** Transita o estado do ticket para 'Em Curso', injeta a timestamp `in_progress_at` via servidor e dispara o Broadcast. |
| **PUT** | `/api/technician/tickets/{id}/close` | `role:technician` | **Encerrar Intervenção:** Move o estado para 'Fechado', exigindo o relatório técnico, registo de minutos gastos e custos de peças do stock interno. |
| **POST** | `/api/tickets/{id}/comments` | `auth` | **Sistema de Comentários:** Adiciona uma mensagem ao ticket. Operários apenas comentam os seus próprios tickets; Técnicos e Admins comentam globalmente. |
| **GET** | `/api/tickets/{id}/comments` | `role:technician,admin`| **Histórico de Diálogo:** Lista a árvore completa de comentários e notas técnicas associadas ao ticket. |
| **POST** | `/api/tickets/{id}/photos` | `auth` | **Upload de Fotos:** Permite anexar ficheiros de imagem como evidências visuais do problema ou da resolução na fábrica. |
| **GET** | `/api/tickets/{id}/photos` | `auth` | **Galeria de Evidências:** Retorna os metadados e URLs dos anexos multimédia carregados no âmbito do ticket. |

### 3. Administração, Backoffice, IA & Relatórios
| Método | Endpoint | Proteção | Descrição / Ações Estruturais |
| :--- | :--- | :--- | :--- |
| **POST** | `/api/admin/users/register` | `role:admin` | **Registo Restrito (Segurança Blindada):** Endpoint exclusivo do Administrador para criar e cadastrar novos utilizadores e funcionários na empresa. |
| **PATCH** | `/api/admin/tickets/{id}/atribuir` | `role:admin` | **Despacho Assistido por IA:** Grava de forma definitiva a alocação do técnico sugerido pelo motor NLP do `AIService` ou selecionado manualmente. |
| **PATCH**| `/api/admin/tickets/{id}/approve-budget` | `role:admin` | **Decidir Orçamento:** Analisa e aprova a requisição orçamental enviada por um técnico para intervenções de alto custo. |
| **POST** | `/api/admin/preventive` | `role:admin` | **Manutenção Preventiva:** Agenda e injeta uma ordem de trabalho planeada diretamente na fila operacional dos técnicos. |
| **GET** | `/api/admin/users` | `role:admin` | **Consulta de Funcionários:** Lista todos os colaboradores registados na plataforma para fins de gestão de recursos humanos. |
| **PATCH**| `/api/admin/users/{id}/inactive` | `role:admin` | **Inativação de Contas:** Revoga o acesso à plataforma alterando logicamente o estado do utilizador para inativo. |
| **GET** | `/api/admin/audits` | `role:admin` | **Logs de Auditoria:** Retorna o rasto imutável e estruturado em JSON com as alterações (`old_values` e `new_values`) efetuadas no sistema. |
| **CRUD** | `/api/admin/rooms/*` | `role:admin` | **Gestão de Infraestrutura:** Cria, atualiza e inativa a árvore de salas, pavilhões e localizações físicas da fábrica. |
| **CRUD** | `/api/admin/equipment/*` | `role:admin` | **Gestão de Inventário:** Controlo completo sobre o cadastro de ativos, números de série, marcas e categorias de equipamentos. |
| **GET** | `/api/analytics/*` | `role:technician,admin`| **Módulo Analítico:** Consome as estatísticas agregadas e barramentos de dados para renderização dos gráficos de KPI e MTTR. |