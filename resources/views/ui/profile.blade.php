@extends('ui.layout')

@php
    $profileName = $user->profile->name ?? 'user';
    $translatedProfile = [
        'admin' => __('Administrador'),
        'technician' => __('Técnico'),
        'user' => __('Funcionário')
    ][$profileName] ?? ucfirst($profileName);
@endphp

@section('content')
<script>
window.requireAuthOnLoad = true;
</script>

@component('ui.partials.page-card', [
    'title' => __('Perfil'),
    'subtitle' => __('Consulte e atualize os seus dados pessoais e preferências de acesso.'),
    'actions' => '<a href="/ui" class="inline-flex items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface)] px-3 py-2 text-sm font-semibold text-[var(--text)] transition hover:bg-[var(--surface-2)]">← ' . __('Voltar ao painel') . '</a>'
])
    <div class="grid gap-6 xl:grid-cols-[0.9fr_1.1fr]">
        <section class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
            <div class="flex items-center gap-4">
                <div id="displayUserAvatar" class="flex h-16 w-16 items-center justify-center rounded-2xl bg-primary text-lg font-black text-black transition-all">
                    {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                </div>
                <div>
                    <h2 id="displayUserName" class="text-lg font-semibold text-[var(--text)]">{{ $user->name ?? __('utilizador') }}</h2>
                    <p class="text-sm text-[var(--text-soft)]">{{ $user->email ?? 'sem-email@empresa.pt' }}</p>
                    <span class="mt-2 inline-flex rounded-full border border-primary/20 bg-primary/10 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.2em] text-primary">
                        {{ $translatedProfile }}
                    </span>
                </div>
            </div>

            <div class="mt-8 space-y-4 rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] p-4 text-sm text-[var(--text-soft)]">
                <div class="flex items-center justify-between border-b border-[var(--border)] pb-3">
                    <span>{{ __('Estado') }}</span>
                    <span class="font-semibold text-[var(--text)]">{{ $user->active ? __('Ativo') : __('Inativo') }}</span>
                </div>
                <div class="flex items-center justify-between border-b border-[var(--border)] pb-3">
                    <span>{{ __('Última atualização') }}</span>
                    <span class="font-semibold text-[var(--text)]">{{ $user->updated_at ? $user->updated_at->format('d/m/Y H:i') : '—' }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span>{{ __('Membro desde') }}</span>
                    <span class="font-semibold text-[var(--text)]">{{ $user->created_at ? $user->created_at->format('d/m/Y') : '—' }}</span>
                </div>
            </div>
        </section>

        <section class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-[var(--text)]">{{ __('Atualizar informação') }}</h2>
            <p class="mt-2 text-sm text-[var(--text-soft)]">{{ __('Altere o nome ou a palavra-passe do seu perfil em segurança.') }}</p>

            <form id="profileForm" class="mt-6 space-y-4" novalidate>
                <div>
                    <label for="profileName" class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('Nome Completo') }}</label>
                    <input id="profileName" name="name" type="text" value="{{ $user->name }}" required class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none focus:border-primary focus:ring-4 focus:ring-primary/15" placeholder="{{ __('Ex.: João Silva') }}">
                </div>

                <div>
                    <label for="currentPassword" class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('Palavra-passe atual') }}</label>
                    <input id="currentPassword" name="current_password" type="password" autocomplete="current-password" class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none focus:border-primary focus:ring-4 focus:ring-primary/15" placeholder="••••••••">
                </div>

                <div>
                    <label for="newPassword" class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('Nova palavra-passe') }}</label>
                    <input id="newPassword" name="new_password" type="password" autocomplete="new-password" class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none focus:border-primary focus:ring-4 focus:ring-primary/15" placeholder="{{ __('Mínimo 8 caracteres') }}">
                </div>

                <div id="profileMessage" class="min-h-6 text-sm font-medium text-[var(--text-soft)]"></div>

                <div class="pt-2">
                    <button type="submit" id="submitBtn" class="ui-button ui-button--primary inline-flex items-center justify-center rounded-2xl px-5 py-3 text-sm font-semibold transition hover:opacity-90 disabled:opacity-50 disabled:cursor-not-allowed">
                        {{ __('Guardar alterações') }}
                    </button>
                </div>
            </form>
        </section>
    </div>
@endcomponent
@endsection

@push('scripts')
<script>
function authHeader() {
    const token = localStorage.getItem('auth_token');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const headers = { 'Accept': 'application/json', 'Content-Type': 'application/json' };
    if (token) headers['Authorization'] = 'Bearer ' + token;
    if (csrfToken) headers['X-CSRF-TOKEN'] = csrfToken;
    return headers;
}

async function updateProfile(event) {
    event.preventDefault();
    const message = document.getElementById('profileMessage');
    const form = document.getElementById('profileForm');
    const submitBtn = document.getElementById('submitBtn');

    const name = document.getElementById('profileName').value.trim();
    const currentPassword = document.getElementById('currentPassword').value;
    const newPassword = document.getElementById('newPassword').value;

    if (!name) {
        message.textContent = "{{ __('Introduza um nome para continuar.') }}";
        message.className = 'min-h-6 text-sm font-medium text-red-600 dark:text-red-400';
        return;
    }

    message.textContent = "{{ __('A guardar alterações...') }}";
    message.className = 'min-h-6 text-sm font-medium text-[var(--text-soft)]';
    submitBtn.disabled = true;

    try {
        const res = await fetch('/profile/update', {
            method: 'POST',
            headers: authHeader(),
            body: JSON.stringify({
                name,
                current_password: currentPassword,
                new_password: newPassword,
            })
        });

        const data = await res.json().catch(() => ({}));
        if (!res.ok) {
            throw new Error(data.message || "{{ __('Não foi possível atualizar o perfil.') }}");
        }

        if (data.user?.name) {
            localStorage.setItem('user_name', data.user.name);
            const displayUserName = document.getElementById('displayUserName');
            const displayUserAvatar = document.getElementById('displayUserAvatar');
            if (displayUserName) displayUserName.textContent = data.user.name;
            if (displayUserAvatar) displayUserAvatar.textContent = data.user.name.charAt(0).toUpperCase();
        }
        if (data.user?.profile?.name) {
            localStorage.setItem('user_role', data.user.profile.name);
        }

        document.getElementById('currentPassword').value = '';
        document.getElementById('newPassword').value = '';

        message.textContent = "{{ __('Perfil atualizado com sucesso.') }}";
        message.className = 'min-h-6 text-sm font-medium text-emerald-600 dark:text-emerald-400';
    } catch (error) {
        message.textContent = error.message || "{{ __('Não foi possível atualizar o perfil.') }}";
        message.className = 'min-h-6 text-sm font-medium text-red-600 dark:text-red-400';
    } finally {
        submitBtn.disabled = false;
    }
}

document.getElementById('profileForm').addEventListener('submit', updateProfile);
</script>
@endpush
