# 🧪 Plano de Testes: Sistema Integrado de Gestão de Manutenção

**Objetivo:** Validar a integridade dos fluxos de dados (MySQL), restrições de segurança (RBAC), lógica do motor de IA (SAD) e processamento de exceções da telemetria em tempo real. Este documento serve como guião para a fase de *Quality Assurance* (QA) da equipa.

---

## 1. Matriz de Testes de Autenticação e Perfis (RBAC)
*Objetivo: Garantir o isolamento absoluto de rotas e permissões de acordo com o perfil autenticado.*

* **CT01: Validação de Bloqueio de Segurança (Utilizador Comum)**
    * **Cenário:** Um funcionário autenticado tenta aceder manualmente via URL à rota de backoffice `/api/admin/analytics` ou `/api/admin/audit-logs`.
    * **Resultado Esperado:** O Middleware intercepta a requisição, nega o acesso de imediato e retorna o código HTTP `403 Forbidden` (Acesso Negado), protegendo os dados sensíveis da administração.
* **CT02: Persistência e Alteração de Password**
    * **Cenário:** O utilizador solicita a alteração das suas credenciais no perfil.
    * **Resultado Esperado:** O controlador processa a nova string, aplica o algoritmo de *hashing* (Bcrypt) e atualiza o campo imutável no MySQL com sucesso. O token de sessão antigo é invalidado.

---

## 2. Matriz de Testes do Workflow do Ticket (Core Business)
*Objetivo: Garantir que o ciclo de vida do incidente segue as regras estritas de negócio sem falhas lógicas.*

* **CT03: Transição de Estado e Captura de SLA**
    * **Cenário:** O Técnico clica no botão "Iniciar Reparação" no painel global.
    * **Resultado Esperado:** O estado do ticket muda de `Aberta` para `Em Curso`, o ID do técnico fica vinculado permanentemente ao registo, e o campo de base de dados `in_progress_at` captura o *timestamp* exato para cálculo futuro do SLA.
* **CT04: Bloqueio Condicional de Cancelamento**
    * **Cenário:** O funcionário que abriu o ticket tenta cancelá-lo, mas o ticket já foi assumido por um técnico (Estado: *Em Curso*).
    * **Resultado Esperado:** A interface omite o botão de cancelamento. Caso o utilizador tente forçar o pedido via API/Postman, o Back-End bloqueia a operação, preservando o histórico da manutenção.
* **CT05: Encerramento Obrigatório com Dados de Custos**
    * **Cenário:** O Técnico tenta submeter o encerramento de um ticket (mudar para *Fechada*) deixando o campo do relatório técnico ou as horas de mão de obra em branco.
    * **Resultado Esperado:** O *Form Request* do Laravel falha na validação, impede a gravação na base de dados (`rollback`), e devolve mensagens de erro amigáveis ao utilizador exigindo os campos em falta.

---

## 3. Matriz de Testes de Automação e Inteligência Artificial (SAD)
*Objetivo: Validar a camada inteligente de dados, integrações e o processamento em tempo real.*

* **CT06: Triagem por Exceção (Telemetria em Tempo Real)**
    * **Cenário:** O serviço em segundo plano (Task Scheduling) analisa o fluxo de telemetria e deteta uma leitura de temperatura acima dos 80°C (limite crítico).
    * **Resultado Esperado:** O sistema injeta automaticamente uma avaria preventiva na tabela do MySQL e atualiza a agenda técnica no Front-End via WebSockets (Pusher) em tempo real, **sem** gravar logs intermédios de leituras normais na base de dados (Gestão por Exceção).
* **CT07: Recomendação Assistida de Técnicos (Motor de IA)**
    * **Cenário:** O Administrador abre o detalhe de um ticket recém-criado para efetuar triagem manual.
    * **Resultado Esperado:** O `AIService` é invocado com sucesso, cruza a categoria da avaria com a matriz de especialidades e a carga atual dos técnicos, e imprime no ecrã a sugestão fundamentada do profissional ideal.

---

## 4. Matriz de Testes de Integridade de Dados (DBA)
*Objetivo: Garantir a consistência física e evitar dados órfãos no MySQL.*

* **CT08: Restrição de Eliminação em Cascata**
    * **Cenário:** O Administrador tenta eliminar uma `Sala` (no Backoffice) que ainda contém `Equipamentos` operacionais ativos a ela vinculados.
    * **Resultado Esperado:** A base de dados MySQL bloqueia a ação devido à restrição de chave estrangeira (`onDelete('restrict')`). O Laravel apanha a exceção SQL e exibe um alerta de erro amigável ao Administrador ("Não é possível apagar uma sala com equipamentos associados").