@extends('ui.layout')

@section('page_key', 'profile')

@php
    $profileName = $user->profile->name ?? 'user';
    $translatedProfile = [
        'admin' => __('common.Administrador'),
        'technician' => __('common.Técnico'),
        'user' => __('common.Funcionário')
    ][$profileName] ?? ucfirst($profileName);
@endphp

@section('content')
<nav aria-label="{{ __('common.Breadcrumb') }}" class="mb-4">
    <ol class="flex flex-wrap items-center gap-1.5 text-sm">
        <li>
            <a href="{{ route('ui.index') }}" class="font-medium text-[var(--text-soft)] transition-colors hover:text-[var(--text)]">
                {{ __('dashboard.Painel') }}
            </a>
        </li>
        <li aria-hidden="true" class="select-none text-[var(--text-soft)]">/</li>
        <li aria-current="page" class="font-semibold text-[var(--text)]">
            {{ __('common.Perfil do Utilizador') }}
        </li>
    </ol>
</nav>

<x-ui.partials.page-header
    :title="__('common.Perfil')"
    :subtitle="__('common.Consulte e atualize os seus dados pessoais e preferências de acesso.')"
>
    <x-slot:actions>
        <x-ui.page-actions.back-button href="/ui" :label="__('dashboard.Voltar ao painel')" />
    </x-slot:actions>

    <div class="grid gap-6 xl:grid-cols-2 items-start">
        <div class="space-y-6">
            <x-ui.profile.information-card :user="$user" />
            <x-ui.profile.security-card />
        </div>

        <div class="space-y-6">
            <x-ui.profile.summary-card :user="$user" :translatedProfile="$translatedProfile" />
            <x-ui.profile.delete-account-card />
        </div>
    </div>
</x-ui.partials.page-header>
@endsection
