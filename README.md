# Sistema de Gestão e Manutenção de Avarias em Equipamentos

Uma aplicação desenvolvida em **Laravel** para o registo, acompanhamento e gestão de avarias em equipamentos, permitindo controlar todo o ciclo de vida de um ticket de manutenção.

## Objetivo

O objetivo deste projeto é disponibilizar uma plataforma web que facilite a comunicação entre utilizadores, técnicos e administradores, tornando o processo de gestão de avarias mais organizado, rápido, rastreável e totalmente automatizado através de notificações em tempo real, auditoria completa e dashboards interativos.

---

## Product Backlog Concluído

| Prioridade | User Story (Funcionalidade) | Critérios de Aceitação / DoD Técnico |
| :--- | :--- | :--- |
| 🔴 **Crítica** | **Como:** Funcionário<br>**Quero:** reportar uma avaria num equipamento específico<br>**Para:** que a equipa de manutenção saiba o que reparar. | • Formulário de submissão com campos: Equipamento, Sala, Descrição e **Upload de fotos**.<br>• Associação automática do ID do utilizador autenticado (`Auth::id()`).<br>• Estado inicial automático como 'Aberta' com carimbo `created_at`. |
| 🔴 **Crítica** | **Como:** Técnico<br>**Quero:** alterar o estado de uma avaria ("Em Curso" / "Fechada")<br>**Para:** comunicar o progresso atualizado dos trabalhos. | • Dropdown exclusivo de transição de estados no workflow.<br>• Bloqueio de rotas via Middleware do Laravel para perfis não autorizados (403).<br>• Estado 'Fechada' exige parecer técnico, relatório final e injeta o timestamp final. |
| 🔴 **Crítica** | **Como:** Administrador<br>**Quero:** gerir o inventário de equipamentos e salas (CRUD)<br>**Para:** manter a infraestrutura física da empresa atualizada. | • CRUD completo integrado com *Soft Deletes* do Eloquent ORM.<br>• Validação no *Form Request* do Laravel impedindo números de série duplicados. |
| 🟡 **Alta** | **Como:** Administrador<br>**Quero:** consultar dashboards com métricas operacionais e gráficos<br>**Para:** avaliar a eficiência e tempos de resolução (MTTR). | • Painel dinâmico no Front-End alimentado por assets compilados via NPM (Vite) com gráficos interativos em tempo real (Chart.js).<br>• Consultas SQL otimizadas com *Eager Loading* (`with()`) no Eloquent. |
| 🟡 **Alta** | **Como:** Sistema (Automação)<br>**Quero:** monitorizar a telemetria simulada dos ativos<br>**Para:** abrir avarias preventivas automaticamente em caso de anomalia. | • Execução de rotinas em segundo plano utilizando o *Laravel Task Scheduling*.<br>• Geração autónoma de ticket na base de dados caso os limites tolerados sejam violados. |
| 🟢 **Média** | **Como:** Utilizador / Técnico<br>**Quero:** comunicar via comentários e anexar fotografias no ticket<br>**Para:** detalhar a evolução da reparação de forma clara. | • Canal de comunicação bilateral dentro do ticket.<br>• Armazenamento seguro de evidências fotográficas via Laravel Storage (Local/S3). |
| 🟢 **Média** | **Como:** Utilizador / Técnico<br>**Quero:** receber alertas imediatos por email e em tempo real<br>**Para:** saber quando um ticket muda de estado ou recebe mensagens. | • Integração com **Laravel Echo / Pusher** para notificações instantâneas no browser.<br>• Disparo de e-mails assíncronos em background utilizando *Laravel Queues*. |
| 🟢 **Média** | **Como:** Administrador<br>**Quero:** exportar dados e consultar o histórico completo de alterações<br>**Para:** auditar o sistema e emitir relatórios físicos. | • Exportação de relatórios customizados com filtros avançados para **PDF e Excel**.<br>• Registo imutável de alterações (Audit Log) que detalha quem, quando e o que foi alterado. |
| 🟢 **Média** | **Como:** Desenvolvedor / Integrador<br>**Quero:** aceder à documentação viva dos endpoints<br>**Para:** integrar outros sistemas com a plataforma de avarias. | • Documentação automatizada e interativa da API exposta via **Swagger/OpenAPI**. |

---

## 🔐 Matriz de Autorizações & Permissões (RBAC)

### 1. Utilizador Comum (Operário/Funcionário)
- **Alterar Password:** Gestão autónoma da sua segurança de acesso à plataforma.
- **Consultar Catálogo de Ativos (Apenas Leitura):** Listar salas e equipamentos ativos, utilizando a **pesquisa e filtros avançados**.
- **Abrir Ticket (Manutenção Corretiva):** Reportar uma avaria real associando sala, máquina, descrição e **upload de fotografias da avaria**.
- **Consultar os Seus Tickets:** Listagem restrita das suas avarias com suporte a filtros por estado, data e criticidade.
- **Interação por Comentários:** Enviar e receber mensagens em formato de chat com o técnico atribuído ao seu ticket.
- **Notificações:** Receção de alertas em tempo real (no browser) e por e-mail quando o seu ticket for assumido, comentado ou fechado.
- **Cancelar Ticket (Condicional):** Capacidade de anular o próprio alerta, desde que este ainda se encontre no estado inicial "Aberto".

### 2. Técnico de Manutenção
- **Alterar Password:** Gestão autónoma da sua segurança de acesso.
- **Consultar Painel de Avarias Ativas:** Visualizar a fila global de tickets com ferramentas de **pesquisa e filtros avançados** (por sala, criticidade ou tipo de equipamento).
- **Consultar Histórico de Ativos:** Acesso à ficha técnica e ao registo histórico de intervenções passadas de qualquer máquina.
- **Iniciar Reparação:** Assumir a responsabilidade de um ticket (muda para "Em Curso", inicia o SLA e envia notificação em tempo real ao funcionário).
- **Upload de Evidências:** Adicionar fotos do decorrer da reparação ou de componentes danificados para o relatório técnico.
- **Pedir Autorização Orçamental (Fluxo Excecional):** Move o ticket para "Pendente de Orçamento", suspende o SLA e anexa uma justificação financeira.
- **Encerrar Ticket:** Submeter o encerramento (estado "Fechada"), com preenchimento obrigatório das horas de mão de obra, relatório técnico final e **geração opcional de um relatório individual em PDF**.

### 3. Administrador (Diretor de Operações)
- **Gestão Total de Utilizadores:** Controlo absoluto (CRUD) sobre as contas, atribuição de Perfis (Roles) e inativação de accesses.
- **Gestão Total de Inventário, Ativos & Infraestrutura:** Operações estruturais (CRUD) sobre Equipamentos, Salas, Categorias e Localizações físicas com *Soft Deletes*.
- **Agendar Manutenções Preventivas:** Gerar ordens de trabalho proativas e planeadas cronologicamente.
- **Aprovar/Rejeitar Orçamentos:** Decidir sobre os pedidos de alto valor submetidos pelos técnicos.
- **Consultar Dashboard Analítico com Gráficos:** Acesso exclusivo a gráficos dinâmicos de barras, linhas e circulares que demonstram o MTTR, MTBF, eficiência da equipa técnica e custos gerais de manutenção.
- **Consultar Audit Log Global:** Visualizar o histórico completo de alterações do sistema (quem alterou que campo, o valor antigo e o novo valor).
- **Exportação de Relatórios Avançados:** Descarregar relatórios consolidados em formato **Excel (.xlsx)** ou **PDF** com base em filtros temporais e operacionais.
- **Aceder ao Swagger:** Consulta e teste dos endpoints através da documentação interativa da API.

---

## 🔄 Workflow & Regras de Transição de Estados e Auditoria

O ciclo de vida de uma avaria é gerido de forma estrita via Eloquent ORM. Todas as ações disparam eventos que alimentam o histórico em background através do trait `Auditable.php`, registando os utilizadores, os campos modificados e os timestamps de controlo (`opened_at`, `in_progress_at`, `closed_at`). 

Cada transição de estado ou novo comentário introduzido dispara adicionalmente um **Job assíncrono** na fila (*Queue*) para despachar notificações em tempo real via **WebSockets** e e-mails formatados.

### 📋 Detalhe das Transições e Comportamento Esperado

#### 1. De [Aberta] para [Em Curso]
* **Gatilho:** O Técnico clica em "Iniciar Reparação" no seu painel.
* **Regra de Negócio:**
  - O sistema associa o ID do técnico ao campo `tecnico_atribuido_id`.
  - Regista o timestamp em `in_progress_at` para cálculo do SLA.
  - O ticket fica bloqueado para edição por outros técnicos.
  - **Notificação:** O Funcionário recebe um alerta em tempo real e um e-mail a avisar que a reparação começou.

#### 2. De [Em Curso] para [Pendente de Orçamento] (Fluxo Excecional)
* **Gatilho:** O Técnico deteta a necessidade de peças de alto custo e clica em "Solicitar Aprovação".
* **Regra de Negócio:**
  - A justificativa financeira, estimativa de custo e o upload de uma foto da peça danificada tornam-se obrigatórios.
  - O cronómetro de tempo de resolução (SLA) é **suspenso**.
  - **Notificação:** O Administrador recebe um aviso instantâneo no seu painel analítico.

#### 3. De [Pendente de Orçamento] para [Em Curso] ou [Recusada]
* **Gatilho:** O Administrador toma uma ação sobre o orçamento pendente.
* **Regra de Negócio:**
  - **Se Aprovado:** Regressa a "Em Curso", o SLA é reativado e o técnico é notificado em tempo real para prosseguir.
  - **Se Rejeitado:** Passa para "Recusada/Cancelada", exigindo feedback descritivo do Administrador. O funcionário original é avisado por e-mail.

#### 4. De [Em Curso] para [Fechada]
* **Gatilho:** O Técnico conclui a reparação física e clica em "Encerrar Ticket".
* **Regra de Negócio:**
  - Torna-se obrigatória a introdução das horas de mão de obra e do relatório técnico.
  - O sistema injeta o timestamp em `closed_at` e calcula o MTTR.
  - **Notificação:** O Funcionário recebe um e-mail com o sumário e o relatório da reparação. O ticket é trancado para novos comentários.

#### 5. De [Aberta] para [Cancelada]
* **Gatilho:** O Funcionário decide anular o ticket por erro ou duplicação.
* **Regra de Negócio:**
  - **Condição Estrita:** Só é permitido se o ticket estiver em "Aberto". Se já estiver "Em Curso", a rota bloqueia a ação (403).

---

## Tecnologias Utilizadas

- **Laravel (Framework MVC)** - Núcleo da aplicação e APIs.
- **PHP** - Linguagem de programação Back-End.
- **Composer** - Gestão de dependências PHP.
- **MySQL** - Base de dados relacional.
- **Pusher / Laravel Echo** - Infraestrutura para notificações e atualizações em tempo real via WebSockets.
- **Laravel MediaLibrary / Storage** - Gestão e processamento do upload de fotografias.
- **DomPDF & Laravel Excel** - Motores de geração e exportação de ficheiros PDF e folhas de cálculo.
- **L5-Swagger (OpenAPI)** - Gerador automático de documentação interativa para a API.
- **Chart.js** - Biblioteca JavaScript para renderização dos gráficos nos Dashboards.
- **PHPUnit** - Testes automatizados unitários e de integração.
- **NPM / Vite** - Compilação de Assets Frontend e scripts em tempo real.

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
Copiar o ficheiro de configuração e gerar a chave:
```bash
cp .env.example .env
php artisan key:generate
```
*Nota: Configura as credenciais da Base de Dados, as chaves do Pusher/WebSockets e as configurações de e-mail (SMTP) dentro do teu `.env`.*

## 4. Executar as migrations, seeders e links de armazenamento
```bash
php artisan migrate --seed
php artisan storage:link
```

## 5. Iniciar os workers de filas e a aplicação
Para processar e-mails e notificações em segundo plano:
```bash
php artisan queue:work
```
Num novo terminal, inicia o servidor e compila os assets:
```bash
php artisan serve
npm run dev
```

---

# Executar Testes
```bash
php artisan test
```

---

# API Endpoints & Documentação Interativa

A documentação interativa completa (onde podes testar os parâmetros e ver as respostas JSON) está disponível localmente na rota pública:
👉 `http://localhost:8000/api/documentation` (Interface Swagger UI).

### 🔐 1. Autenticação & Gestão de Perfil
| Método | Endpoint | Proteção | Descrição / Comportamento |
| :--- | :--- | :--- | :--- |
| **POST** | `/api/register` | `guest` | Cria uma conta. Estado inicial: 'Funcionário'. |
| **POST** | `/api/login` | `guest` | Valida credenciais e injeta o Cookie/Token de Autenticação. |
| **POST** | `/api/logout` | `auth` | Destrói a sessão, invalida o token e limpa os cookies de forma segura. |
| **PUT** | `/api/user/password` | `auth` | Altera autonomamente a palavra-passe do utilizador autenticado. |

### 🎫 2. Fluxo de Tickets, Fotos e Comentários (Operacional)
Todos os endpoints de listagem (`GET`) suportam agora parâmetros de **pesquisa e filtros avançados** (ex: `?search=motor&status=em_curso&sala_id=5`).

| Método | Endpoint | Permissão Exigida | Regras de Negócio & Efeitos |
| :--- | :--- | :--- | :--- |
| **POST** | `/api/tickets` | `role:funcionario` | **Criar Ticket:** Valida campos, associa `Auth::id()`, permite **upload de fotos** e define estado como 'Aberta'. |
| **GET** | `/api/tickets/my` | `role:funcionario` | **Painel do Funcionário:** Retorna as suas avarias ativas e o histórico completo de tickets fechados com filtros. |
| **PUT** | `/api/tickets/{id}/cancel` | `role:funcionario` | **Cancelar Ticket:** Anula se estiver 'Aberto'. Se estiver em curso, bloqueia (403). |
| **GET** | `/api/technician/tickets/open` | `role:technician,admin`| **Fila Global:** Lista todas as avarias abertas ou preventivas prontas para triagem com filtros avançados. |
| **GET** | `/api/technician/tickets/assigned`| `role:technician` | **Os Meus Tickets:** Lista as avarias sob a responsabilidade do técnico autenticado. |
| **GET** | `/api/tickets/{id}` | `role:technician,admin`| **Detalhe Contextualizado:** Retorna o ticket, as fotos anexadas, a árvore de comentários e as últimas 3 intervenções daquela máquina. |
| **POST** | `/api/tickets/{id}/comments` | `auth` | **Sistema de Comentários:** Adiciona uma mensagem ao ticket. Dispara notificação instantânea para a contraparte. |
| **POST** | `/api/tickets/{id}/photos` | `auth` | **Upload de Fotos:** Permite anexar fotografias adicionais de evidências ao longo do ciclo de vida do ticket. |
| **PUT** | `/api/technician/tickets/{id}/start` | `role:technician` | **Iniciar Reparação:** Transita para 'Em Curso', injeta `in_progress_at` e avisa o utilizador em tempo real. |
| **PUT** | `/api/technician/tickets/{id}/request-budget`| `role:technician` | **Solicitar Orçamento:** Move para 'Pendente de Orçamento', exige valores e **suspende o SLA**. Alerta o Admin. |
| **PUT** | `/api/technician/tickets/{id}/close` | `role:technician` | **Encerrar Intervenção:** Move para 'Fechada'. Exige relatório e horas. Grava `closed_at`, calcula MTTR e envia e-mail com PDF. |

### 👑 3. Administração, Backoffice & Relatórios
| Método | Endpoint | Proteção | Descrição / Ações Estruturais |
| :--- | :--- | :--- | :--- |
| **PATCH**| `/api/admin/tickets/{id}/budget` | `role:admin` | **Decidir Orçamento:** Aprova (SLA reativa, volta a 'Em Curso') ou Rejeita (encerra o processo com feedback). |
| **POST** | `/api/admin/preventive` | `role:admin` | **Manutenção Preventiva:** Agenda e injeta uma ordem proativa diretamente na fila dos técnicos. |
| **GET** | `/api/admin/analytics` | `role:admin` | **Dashboard Analítico:** Retorna os dados agregados para os **gráficos** (MTTR, MTBF, custos e desempenho). |
| **GET** | `/api/admin/audit-logs` | `role:admin` | **Audit Log:** Retorna o histórico completo e imutável de logs e alterações efetuadas em qualquer tabela do sistema. |
| **GET** | `/api/admin/reports/export` | `role:admin` | **Exportação de Relatórios:** Gera e descarrega ficheiros consolidados em formato **Excel (.xlsx)** ou **PDF** com base em filtros. |
| **CRUD** | `/api/admin/users/*` | `role:admin` | **Gestão de Pessoal:** Controlo total sobre criação, atualização de perfis e inativação de contas de colaboradores. |
| **CRUD** | `/api/admin/assets/*` | `role:admin` | **Gestão de Inventário:** Controlo total (Filtros, Criar, Editar, Soft Delete) de Equipamentos, Salas e Categorias. |

---

# Arquitetura de Dados - DER

<p align="center">
  <img src="docs/Diagrama de Entidade-Relacionamento (DER).drawio.svg" alt="Diagrama de Entidade-Relacionamento" width="850">
</p>

# Estrutura Geral do Fluxo e Integrações

```text
       Utilizador (Abre Ticket + Upload de Fotos)
                         │
                         ▼
                   Estado: Aberta ───► [Dispara Notificação em Tempo Real ao Técnico]
                         │
                         ▼
              Técnico inicia reparação
                         │
                         ▼
                  Estado: Em curso ◄───► [Sistema de Comentários / Chat Ativo]
                         │
                         ├──────────────► Pedido de orçamento (opcional)
                         │                     │
                         │                     ▼
                         │               Administrador aprova/recusa (Dashboard/Gráficos)
                         │                     │
                         ▼ ◄───────────────────┘
              Técnico conclui reparação
                         │
                         ▼
                  Estado: Fechada ───► [Gera Relatório PDF / Envia E-mail Assíncrono]
                         │
                         ▼
       [Registo imutável guardado no Audit Log Global]
```

---

## ✔️ Estado do Projeto

Todas as melhorias anteriormente planeadas foram integradas com sucesso no núcleo do sistema. A plataforma encontra-se na sua versão estável de produção, com suporte total a auditoria, uploads, notificações síncronas/assíncronas, geração de relatórios e documentação OpenAPI viva.

---

# Licença

Este projeto encontra-se licenciado sob a **MIT License**.

Consulte o ficheiro **LICENSE** para mais informações.
