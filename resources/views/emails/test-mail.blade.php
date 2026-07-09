<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste de Configuração de Email</title>
    <style>
        /* Reset e Regras de Renderização Segura */
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

        /* Estrutura de Contentor Fluido */
        .wrapper {
            width: 100%;
            background-color: #fafafa;
            padding: 40px 20px;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #e3e3e0;
            border-radius: 8px;
            padding: 32px;
        }

        /* Tipografia de Alta Precisão */
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
        .text-body {
            font-size: 13px;
            color: #1b1b18;
            margin: 0 0 16px 0;
        }

        /* Bloco de Telemetria e Diagnóstico */
        .telemetry-box {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            font-size: 11px;
            color: #555450;
            line-height: 1.6;
            background-color: #fafafa;
            border: 1px solid #e3e3e0;
            border-radius: 6px;
            padding: 14px;
            margin: 24px 0;
        }
        .telemetry-label {
            color: #706f6c;
            font-weight: 600;
        }

        /* Rodapé de Isenção */
        .footer {
            margin-top: 24px;
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
                {{-- Identificador de Contexto --}}
                <div class="header-badge">Verificação de Serviço</div>
                <h1 class="title">Ligação Estabelecida com Sucesso</h1>

                <p class="text-body">Olá, {{ $recipientName ?? 'Utilizador' }}.</p>
                <p class="text-body" style="margin-bottom: 0;">Este é um disparo de validação estrutural enviado para confirmar a correta integração, credenciação e entrega de mensagens na plataforma.</p>

                {{-- Metadados de Diagnóstico do Sistema --}}
                <div class="telemetry-box">
                    <span class="telemetry-label">CANAL TRÁFEGO:</span> Mailgun API Driver<br>
                    <span class="telemetry-label">ESTADO:</span> Conexão Ativa / Válida<br>
                    <span class="telemetry-label">DATA EMISSÃO:</span> {{ now()->format('Y-m-d H:i:s') }} UTC
                </div>

                {{-- Rodapé Sistémico --}}
                <div class="footer">
                    <p style="margin: 0; text-transform: uppercase;">Mensagem automática de diagnóstico • Não responda a este endereço</p>
                </div>
            </td>
        </tr>
    </table>
</div>

</body>
</html>
