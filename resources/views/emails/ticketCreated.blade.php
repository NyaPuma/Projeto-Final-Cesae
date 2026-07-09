<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificação de Sistema</title>
    <style>
        /* Reset e Estilos Globais de Renderização */
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.5;
            color: #1b1b18;
            background-color: #fafafa;
            -webkit-font-smoothing: antialiased;
        }
        table {
            border-collapse: collapse;
            border-spacing: 0;
        }
        td {
            vertical-align: top;
        }

        /* Contentor Principal de Alta Precisão */
        .wrapper {
            width: 100%;
            background-color: #fafafa;
            padding: 40px 20px;
        }
        .container {
            max-width: 560px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #e3e3e0;
            border-radius: 8px;
            padding: 32px;
        }

        /* Tipografia e Estrutura Sóbria */
        .header-badge {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #706f6c;
            margin-bottom: 8px;
        }
        .title {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: #1b1b18;
            margin: 0 0 16px 0;
        }
        .greeting {
            font-size: 13px;
            color: #1b1b18;
            margin: 0 0 16px 0;
        }

        /* Matriz de Dados (Key-Value) */
        .details-table {
            width: 100%;
            margin: 24px 0;
            border-top: 1px solid #e3e3e0;
        }
        .data-row td {
            padding: 12px 0;
            border-bottom: 1px solid #f0f0ef;
            font-size: 12px;
        }
        .label {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #706f6c;
            width: 120px;
        }
        .value {
            color: #1b1b18;
            font-weight: 500;
        }
        .description-box {
            font-size: 12px;
            color: #555450;
            line-height: 1.6;
            background-color: #fafafa;
            border: 1px solid #e3e3e0;
            border-radius: 6px;
            padding: 12px;
            margin-top: 6px;
        }

        /* Botão Call to Action (Estilo Inline Seguro para Email) */
        .btn-container {
            margin: 28px 0;
            text-align: center;
        }
        .btn-action {
            display: inline-block;
            background-color: #f59e0b;
            color: #ffffff !important;
            text-decoration: none;
            padding: 10px 20px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 6px;
            letter-spacing: 0.02em;
        }

        /* Rodapé e Alertas Utilitários */
        .notice {
            font-size: 12px;
            color: #706f6c;
            margin: 20px 0 0 0;
        }
        .footer {
            margin-top: 32px;
            border-top: 1px solid #f0f0ef;
            padding-top: 16px;
            font-size: 10px;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            color: #a1a09a;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <table role="presentation" class="container">
        <tr>
            <td>
                {{-- Prefixo de Contexto Técnico --}}
                <div class="header-badge">Notificação de Incidente</div>
                <h1 class="title">Nova Avaria Registada #{{ $ticket->id }}</h1>

                <p class="greeting">Olá,</p>
                <p class="greeting" style="margin-bottom: 0;">Foi submetido um novo registo de avaria no sistema com os seguintes parâmetros operacionais:</p>

                {{-- Matriz Estruturada de Metadados --}}
                <table role="presentation" class="details-table">
                    <tr class="data-row">
                        <td class="label">Título</td>
                        <td class="value" style="font-weight: 600; color: #1b1b18;">{{ $ticket->title }}</td>
                    </tr>
                    <tr class="data-row">
                        <td class="label">Equipamento</td>
                        <td class="value">{{ $ticket->equipment?->name ?? 'Não especificado' }}</td>
                    </tr>
                    <tr class="data-row">
                        <td class="label">Sala / Espaço</td>
                        <td class="value">{{ $ticket->room?->name ?? 'Não especificada' }}</td>
                    </tr>
                    <tr class="data-row">
                        <td class="label">Prioridade</td>
                        <td class="value" style="font-family: ui-monospace, monospace; font-size: 11px; font-weight: 700; color: {{ match(strtolower($ticket->priority)) { 'alta', 'critica', 'crítica' => '#ef4444', 'media', 'média' => '#f59e0b', default => '#6b7280' } }};">
                            [{{ strtoupper($ticket->priority) }}]
                        </td>
                    </tr>
                    <tr class="data-row">
                        <td class="label">Registado Por</td>
                        <td class="value">{{ $ticket->user?->name ?? 'Utilizador do Sistema' }}</td>
                    </tr>
                    <tr class="data-row">
                        <td class="label">Data de Entrada</td>
                        <td class="value" style="font-family: ui-monospace, monospace; font-size: 11px;">
                            {{ $ticket->created_at?->format('Y-m-d H:i') ?? now()->format('Y-m-d H:i') }}
                        </td>
                    </tr>
                    {{-- Bloco Isolado para Descrições Longas --}}
                    <tr>
                        <td colspan="2" style="padding: 16px 0 4px 0;">
                            <div class="label" style="margin-bottom: 2px;">Descrição do Sintoma</div>
                            <div class="description-box">
                                {{ $ticket->description }}
                            </div>
                        </td>
                    </tr>
                </table>

                {{-- Botão de Acesso Direto --}}
                <div class="btn-container">
                    <a href="{{ url('/tickets/' . $ticket->id) }}" class="btn-action">
                        Ver Detalhes do Ticket
                    </a>
                </div>

                <p class="notice">O ciclo de vida, atribuição de técnicos e auditoria deste ticket podem ser geridos diretamente através do painel de controlo principal.</p>

                {{-- Rodapé Institucional --}}
                <div class="footer">
                    <p style="margin: 0; uppercase">Mensagem automática de sistema • Não responda a este endereço</p>
                </div>
            </td>
        </tr>
    </table>
</div>

</body>
</html>
