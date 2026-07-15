## 1. Âmbito e Objetivos Gerais

O objetivo principal deste projeto é transformar processos reativos ou manuais numa operação industrial totalmente otimizada e integrada através de:
* **Comunicação Centralizada e Omnicanal:** Canal direto e reativo entre quem deteta a avaria (Operário), quem a repara (Técnico) e quem gere a infraestrutura (Administrador), permitindo que qualquer perfil autenticado reporte falhas em campo.
* **Inteligência Operacional Assistida (SAD):** Integração do motor `AIService` (OpenAI `gpt-4o-mini`) como um Sistema de Apoio à Decisão para triagem categórica automática por NLP e recomendação analítica de alocação de técnicos com base em especialidades e volume de carga de trabalho.
* **Segurança, Auditoria e Controlo:** Remoção do auto-registo público de utilizadores para blindagem da infraestrutura corporativa. Registo automático de *timestamps* invioláveis pelo servidor (`NOW()`) em cada mudança de estado do ticket, armazenamento de logs em JSON com os estados modificados (`old_values` e `new_values`) e dashboards reativos via WebSockets para monitorização de custos e KPIs da Direção.

---

## 2. Divisão de Papéis da Equipa Técnica

Para simular a dinâmica de uma equipa real de desenvolvimento de software, os 4 elementos do grupo assumem focos de liderança no Trello:

* **Team Leader & Product Owner:** Gestão de projeto, planeamento ágil (Sprints), controlo de requisitos, versionamento semântico no Git e interface pedagógica.
* **Dev-End Developer (Frontend Lead):** Construção das interfaces responsivas em Blade, compilação de assets via Vite, calendarização na Agenda (FullCalendar v6) e componentes reativos de gráficos (Chart.js).
* **Back-End Developer (Core Engineer):** Orquestração das rotas de API/Web, isolamento de permissões via middlewares de controlo de acessos baseado em perfis (RBAC), controladores refinados e injeção do serviço de Inteligência Artificial.
* **Database Administrator (DBA):** Modelação de dados relacional no MySQL, desenho do DER, indexação avançada de chaves para performance de queries complexas e execução física via Laravel Migrations.

---

## 3. Cronograma de Desenvolvimento (Estrutura de Sprints)

O projeto foi planeado num ciclo de **4 Sprints Semanais** para garantir entregas incrementais e estáveis:

### Sprint 1: Engenharia de Requisitos e Modelação de Dados
* Levantamento completo de Requisitos Funcionais (RF) e Não-Funcionais (RNF).
* Desenho e fecho do Diagrama Entidade-Relacionamento (DER) ajustado ao modelo *In-House* departamental.
* Configuração do repositório Git corporativo e criação do quadro de tarefas no Trello (Product Backlog e Sprint Backlog).
* Execução física da base de dados relacional no MySQL usando **Laravel Migrations**.

### Sprint 2: Core do Workflow, Rotas Globais e Segurança RBAC
* Implementação do sistema de autenticação customizado e proteção de rotas com base em middlewares de perfis (`role:user,technician,admin`).
* **Blindagem de Identity:** Remoção do endpoint público `/register` e implementação da criação restrita de utilizadores no Backoffice do Administrador (`/admin/users/register`).
* **Fluxo Global In-House:** Criação da lógica de abertura de tickets omnicanal (`POST /tickets`), permitindo o registo detalhado de avarias por qualquer colaborador autenticado em campo.
* Desenvolvimento da transição de estados dos tickets com registo automático de carimbos temporais no servidor.

### Sprint 3: Layer de Inteligência Artificial e Agenda Operacional
* Injeção de dependência e desacoplamento do `AIService` no controlador central (`TicketController`).
* Construção do prompt contextualizado em português (NLP) para classificação automática e sugestão fundamentada do mecânico ideal com menor volumetria de tarefas ativas.
* Integração da interface visual da **Agenda** utilizando o **FullCalendar v6** para leitura dinâmica e síncrona de ordens de trabalho agendadas a partir do MySQL.

### Sprint 4: Painel Analítico Reativo, Relatórios e Fecho
* Desenvolvimento do Dashboard de Gestão do Administrador com gráficos analíticos reativos (`Chart.js`) alimentados em tempo real via eventos de transmissão (`[Broadcast]` via WebSockets) no fecho das intervenções.
* Implementação do módulo de carregamento de evidências fotográficas (`Storage`) e comentários operacionais com restrições lógicas por utilizador.
* Execução do Plano de Testes global (validação de concorrência, mitigação de erros de variáveis no servidor e tratamento de exceções na API) e compilação do manual técnico do utilizador.

---

## 4. Matriz de Riscos e Mitigação Operacional

| Risco Identificado | Impacto | Estratégia de Mitigação Técnica |
| :--- | :---: | :--- |
| **Erros de Integridade de Dados** (Ex: eliminar uma sala ou categoria com equipamentos ativamente vinculados) | Alto | Configuração rigorosa de chaves estrangeiras com restrição de eliminação física (`onDelete('restrict')` ou `nullOnDelete()`) nas migrations do MySQL. |
| **Elevação de Privilégios ou Contas Fantasma** (Ex: criação descontrolada de perfis administrativos por utilizadores externos) | Alto | **Auto-registo desativado.** Eliminação de rotas de registo públicas e isolamento do controlador de criação de identidade estritamente atrás do middleware de barramento do Administrador. |
| **Falha de Sessão / Token Expirado** (Avisos de autenticação em requisições AJAX do calendário ou submissão de formulários) | Médio | Tratamento de exceções HTTP nos controladores do Laravel e isenção controlada de CSRF em rotas de API específicas (`withoutMiddleware`), garantindo resiliência visual e fallbacks limpos. |
| **Gargalo Administrativo na Distribuição de Tarefas** (Erros humanos ou atrasos na alocação manual de incidentes na fábrica) | Alto | **Módulo de Decisão por IA.** Triagem assistida no `AIService`, que tritura o texto livre e automatiza a recomendação do técnico ideal, reduzindo o tempo médio de resposta (SLA) através de um despacho em 1 clique. |