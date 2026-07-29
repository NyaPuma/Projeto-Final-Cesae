@extends('ui.layout')

@section('page_key', 'user-edit')

@section('content')
<div data-user-mode="edit" data-user-id="{{ $targetUser->id }}" data-profile-id="{{ $targetUser->profile_id }}">
<x-ui.partials.page-card
    :title="__('Editar Utilizador')"
    :subtitle="__('Atualize as credenciais e permissões de acesso do perfil de utilizador.')"
>
    <x-slot:actions>
        <x-ui.page-actions.back-button :href="route('ui.users')" :label="__('Voltar')" compact class="rounded-2xl text-sm shadow-none" />
    </x-slot:actions>

    <x-ui.form.card>
        <form id="editUserForm" class="space-y-6">
            <div class="grid gap-6 lg:grid-cols-2">
                <x-ui.form.field id="userName" :label="__('Nome Completo')" :required="true">
                    <x-ui.form.input id="userName" name="name" type="text" :required="true" :value="$targetUser->name" placeholder="Ex.: João Silva" />
                </x-ui.form.field>
                <x-ui.form.field id="userEmail" :label="__('Email')" :required="true">
                    <x-ui.form.input id="userEmail" name="email" type="email" :required="true" :value="$targetUser->email" placeholder="utilizador@empresa.pt" />
                </x-ui.form.field>
                <x-ui.form.field id="userPassword" :label="__('Nova Password')">
                    <x-ui.form.input id="userPassword" name="password" type="password" :placeholder="__('Deixe em branco para manter a atual')" />
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
                    {{ __('Guardar Alterações') }}
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
