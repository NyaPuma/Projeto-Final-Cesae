@extends('ui.layout')

@section('page_key', 'user-create')

@section('content')
<div data-user-mode="create">
<x-ui.partials.page-card
    :title="__('Criar Utilizador')"
    :subtitle="__('Crie um novo perfil de utilizador e defina as suas credenciais e permissões de acesso.')"
>
    <x-slot:actions>
        <x-ui.page-actions.back-button :href="route('ui.users')" :label="__('Voltar')" compact class="rounded-2xl text-sm shadow-none" />
    </x-slot:actions>

    <x-ui.form.card>
        <form id="createUserForm" class="space-y-6">
            <div class="grid gap-6 lg:grid-cols-2">
                <x-ui.form.field id="userName" :label="__('Nome Completo')" :required="true">
                    <x-ui.form.input id="userName" name="name" type="text" :required="true" :placeholder="__('Ex.: João Silva')" />
                </x-ui.form.field>
                <x-ui.form.field id="userEmail" :label="__('Email')" :required="true">
                    <x-ui.form.input id="userEmail" name="email" type="email" :required="true" :placeholder="__('utilizador@empresa.pt')" />
                </x-ui.form.field>
                <x-ui.form.field id="userPassword" :label="__('Password')" :required="true">
                    <x-ui.form.input id="userPassword" name="password" type="password" :required="true" :placeholder="__('Mínimo 8 caracteres')" />
                </x-ui.form.field>
                <x-ui.form.field id="userProfile" :label="__('Perfil')" :required="true">
                    <x-ui.form.select id="userProfile" name="profile_id" :required="true">
                        <option value="">{{ __('Selecione o perfil') }}</option>
                    </x-ui.form.select>
                </x-ui.form.field>
            </div>

            <x-ui.form.message id="formMessage" />

            <div class="mt-6 flex flex-wrap gap-3">
                <x-ui.buttons.submit id="submitBtn" variant="primary" size="md" weight="semibold" class="rounded-2xl disabled:opacity-50 disabled:cursor-not-allowed">
                    {{ __('Guardar Utilizador') }}
                </x-ui.buttons.submit>
                <x-ui.buttons.link :href="route('ui.users')" variant="secondary" size="md" weight="semibold" class="rounded-2xl">
                    {{ __('Cancelar') }}
                </x-ui.buttons.link>
            </div>
        </form>
    </x-ui.form.card>
</x-ui.partials.page-card>
</div>
@endsection
