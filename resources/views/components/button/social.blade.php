{{--
|--------------------------------------------------------------------------
| Social Button Component (Otimizado)
|--------------------------------------------------------------------------
|
| Botão otimizado para autenticação social.
| • Inclui ícones oficiais das marcas prontos a usar.
| • Garante segurança avançada para redirecionamentos externos de OAuth.
| • Estrutura de tags dinâmica e limpa para o teu IDE.
|
--}}

@props([
    'provider' => 'google',
    'href' => null,
    'label' => null,
    'icon' => null, // Permite substituir o ícone padrão se necessário
    'size' => 'md',
    'disabled' => false,
    'fullWidth' => false,
])

@php
    // Define se o elemento final será um link de redirecionamento ou um botão
    $tag = $href ? 'a' : 'button';

    // Rótulos padrão internacionais para manter a consistência da UI
    $providerLabels = [
        'google' => 'Continuar com Google',
        'github' => 'Continuar com GitHub',
        'microsoft' => 'Continuar com Microsoft',
        'apple' => 'Continuar com Apple',
        'facebook' => 'Continuar com Facebook',
        'discord' => 'Continuar com Discord',
        'linkedin' => 'Continuar com LinkedIn',
    ];

    // Biblioteca de SVGs Oficiais embutida no componente
    $defaultIcons = [
        'google' => '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z" fill="#EA4335"/></svg>',
        'github' => '<svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.831.092-.646.35-1.086.636-1.336-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.579.688.481C19.138 20.161 22 16.416 22 12c0-5.523-4.477-10-10-10z"/></svg>',
        'microsoft' => '<svg viewBox="0 0 23 23" xmlns="http://www.w3.org/2000/svg"><path fill="#f35325" d="M0 0h11v11H0z"/><path fill="#81bc06" d="M12 0h11v11H12z"/><path fill="#05a6f0" d="M0 12h11v11H0z"/><path fill="#ffba08" d="M12 12h11v11H12z"/></svg>',
        'apple' => '<svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M12.152 6.897c-.948 0-2.415-1.078-3.96-1.04-2.04.029-3.91 1.183-4.961 3.014-2.117 3.675-.54 9.103 1.51 12.06 1.005 1.45 2.187 3.068 3.761 3.008 1.516-.06 2.09-.977 3.921-.977 1.82 0 2.347.977 3.931.947 1.615-.03 2.647-1.46 3.633-2.899 1.137-1.65 1.61-3.25 1.64-3.33-.03-.01-3.136-1.199-3.165-4.785-.03-2.99 2.441-4.43 2.55-4.49-1.397-2.05-3.555-2.27-4.314-2.318-2.01-.16-3.975 1.22-4.945 1.22zm2.495-4.547c.813-.98 1.353-2.35 1.203-3.71-1.17.05-2.585.78-3.424 1.76-.732.85-1.373 2.24-1.202 3.58 1.294.1 2.61-.65 3.423-1.63z"/></svg>',
        'facebook' => '<svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c4.56-.93 8-4.96 8-9.75z"/></svg>',
        'discord' => '<svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057 19.9 19.9 0 0 0 5.993 3.03.078.078 0 0 0 .084-.028c.462-.63.874-1.295 1.226-1.994.021-.041.001-.09-.041-.106a13.094 13.094 0 0 1-1.873-.894.077.077 0 0 1-.008-.128c.126-.093.252-.19.372-.287a.075.075 0 0 1 .077-.011c3.92 1.793 8.18 1.793 12.061 0a.073.073 0 0 1 .078.009c.12.099.246.195.373.289a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.894.077.077 0 0 1-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03a.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.03zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.956-2.419 2.156-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.956 2.418-2.156 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.955-2.419 2.156-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.946 2.418-2.156 2.418z"/></svg>',
        'linkedin' => '<svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>',
    ];

    // Configurações de atributos seguros e dinâmicos
    $customAttributes = [];

    if ($tag === 'button') {
        $customAttributes['type'] = 'button';
        if ($disabled) {
            $customAttributes['disabled'] = true;
        }
    } else {
        // Fallback seguro de acessibilidade para links desativados
        if ($disabled) {
            $customAttributes['aria-disabled'] = 'true';
            $customAttributes['role'] = 'button';
            $customAttributes['tabindex'] = '-1';
        } else {
            $customAttributes['href'] = $href;
            // Segurança fundamental contra ataques de Tabnabbing em OAuth externo
            $customAttributes['rel'] = 'noopener noreferrer';
        }
    }

    // Seleciona o ícone customizado ou faz fallback automático para o oficial
    $selectedIcon = $icon ?? ($defaultIcons[$provider] ?? null);
@endphp

<{{ $tag }}
    {{ $attributes->merge($customAttributes)->class([
        'ui-social-button',
        "ui-social-button--{$provider}",
        "ui-social-button--{$size}",
        'ui-social-button--block' => $fullWidth,
        'ui-social-button--disabled' => $disabled,
    ]) }}
>
    {{-- Renderização Inteligente do Ícone --}}
    @if($selectedIcon)
        <span class="ui-social-button__icon" aria-hidden="true">
            {!! $selectedIcon !!}
        </span>
    @endif

    {{-- Rótulo descritivo do botão --}}
    <span class="ui-social-button__label">
        {{ $label ?? ($providerLabels[$provider] ?? ucfirst($provider)) }}
    </span>
</{{ $tag }}>
