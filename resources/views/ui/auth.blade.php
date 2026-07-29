<x-ui.auth.shell
    :title="__('Gestão de Avarias')"
    :description="__('Aceda ao painel de operação com um ambiente profissional, simples e focado na autenticação.')"
    :highlights="[
        ['title' => __('Acesso direto'), 'description' => __('Utilize as suas credenciais para entrar no painel principal.')],
        ['title' => __('Sessão protegida'), 'description' => __('A autenticação é processada de forma segura e imediata.')],
    ]"
>
    <x-ui.auth.form-header
        :eyebrow="__('Iniciar sessão')"
        :title="__('Bem-vindo de volta')"
        :description="__('Introduza o seu email e palavra-passe para continuar.')"
    />

    <x-ui.auth.message id="msg" class="mb-6" />

    <form id="loginForm" class="space-y-5">
        <x-ui.auth.text-field
            id="loginEmail"
            name="email"
            :label="__('Email')"
            type="email"
            autocomplete="email"
            :required="true"
            placeholder="utilizador@empresa.pt"
        />

        <x-ui.auth.password-field
            id="loginPassword"
            name="password"
            :label="__('Palavra-passe')"
            autocomplete="current-password"
            :required="true"
            :toggle="true"
        />

        <x-ui.auth.submit-button :label="__('Entrar no sistema')" />
    </form>
</x-ui.auth.shell>
