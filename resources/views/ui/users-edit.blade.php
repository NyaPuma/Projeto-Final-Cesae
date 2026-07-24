@extends('ui.layout')

@section('content')
<script>
window.requireAuthOnLoad = true;
</script>

@component('ui.partials.page-card', [
    'title' => __('Editar Utilizador'),
    'subtitle' => __('Atualize as credenciais e permissões de acesso do perfil de utilizador.'),
    'actions' => '<a href="' . route('ui.users') . '" class="inline-flex items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface)] px-3 py-2 text-sm font-semibold text-[var(--text)] transition hover:bg-[var(--surface-2)]">← Voltar</a>'
])
    <div class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
        <form id="editUserForm" class="space-y-6">
            <div class="grid gap-6 lg:grid-cols-2">
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">Nome Completo</label>
                    <input type="text" id="userName" name="name" required value="{{ $targetUser->name }}" class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none focus:border-primary focus:ring-4 focus:ring-primary/15" placeholder="Ex.: João Silva">
                </div>
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">Endereço de Email</label>
                    <input type="email" id="userEmail" name="email" required value="{{ $targetUser->email }}" class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none focus:border-primary focus:ring-4 focus:ring-primary/15" placeholder="Ex.: joao@empresa.pt">
                </div>
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">Nova Palavra-passe (deixar em branco para manter)</label>
                    <input type="password" id="userPassword" name="password" class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none focus:border-primary focus:ring-4 focus:ring-primary/15" placeholder="••••••••">
                </div>
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">Perfil de Acesso</label>
                    <select id="userProfileId" name="profile_id" required disabled class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none focus:border-primary focus:ring-4 focus:ring-primary/15 disabled:opacity-60 disabled:cursor-not-allowed">
                        <option value="">A carregar perfis...</option>
                    </select>
                </div>
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">Estado da Conta</label>
                    <div class="flex items-center gap-3 mt-2">
                        <input type="checkbox" id="userActive" name="active" value="1" {{ $targetUser->active ? 'checked' : '' }} class="h-4 w-4 rounded border-[var(--border)] text-primary focus:ring-primary">
                        <span class="text-sm font-semibold text-[var(--text)]">Conta ativa (permite login)</span>
                    </div>
                </div>
            </div>

            <div id="formMessage" class="min-h-6 text-sm font-medium text-[var(--text-soft)]"></div>

            <div class="mt-6 flex flex-wrap gap-3">
                <button type="submit" id="submitBtn" class="ui-button ui-button--primary inline-flex items-center justify-center rounded-2xl px-5 py-3 text-sm font-semibold transition hover:opacity-90 disabled:opacity-50 disabled:cursor-not-allowed">Guardar Alterações</button>
                <a href="{{ route('ui.users') }}" class="ui-button ui-button--outline inline-flex items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface)] px-5 py-3 text-sm font-semibold text-[var(--text)] transition hover:bg-[var(--surface-2)]">Cancelar</a>
            </div>
        </form>
    </div>
@endcomponent
@endsection

@push('scripts')
<script>
// Define as variáveis globais injetadas pelo Blade para uso no JavaScript
const targetUserId = "{{ $targetUser->id }}";
const targetProfileId = "{{ $targetUser->profile_id }}";

// Obtém os cabeçalhos padrão com os tokens necessários para a API
function authHeader() {
    const token = localStorage.getItem('auth_token');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const headers = { 'Accept': 'application/json', 'Content-Type': 'application/json' };
    if (token) headers['Authorization'] = 'Bearer ' + token;
    if (csrfToken) headers['X-CSRF-TOKEN'] = csrfToken;
    return headers;
}

// Carrega os perfis de acesso da API e pré-seleciona o perfil atual do utilizador
async function loadProfiles() {
    const select = document.getElementById('userProfileId');
    try {
        const res = await fetch('/admin/profiles', { headers: authHeader() });
        if (!res.ok) throw new Error('Não foi possível carregar os perfis.');

        const data = await res.json();
        const profiles = data.profiles || [];

        select.innerHTML = '<option value="">Selecione um perfil...</option>';
        select.removeAttribute('disabled');

        profiles.forEach(p => {
            const opt = document.createElement('option');
            opt.value = p.id;

            // Tradução e mapeamento amigável para PT-PT
            let label = p.name;
            if (p.name === 'admin') label = 'Administrador';
            else if (p.name === 'technician') label = 'Técnico de Manutenção';
            else if (p.name === 'user') label = 'Utilizador Comum';

            opt.textContent = label;

            // Pré-seleciona o perfil atual do utilizador editado
            if (String(p.id) === String(targetProfileId)) {
                opt.selected = true;
            }

            select.appendChild(opt);
        });
    } catch (e) {
        console.error('Erro ao carregar perfis:', e);
        select.innerHTML = '<option value="">Erro ao carregar perfis de acesso</option>';
    }
}

// Submete os dados atualizados do formulário para a API
document.getElementById('editUserForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const form = e.target;
    const message = document.getElementById('formMessage');
    const submitBtn = document.getElementById('submitBtn');

    const name = document.getElementById('userName').value.trim();
    const email = document.getElementById('userEmail').value.trim();
    const password = document.getElementById('userPassword').value;
    const profile_id = document.getElementById('userProfileId').value;
    const active = document.getElementById('userActive').checked;

    const payload = { name, email, profile_id, active };

    // Apenas envia o campo password se o utilizador tiver inserido algo
    if (password) {
        payload.password = password;
    }

    message.textContent = 'A guardar alterações...';
    message.className = 'min-h-6 text-sm font-medium text-[var(--text-soft)]';
    submitBtn.disabled = true;

    try {
        const res = await fetch(`/admin/users/${targetUserId}`, {
            method: 'PATCH',
            headers: authHeader(),
            body: JSON.stringify(payload)
        });

        const data = await res.json().catch(() => ({}));

        if (!res.ok) {
            let errorText = data.message || 'Erro ao editar utilizador.';
            if (data.errors) {
                errorText = Object.values(data.errors).flat().join(' ');
            }
            throw new Error(errorText);
        }

        message.textContent = 'Utilizador atualizado com sucesso! A redirecionar...';
        message.className = 'min-h-6 text-sm font-medium text-emerald-600 dark:text-emerald-400';
        setTimeout(() => { window.location.href = '{{ route('ui.users') }}'; }, 1500);
    } catch (err) {
        message.textContent = err.message;
        message.className = 'min-h-6 text-sm font-medium text-red-600 dark:text-red-400';
        submitBtn.disabled = false;
    }
});

window.addEventListener('load', loadProfiles);
</script>
@endpush
