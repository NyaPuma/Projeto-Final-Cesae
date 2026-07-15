# 🧪 Plano de Testes: Sistema Integrado de Gestão de Manutenção

**Objetivo:** Validar a integridade dos fluxos de dados (MySQL), restrições de segurança (RBAC), lógica do motor de IA (SAD) e a reatividade de eventos em tempo real. Este documento serve como guião para a fase de *Quality Assurance* (QA) da equipa para a ACCEPT Review.

---

## 1. Matriz de Testes de Autenticação e Perfis (RBAC)
*Objetivo: Garantir o isolamento absoluto de rotas e permissões de acordo com o perfil autenticado.*

* **CT01: Validação de Bloqueio de Segurança (Operador)**
    * **Cenário:** Um operador (operário) autenticado tenta aceder manualmente via URL ou Postman a rotas administrativas de Backoffice, tais como `/api/admin/audits` ou à criação de perfis.
    * **Resultado Esperado:** O Middleware intercepta a requisição, nega o acesso de imediato e retorna o código HTTP `403 Forbidden` (Acesso Negado), protegendo os dados de identidade e auditoria.
* **CT02: Persistência e Alteração de Password**
    * **Cenário:** O utilizador solicita a alteração das suas credenciais no perfil.
    * **Resultado Esperado:** O controlador processa a nova string, aplica o algoritmo de *hashing* (Bcrypt) e atualiza o campo imutável no MySQL com sucesso. O token de sessão antigo é invalidado.

---

## 2. Matriz de Testes do Workflow do Ticket (Core Business)
*Objetivo: Garantir que o ciclo de vida do incidente segue as regras estritas de negócio sem falhas lógicas.*

* **CT03: Transição de Estado e Captura de Timestamps**
    * **Cenário:** O Técnico clica no botão "Iniciar Reparação" no painel global.
    * **Resultado Esperado:** O estado do ticket transita de `Aberto` para `Em Curso`, o ID do técnico fica vinculado ao campo `assigned_to` no MySQL, e a coluna `in_progress_at` captura a timestamp exata gerada pelo servidor (`NOW()`) para cronometragem da intervenção.
* **CT04: Bloqueio Condicional de Cancelamento**
    * **Cenário:** O operador tenta cancelar um ticket submetido por si, mas o ticket já se encontra em tratamento técnico (Estado: `Em Curso`).
    * **Resultado Esperado:** A interface omite o botão de cancelamento. Caso o utilizador tente forçar o pedido via requisição direta na API, o Back-End bloqueia a operação (HTTP 403), preservando a integridade do ciclo de vida.
* **CT05: Encerramento Obrigatório com Dados de Custos**
    * **Cenário:** O Técnico tenta submeter o fecho de um ticket (mudar para `Fechado`) deixando os minutos de trabalho, nota de resolução ou custos com materiais internos em branco.
    * **Resultado Esperado:** O *Form Request* de validação do Laravel falha, impede a gravação na base de dados (rejeitando o UPDATE) e devolve erros amigáveis em JSON (HTTP 422) listando os campos operacionais obrigatórios.

---

## 3. Matriz de Testes de Reatividade e Inteligência Artificial (SAD)
*Objetivo: Validar a camada inteligente de dados, integrações e as transmissões assíncronas.*

* **CT06: Transmissão Reativa via WebSockets (Laravel Echo)**
    * **Cenário:** Um técnico conclui o encerramento físico de uma ordem de trabalho na fábrica e submete os dados de fecho.
    * **Resultado Esperado:** O evento `TicketStatusUpdatedBroadcast` é disparado síncronamente. A interface do Administrador (Diretor de Manutenção) capta o push do canal e atualiza reativamente os gráficos de KPIs (`Chart.js`) em tempo real, sem necessidade de atualizar a página.
* **CT07: Despacho Assistido e Persistência do Motor de IA**
    * **Cenário:** O Administrador abre o detalhe de uma avaria e clica em alocar o profissional sugerido pelo `AIService`.
    * **Resultado Esperado:** O controlador invoca a API da OpenAI via modelo `gpt-4o-mini`, tritura a descrição por NLP e devolve uma resposta estruturada em JSON contendo o `tecnico_id` ideal e a justificação. Ao validar, o Administrador submete a rota `PATCH /admin/tickets/{id}/atribuir` e grava de forma definitiva a decisão assistida no MySQL.

---

## 4. Matriz de Testes de Integridade de Dados (DBA)
*Objetivo: Garantir a consistência física e evitar dados órfãos ou inconsistências referenciais no MySQL.*

* **CT08: Restrição de Eliminação e Chaves Estrangeiras (Foreign Keys)**
    * **Cenário:** O Administrador tenta eliminar logicamente ou fisicamente uma `Sala` ou um utilizador do sistema que possuam ligações ativas a equipamentos ou históricos de workflows.
    * **Resultado Esperado:** A base de dados MySQL protege os dados órfãos seguindo as regras restritas das migrations (`nullOnDelete()` para relacionamentos opcionais ou bloqueio de integridade). O Laravel captura a exceção SQL e impede qualquer quebra na árvore estrutural de tabelas do sistema.