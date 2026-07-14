
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