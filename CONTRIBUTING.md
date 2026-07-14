# Normas de Contribuição (CONTRIBUTING)

Este repositório é um projeto colaborativo. Para garantir a organização, a qualidade do código e a estabilidade da plataforma, todos os membros devem seguir estas normas de contribuição.

---

## 1. Gestão de Branches
* **`main`**: Ramo de produção. Nunca faça `push` direto para este ramo.
* **`develop`**: Ramo principal de integração. É aqui que o código deve ser fundido (*merge*) após testes.
* **`feature/nome-da-funcionalidade`**: Ramos de trabalho individual. Exemplo: `feature/sistema-de-alertas`.

## 2. Padrão de Commits (Conventional Commits)
Para manter o histórico legível, cada mensagem de commit deve seguir este formato:
`<tipo>(<âmbito>): <descrição>`

* **`feat:`** (Funcionalidade) - Adição de algo novo.
* **`fix:`** (Correção) - Correção de um bug.
* **`docs:`** (Documentação) - Alterações em ficheiros `.md`.
* **`refactor:`** (Refatoração) - Melhoria de código que não adiciona funcionalidades nem corrige bugs.
* **`style:`** (Estilo) - Alterações de formatação (sem impacto na lógica).

**Exemplos:**
* `feat(auth): implementar sistema de login com RBAC`
* `fix(dashboard): corrigir gráfico de MTTR`
* `docs(readme): atualizar instruções de instalação`

## 3. Fluxo de Trabalho (Workflow)
1. Antes de começar, garante que tens a última versão: `git pull origin develop`.
2. Cria um novo ramo para a tua tarefa: `git checkout -b feature/nome-da-task`.
3. Desenvolve, testa localmente com `php artisan test` e faz o commit.
4. Faz o `push` do teu ramo: `git push origin feature/nome-da-task`.
5. Abre um *Pull Request* para o ramo `develop` para revisão da equipa.

## 4. Revisão de Código
* Antes de fundir (*merge*) qualquer código, outro elemento da equipa deve validar se:
    * O código segue as normas PSR.
    * Os testes automatizados estão a passar.
    * A funcionalidade resolve o problema descrito no Backlog.