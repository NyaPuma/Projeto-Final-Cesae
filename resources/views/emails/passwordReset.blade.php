<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de Credenciais</title>
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

        /* Contentor Centralizado */
        .wrapper {
            width: 100%;
            background-color: #fafafa;
            padding: 40px 20px;
        }
        .container {
            max-width: 460px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #e3e3e0;
            border-radius: 8px;
            padding: 32px;
        }

        /* Tipografia Editorial Sóbria */
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
            line-height: 1.6;
        }

        /* Botão de Ação Sólido Alinhado com o Tema */
        .btn-container {
            margin: 28px 0;
            text-align: center;
        }
        .btn-action {
            display: inline-block;
            background-color: #f59e0b;
            color: #ffffff !important;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 6px;
            letter-spacing: -0.01em;
        }

        /* Notas de Segurança e Telemetria */
        .security-box {
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
        .security-label {
            color: #706f6c;
            font-weight: 600;
        }

        /* Fallback de URL Puro para Clientes Restritos */
        .link-fallback {
            font-size: 11px;
            color: #706f6c;
            line-height: 1.5;
            word-break: break-all;
            margin-top: 24px;
        }
        .link-fallback a {
            color: #f59e0b;
            text-decoration: underline;
        }

        /* Rodapé de Isenção */
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
                {{-- Identificador de Contexto --}}
                <div class="header-badge">Segurança de Conta</div>
                <h1 class="title">Pedido de Nova Password</h1>

                <p class="text-body">Olá,</p>
                <p class="text-body">Recebemos uma solicitação para redefinir as credenciais de acesso associadas à sua conta. Para prosseguir com a alteração, utilize o botão de verificação abaixo:</p>

                {{-- Ação Principal Segura --}}
                <div class="btn-container">
                    <a href="{{ $url ?? '#' }}" class="btn-action" target="_blank">
                        Redefinir Password
                    </a>
                </div>

                {{-- Bloco de Segurança Normativo --}}
                <div class="security-box">
                    <span class="security-label">VALIDADE DO LINK:</span> Este link expira em {{ config('auth.passwords.'.config('auth.defaults.passwords').'.expire') ?? 60 }} minutos.<br>
                    <span class="security-label">AVISO:</span> Se não solicitou esta alteração, nenhuma ação adicional é necessária e a sua password atual permanecerá segura.
                </div>

                {{-- Fallback de URL Puro para Clientes Restritos --}}
                <p class="link-fallback">
                    Se tiver problemas com o botão acima, copie e cole o URL seguinte no seu navegador:<br>
                    <a href="{{ $url ?? '#' }}">{{ $url ?? '#' }}</a>
                </p>

                {{-- Rodapé Sistémico --}}
                <div class="footer">
                    <p style="margin: 0; text-transform: uppercase;">Esta é uma notificação compulsória de segurança • Não responda</p>
                </div>
            </td>
        </tr>
    </table>
</div>

</body>
</html>
