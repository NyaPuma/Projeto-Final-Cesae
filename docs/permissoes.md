# 🔐 Matriz de Autorizações & Permissões (RBAC)

Este documento define de forma estrita o controlo de acessos baseado em funções (Role-Based Access Control) aplicado às rotas e controladores do sistema para garantir a segurança dos dados.

## 1. Utilizador Comum (Operário/Funcionário)
* **Alterar Password:** Gestão autónoma da sua segurança de acesso à plataforma.
* **Consultar Catálogo de Ativos (Apenas Leitura):** Listar salas e equipamentos ativos, utilizando a pesquisa e filtros avançados.
* **Abrir Ticket (Manutenção Corretiva):** Reportar uma avaria real associando sala, máquina, descrição e upload de fotografias.
* **Consultar os Seus Tickets:** Listagem restrita das suas avarias com suporte a filtros por estado, data e criticidade.
* **Interação por Comentários:** Enviar e receber mensagens em formato de chat com o técnico atribuído.
* **Notificações:** Receção de alertas em tempo real e por e-mail quando o seu ticket mudar de estado.
* **Cancelar Ticket (Condicional):** Capacidade de anular o próprio alerta, desde que este ainda se encontre no estado inicial "Aberto".

## 2. Técnico de Manutenção
* **Alterar Password:** Gestão autónoma da sua segurança de acesso.
* **Consultar Painel de Avarias Ativas:** Visualizar a fila global de tickets com ferramentas de pesquisa e filtros avançados.
* **Consultar Histórico de Ativos:** Acesso à ficha técnica e ao registo histórico de intervenções passadas de qualquer máquina.
* **Iniciar Reparação:** Assumir a responsabilidade de um ticket (muda para "Em Curso", inicia o SLA e envia notificação).
* **Upload de Evidências:** Adicionar fotos do decorrer da reparação ou de componentes danificados para o relatório técnico.
* **Pedir Autorização Orçamental (Fluxo Excecional):** Move o ticket para "Pendente de Orçamento", suspende o SLA e anexa uma justificação financeira.
* **Encerrar Ticket:** Submeter o encerramento (estado "Fechada"), com preenchimento obrigatório das horas de mão de obra, relatório técnico final e geração opcional de um relatório individual em PDF.

## 3. Administrador (Diretor de Operações)
* **Gestão Total de Utilizadores:** Controlo absoluto (CRUD) sobre as contas, atribuição de Perfis (Roles) e inativação de acessos.
* **Gestão Total de Inventário, Ativos & Infraestrutura:** Operações estruturais (CRUD) sobre Equipamentos, Salas, Categorias e Localizações físicas com Soft Deletes.
* **Agendar Manutenções Preventivas:** Gerar ordens de trabalho proativas e planeadas cronologicamente.
* **Aprovar/Rejeitar Orçamentos:** Decidir sobre os pedidos de alto valor submetidos pelos técnicos.
* **Consultar Dashboard Analítico com Gráficos:** Acesso exclusivo a gráficos dinâmicos (Chart.js) que demonstram o MTTR, MTBF, eficiência da equipa técnica e custos gerais.
* **Consultar Audit Log Global:** Visualizar o histórico completo e imutável de alterações do sistema (quem alterou que campo, o valor antigo e o novo valor).
* **Exportação de Relatórios Avançados:** Descarregar relatórios consolidados em formato Excel (.xlsx) ou PDF com base em filtros temporais e operacionais.
* **Aceder ao Swagger:** Consulta e teste dos endpoints através da documentação interativa da API.