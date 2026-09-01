# Sistema Integrado de Gestão de Manutenção Avançada (SIGMA)

Uma plataforma web desenvolvida em **Laravel 11** e **PHP ^8.2** para a digitalização, centralização e otimização de todo o ciclo de vida de avarias dentro do **Departamento de Manutenção** da organização. 

O sistema mitiga falhas de comunicação e paragens prolongadas de infraestruturas industriais, tornando o fluxo de trabalho mais organizado, rápido e rastreável ao distribuir inteligência operacional entre três perfis internos: **Operador (Operário)**, **Técnico** e **Administrador (Diretor de Operações)**.

---

##  Stack Tecnológica & Requisitos de Sistema
* **Linguagem & Ambiente:** PHP `^8.2`
* **Framework Back-End:** Laravel 11.x
* **Base de Dados Relacional:** MySQL 8.0+ / MariaDB
* **Interface Front-End:** Blade Templates + Tailwind CSS + FullCalendar v6 + Chart.js
* **Inteligência Artificial:** Módulo Assistido (SAD) com motor de triagem por Processamento de Linguagem Natural (NLP) via OpenAI (`gpt-4o-mini`)
* **Comunicação em Tempo Real:** Pusher / Laravel Echo (WebSockets)

---

##  Base de Dados & Ficheiro de Entrega
* **Nome da Base de Dados esperada:** `sigma_maintenance_db` (configurável no `.env`).
* ⚠️ **Nota de Avaliação/Entrega:** A base de dados estrutural com dados de demonstração completos é entregue separadamente através do ficheiro SQL (`sigma_maintenance_bd.sql`) enviado em anexo via Microsoft Teams / e-mail. Não é obrigatório recriar os dados via `migrate:fresh --seed`, embora as *migrations* e *seeders* estejam totalmente operacionais no código-fonte.

---

##  Localização de Imagens & Recursos Multimédia
* **Imagens estáticas e diagramas:** `public/images/`
* **Anexos e uploads de evidências de avarias:** `public/uploads/` e `storage/app/public/tickets`

---

##  Documentação Arquitetural e de Gestão

Para consultar o planeamento detalhado, requisitos e o desenho de processos da plataforma, aceda aos documentos técnicos específicos localizados na diretoria de documentação (`/docs`):

### Estratégia e Gestão
* [Plano de Projeto](docs/plano-projeto.md) — Sprints, equipa e matriz de riscos.
* [Product Backlog](docs/product-backlog.md) — Lista de funcionalidades, prioridades e critérios de aceitação.
* [Análise de Processos (As-Is vs To-Be)](docs/analise-pocessos.md) — Otimização operacional e Módulo Assistido por IA.
* [Atas de Reunião](docs/atas-reuniao.md) — Registo formal de acompanhamento de equipa e sprints.

### Engenharia e Arquitetura
* [Lista de Requisitos](docs/Requisitos.md) — Requisitos Funcionais (RF) e Não-Funcionais (RNF) consolidados.
* [Matriz de Autorizações & Permissões (RBAC)](docs/permissoes.md) — Controlo estrito de acessos por perfil e rotas.
* [Arquitetura de Dados (DER)](docs/diagrama-arquitetura.md) — Modelo relacional, indexação e integridade física.
* [Fluxo Orçamental](docs/fluxo-orcamental.md) — Regras de controlo financeiro e autorização de despesas.
* [Atribuição de Prioridades](docs/atribuicao-prioridades.md) — Matriz de 4 níveis de severidade e SLA.
* [API Endpoints](docs/api-endpoints.md) — Documentação e contratos de integração com a API (Swagger UI).

### Qualidade e Operação
* [Guia do Utilizador](docs/guia-utilizador.md) — Manual de instruções passo a passo por perfil.
* [Plano de Testes](docs/Plano-Testes.md) — Cenários de QA, segurança RBAC e matriz de validação.
* [Workflow e Integrações](docs/Workflow.md) — Estrutura unificada de fluxos de dados e notificações.

---

##  Instalação e Configuração Local

### 1. Clonar o repositório
```bash
git clone [https://github.com/NyaPuma/Projeto-Final-Cesae.git](https://github.com/NyaPuma/Projeto-Final-Cesae.git)
cd Projeto-Final-Cesae