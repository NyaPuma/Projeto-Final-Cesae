{{--
|-------------------------------------------------------------------------- |
Profile Information Form Card Component
|-------------------------------------------------------------------------- |
| Card com o formulário de informações pessoais (nome e email).
| • Padronizado com as variáveis CSS oficiais do Design System.
| • Cabeçalho com ícone de utilizador para identificação rápida.
| • 100% livre de CSS ou JS inline.
| --}}
@props([
    'user',
])

<x-ui.form.card
    :title="__('common.Informações Pessoais')"
    :description="__('common.Atualize os seus dados pessoais.')"
    icon='<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>'
>
    <form
        id="profileForm"
        class="space-y-4"
        novalidate
        data-validation-message="{{ __('common.Introduza um nome para continuar.') }}"
        data-saving-message="{{ __('ui.A guardar alterações...') }}"
        data-success-message="{{ __('messages.Perfil atualizado com sucesso.') }}"
        data-error-message="{{ __('ui.Não foi possível atualizar o perfil.') }}"
    >
        <x-ui.auth.text-field
            id="profileName"
            name="name"
            :label="__('common.Nome Completo')"
            type="text"
            :value="$user->name"
            :required="true"
            :placeholder="__('common.Ex.: João Silva')"
            class="py-3"
        />

        <x-ui.form.field :id="'profileEmail'" :label="__('common.Email')">
            <x-ui.form.input
                id="profileEmail"
                name="email"
                type="email"
                :value="$user->email"
                readonly
                class="py-3 cursor-not-allowed opacity-80"
            />
        </x-ui.form.field>
        <p class="text-xs text-[var(--text-soft)]">{{ __('validation.O email é gerido pela administração e não pode ser alterado.') }}</p>

        <x-ui.form.message id="profileMessage" />

        <div class="pt-2">
            <x-ui.buttons.submit id="submitBtn" variant="primary" size="md" weight="semibold" class="rounded-2xl disabled:cursor-not-allowed disabled:opacity-50">
                {{ __('ui.Guardar alterações') }}
            </x-ui.buttons.submit>
        </div>
    </form>
</x-ui.form.card>
