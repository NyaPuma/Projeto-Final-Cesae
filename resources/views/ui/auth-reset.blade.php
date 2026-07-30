@php($resetToken = $token)

<x-ui.auth.shell
    data-page="auth-reset"
    :title="__('Recuperação de Password')"
    :description="__('Introduza o seu email e a nova palavra-passe. O token de recuperação foi enviado para o seu email.')"
    :highlights="[
        ['title' => __('Token seguro'), 'description' => __('O token expira em 60 minutos por segurança.')],
    ]"
>
    <x-ui.auth.form-header
        :eyebrow="__('Nova password')"
        :title="__('Repor palavra-passe')"
        :description="__('Escolha uma password forte com pelo menos 8 caracteres.')"
    />

    <x-ui.auth.message id="msg" class="mb-6" />

    <form id="resetForm" class="space-y-5">
        <input type="hidden" name="token" value="{{ $resetToken }}">

        <x-ui.auth.text-field
            id="resetEmail"
            name="email"
            :label="__('Email')"
            type="email"
            autocomplete="email"
            :required="true"
            placeholder="utilizador@empresa.pt"
        />

        <x-ui.auth.password-field
            id="resetPassword"
            name="password"
            :label="__('Nova Password')"
            autocomplete="new-password"
            :required="true"
        />

        <x-ui.auth.password-field
            id="resetPasswordConfirmation"
            name="password_confirmation"
            :label="__('Confirmar Password')"
            autocomplete="new-password"
            :required="true"
        />

        <x-ui.auth.submit-button :label="__('Repor password')" />

        <a href="{{ route('ui.login') }}" class="block text-center text-sm font-semibold text-primary transition hover:opacity-70">
            {{ __('Voltar ao login') }}
        </a>
    </form>
</x-ui.auth.shell>
