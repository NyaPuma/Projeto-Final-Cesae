@extends('ui.layout')

@section('page_key', 'user-create')

@section('content')
<div data-user-mode="create">
@component('ui.partials.page-card', [
    'title' => __('Criar Utilizador'),
    'subtitle' => __('Crie um novo perfil de utilizador e defina as suas credenciais e permissões de acesso.'),
'actions' => '<a href="' . route('ui.users') . '" class="inline-flex items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface)] px-3 py-2 text-sm font-semibold text-[var(--text)] transition hover:bg-[var(--surface-2)]">← ' . __('Voltar') . '</a>'
])
    <div class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
        <form id="createUserForm" class="space-y-6">
            <div class="grid gap-6 lg:grid-cols-2">
                <div>
<label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('Nome Completo') }}</label>
                    <input type="text" id="userName" name="name" required class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none focus:border-primary focus:ring-4 focus:ring-primary/15" placeholder="{{ __('Ex.: João Silva') }}">
                </div>
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('Email') }}</label>
                    <input type="email" id="userEmail" name="email" required class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none focus:border-primary focus:ring-4 focus:ring-primary/15" placeholder="Ex.: joao@empresa.pt">
                </div>
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('Palavra-passe') }}</label>
                    <input type="password" id="userPassword" name="password" required class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none focus:border-primary focus:ring-4 focus:ring-primary/15" placeholder="••••••••">
                </div>
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('Perfil de Acesso') }}</label>
                    <select id="userProfileId" name="profile_id" required disabled class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none focus:border-primary focus:ring-4 focus:ring-primary/15 disabled:opacity-60 disabled:cursor-not-allowed">
                        <option value="">{{ __('A carregar perfis...') }}</option>
                    </select>
                </div>
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('Estado da Conta') }}</label>
                    <div class="flex items-center gap-3 mt-2">
                        <input type="checkbox" id="userActive" name="active" value="1" checked class="h-4 w-4 rounded border-[var(--border)] text-primary focus:ring-primary">
                        <span class="text-sm font-semibold text-[var(--text)]">{{ __('Conta ativa (permite login)') }}</span>
                    </div>
                </div>
            </div>

            <div id="formMessage" class="min-h-6 text-sm font-medium text-[var(--text-soft)]"></div>

            <div class="mt-6 flex flex-wrap gap-3">
<button type="submit" id="submitBtn" class="ui-button ui-button--primary inline-flex items-center justify-center rounded-2xl px-5 py-3 text-sm font-semibold transition hover:opacity-90 disabled:opacity-50 disabled:cursor-not-allowed">{{ __('Guardar Utilizador') }}</button>
                <a href="{{ route('ui.users') }}" class="ui-button ui-button--outline inline-flex items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface)] px-5 py-3 text-sm font-semibold text-[var(--text)] transition hover:bg-[var(--surface-2)]">{{ __('Cancelar') }}</a>
            </div>
        </form>
    </div>
@endcomponent
</div>
@endsection
