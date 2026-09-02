# Matriz de Autorizações & Permissões (RBAC)

Este documento define de forma estrita o controlo de acessos baseado em funções (Role-Based Access Control) aplicado às rotas, controladores e middlewares do sistema para garantir a segurança dos dados e a segregação de responsabilidades segundo o Princípio do Menor Privilégio (Least Privilege).

---

## 1. Operador (Operário)
* **Alterar Password:** Gestão autónoma da sua segurança de acesso à plataforma.
* **Consultar Catálogo de Ativos (Apenas Leitura):** Listar salas e equipamentos ativos, utilizando a pesquisa e filtros avançados.
* **Abrir Ticket (Manutenção Corretiva):** Reportar uma avaria real associando sala, máquina, nível de prioridade inicial, descrição e upload de fotografias.
* **Consultar os Seus Tickets:** Listagem restrita das suas avarias com suporte a filtros por estado, data e criticidade.
* **Interação por Comentários:** Enviar e receber mensagens em formato de comentários nos tickets criados pelo próprio utilizador.
* **Notificações:** Receção de alertas em tempo real e por e-mail quando o seu ticket mudar de estado.
* **Cancelar Ticket (Condicional):** Capacidade de anular o próprio alerta, desde que este ainda se encontre no estado inicial "Aberto".

---

## 2. Técnico de Manutenção
* **Alterar Password:** Gestão autónoma da sua segurança de acesso.
* **Abertura de Tickets em Campo:** Autonomia para registar uma nova ordem de avaria (`POST /tickets`) imediatamente caso detete uma falha mecânica ou elétrica em campo.
* **Consultar Painel de Avarias Ativas:** Visualizar a fila global de tickets com ferramentas de pesquisa e filtros avançados.
* **Consultar Histórico de Ativos:** Acesso à ficha técnica e ao registo histórico de intervenções passadas de qualquer máquina.
* **Auto-atribuição e Início de Reparação:** Assumir a responsabilidade de um ticket livre (transita o estado para "Em Curso", associa o técnico e captura o carimbo de data/hora no servidor).
* **Gestão de Orçamento Detalhado:** Submeter discriminação orçamental com itens de mão de obra e peças. Valores superiores ao limiar de autonomia (100.00 EUR) suspendem o SLA e transitam a avaria para "Pendente de Orçamento".
* **Upload de Evidências:** Adicionar fotos do decorrer da reparação ou de componentes danificados para o relatório técnico.
* **Devolver / Libertar Ocorrência:** Devolver o ticket para o estado "Aberto" e remover a sua atribuição caso não consiga dar continuidade (bloqueado para ocorrências de prioridade Crítica).
* **Encerrar Ticket:** Submeter o encerramento definitivo (estado "Fechada"), com preenchimento do custo real apurado, minutos despendidos e relatório técnico final.

---

## 3. Administrador (Diretor de Operações)
* **Gestão Exclusiva de Utilizadores e Recursos Humanos:** Controlo absoluto (CRUD) sobre a criação de contas e atribuição de Perfis (Roles) no Backoffice corporativo. O auto-registo público encontra-se desativado; a introdução de novos utilizadores é restrita à administração.
* **Despacho e Triagem Manual / Assistida por IA:** Interface de decisão onde visualiza a avaria, define manualmente o técnico responsável ou recorre ao assistente inteligente para alocação com 1 clique.
* **Gestão Total de Inventário, Ativos & Infraestrutura:** Operações estruturais (CRUD) sobre Equipamentos, Salas, Categorias e Localizações físicas com suporte a Soft Deletes.
* **Agendar Manutenções Preventivas:** Gerar ordens de trabalho proativas e planeadas cronologicamente diretamente no calendário.
* **Validação e Decisão Orçamental:** Painel dedicado para analisar, aprovar ou recusar os pedidos de orçamento submetidos pelos técnicos que excedam o limiar de autonomia.
* **Consultar Dashboard Analítico Reativo:** Acesso exclusivo a métricas e gráficos de desempenho (MTTR, MTBF, distribuição de tickets e custos acumulados).
* **Consultar Audit Log Global:** Visualizar o histórico completo e imutável de alterações do sistema (registo de payloads com valores anteriores e novos em formato JSON).
* **Exportação de Relatórios:** Descarregar relatórios operacionais consolidados em formatos CSV, PDF ou Excel.
* **Restrição Técnica:** Não possui acesso às ferramentas internas de teste de endpoints da API (Swagger UI), concentrando o seu painel estritamente nas operações de negócio e manutenção.

---

## 4. Developer (Programador / Integrador de API)
* **Alterar Password:** Gestão autónoma da sua segurança de acesso.
* **Acesso Exclusivo à Documentação OpenAPI / Swagger:** Acesso reservado e protegido via middleware à interface interativa Swagger UI (`/docs/openapi`) e ao esquema técnico em formato JSON (`/docs/openapi.json`).
* **Exploração e Depuração de Endpoints:** Realização de chamadas de teste e inspeção de contratos de dados (payloads de requisição, headers e códigos de resposta HTTP) para construção de integrações externas.
* **Isolamento de Negócio:** Perfil estritamente técnico sem privilégios de gestão operacional. Não possui acesso ao painel de utilizadores, validação de orçamentos, logs de auditoria corporativa ou criação e despacho de avarias.

---

## 5. Tabela Resumo de Permissões por Módulo

| Módulo / Ação | Operador | Técnico | Administrador | Developer |
| :--- | :---: | :---: | :---: | :---: |
| Abertura de Tickets | Sim | Sim | Sim | Não |
| Consultar Avarias Globais | Não | Sim | Sim | Não |
| Iniciar / Fechar Intervenção | Não | Sim | Sim | Não |
| Submeter Estimativa Orçamental | Não | Sim | Não | Não |
| Decidir / Aprovar Orçamento | Não | Não | Sim | Não |
| Atribuição Manual / IA de Técnico | Não | Não | Sim | Não |
| Gestão de Salas e Equipamentos (CRUD) | Não | Não | Sim | Não |
| Gestão de Utilizadores (Registo e Perfis) | Não | Não | Sim | Não |
| Logs de Auditoria e Analítica Global | Não | Não | Sim | Não |
| Documentação Swagger / OpenAPI UI | Não | Não | Não | Sim |
| Visualizar Roadmap de Produto | Sim | Sim | Sim | Sim |