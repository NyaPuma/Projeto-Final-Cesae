# Sistema de Gestão e Manutenção de Avarias em Equipamentos

Uma aplicação desenvolvida em **Laravel** para o registo, acompanhamento e gestão de avarias em equipamentos, permitindo controlar todo o ciclo de vida de um ticket de manutenção.

## Objetivo

O objetivo deste projeto é disponibilizar uma plataforma web que facilite a comunicação entre utilizadores, técnicos e administradores, tornando o processo de gestão de avarias mais organizado, rápido e rastreável.

---

## Product Backlog Inicial

| Prioridade | User Story (Funcionalidade) | Critérios de Aceitação / DoD Técnico |
| :--- | :--- | :--- |
| 🔴 **Crítica** | **Como:** Funcionário<br>**Quero:** reportar uma avaria num equipamento específico<br>**Para:** que a equipa de manutenção saiba o que reparar. | • Formulário de submissão com campos: Equipamento, Sala e Descrição.<br>• Associação automática do ID do utilizador autenticado (`Auth::id()`).<br>• Estado inicial automático como 'Aberta' com carimbo `created_at`. |
| 🔴 **Crítica** | **Como:** Técnico<br>**Quero:** alterar o estado de uma avaria ("Em Curso" / "Fechada")<br>**Para:** comunicar o progresso atualizado dos trabalhos. | • Dropdown exclusivo de transição de estados no workflow.<br>• Bloqueio de rotas via Middleware do Laravel para perfis não autorizados (403).<br>• Estado 'Fechada' exige parecer técnico e injeta o timestamp final. |
| 🔴 **Crítica** | **Como:** Administrador<br>**Quero:** gerir o inventário de equipamentos e salas (CRUD)<br>**Para:** manter a infraestrutura física da empresa atualizada. | • CRUD completo integrado com *Soft Deletes* do Eloquent ORM.<br>• Validação no *Form Request* do Laravel impedindo números de série duplicados. |
| 🟡 **Alta** | **Como:** Administrador<br>**Quero:** consultar dashboards com métricas operacionais<br>**Para:** avaliar a eficiência e tempos de resolução (MTTR). | • Painel dinâmico no Front-End alimentado por assets compilados via NPM (Vite).<br>• Consultas SQL otimizadas com *Eager Loading* (`with()`) no Eloquent para evitar o problema N+1. |
| 🟡 **Alta** | **Como:** Sistema (Automação)<br>**Quero:** monitorizar a telemetria simulada dos ativos<br>**Para:** abrir avarias preventivas automaticamente em caso de anomalia. | • Execução de rotinas em segundo plano utilizando o *Laravel Task Scheduling*.<br>• Geração autónoma de ticket na base de dados caso os limites tolerados sejam violados. |


## 🔐 Matriz de Autorizações & Permissões (RBAC)

### 1. Utilizador Comum (Operário/Funcionário)
- **Alterar Password:** Gestão autónoma da sua segurança de acesso à plataforma.
- **Consultar Catálogo de Ativos (Apenas Leitura):** Capacidade de listar salas e equipamentos ativos para poder popular corretamente a interface de reporte.
- **Abrir Ticket (Manutenção Corretiva):** Reportar uma avaria real de forma cirúrgica, associando obrigatoriamente uma sala, um equipamento e uma descrição textual.
- **Consultar os Seus Tickets:** Listagem restrita e exclusiva das avarias reportadas pelo próprio utilizador, para acompanhamento em tempo real do estado (Aberta, Em Curso, Fechada).
- **Cancelar Ticket (Condicional):** Capacidade de anular o próprio alerta, desde que este ainda se encontre no estado inicial "Aberto".

### 2. Técnico de Manutenção
- **Alterar Password:** Gestão autónoma da sua segurança de acesso.
- **Consultar Painel de Avarias Ativas:** Visualizar a listagem global de todos os tickets em estado "Aberto" ou de cariz "Preventivo" agendados para a fábrica.
- **Consultar Histórico de Ativos:** Acesso à ficha técnica e ao registo histórico de intervenções passadas de qualquer máquina para apoio ao diagnóstico.
- **Iniciar Reparação:** Assumir a responsabilidade de um ticket. O sistema altera o estado para "Em Curso", injeta o timestamp automático de início e vincula o ID do técnico ao registo.
- **Pedir Autorização Orçamental (Fluxo Excecional):** Caso identifique a necessidade de peças dispendiosas, move o ticket para "Pendente de Orçamento", suspendo o cronómetro de SLA e anexando uma justificação financeira.
- **Encerrar Ticket (Custo Baixo/Autorizado):** Submeter o encerramento da avaria (estado "Fechada"), com preenchimento obrigatório das horas de mano de obra investidas e do relatório técnico final.

### 3. Administrador (Diretor de Operações)
- **Gestão Total de Utilizadores:** Controlo absoluto (CRUD) sobre as contas dos colaboradores, atribuição de Perfis (Roles) e bloqueio de acessos através de inativação.
- **Gestão Total de Inventário (Ativos):** Operações estruturais (CRUD) sobre Equipamentos e Categorias, utilizando inativação lógica (*Soft Deletes* do Eloquent).
- **Gestão Total de Infraestrutura:** Criação e configuração (CRUD) de Salas e Localizações físicas.
- **Agendar Manutenções Preventivas:** Gerar ordens de trabalho proativas e planeadas cronologicamente, injetando os alertas diretamente no painel dos técnicos.
- **Aprovar/Rejeitar Orçamentos:** Decidir sobre os pedidos de alto valor submetidos pelos técnicos. A aprovação reativa o ticket para "Em Curso"; a rejeição encerra o processo ou devolve-o para revisão técnica.
- **Consultar Dashboard Analítico:** Acesso exclusivo aos relatórios estatísticos calculados via **Eloquent ORM** (Tempos médios de resolução - MTTR, eficiência da equipa técnica e custos gerais de manutenção).

---

## 🔄 Workflow & Regras de Transição de Estados

O ciclo de vida de uma avaria no sistema segue regras estritas de transição geridas via Eloquent ORM. Cada alteração de estado é auditada em background através do trait `Auditable.php`, registando os timestamps de controlo (`opened_at`, `in_progress_at`, `closed_at`).

### 📋 Detalhe das Transições e Comportamento Esperado

#### 1. De [Aberta] para [Em Curso]
* **Gatilho:** O Técnico clica em "Iniciar Reparação" no seu painel.
* **Regra de Negócio:**
  - O sistema associa automaticamente o ID do técnico ao campo `tecnico_atribuido_id`.
  - É registado o timestamp exato em `in_progress_at` para cálculo do SLA de atendimento.
  - O ticket fica bloqueado para edição por outros técnicos.

#### 2. De [Em Curso] para [Pendente de Orçamento] (Fluxo Excecional)
* **Gatilho:** O Técnico deteta a necessidade de peças ou serviços de alto custo e clica em "Solicitar Aprovação".
* **Regra de Negócio:**
  - O preenchimento da justificativa financeira e a estimativa de custo tornam-se campos obrigatórios.
  - O cronómetro de tempo de resolução (SLA) é **suspenso** para não penalizar as métricas do técnico.
  - O Administrador é notificado no seu painel analítico.

#### 3. De [Pendente de Orçamento] para [Em Curso] ou [Recusada]
* **Gatilho:** O Administrador toma uma ação sobre o orçamento pendente.
* **Regra de Negócio:**
  - **Se Aprovado:** O estado regressa a "Em Curso", o cronómetro de SLA é reativado e o técnico pode prosseguir com a reparação.
  - **Se Rejeitado:** O estado passa para "Recusada/Cancelada", exigindo uma nota de feedback do Administrador, e o ticket é encerrado.

#### 4. De [Em Curso] para [Fechada]
* **Gatilho:** O Técnico conclui a reparação física e clica em "Encerrar Ticket".
* **Regra de Negócio:**
  - Torna-se obrigatória a introdução das horas de mano de obra gastas e do relatório técnico final.
  - O sistema injeta automaticamente o timestamp de conclusão em `closed_at` e calcula o tempo total de resolução (MTTR).

#### 5. De [Aberta] para [Cancelada]
* **Gatilho:** O Funcionário que abriu o ticket decide anulá-lo por erro ou duplicação.
* **Regra de Negócio:**
  - **Condição Estrita:** Esta ação só é permitida se o ticket ainda estiver no estado inicial "Aberto". Se um técnico já tiver iniciado a reparação, o utilizador comum deixa de ter permissão para cancelar.

---

## Tecnologias Utilizadas

- Laravel (Framework MVC)
- PHP
- Composer (Gestão de dependências PHP)
- MySQL (Base de dados relacional)
- PHPUnit (Testes automatizados)
- NPM / Vite (Compilação de Assets Frontend)

---

# Instalação

## 1. Clonar o repositório

```bash
git clone [https://github.com/seu-utilizador/seu-repositorio.git](https://github.com/seu-utilizador/seu-repositorio.git)
cd seu-repositorio
```

## 2. Instalar dependências

```bash
composer install
npm install
```

## 3. Configurar o ambiente

Copiar o ficheiro de configuração:

```bash
cp .env.example .env
```

Gerar a chave da aplicação:

```bash
php artisan key:generate
```

Configurar a ligação à base de dados no ficheiro `.env`.

## 4. Executar as migrations

```bash
php artisan migrate
```

Caso existam seeders:

```bash
php artisan db:seed
```

## 5. Iniciar a aplicação

```bash
php artisan serve
```

---

# Executar Testes

```bash
php artisan test
```

---

# API Endpoints

### 🔐 1. Autenticação & Gestão de Perfil

Estes endpoints gerem o ciclo de vida da sessão do utilizador e a segurança autónoma da conta. As rotas públicas usam o middleware `guest`, enquanto as protegidas exigem o middleware `auth`.

| Método | Endpoint | Proteção (Middleware) | Descrição / Comportamento Esperado |
| :--- | :--- | :--- | :--- |
| **POST** | `/register` | `guest` | Cria uma nova conta de colaborador na plataforma. Por omissão, o estado inicial do perfil é atribuído como 'Funcionário'. |
| **POST** | `/login` | `guest` | Valida as credenciais, inicia a sessão e injeta o Cookie de Autenticação/Token no cliente. |
| **POST** | `/logout` | `auth` | Destrói a sessão ativa do utilizador, invalida o token e limpa os cookies de autenticação de forma segura. |
| **PUT** | `/user/password` | `auth` | Permite que qualquer utilizador autenticado altere autonomamente a sua palavra-passe de acesso, reforçando a segurança. |

---

### 🎫 2. Fluxo de Tickets de Avaria (Operacional)

Rotas responsáveis por controlar todo o ciclo de vida das ordens de trabalho da fábrica. O acesso e os dados retornados são validados de forma estrita no Back-End através do ecossistema de *Middlewares* e *Policies* do Laravel baseado nas Roles (`funcionario`, `technician`, `admin`).

Cada transição gera uma salvaguarda automática de auditoria via `Auditable.php` para preenchimento dos carimbos de SLA (`opened_at`, `in_progress_at`, `closed_at`).

| Método | Endpoint | Permissão Exigida (Middleware) | Regras de Negócio, UX & Efeitos no Back-End |
| :--- | :--- | :--- | :--- |
| **POST** | `/tickets` | `role:funcionario` | **Criar Ticket Corretivo:** Submete um alerta de avaria. O Laravel valida os campos (Equipamento, Sala, Descrição), vincula o utilizador autenticado (`Auth::id()`) e define o estado inicial como 'Aberta'. |
| **GET** | `/tickets/my` | `role:funcionario` | **Painel do Funcionário:** Retorna as avarias ativas reportadas pelo próprio e, a pedido do cliente, disponibiliza o **histórico completo dos seus tickets já concluídos/fechados** para consulta autónoma. |
| **PUT** | `/tickets/{id}/cancel` | `role:funcionario` | **Cancelar Ticket Próprio:** Permite ao funcionário anular um ticket emitido por si, **desde que este permaneça no estado inicial 'Aberto'**. Se um técnico já tiver iniciado os trabalhos, a rota bloqueia a ação (403). |
| **GET** | `/technician/tickets/open` | `role:technician,admin` | **Fila de Espera Global:** Lista todas as avarias em estado 'Aberto' na fábrica ou de cariz 'Preventivo' agendado, prontas para serem triadas ou assumidas por qualquer técnico disponível. |
| **GET** | `/technician/tickets/assigned` | `role:technician` | **Os Meus Tickets:** Retorna exclusivamente a listagem de avarias ativas que o técnico logado assumiu para si e se encontram atualmente sob a sua responsabilidade (`tecnico_id == Auth::id()`). |
| **GET** | `/tickets/{id}` | `role:technician,admin` | **Detalhe Contextualizado (UX):** Carrega os dados do incidente e, de forma proativa, injeta na resposta Eloquent o **histórico das últimas 3 intervenções fechadas daquele equipamento específico** para apoiar o diagnóstico no local. |
| **PUT** | `/technician/tickets/{id}/start` | `role:technician` | **Iniciar Reparação:** Transita o estado para 'Em Curso'. Vincula o ID do técnico ao ticket e injeta o timestamp exato em `in_progress_at` para inicializar a contagem de SLA de atendimento. |
| **PUT** | `/technician/tickets/{id}/request-budget`| `role:technician` | **Fluxo Extraordinário de Orçamento:** Disparado caso a reparação exija peças dispendiosas. Move o ticket para 'Pendente de Orçamento', obriga a preencher uma estimativa e **suspende o cronómetro de SLA**. |
| **PUT** | `/technician/tickets/{id}/close` | `role:technician` | **Encerrar Intervenção:** Finaliza o processo movendo para 'Fechada'. Exige obrigatoriamente o relatório técnico detalhado e as horas de mão de obra gastas. Trava o `closed_at` e calcula o MTTR. |

---

### 👑 3. Administração & Backoffice

Endpoints de controlo estrutural e análise de dados. Estas rotas estão trancadas sob o middleware global `role:admin`, garantindo o isolamento total das funções de Direção de Operações.

| Método | Endpoint | Proteção (Middleware) | Descrição / Ações Estruturais |
| :--- | :--- | :--- | :--- |
| **PATCH**| `/admin/tickets/{id}/budget` | `role:admin` | **Decidir Orçamento:** Aprova (retoma para 'Em Curso' e reativa SLA) ou Rejeita (encerra o ticket com feedback descritivo). |
| **POST** | `/admin/preventive` | `role:admin` | **Manutenção Preventiva:** Cria e injeta uma ordem de trabalho planeada diretamente na agenda de trabalho dos técnicos. |
| **GET** | `/admin/analytics` | `role:admin` | **Dashboard Analítico:** Retorna as métricas cruciais compiladas via Eloquent ORM (MTTR, MTBF, eficiência e custos globais). |
| **CRUD** | `/admin/users/*` | `role:admin` | **Gestão de Pessoal:** Rotas completas para Criar, Atualizar e Inativar (bloqueio lógico de acesso) contas de colaboradores. |
| **CRUD** | `/admin/assets/*` | `role:admin` | **Gestão de Inventário:** Controlo total sobre Equipamentos, Salas e Categorias, utilizando *Soft Deletes* nativos do Laravel. |

---

# Arquitetura de Dados - DER

<p align="center">
  <img src="docs/Diagrama de Entidade-Relacionamento (DER).drawio.svg" alt="Diagrama de Entidade-Relacionamento" width="850">
</p>


# Estrutura Geral do Fluxo

```text
Utilizador
      │
      ▼
Criar Ticket
      │
      ▼
Estado: Aberta
      │
      ▼
Técnico inicia reparação
      │
      ▼
Estado: Em curso
      │
      ├──────────────► Pedido de orçamento (opcional)
      │                       │
      │                       ▼
      │              Administrador aprova
      │
      ▼
Técnico conclui reparação
      │
      ▼
Estado: Fechada
```

---

# Melhorias Futuras

- Notificações por email.
- Notificações em tempo real.
- Histórico completo de alterações (Audit Log).
- Dashboard com gráficos e métricas.
- Upload de fotografias das avarias.
- Sistema de comentários entre utilizador e técnico.
- Pesquisa e filtros avançados.
- Gestão de equipamentos e salas.
- Exportação de relatórios (PDF/Excel).
- API documentada com Swagger/OpenAPI.

---

# Licença

Este projeto encontra-se licenciado sob a **MIT License**.

Consulte o ficheiro **LICENSE** para mais informações.
