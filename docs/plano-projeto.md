## 1. Âmbito e Objetivos Gerais

O objetivo principal deste projeto é transformar processos reativos ou manuais numa operação totalmente automatizada através de:
* **Comunicação Centralizada:** Canal direto entre quem deteta a avaria, quem a repara e quem gere a infraestrutura.
* **Inteligência Operacional:** Automatização de triagens e suporte à decisão na escala de técnicos através de IA.
* **Auditoria e Controlo:** Registo automático de *timestamps* em cada mudança de estado do ticket e dashboards interativos com métricas de tempo e custos para a Direção de Operações.

---

## 2. Divisão de Papéis da Equipa Técnica

Para simular a dinâmica de uma equipa real de desenvolvimento de software, os 4 elementos do grupo assumem focos de liderança no Trello:

* **Team Leader & Product Owner:** Gestão de projeto, planeamento, controlo de requisitos e interface pedagógica.
* **Dev-End Developer (Frontend Lead):** Construção das interfaces Blade, calendarização reativa (FullCalendar v6) e dashboards estatísticos.
* **Back-End Developer (Core Engineer):** Orquestração de rotas, middlewares de controlo de acessos (RBAC), controladores e lógica do workflow.
* **Database Administrator (DBA):** Modelação de dados no MySQL, desenho do DER, indexação e execução física via Laravel Migrations.

---

## 3. Cronograma de Desenvolvimento (Estrutura de Sprints)

O projeto foi planeado num ciclo de **4 Sprints Semanais** para garantir entregas incrementais e estáveis:

### Sprint 1: Engenharia de Requisitos e Modelação de Dados
* Levantamento completo de Requisitos Funcionais (RF) e Não-Funcionais (RNF).
* Desenho e fecho do Diagrama Entidade-Relacionamento (DER) ajustado ao modelo *In-House*.
* Configuração do repositório Git e criação do quadro de tarefas no Trello.
* Execução física do banco de dados no MySQL usando **Laravel Migrations**.

### Sprint 2: Core do Workflow e Matriz de Autenticação
* Implementação do sistema de autenticação e proteção de rotas com base em perfis (RBAC).
* Criação da lógica de transição obrigatória dos 3 estados do ticket (*Aberto ➔ Em Curso ➔ Fechada*) com registo automático de timestamps.
* Criação dos ecrãs de submissão detalhada de avarias para os funcionários e painel de triagem para técnicos.

### Sprint 3: Layer de Inteligência Artificial e Agenda Operacional
* Injeção do `AIService` no controlador central (`TicketController`).
* Lógica algorítmica para recomendação assistida de técnicos e diagnósticos prescritivos baseados no histórico do equipamento.
* Construção do ecrã visual da **Agenda** integrando o **FullCalendar v6** para leitura de eventos agendados em tempo real a partir do MySQL.

### Sprint 4: Painel Analítico, Automação de Ativos e Fecho
* Desenvolvimento do Dashboard do Administrador com métricas operacionais (MTTR) e custos.

* Implementação de um Background Service (rotina em segundo plano via Laravel Task Scheduling) para monitorização e leitura da Telemetria simulada dos equipamentos.

* Execução do Plano de Testes (validação de fluxos e eliminação de Erros 500) e compilação do manual de utilizador.

---

## 4. Matriz de Riscos e Mitigação Operacional

| Risco Identificado | Impacto | Estratégia de Mitigação Técnica |
| :--- | :---: | :--- |
| **Erros de Integridade de Dados** (Ex: eliminar uma sala com equipamentos associados) | Alto | Configuração rigorosa de chaves estrangeiras com restrição de eliminação (`onDelete('restrict')`) no MySQL. |
| **Falha de Sessão / Token Expirado** (Avisos de autenticação em requisições AJAX do calendário) | Médio | Implementação de fallbacks silenciosos e tratamentos de erros em JavaScript para garantir resiliência visual na Agenda. |
| **Gargalo Administrativo** (Erros manuais de triagem na classificação de avarias) | Alto | Automação na triagem inicial de severidade e categoria utilizando Processamento de Linguagem Natural (NLP) no momento da abertura do ticket. 