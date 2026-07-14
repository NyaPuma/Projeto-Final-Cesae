# Atas de Reunião e Decisões Técnicas

Este documento regista as decisões cruciais, a evolução das *sprints* e a resolução de impedimentos técnicos encontrados durante o desenvolvimento do sistema.

---

## Log de Reuniões

### Reunião #01: Definição da Stack e Arquitetura
* **Data:** [Inserir Data]
* **Decisões:** 
    * Escolha de Laravel 11 pelo ecossistema de segurança e facilidade em lidar com filas de espera.
    * Decisão de usar Blade Templates + Tailwind CSS pela agilidade de *prototipagem*.
* **Impedimentos:** Dificuldade inicial na configuração do `Laravel Echo` com o Pusher.
* **Resolução:** Utilização de documentação oficial e revisão das variáveis de ambiente (`.env`).

### Reunião #02: Refinamento dos Processos (As-Is vs To-Be)
* **Data:** [Inserir Data]
* **Decisões:** 
    * Mapeamento do fluxo de manutenção para "Gestão por Exceção" (apenas eventos críticos disparam tickets).
    * Definição dos três perfis (Operador, Técnico, Administrador) com isolamento estrito de rotas (RBAC).
* **Notas:** Identificou-se a necessidade de um sistema de "Orçamento Excecional" para evitar paragens injustificadas por falta de peças.

### Reunião #03: Desenvolvimento e Integração
* **Data:** [Inserir Data]
* **Decisões:**    
    * Implementação dos *Service Providers* para o motor de IA (NLP) para manter os controladores limpos (*Slim Controllers*).
* **Impedimentos:** Erros de permissão de escrita em diretórios de *storage*.
* **Resolução:** Execução do comando `php artisan storage:link` e ajuste de permissões de pasta.

### Reunião #04: Revisão de Qualidade e Documentação
* **Data:** [Inserir Data]
* **Decisões:**
    * Padronização de toda a documentação na pasta `/docs` utilizando Markdown.
    * Criação do guião de testes para garantir a robustez das funcionalidades críticas.
* **Estado Final:** Sistema estável, documentado e com testes unitários configurados (`php artisan test`).

---

## Dica de Equipa
Sempre que encontrarem um erro complexo durante o código que vos tire 1 ou 2 horas de trabalho, adicionem uma pequena linha aqui nas Atas: *"Erro: X | Resolução: Y"*. Isto é **ouro** para o júri, pois prova que vocês souberam depurar (debugar) o vosso próprio código!