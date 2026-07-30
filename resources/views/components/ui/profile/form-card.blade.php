{{--
|-------------------------------------------------------------------------- |
Profile Update Form Component (Otimizado)
|-------------------------------------------------------------------------- |
| Componente para alteração de informações e palavra-passe do perfil.
| • Padronizado com as variáveis CSS oficiais do Tailwind.
| • 100% livre de CSS ou JS inline.
| --}}
@props([
    'user',
    'messages' => [],
])

<x-ui.form.card>
    <div>
        <h2 class="text-lg font-semibold text-[var(--text)]">{{ __('Atualizar informação') }}</h2>
        <p class="mt-2 text-sm text-[var(--text-soft)]">{{ __('Altere o nome ou a palavra-passe do seu perfil em segurança.') }}</p>
    </div>

    <form
        id="profileForm"
        class="mt-6 space-y-4"
        novalidate
        data-validation-message="{{ $messages['validation'] ?? __('Introduza um nome para continuar.') }}"
        data-saving-message="{{ $messages['saving'] ?? __('A guardar alterações...') }}"
        data-success-message="{{ $messages['success'] ?? __('Perfil atualizado com sucesso.') }}"
        data-error-message="{{ $messages['error'] ?? __('Não foi possível atualizar o perfil.') }}"
    >
        <x-ui.auth.text-field
            id="profileName"
            name="name"
            :label="__('Nome Completo')"
            type="text"
            :value="$user->name"
            :required="true"
            :placeholder="__('Ex.: João Silva')"
            class="py-3"
        />

        <x-ui.auth.password-field
            id="currentPassword"
            name="current_password"
            :label="__('Palavra-passe atual')"
            autocomplete="current-password"
            class="py-3"
        />

        <x-ui.auth.password-field
            id="newPassword"
            name="new_password"
            :label="__('Nova palavra-passe')"
            autocomplete="new-password"
            :placeholder="__('Mínimo 8 caracteres')"
            class="py-3"
        />

        <x-ui.form.message id="profileMessage" />

        <div class="pt-2">
            <x-ui.buttons.submit id="submitBtn" variant="primary" size="md" weight="semibold" class="rounded-2xl disabled:cursor-not-allowed disabled:opacity-50">
                {{ __('Guardar alterações') }}
            </x-ui.buttons.submit>
        </div>
    </form>
</x-ui.form.card>
