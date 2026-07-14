# Análise de Processos: Mapeamento As-Is vs To-Be

Este documento descreve a transição operacional entre o modelo de gestão reativo tradicional (manual) e o novo fluxo automatizado inteligente implementado na plataforma.

---

## 1. O Processo Atual: Mapeamento "As-Is" (O Problema)
No cenário analógico ou semi-digitalizado atual, o fluxo de correção de uma avaria é fragmentado e ineficiente:

* **Deteção Reativa:** Um equipamento crítico falha (ex: uma máquina para por sobreaquecimento). O operário da sala pode demorar minutos ou horas a notar a quebra de rendimento.
* **Reporte Disperso:** O operário tenta contactar a manutenção enviando um e-mail, telefonando ou deixando uma nota em papel. A informação perde-se frequentemente ou chega sem detalhes técnicos (ex: "a máquina não liga").
* **Triagem Manual:** O Diretor de Operações recebe o alerta de forma informal. Precisa de consultar manualmente quais os técnicos que dominam aquela especialidade e quem tem menos trabalho acumulado na semana para efetuar o despacho.
* **Diagnóstico às Cegas:** O técnico desloca-se ao local para perceber o problema. Descobre que precisa de uma peça específica, regressa ao armazém para validar o stock e, se for de alto custo, tem de procurar o administrador para pedir autorização verbal.
* **Fecho Indocumentado:** Após a reparação, os tempos de paragem (SLA) e os custos associados não são registados ou ficam guardados numa folha de Excel isolada, impedindo qualquer análise estatística futura.

---

## 2. O Processo Proposto: Mapeamento "To-Be" (A Solução)
Com a introdução da plataforma e do processamento de telemetria em tempo real, o fluxo transforma-se numa operação otimizada e inteligente:

### Fluxo de Manutenção Preventiva (Via Telemetria)
* **Monitorização Contínua:** O sistema analisa em background os fluxos de dados de telemetria enviados pelos ativos (*Stream* de Dados). Leituras normais não sobrecarregam a base de dados MySQL.
* **Deteção Automatizada por Exceção:** No milissegundo em que um limite crítico é violado (ex: temperatura > 80°C), o motor do sistema deteta a anomalia e injeta automaticamente um ticket na tabela `Avarias`.
* **Alerta Instantâneo:** O ticket aparece de imediato na Agenda dos técnicos (`FullCalendar v6`) e os alertas disparam em tempo real via WebSockets (Pusher), sem intervenção humana.

### Fluxo de Resolução Assistida (Workflow com IA)
* **Triagem e Recomendação Inteligente:** Ao abrir o incidente, o Administrador é apoiado pelo `AIService`. O sistema analisa o texto livre da avaria (NLP), define a gravidade e sugere fundamentadamente o técnico ideal com base na sua matriz de especialidades e carga de trabalho atual.
* **Diagnóstico Prescritivo:** O técnico assume o ticket (o estado muda para "Em Curso" e tranca a rota). A IA cruza o incidente com as intervenções passadas daquela máquina e prescreve quais as peças com maior probabilidade de falha. O técnico desloca-se ao local com o material correto.
* **Encerramento Estruturado:** Ao fechar o ticket, o sistema obriga à inserção de horas e custos, calcula o MTTR e atualiza os dashboards com gráficos dinâmicos (`Chart.js`) para análise da Direção.

---

## 3. Tabela Comparativa de Impacto Operacional

| Dimensão Analisada | Cenário Atual (As-Is) | Cenário Futuro (To-Be) |
| :--- | :--- | :--- |
| **Deteção de Falhas** | Manual, tardia e dependente do olhar humano. | **Automatizada em tempo real** através de limites de telemetria. |
| **Abertura de Incidentes** | Dispersa (e-mail, chamadas, papel) e sem dados técnicos. | **Centralizada na plataforma** com classificação automática (NLP). |
| **Alocação de Técnicos** | Subjetiva, baseada no instinto do administrador. | **Otimizada por IA** (cruzamento de carga de trabalho e competências). |
| **Tempo de Diagnóstico** | Elevado (múltiplas deslocações e validações de stock). | **Prescritivo** (sugestão de peças baseada no histórico do ativo). |
| **Auditoria e Métricas** | Inexistente. Perda de dados históricos de custos. | **Imutável**. Logs de auditoria globais e dashboards estatísticos. |