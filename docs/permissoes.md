# 🔐 Matriz de Autorizações & Permissões (RBAC)

Este documento define de forma estrita o controlo de acessos baseado em funções (Role-Based Access Control) aplicado às rotas, controladores e middlewares do sistema para garantir a segurança dos dados.

## 1. Operador (Operário)
* **Alterar Password:** Gestão autónoma da sua segurança de acesso à plataforma.
* **Consultar Catálogo de Ativos (Apenas Leitura):** Listar salas e equipamentos ativos, utilizando a pesquisa e filtros avançados.
* **Abrir Ticket (Manutenção Corretiva):** Reportar uma avaria real associando sala, máquina, descrição e upload de fotografias.
* **Consultar os Seus Tickets:** Listagem restrita das suas avarias com suporte a filtros por estado, data e criticidade.
* **Interação por Comentários:** Enviar e receber mensagens em formato de comentários nos tickets criados pelo próprio utilizador.
* **Notificações:** Receção de alertas em tempo real e por e-mail quando o seu ticket mudar de estado.
* **Cancelar Ticket (Condicional):** Capacidade de anular o próprio alerta, desde que este ainda se encontre no estado inicial "Aberto".

## 2. Técnico de Manutenção
* **Alterar Password:** Gestão autónoma da sua segurança de acesso.
* **Abertura de Tickets em Campo:** Autonomia para registar uma nova ordem de avaria (`POST /tickets`) imediatamente caso detete uma falha mecânica ou elétrica em campo.
* **Consultar Painel de Avarias Ativas:** Visualizar a fila global de tickets com ferramentas de pesquisa e filtros avançados.
* **Consultar Histórico de Ativos:** Acesso à ficha técnica e ao registo histórico de intervenções passadas de qualquer máquina.
* **Iniciar Reparação:** Assumir a responsabilidade de um ticket (muda o estado para "Em Curso", inicia o cronómetro operacional do servidor e envia notificação).
* **Upload de Evidências:** Adicionar fotos do decorrer da reparação ou de componentes danificados para o relatório técnico.
* **Pedir Autorização Orçamental (Fluxo Excecional):** Move o ticket para "Pendente de Orçamento", suspende o SLA e anexa uma justificação financeira.
* **Encerrar Ticket:** Submeter o encerramento (estado "Fechada"), com preenchimento obrigatório dos minutos de mão de obra despendidos, relatório técnico final, registo de consumos de peças do stock interno e geração do relatório individual.

## 3. Administrador (Diretor de Operações)
* **Gestão Exclusiva de Utilizadores e Recursos Humanos:** Controlo absoluto (CRUD) sobre a criação de contas e atribuição de Perfis (Roles) no Backoffice corporativo. O auto-registo público foi desativado; a introdução de novos utilizadores é restrita à administração.
* **Despacho Assistido por IA:** Acesso à interface de decisão onde visualiza a avaria cruzada com a recomendação em tempo real do `AIService` (NLP), gravando a alocação do técnico sugerido com 1 clique.
* **Gestão Total de Inventário, Ativos & Infraestrutura:** Operações estruturais (CRUD) sobre Equipamentos, Salas, Categorias e Localizações físicas com suporte a Soft Deletes.
* **Agendar Manutenções Preventivas:** Gerar ordens de trabalho proativas e planeadas cronologicamente diretamente no calendário.
* **Aprovar/Rejeitar Orçamentos:** Decidir sobre os pedidos de alto valor submetidos pelos técnicos para libertação da reparação.
* **Consultar Dashboard Analítico Reativo com Gráficos:** Acesso exclusivo a gráficos dinâmicos (Chart.js) que demonstram o MTTR, MTBF, eficiência da equipa técnica e custos gerais atualizados automaticamente via WebSockets.
* **Consultar Audit Log Global:** Visualizar o histórico completo e imutável de alterações do sistema (quem alterou que campo, o valor antigo e o novo valor armazenados em JSON).
* **Exportação de Relatórios Avançados:** Descarregar relatórios consolidados em formato Excel (.xlsx) ou PDF com base em filtros temporais e operacionais.
* **Aceder à Documentação Interativa:** Consulta e teste dos endpoints através da interface Swagger UI.