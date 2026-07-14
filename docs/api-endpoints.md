
# API Endpoints & Documentação Interativa

A documentação interativa completa (onde podes testar os parâmetros e ver as respostas JSON) está disponível localmente na rota pública:
 `http://localhost:8000/api/documentation` (Interface Swagger UI).

### 1. Autenticação & Gestão de Perfil
| Método | Endpoint | Proteção | Descrição / Comportamento |
| :--- | :--- | :--- | :--- |
| **POST** | `/api/register` | `guest` | Cria uma conta. Estado inicial: 'Funcionário'. |
| **POST** | `/api/login` | `guest` | Valida credenciais e injeta o Cookie/Token de Autenticação. |
| **POST** | `/api/logout` | `auth` | Destrói a sessão, invalida o token e limpa os cookies de forma segura. |
| **PUT** | `/api/user/password` | `auth` | Altera autonomamente a palavra-passe do utilizador autenticado. |

### 2. Fluxo de Tickets, Fotos e Comentários (Operacional)
Todos os endpoints de listagem (`GET`) suportam agora parâmetros de **pesquisa e filtros avançados** (ex: `?search=motor&status=em_curso&sala_id=5`).

| Método | Endpoint | Permissão Exigida | Regras de Negócio & Efeitos |
| :--- | :--- | :--- | :--- |
| **POST** | `/api/tickets` | `role:funcionario` | **Criar Ticket:** Valida campos, associa `Auth::id()`, permite **upload de fotos** e define estado como 'Aberta'. |
| **GET** | `/api/tickets/my` | `role:funcionario` | **Painel do Funcionário:** Retorna as suas avarias ativas e o histórico completo de tickets fechados com filtros. |
| **PUT** | `/api/tickets/{id}/cancel` | `role:funcionario` | **Cancelar Ticket:** Anula se estiver 'Aberto'. Se estiver em curso, bloqueia (403). |
| **GET** | `/api/technician/tickets/open` | `role:technician,admin`| **Fila Global:** Lista todas as avarias abertas ou preventivas prontas para triagem com filtros avançados. |
| **GET** | `/api/technician/tickets/assigned`| `role:technician` | **Os Meus Tickets:** Lista as avarias sob a responsabilidade do técnico autenticado. |
| **GET** | `/api/tickets/{id}` | `role:technician,admin`| **Detalhe Contextualizado:** Retorna o ticket, as fotos anexadas, a árvore de comentários e as últimas 3 intervenções daquela máquina. |
| **POST** | `/api/tickets/{id}/comments` | `auth` | **Sistema de Comentários:** Adiciona uma mensagem ao ticket. Dispara notificação instantânea para a contraparte. |
| **POST** | `/api/tickets/{id}/photos` | `auth` | **Upload de Fotos:** Permite anexar fotografias adicionais de evidências ao longo do ciclo de vida do ticket. |
| **PUT** | `/api/technician/tickets/{id}/start` | `role:technician` | **Iniciar Reparação:** Transita para 'Em Curso', injeta `in_progress_at` e avisa o utilizador em tempo real. |
| **PUT** | `/api/technician/tickets/{id}/request-budget`| `role:technician` | **Solicitar Orçamento:** Move para 'Pendente de Orçamento', exige valores e **suspende o SLA**. Alerta o Admin. |
| **PUT** | `/api/technician/tickets/{id}/close` | `role:technician` | **Encerrar Intervenção:** Move para 'Fechada'. Exige relatório e horas. Grava `closed_at`, calcula MTTR e envia e-mail com PDF. |

### 3. Administração, Backoffice & Relatórios
| Método | Endpoint | Proteção | Descrição / Ações Estruturais |
| :--- | :--- | :--- | :--- |
| **PATCH**| `/api/admin/tickets/{id}/budget` | `role:admin` | **Decidir Orçamento:** Aprova (SLA reativa, volta a 'Em Curso') ou Rejeita (encerra o processo com feedback). |
| **POST** | `/api/admin/preventive` | `role:admin` | **Manutenção Preventiva:** Agenda e injeta uma ordem proativa diretamente na fila dos técnicos. |
| **GET** | `/api/admin/analytics` | `role:admin` | **Dashboard Analítico:** Retorna os dados agregados para os **gráficos** (MTTR, MTBF, custos e desempenho). |
| **GET** | `/api/admin/audit-logs` | `role:admin` | **Audit Log:** Retorna o histórico completo e imutável de logs e alterações efetuadas em qualquer tabela do sistema. |
| **GET** | `/api/admin/reports/export` | `role:admin` | **Exportação de Relatórios:** Gera e descarrega ficheiros consolidados em formato **Excel (.xlsx)** ou **PDF** com base em filtros. |
| **CRUD** | `/api/admin/users/*` | `role:admin` | **Gestão de Pessoal:** Controlo total sobre criação, atualização de perfis e inativação de contas de colaboradores. |
| **CRUD** | `/api/admin/assets/*` | `role:admin` | **Gestão de Inventário:** Controlo total (Filtros, Criar, Editar, Soft Delete) de Equipamentos, Salas e Categorias. |
