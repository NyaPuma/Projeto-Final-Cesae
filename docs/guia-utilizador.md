# Manual do Utilizador & Perfis de Acesso

Este documento serve como guia prático de utilização da plataforma SIGMA (Sistema Integrado de Gestão de Manutenção Avançada), detalhando os fluxos operacionais, interfaces e permissões associadas a cada perfil de utilizador no sistema.

---

## 1. Visão Geral da Plataforma

A plataforma centraliza a gestão de manutenção industrial corretiva e planeada, articulando a comunicação entre quem deteta anomalias na fábrica, a equipa técnica que executa as reparações e a direção operacional que gere recursos e custos.

### Perfis Disponíveis no Sistema
* **Operador (Operário):** Registo de avarias, consulta dos seus pedidos e acompanhamento do estado das intervenções.
* **Técnico de Manutenção:** Gestão da fila de avarias, início de reparações, upload de evidências e submissão de orçamentos e relatórios técnicos.
* **Administrador (Diretor de Operações):** Gestão de colaboradores, alocação inteligente de equipas, aprovação orçamental, auditoria e controlo de indicadores analíticos.
* **Developer (Programador / Integrador de API):** Perfil técnico restrito para exploração e testes de endpoints via Swagger UI e integração com sistemas externos.

---

## 2. Acesso à Plataforma e Autenticação

1. Aceda ao endereço da aplicação (`/ui/login`).
2. Introduza as suas credenciais corporativas (e-mail e palavra-passe).
3. O sistema valida o token de autenticação e redireciona automaticamente para o ecrã correspondente ao seu perfil.
4. Para alterar o idioma entre Português e Inglês, utilize o seletor circular no canto superior direito do ecrã.

---

## 3. Guia do Operador (Operário)

### 3.1 Registar uma Avaria (Abertura de Ticket)
1. No menu lateral, selecione **Tickets** e clique no botão **Novo Ticket**.
   * *Nota de Campo:* Caso esteja junto à máquina ou porta da sala, pode utilizar a leitura do **QR Code** físico para pré-preencher automaticamente a localização ou o equipamento.
2. Preencha os campos obrigatórios:
   * **Equipamento:** Selecione o ativo avariado.
   * **Sala / Localização:** Confirme o espaço fabril onde se encontra o ativo.
   * **Prioridade Proposta:** Indique o impacto visual (Baixa, Média, Alta ou Crítica).
   * **Descrição:** Explique brevemente o sintoma ou comportamento anómalo observado.
3. Clique em **Anexar Fotografia** se pretender enviar uma evidência visual da quebra.
4. Confirme clicando em **Submeter Ticket**. O estado inicial será **Aberto**.

### 3.2 Acompanhar e Interagir
* **Histórico Pessoal:** Aceda a **Tickets** para consultar a lista restrita das suas solicitações, visualizando se a avaria já foi atribuída a um técnico ou se está **Em Curso**.
* **Comentários:** Abra os detalhes do ticket para enviar notas adicionais à equipa de manutenção.
* **Cancelamento:** Se a situação for resolvida antes da intervenção técnica, pode cancelar o ticket desde que este permaneça no estado **Aberto**.

---

## 4. Guia do Técnico de Manutenção

### 4.1 Painel Operacional e Assunção de Avarias
1. Aceda à secção **Meus Tickets** para verificar intervenções sob a sua responsabilidade ou consulte a listagem global para identificar tickets livres.
2. Para assumir uma ordem de trabalho aberta, clique em **Assumir Ticket**.
3. O estado muda para **Em Curso**, e o cronómetro de resolução inicia automaticamente a contagem no servidor.

### 4.2 Pedido de Autorização Orçamental
Se a reparação exigir peças de substituição ou custos externos superiores ao limiar de autonomia técnica (100.00 EUR):
1. No ecrã do ticket, selecione **Pedir Orçamento**.
2. Descrimine o valor estimado de materiais e mão de obra e introduza a respetiva justificação técnica.
3. Ao submeter, o ticket transita para o estado **Pendente de Orçamento** e o SLA de resolução fica suspenso até validação da administração.

### 4.3 Concluir uma Intervenção
1. Aceda ao ticket em curso e selecione **Encerrar Ticket**.
2. Preencha os dados obrigatórios do fecho:
   * **Minutos de Intervenção:** Tempo real de mão de obra despendido.
   * **Custo Real:** Valor final de consumíveis ou materiais aplicados.
   * **Relatório Técnico:** Descrição do diagnóstico efetuado e das ações corretivas executadas.
3. Carregue fotos comprovativas da resolução na secção **Evidências Fotográficas**.
4. Submeta para transitar a avaria para o estado **Fechado**.

---

## 5. Guia do Administrador (Diretor de Operações)

### 5.1 Despacho de Técnicos e Triagem Inteligente
1. No menu lateral, aceda a **Tickets** e abra um registo em estado **Aberto**.
2. Na área de alocação:
   * **Atribuição Manual:** Escolha diretamente o colaborador técnico na lista suspensa.
   * **Assistente IA:** Consulte o cartão de recomendação inteligente que cruza o texto da avaria com as especialidades e carga horária dos técnicos, aplicando a alocação sugerida com 1 clique.

### 5.2 Validação Orçamental
1. Aceda ao módulo **Orçamentos** no menu de navegação.
2. Analise os pedidos com valor superior a 100.00 EUR pendentes de validação.
3. Selecione **Aprovar** para libertar a continuidade da reparação pelo técnico ou **Rejeitar** anexando uma nota de recusa.

### 5.3 Gestão de Utilizadores e Infraestrutura
* **Utilizadores:** Crie novos colaboradores corporativos e defina o respetivo perfil funcional. A plataforma não possui auto-registo externo por motivos de segurança.
* **Inventário & Salas:** Cadastre novas máquinas, números de série e salas, com suporte a geração e impressão de etiquetas QR Code.
* **Preventivas:** Agende intervenções periódicas e preventivas diretamente no calendário da fábrica.
* **Auditoria & Relatórios:** Consulte os registos estruturados de alterações no sistema e exporte folhas analíticas em formatos PDF, Excel ou CSV.

---

## 6. Guia do Developer (Integrador de API)

### 6.1 Propósito do Perfil
O perfil **Developer** é estritamente técnico e desacoplado dos fluxos de negócio fabris, destinando-se a programadores internos, auditores de software ou parceiros de integração.

### 6.2 Acesso à Documentação OpenAPI / Swagger
1. Inicie sessão com a conta técnica autorizada (ex.: `developer@example.com`).
2. O menu lateral apresentará exclusivamente os acessos genéricos e o botão **Swagger**.
3. Clique em **Swagger** para abrir a consola interativa em `/docs/openapi`.
4. A partir desta interface, o developer pode:
   * Analisar schemas de dados e formatos JSON de cada endpoint.
   * Testar chamadas diretas aos endpoints RESTful através da ferramenta interativa de teste.
   * Aceder ao ficheiro estático de especificação em `/docs/openapi.json` para importação em ferramentas externas (como Postman ou Insomnia).

---

## Dicas de Utilização
* **Notificações em Tempo Real:** O sistema alerta-o instantaneamente no ecrã (através do Laravel Echo) sempre que um ticket muda de estado, recebe um comentário ou dispara um alerta reativo de telemetria.
* **Pesquisa Avançada:** Em qualquer listagem, utilize a barra de pesquisa combinada com filtros para isolar rapidamente registos por ID, número de série, prioridade ou intervalo de datas.