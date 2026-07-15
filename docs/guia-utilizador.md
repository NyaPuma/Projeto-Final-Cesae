# Guia do Utilizador: Sistema Integrado de Gestão de Manutenção

Este manual descreve as funcionalidades principais disponíveis na plataforma, organizadas pelos três perfis de utilizador.

---

## 1. Perfil Operador (Operário)
O foco deste perfil é a comunicação rápida de anomalias e falhas operacionais na fábrica.

* **Submeter Avaria:**
    1. Aceda ao menu "Novo Ticket".
    2. Selecione o Equipamento e a Sala respetiva.
    3. Descreva detalhadamente o problema (ex: ruído anormal, paragem súbita).
    4. **Upload de Evidências:** Anexe fotografias da avaria para acelerar o diagnóstico inicial.
* **Consultar Tickets:**
    * Visualize o estado dos seus pedidos (Aberto, Em Curso ou Fechado) através da listagem "Os Meus Tickets".
* **Comunicação:**
    * Utilize o sistema de comentários dentro de cada ticket criado por si para esclarecer dúvidas ou fornecer atualizações ao técnico responsável.

---

## 2. Perfil Técnico de Manutenção
O foco deste perfil é a eficiência na reparação, controlo de stock e atualização do fluxo de trabalho.

* **Abertura em Campo:**
    * Possui autonomia para abrir de imediato um ticket de avaria na plataforma caso detete uma falha mecânica ou elétrica durante as suas rondas pela fábrica.
* **Painel de Avarias e Fila Global:**
    * Consulte a lista de tickets pendentes atribuídos ou disponíveis para triagem, com suporte a filtros avançados por equipamento, estado ou localização física.
* **Iniciar Reparação:**
    * Ao assumir uma intervenção, clique em "Iniciar Reparação". O estado transita automaticamente para "Em Curso" e tranca a rota, iniciando a contagem de tempo com um carimbo do servidor (`NOW()`).
* **Reportar Evolução & Comentários:**
    * Adicione notas técnicas e faça o upload de fotos de componentes substituídos ao longo do ciclo de vida do ticket.
* **Solicitação de Orçamento:**
    * Caso a avaria exija componentes de alto custo, altere o estado para "Pendente de Orçamento" e anexe a respetiva justificação financeira para avaliação da Direção.
* **Encerramento do Ticket:**
    * Ao concluir a reparação física, submeta o relatório técnico, os minutos despendidos e o custo das peças consumidas do stock interno. O sistema calcula o MTTR e atualiza os indicadores estatísticos.

---

## 3. Perfil Administrador (Diretor de Operações)
O foco deste perfil é a gestão de acessos, despacho inteligente, controlo analítico e decisão estratégica.

* **Gestão de Utilizadores e Segurança (Exclusivo):**
    * Retém o controlo absoluto sobre as credenciais e recursos humanos da empresa. O auto-registo público encontra-se desativado; a criação de novas contas e a atribuição de perfis (*Roles*) é efetuada obrigatoriamente através do menu de Backoffice restrito.
* **Despacho Assistido por IA:**
    * Ao triar um incidente, o Administrador é apoiado pelo assistente de Inteligência Artificial (`AIService`). O motor processa o texto livre (NLP), categoriza a falha e sugere o técnico ideal com base nas competências e na volumetria de trabalho atual, permitindo a alocação oficial com apenas 1 clique.
* **Gestão de Inventário e Ativos:**
    * Controlo total do backoffice para gerir (Criar, Editar, Inativar ou aplicar Soft Delete) a árvore de salas, pavilhões, marcas e equipamentos da fábrica.
* **Gestão Orçamental:**
    * Analisa as requisições financeiras submetidas pelos técnicos para reparações complexas, retendo o poder de aprovar ou rejeitar os orçamentos.
* **Manutenção Preventiva:**
    * Agenda proativamente intervenções periódicas em equipamentos antes que ocorra uma falha, injetando ordens de trabalho planeadas diretamente no calendário técnico.
* **Dashboard Analítico e Auditoria:**
    * Monitoriza os gráficos de KPI em tempo real (MTTR, custos e desempenho da equipa) atualizados via WebSockets e consulta os logs de auditoria imutáveis para rastrear qualquer alteração feita no sistema.

---

## Dicas de Utilização
* **Notificações em Tempo Real:** O sistema alerta-o instantaneamente no ecrã (através do Laravel Echo) sempre que um ticket muda de estado, recebe um comentário ou dispara um alerta reativo de telemetria.
* **Pesquisa Avançada:** Em qualquer listagem, utilize a barra de pesquisa combinada com filtros para isolar rapidamente registos por ID, número de série, prioridade ou intervalo de datas.