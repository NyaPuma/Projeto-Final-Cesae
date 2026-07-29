@extends('ui.layout')

@section('page_key', 'profile')

@php
    $profileName = $user->profile->name ?? 'user';
    $translatedProfile = [
        'admin' => __('Administrador'),
        'technician' => __('Técnico'),
        'user' => __('Funcionário')
    ][$profileName] ?? ucfirst($profileName);
@endphp

@section('content')
<x-ui.partials.page-card
    :title="__('Perfil')"
    :subtitle="__('Consulte e atualize os seus dados pessoais e preferências de acesso.')"
>
    <x-slot:actions>
        <x-ui.page-actions.back-button :href="route('ui.index')" :label="__('Voltar ao painel')" compact class="rounded-2xl text-sm shadow-none" />
    </x-slot:actions>

    <div class="grid gap-6 xl:grid-cols-[0.9fr_1.1fr]">
        <x-ui.profile.summary-card :user="$user" :translated-profile="$translatedProfile" />

        <x-ui.profile.form-card
            :user="$user"
            :messages="[
                'validation' => __('Introduza um nome para continuar.'),
                'saving' => __('A guardar alterações...'),
                'success' => __('Perfil atualizado com sucesso.'),
                'error' => __('Não foi possível atualizar o perfil.'),
            ]"
        />
    </div>
</x-ui.partials.page-card>
@endsection
