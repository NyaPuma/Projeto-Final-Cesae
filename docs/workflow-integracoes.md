# Overall Workflow Structure and Integrations

```text
==========================================================================================
1. IDENTITY AND SECURITY WORKFLOW (Backoffice Exclusive)
==========================================================================================

               Administrator (Restricted Backoffice Menu)
                                  │
                                  ▼
                    POST /admin/users/register
                                  │
                                  ▼
                  [Controlled User Creation]


==========================================================================================
2. SMART TICKET LIFE CYCLE (In-House Workflow)
==========================================================================================

         Authenticated Employee (Factory Worker, Technician or Admin)
                                  │
                                  ▼
                            POST /tickets
                                  │
                                  ▼
                [Optional Upload of Evidence Photos]
                                  │
                                  ▼
                           Status: Open
                                  │
                                  ▼
                 [Automatic AIService Invocation]
             Categorical Classification via NLP (OpenAI)
                                  │
                                  ▼
              Administrator views the AI Recommendation
                PATCH /admin/tickets/{id}/atribuir
                                  │
                                  ├────────────────► [Real-Time Notification via Laravel Echo]
                                  ▼
                      Technician Starts Intervention
                                  │
                                  ▼
                        Status: In Progress ◄──────► [Comments System / Active Notes]
                                  │
                                  ├────────────────► High-Cost Budget Request (Optional)
                                  │                       │
                                  │                       ▼
                                  │               SLA Temporarily Suspended by the Server
                                  │                       │
                                  │                       ▼
                                  │               Administrator Decides (Approve / Reject)
                                  │                       │
                                  │                       ▼
                                  ▼ ◄─────────────────────┘
                      Technician Completes Repair 
                (Hours Log and Stock Consumption)
                                  │
                                  ▼
                          Status: Closed ────────► [Generates PDF Report and Email Alert]
                                  │
                                  ▼
                 [Synchronous Broadcast via WebSockets] ────► Chart Updates (Chart.js)
                                  │
                                  ▼
         [Immutable Record with JSON History in the Global Audit Log]
