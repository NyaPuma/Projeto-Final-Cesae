# Lista de Requisitos do Sistema

### 1. Requisitos Funcionais (RF)

#### 1.1 Autenticação, Perfis e Segurança de Identidade
* **RF01:** O sistema deve suportar três perfis de utilizador distintos e isolados: Operador (Operário), Técnico e Administrador.
* **RF02:** Qualquer utilizador devidamente autenticado e validado na plataforma (seja Operário, Técnico ou Administrador) deve possuir autonomia para submeter novas avarias operacionais no sistema (**Fluxo Omnicanal In-House**).
* **RF14 (Requisito de Segurança Crítico):** O sistema deve bloquear o auto-registo público e anónimo de contas. A criação, cadastro e atribuição de perfis (*Roles*) de novos colaboradores na empresa deve ser uma funcionalidade restrita e exclusiva do Administrador através da rota `/admin/users/register`.

#### 1.2 Gestão de Ativos e Infraestrutura
* **RF03:** CRUD completo (Criar, Ler, Atualizar, Eliminar) de equipamentos, categorias e salas pelo Administrador, com suporte a *Soft Deletes* no Eloquent ORM.
* **RF04:** O sistema deve permitir associar um equipamento a uma sala específica (associação opcional/nullable na base de dados).

#### 1.3 Workflow de Avarias (Core Business)
* **RF05:** O utilizador deve preencher um registo detalhado (Equipamento, Sala e Descrição por texto livre) ao abrir uma avaria, permitindo opcionalmente o upload de ficheiros de imagem como evidência.
* **RF06:** Após a abertura, o ticket deve ser encaminhado automaticamente para uma fila global e painel de triagem visível para os técnicos e administradores.
* **RF07:** O ciclo de vida de uma avaria deve passar obrigatoriamente por 3 estados lógicos imutáveis: Aberto, Em Curso e Fechado.
* **RF08:** O sistema deve capturar e registar automaticamente no MySQL o *timestamp* de transição entre cada um dos três estados através do horário do servidor (`NOW()`).
* **RF09:** Ao encerrar um ticket, o técnico é obrigado a introduzir o relatório técnico final, os minutos despendidos e o registo de **peças consumidas do stock interno** da fábrica para cálculo automático de custos.

#### 1.4 Inteligência de Dados, IA e Reatividade
* **RF10:** Disponibilizar dados estatísticos e gráficos analíticos (MTTR, MTBF e custos) atualizados de forma reativa no ecrã do Administrador (via WebSockets e Laravel Echo) sempre que um ticket for fechado.
* **RF11:** Motor de IA (`AIService`) integrado como um Sistema de Apoio à Decisão (SAD) para recomendação automática do técnico ideal com base no cruzamento semântico de especialidades e menor volumetria de carga de trabalho atual no MySQL.
* **RF12:** Triagem e classificação automática da categoria técnica (Mecânica, Elétrica, Informática) através do Processamento de Linguagem Natural (NLP) aplicado ao texto livre digitado na descrição da avaria.
* **RF13:** Fornecimento de diagnósticos prescritivos baseados no histórico de manutenção e relatórios passados do ativo, exibindo sugestões de peças standard para o técnico.

---

### 2. Requisitos Não-Funcionais (RNF)

#### 2.1 Segurança e Auditoria
* **RNF01:** Todas as palavras-passe dos utilizadores devem ser encriptadas de forma unidirecional com *hashing* seguro utilizando o algoritmo padrão Bcrypt.
* **RNF02:** Registo imutável de logs de auditoria (`audits`) de todas as alterações estruturais do sistema, armazenando em formato JSON os payloads correspondentes aos estados modificados (`old_values` e `new_values`).
* **RNF03:** Controlo de acessos baseado em funções (RBAC) através de middlewares injetados no barramento de rotas do Laravel, garantindo o isolamento completo entre perfis.

#### 2.2 Desempenho e Disponibilidade
* **RNF04:** O tempo de resposta do processamento do `AIService` nas chamadas à API da OpenAI (modelo `gpt-4o-mini`) para geração do JSON de triagem e recomendação técnica não deve exceder 2 segundos.
* **RNF05:** O sistema deve garantir integridade e persistência transacional completa no banco de dados MySQL, prevenindo perdas de dados em submissões concorrentes através de restrições de chaves estrangeiras.

#### 2.3 Usabilidade e Manutenibilidade
* **RNF06:** Interface responsiva desenvolvida em Blade/CSS, totalmente adaptada a navegadores modernos e otimizada para o VS Code/ambiente de desenvolvimento escolar.
* **RNF07:** Conformidade do código-fonte PHP com os padrões PSR do ecossistema Laravel, utilizando o padrão MVC e injeção de dependências para desacoplamento de serviços.
* **RNF08:** Base de dados MySQL otimizada com indexação eficiente nas chaves estrangeiras e campos de busca frequentes (`status_id`, `assigned_to`, `email`), prevenindo o problema de *N+1 queries* através de *Eager Loading* (`with()`).

---

### 3. Regras de Negócio e Fluxo Operacional

### 3.1 Reatividade e Distribuição In-House
* O sistema opera num circuito fechado departamental. A criação ou encerramento de qualquer ticket dispara transmissões assíncronas (*Broadcasts*) via WebSockets para atualizar de imediato os ecrãs de gestão e contadores de alertas sem recarregar a página.
* O encerramento do ticket exige a dedução e contabilização de peças do stock interno, cujo impacto financeiro é somado ao custo de mão de obra para atualização imediata dos KPIs analíticos do Administrador.

### 3.2 Regras de Transição de Estado e SLA
* **Início de Intervenção:** O técnico assume a propriedade do ticket movendo o estado para `Em Curso`, o que tranca a rota de edição e armazena a timestamp `in_progress_at` via Back-End para início da contagem cronológica de paragem do ativo.
* **Aprovação Orçamental Excecional:** Caso uma reparação exija componentes dispendiosos, o técnico solicita autorização. O ticket transita para o estado de pausa e suspende o cálculo do SLA até que o Administrador aprove (`approveBudget`) ou rejeite a requisição financeira.
* **Cancelamento:** A operação de cancelamento de um ticket é estritamente condicional; só é permitida ao operador que o criou e apenas se o registo ainda se encontrar no estado original `Aberto`.