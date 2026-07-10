@extends('ui.layout')

@section('content')
<script>
window.requireAuthOnLoad = true;
</script>

@component('ui.partials.page-card', [
    'title' => 'Perfil',
    'subtitle' => 'Consulte e atualize os seus dados pessoais e preferências de acesso.',
    'actions' => '<a href="/ui" class="inline-flex items-center justify-center px-3 py-1.5 bg-[var(--surface)] text-xs font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all">← Voltar ao painel</a>'
])
    <div class="grid gap-6 xl:grid-cols-[0.9fr_1.1fr]">
        <section class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-primary text-lg font-black text-black">
                    {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-[var(--text)]">{{ $user->name ?? 'Utilizador' }}</h2>
                    <p class="text-sm text-[var(--text-soft)]">{{ $user->email ?? 'sem-email@empresa.pt' }}</p>
                    <span class="mt-2 inline-flex rounded-full border border-primary/20 bg-primary/10 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.2em] text-primary">
                        {{ $user->profile->name ?? 'user' }}
                    </span>
                </div>
            </div>

            <div class="mt-8 space-y-4 rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] p-4 text-sm text-[var(--text-soft)]">
                <div class="flex items-center justify-between border-b border-[var(--border)] pb-3">
                    <span>Estado</span>
                    <span class="font-semibold text-[var(--text)]">{{ $user->active ? 'Ativo' : 'Inativo' }}</span>
                </div>
                <div class="flex items-center justify-between border-b border-[var(--border)] pb-3">
                    <span>Última atualização</span>
                    <span class="font-semibold text-[var(--text)]">{{ $user->updated_at ? $user->updated_at->format('d/m/Y H:i') : '—' }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span>Membro desde</span>
                    <span class="font-semibold text-[var(--text)]">{{ $user->created_at ? $user->created_at->format('d/m/Y') : '—' }}</span>
                </div>
            </div>
        </section>

        <section class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-[var(--text)]">Atualizar informação</h2>
            <p class="mt-2 text-sm text-[var(--text-soft)]">Altere o nome ou a palavra-passe do seu perfil em segurança.</p>

            <form id="profileForm" class="mt-6 space-y-4" novalidate>
                <div>
                    <label for="profileName" class="mb-2 block text-[10px] font-bold uppercase tracking-[0.18em] text-[var(--text-soft)]">Nome</label>
                    <input id="profileName" name="name" type="text" value="{{ $user->name }}" class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] focus:border-primary focus:outline-none">
                </div>

                <div>
                    <label for="currentPassword" class="mb-2 block text-[10px] font-bold uppercase tracking-[0.18em] text-[var(--text-soft)]">Palavra-passe atual</label>
                    <input id="currentPassword" name="current_password" type="password" autocomplete="current-password" class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] focus:border-primary focus:outline-none">
                </div>

                <div>
                    <label for="newPassword" class="mb-2 block text-[10px] font-bold uppercase tracking-[0.18em] text-[var(--text-soft)]">Nova palavra-passe</label>
                    <input id="newPassword" name="new_password" type="password" autocomplete="new-password" class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] focus:border-primary focus:outline-none">
                </div>

                <div id="profileMessage" class="min-h-6 text-sm font-medium text-[var(--text-soft)]"></div>

                <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-primary px-5 py-3 text-sm font-semibold text-black shadow-sm shadow-primary/20 transition hover:opacity-90">
                    Guardar alterações
                </button>
            </form>
        </section>
    </div>
@endcomponent
@endsection

@push('scripts')
<script>
function authHeader() {
    const token = localStorage.getItem('api_token');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const headers = { 'Accept': 'application/json', 'Content-Type': 'application/json' };
    if (token) headers['X-Auth-Token'] = token;
    if (csrfToken) headers['X-CSRF-TOKEN'] = csrfToken;
    return headers;
}

async function updateProfile(event) {
    event.preventDefault();
    const message = document.getElementById('profileMessage');
    const form = document.getElementById('profileForm');
    const name = document.getElementById('profileName').value.trim();
    const currentPassword = document.getElementById('currentPassword').value;
    const newPassword = document.getElementById('newPassword').value;

    if (!name) {
        message.textContent = 'Introduza um nome para continuar.';
        message.className = 'min-h-6 text-sm font-medium text-red-600 dark:text-red-400';
        return;
    }

    message.textContent = 'A guardar alterações...';
    message.className = 'min-h-6 text-sm font-medium text-[var(--text-soft)]';
    form.querySelector('button[type="submit"]').disabled = true;

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
            throw new Error(data.message || 'Não foi possível atualizar o perfil.');
        }

        if (data.user?.name) {
            localStorage.setItem('user_name', data.user.name);
        }
        if (data.user?.profile?.name) {
            localStorage.setItem('user_role', data.user.profile.name);
        }

        message.textContent = 'Perfil atualizado com sucesso.';
        message.className = 'min-h-6 text-sm font-medium text-emerald-600 dark:text-emerald-400';
    } catch (error) {
        message.textContent = error.message || 'Não foi possível atualizar o perfil.';
        message.className = 'min-h-6 text-sm font-medium text-red-600 dark:text-red-400';
    } finally {
        form.querySelector('button[type="submit"]').disabled = false;
    }
}

document.getElementById('profileForm').addEventListener('submit', updateProfile);
</script>
@endpush
