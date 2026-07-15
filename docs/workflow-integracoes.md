# Estrutura Geral do Fluxo e Integrações

```text
==========================================================================================
1. FLUXO DE IDENTIDADE E SEGURANÇA (Exclusivo Backoffice)
==========================================================================================

               Administrador (Menu Restrito Backoffice)
                                  │
                                  ▼
                    POST /admin/users/register
                                  │
                                  ▼
                  [Criação Controlada de Utilizadores]


==========================================================================================
2. CICLO DE VIDA DO TICKET INTELIGENTE (Workflow In-House)
==========================================================================================

         Colaborador Autenticado (Operário, Técnico ou Admin)
                                  │
                                  ▼
                            POST /tickets
                                  │
                                  ▼
               [Upload Opcional de Fotos de Evidência]
                                  │
                                  ▼
                            Estado: Aberto
                                  │
                                  ▼
                 [Invocação Automática do AIService]
             Classificação Categórica por NLP (OpenAI)
                                  │
                                  ▼
             Administrador visualiza Recomendação da IA
               PATCH /admin/tickets/{id}/atribuir
                                  │
                                  ├────────────────► [Notificação em Tempo Real via Laravel Echo]
                                  ▼
                      Técnico Inicia Intervenção
                                  │
                                  ▼
                           Estado: Em Curso ◄──────► [Sistema de Comentários / Notas Ativas]
                                  │
                                  ├────────────────► Pedido de Orçamento de Alto Custo (Opcional)
                                  │                       │
                                  │                       ▼
                                  │               SLA Suspenso Temporariamente pelo Servidor
                                  │                       │
                                  │                       ▼
                                  │               Administrador Decide (Aprovar / Recusar)
                                  │                       │
                                  │                       ▼
                                  ▼ ◄─────────────────────┘
                      Técnico Conclui Reparação 
                (Registo de Horas e Consumo de Stock)
                                  │
                                  ▼
                           Estado: Fechado ────────► [Gera Relatório PDF e Alerta por E-mail]
                                  │
                                  ▼
                 [Broadcast Síncrono via WebSockets] ────► Atualização dos Gráficos (Chart.js)
                                  │
                                  ▼
         [Registo Imutável com Histórico JSON no Audit Log Global]