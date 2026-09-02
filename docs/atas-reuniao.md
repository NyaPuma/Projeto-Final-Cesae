# Atas de Reunião e Decisões Técnicas

Este documento regista as decisões cruciais, a evolução das *sprints* e a resolução de impedimentos técnicos encontrados durante o desenvolvimento do sistema SIGMA — Sistema Integrado de Gestão de Manutenção Avançada.

---

## Log de Reuniões

### Reunião #01: Definição da Stack e Arquitetura
* **Data:** 01 de Julho de 2026
* **Decisões:** 
    * Escolha de Laravel 11 pelo ecossistema de segurança e facilidade em lidar com filas de espera.
    * Decisão de usar Blade Templates + Tailwind CSS pela agilidade de *prototipagem*.
* **Impedimentos:** Dificuldade inicial na configuração do `Laravel Echo` com o Pusher.
* **Resolução:** Utilização de documentação oficial e revisão das variáveis de ambiente (`.env`).

### Reunião #02: Refinamento dos Processos (As-Is vs To-Be)
* **Data:** 07 de Julho de 2026
* **Decisões:** 
    * Mapeamento do fluxo de manutenção para "Gestão por Exceção" (apenas eventos críticos disparam tickets).
    * Definição dos perfis de acesso com isolamento estrito de rotas (RBAC).
* **Notas:** Identificou-se a necessidade de um sistema de "Orçamento Excecional" para evitar paragens injustificadas por falta de peças.

### Reunião #03: Desenvolvimento e Integração
* **Data:** 17 de Julho de 2026
* **Decisões:**    
    * Implementação dos *Service Providers* para o motor de IA (NLP) para manter os controladores limpos (*Slim Controllers*).
* **Impedimentos:** Erros de permissão de escrita em diretórios de *storage*.
* **Resolução:** Execução do comando `php artisan storage:link` e ajuste de permissões de pasta.

### Reunião #04: Revisão de Qualidade e Documentação
* **Data:** 24 de Julho de 2026
* **Decisões:**
    * Padronização de toda a documentação na pasta `/docs` utilizando Markdown.
    * Criação do guião de testes para garantir a robustez das funcionalidades críticas.
* **Estado Final:** Sistema estável, documentado e com testes unitários configurados (`php artisan test`).

### Reunião #05: Sprint de Fecho de Julho (Consolidação Core & Back-End)
* **Data:** 31 de Julho de 2026
* **Decisões:**
    * Oficialização da designação **SIGMA** e harmonização documental.
    * Separação estrita entre custo estimado e custo real nas autorizações orçamentais, incluindo transição para estado *Pendente de Orçamento*.
    * Restrição da vista "Meus Tickets" exclusivamente ao perfil de técnico.
* **Impedimentos:** Erro HTTP 500 no `AnalyticsController`.
* **Resolução:** Correção do alias da rota `/ui/reports` e introdução de tratamento defensivo de nulos no Eloquent.

### Reunião #06: Melhorias de Usabilidade e Funcionalidades de Campo (Agosto)
* **Data:** 02 de Setembro de 2026
* **Decisões:**
    * Implementação e integração da leitura e geração de **QR Codes** (modal no front-end) para salas e equipamentos.
    * Lançamento do **Centro de Ajuda Dinâmico / Guia Rápido** adaptado ao perfil do utilizador diretamente na interface.
    * Desenvolvimento de filtros dinâmicos de tickets por sala.
* **Impedimentos:** Erros na contagem e exibição de avarias ativas no módulo de salas.
* **Resolução:** Correção dos identificadores e consultas agregadas no painel de gestão de salas (`rooms`).
* **Estado Final da Sprint:** Sincronização final da documentação técnica e relatórios na pasta `docs/` com o código-fonte em produção.

---

## Dica de Equipa
Sempre que encontrarem um erro complexo durante o código que vos tire 1 ou 2 horas de trabalho, adicionem uma pequena linha aqui nas Atas: *"Erro: X | Resolução: Y"*.