# Sistema Integrado de Gestão de Manutenção

Uma plataforma web desenvolvida em **Laravel 12** para a digitalização, centralização e otimização de todo o ciclo de vida de avarias dentro do **Departamento de Manutenção** da organização.

O sistema mitiga falhas de comunicação e paragens prolongadas de infraestruturas industriais, tornando o fluxo de trabalho mais organizado, rápido e rastreável ao distribuir inteligência operacional entre três perfis internos: **Operador (Operário)**, **Técnico** e **Administrador (Diretor de Operações)**.

---

## Stack Tecnológica
* **Framework Back-End:** Laravel 12 (PHP 8.4)
* **Base de Dados Relacional:** SQLite (desenvolvimento) / MySQL (produção)
* **Interface Front-End:** Blade Templates + Tailwind CSS + FullCalendar v6
* **Inteligência Artificial:** Módulo Assistido (SAD) com motor de triagem por Processamento de Linguagem Natural (NLP) via OpenAI
* **Comunicação em Tempo Real:** Pusher / Laravel Echo (WebSockets)
* **Arquitetura:** Clean Architecture, SOLID, DDD, Repository Pattern, Action Classes
* **Análise Estática:** PHPStan/Larastan (Level 5)
* **Formatação:** Laravel Pint

---

## Documentação Arquitetural e de Gestão

Para consultar o planeamento detalhado, requisitos e o desenho de processos da plataforma, aceda aos documentos técnicos específicos localizados na diretoria de documentação (`/docs`):

### Estratégia e Gestão
* [Plano de Projeto](docs/plano-projeto.md) — Sprints, equipa e matriz de riscos.
* [Product Backlog](docs/product-backlog.md) — Lista de funcionalidades, prioridades e critérios de aceitação.
* [Análise de Processos (As-Is vs To-Be)](docs/analise-processos.md) — Otimização operacional e Módulo Assistido por IA.

### Engenharia e Arquitetura
* [Lista de Requisitos](docs/requisitos.md) — Requisitos Funcionais (RF) e Não-Funcionais (RNF) consolidados.
* [Matriz de Autorizações & Permissões (RBAC)](docs/permissoes.md) — Controlo estrito de acessos por perfil e rotas.
* [Arquitetura de Dados (DER)](docs/diagrama-arquitetura.md) — Modelo relacional, indexação e integridade física.
* [API Endpoints](docs/api-endpoints.md) — Documentação e contratos de integração com a API.

### Qualidade e Operação
* [Guia do Utilizador](docs/guia-utilizador.md) — Manual de instruções passo a passo por perfil.
* [Plano de Testes](docs/plano-testes.md) — Cenários de QA, segurança RBAC e matriz de validação.
* [Workflow e Integrações](docs/workflow.md) — Estrutura unificada de fluxos de dados e notificações.

---

## Instalação e Configuração Local

### 1. Clonar o repositório
```bash

git clone https://github.com/NyaPuma/Projeto-Final-Cesae.git
cd Projeto-Final-Cesae


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
Para processar e-mails, notificações e exportações em segundo plano:
```bash
php artisan queue:work
```
Para executar as tarefas agendadas (ex.: verificação diária de stock baixo):
```bash
php artisan schedule:work
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

## ✔️ Estado do Projeto

O projeto foi completamente refatorado seguindo as melhores práticas de desenvolvimento moderno:

### Backend Refactoring
- **Clean Architecture:** Separação clara de camadas (Actions, Services, Repositories, DTOs)
- **SOLID Principles:** Single Responsibility, Open/Closed, Dependency Injection
- **Domain-Driven Design:** Value Objects, Enums, Domain Events
- **Repository Pattern:** Abstração de acesso a dados com Query Objects
- **Action Classes:** Classes dedicadas para casos de uso específicos
- **DTOs:** Data Transfer Objects para validação e transporte de dados
- **Observers:** Event-driven model lifecycle management
- **Caching Strategy:** Cache com invalidação automática via observers
- **Jobs:** Operações assíncronas (exportação, email, IA) processadas em fila

### Frontend Refactoring
- **Blade Components:** Sistema de componentes reutilizáveis
- **Modular CSS:** CSS organizado por responsabilidade (components, pages)
- **ES Modules:** JavaScript modularizado por feature
- **Design System:** Variáveis CSS e tokens para consistência visual
- **No Inline Code:** Eliminação completa de CSS/JS inline nas Blade views
- **Accessibility:** ARIA labels, roles, focus management, keyboard navigation
- **Responsive Design:** Layouts adaptativos para todos os breakpoints

### Quality Assurance
- **PHPStan/Larastan:** Análise estática nível máximo (Level 5)
- **Laravel Pint:** Formatação de código consistente
- **Test Suite:** Testes unitários, feature e integration
- **Security:** CSRF, XSS, SQL injection protection, RBAC

A plataforma encontra-se na sua versão estável de produção, com arquitetura enterprise-ready, código limpo e manutenível.


---

# Licença

Este projeto encontra-se licenciado sob a **MIT License**.

Consulte o ficheiro **LICENSE** para mais informações.
