
## Lista de Requisitos do Sistema

### 1. Requisitos Funcionais (RF)

#### 1.1 Autenticação e Perfis
* **RF01:** O sistema deve suportar três perfis de utilizador distintos: Utilizador Comum, Técnico e Administrador.
* **RF02:** Apenas utilizadores registados (Perfil Comum) podem submeter novas avarias no sistema.

#### 1.2 Gestão de Ativos e Infraestrutura
* **RF03:** CRUD completo (Criar, Ler, Atualizar, Eliminar) de equipamentos e salas pelo Administrador.
* **RF04:** O sistema deve permitir associar um equipamento a uma sala específica (associação opcional/nullable).

#### 1.3 Workflow de Avarias (Core)
* **RF05:** O utilizador deve preencher um registo detalhado e específico ao abrir uma avaria.
* **RF06:** Após a abertura, o ticket deve ser encaminhado automaticamente para um painel de triagem visível para os técnicos.
* **RF07:** O ciclo de vida de uma avaria deve passar obrigatoriamente por 3 estados: Aberta, Em Curso e Fechada.
* **RF08:** O sistema deve capturar e registar automaticamente o *timestamp* de transição entre cada um dos três estados.
* **RF09:** Ao encerrar um ticket, o técnico é obrigado a introduzir o tempo gasto e o custo total da intervenção.

#### 1.4 Inteligência de Dados e Apoio à Decisão (IA)
* **RF10:** Disponibilizar dados estatísticos e gráficos sobre tempo médio de resolução e tempo de espera na abertura de tickets.
* **RF11:** Motor de IA para recomendação automática de técnicos com base na especialidade e carga de trabalho.
* **RF12:** Triagem automática de severidade e categoria de avaria via Processamento de Linguagem Natural (NLP).
* **RF13:** Diagnóstico prescritivo baseado no histórico de manutenção do equipamento.

---

### 2. Requisitos Não-Funcionais (RNF)

#### 2.1 Segurança e Auditoria
* **RNF01:** Todos os dados sensíveis dos utilizadores devem ser armazenados com *hashing* seguro (Bcrypt/Argon2).
* **RNF02:** Registo (log) de operações críticas executadas por administradores para efeitos de auditoria.
* **RNF03:** Controlo de acessos baseado em funções (RBAC) para garantir isolamento entre perfis.

#### 2.2 Desempenho e Disponibilidade
* **RNF04:** O tempo de resposta do motor de IA para recomendações técnicas não deve exceder 2 segundos.
* **RNF05:** O sistema deve manter uma disponibilidade de 99% durante o horário laboral do departamento.

#### 2.3 Usabilidade e Manutenibilidade
* **RNF06:** Interface totalmente responsiva, adaptada a navegadores modernos e dispositivos móveis.
* **RNF07:** Conformidade do código-fonte com as normas PSR (*PHP Standards Recommendations*) do ecossistema Laravel.
* **RNF08:** Base de dados MySQL otimizada com indexação eficiente para garantir performance à medida que o histórico de tickets cresce.
  
## 3. Regras de Negócio e Fluxo Operacional

### 3.1 Gestão por Exceção (Telemetria)
* O sistema monitoriza fluxos de dados em tempo real. Leituras normais não são persistidas.
* A violação de limites críticos (ex: temperatura > 80°C) dispara automaticamente a criação de um ticket de avaria preventiva no MySQL.

### 3.2 Regras de Transição de Estado
* **Início de Reparação:** O técnico torna-se o proprietário do ticket, iniciando o cálculo do SLA.
* **Orçamento Excecional:** Se uma reparação exigir aprovação financeira, o SLA é suspenso automaticamente até que o Administrador aprove ou recuse.
* **Cancelamento:** Apenas permitido se o ticket estiver no estado original "Aberto".  