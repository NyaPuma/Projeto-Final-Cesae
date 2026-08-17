@php($resetToken = $token)

<x-ui.auth.shell
    data-page="auth-reset"
    :title="__('auth.Recuperação de Password')"
    :description="__('auth.Introduza o seu email e a nova palavra-passe. O token de recuperação foi enviado para o seu email.')"
    :highlights="[
        ['title' => __('common.Token seguro'), 'description' => __('common.O token expira em 60 minutos por segurança.')],
    ]"
>
    <x-ui.auth.form-header
        :eyebrow="__('auth.Nova password')"
        :title="__('auth.Repor palavra-passe')"
        :description="__('auth.Escolha uma password forte com pelo menos 8 caracteres.')"
    />

    <x-ui.auth.message id="msg" class="mb-6" />

    <form id="resetForm" class="space-y-5">
        <input type="hidden" name="token" value="{{ $resetToken }}">

        <x-ui.auth.text-field
            id="resetEmail"
            name="email"
            :label="__('common.Email')"
            type="email"
            autocomplete="email"
            :required="true"
            placeholder="utilizador@empresa.pt"
        />

        <x-ui.auth.password-field
            id="resetPassword"
            name="password"
            :label="__('auth.Nova Password')"
            autocomplete="new-password"
            :required="true"
        />

        <x-ui.auth.password-field
            id="resetPasswordConfirmation"
            name="password_confirmation"
            :label="__('auth.Confirmar Password')"
            autocomplete="new-password"
            :required="true"
        />

        <x-ui.auth.submit-button :label="__('auth.Repor password')" />

        <a href="{{ route('ui.login') }}" class="block text-center text-sm font-semibold text-primary transition hover:opacity-70">
            {{ __('auth.Voltar ao login') }}
        </a>
    </form>
</x-ui.auth.shell>
