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
        <x-ui.page-actions.back-button href="/ui" :label="__('Voltar ao painel')" />
    </x-slot:actions>

    <div class="grid gap-6 xl:grid-cols-[0.9fr_1.1fr]">
        <x-ui.profile.summary-card :user="$user" :translatedProfile="$translatedProfile" />
        <x-ui.profile.form-card :user="$user" />
    </div>
</x-ui.partials.page-card>
@endsection
