# Sistema Integrado de Gestão de Manutenção

Uma plataforma web desenvolvida em **Laravel 11** para a digitalização, centralização e otimização de todo o ciclo de vida de avarias dentro do **Departamento de Manutenção** da organização. 

O sistema mitiga falhas de comunicação e paragens prolongadas de infraestruturas, tornando o fluxo de trabalho mais organizado, rápido e rastreável ao distribuir inteligência operacional entre três perfis internos: **Operador (Funcionário)**, **Técnico** e **Administrador (Diretor de Operações)**.

---

## Stack Tecnológica
* **Framework Back-End:** Laravel 11 (PHP)
* **Base de Dados Relacional:** MySQL
* **Interface Front-End:** Blade Templates + Tailwind CSS + FullCalendar v6
* **Inteligência Artificial:** Sistema de Apoio à Decisão (SAD) com motor interno de triagem (NLP)
* **Comunicação em Tempo Real:** Pusher / Laravel Echo (WebSockets)

---

## Documentação Arquitetural e de Gestão

Para consultar o planeamento detalhado, requisitos e o desenho de processos da plataforma, aceda aos documentos técnicos específicos localizados na diretoria de documentação (`/docs`):

* [Plano de Projeto](docs/plano-projeto.md) — Sprints de desenvolvimento, papéis da equipa e matriz de riscos.
* [Análise de Processos (As-Is vs To-Be)](docs/analise-processos.md) — Mapeamento do impacto operacional do software e gestão por exceção.
* [Lista Completa de Requisitos](docs/requisitos.md) — Detalhe estrito de Requisitos Funcionais (RF) e Não-Funcionais (RNF).
* [Matriz de Autorizações & Permissões (RBAC)](docs/permissoes.md) — Definição estrita de acessos por perfil de utilizador.
* [Plano de Testes](docs/plano-testes.md) — Cenários e matriz de validação lógica do sistema.
* [Diagrama de Base de Dados (DER)](docs/Diagrama_Base_Dados.drawio.svg) — Representação física e relacional (MySQL).

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

## ✔️ Estado do Projeto

Todas as melhorias anteriormente planeadas foram integradas com sucesso no núcleo do sistema. A plataforma encontra-se na sua versão estável de produção, com suporte total a auditoria, uploads, notificações síncronas/assíncronas, geração de relatórios e documentação OpenAPI viva.


---

# Licença

Este projeto encontra-se licenciado sob a **MIT License**.

Consulte o ficheiro **LICENSE** para mais informações.
