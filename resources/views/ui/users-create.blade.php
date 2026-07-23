@extends('ui.layout')

@section('content')
<script>
window.requireAuthOnLoad = true;
</script>

@component('ui.partials.page-card', [
    'title' => __('Criar Utilizador'),
    'subtitle' => __('Crie um novo perfil de utilizador e defina as suas credenciais e permissões de acesso.'),
'actions' => '<a href="/ui/users" class="inline-flex items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface)] px-3 py-2 text-sm font-semibold text-[var(--text)] transition hover:bg-[var(--surface-2)]">← ' . __('Voltar') . '</a>'
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
                <a href="/ui/users" class="ui-button ui-button--outline inline-flex items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface)] px-5 py-3 text-sm font-semibold text-[var(--text)] transition hover:bg-[var(--surface-2)]">{{ __('Cancelar') }}</a>
            </div>
        </form>
    </div>
@endcomponent
@endsection

@push('scripts')
<script>
// Obtém os cabeçalhos padrão com os tokens necessários para a API
function authHeader() {
    const token = localStorage.getItem('sanctum_token');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const headers = { 'Accept': 'application/json', 'Content-Type': 'application/json' };
    if (token) headers['Authorization'] = 'Bearer ' + token;
    if (csrfToken) headers['X-CSRF-TOKEN'] = csrfToken;
    return headers;
}

// Carrega os perfis de acesso da API e preenche o elemento select
async function loadProfiles() {
    const select = document.getElementById('userProfileId');
    try {
        const res = await fetch('/admin/profiles', { headers: authHeader() });
        if (!res.ok) throw new Error('Não foi possível carregar os perfis.');

        const data = await res.json();
        const profiles = data.profiles || [];

select.innerHTML = '<option value="">' +"{{ __('Selecione um perfil...') }}"+ '</option>';
        select.removeAttribute('disabled');

        profiles.forEach(p => {
            const opt = document.createElement('option');
            opt.value = p.id;

            let label = p.name;
            if (p.name === 'admin') label = "{{ __('Administrador') }}";
            else if (p.name === 'technician') label = "{{ __('Técnico') }}";
            else if (p.name === 'user') label = "{{ __('Funcionário') }}";

            opt.textContent = label;
            select.appendChild(opt);
        });
    } catch (e) {
        console.error('Erro ao carregar perfis:', e);
        select.innerHTML = '<option value="">' + "{{ __('Erro ao carregar perfis') }}" + '</option>';
    }
}

// Submete os dados do formulário para criar o novo utilizador
document.getElementById('createUserForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const form = e.target;
    const message = document.getElementById('formMessage');
    const submitBtn = document.getElementById('submitBtn');

    const name = document.getElementById('userName').value.trim();
    const email = document.getElementById('userEmail').value.trim();
    const password = document.getElementById('userPassword').value;
    const profile_id = document.getElementById('userProfileId').value;
    const active = document.getElementById('userActive').checked;

message.textContent = "{{ __('A guardar utilizador...') }}";
    message.className = 'min-h-6 text-sm font-medium text-[var(--text-soft)]';
    submitBtn.disabled = true;

    try {
        const res = await fetch('/admin/users', {
            method: 'POST',
            headers: authHeader(),
            body: JSON.stringify({ name, email, password, profile_id, active })
        });

        const data = await res.json().catch(() => ({}));

        if (!res.ok) {
let errorText = data.message || "{{ __('Erro ao criar utilizador.') }}";
            if (data.errors) {
                errorText = Object.values(data.errors).flat().join(' ');
            }
            throw new Error(errorText);
        }

        message.textContent = "{{ __('Utilizador criado com sucesso!') }}";
        message.className = 'min-h-6 text-sm font-medium text-emerald-600 dark:text-emerald-400';
        setTimeout(() => { window.location.href = '/ui/users'; }, 1500);
    } catch (err) {
        message.textContent = err.message;
        message.className = 'min-h-6 text-sm font-medium text-red-600 dark:text-red-400';
        submitBtn.disabled = false;
    }
});

window.addEventListener('load', loadProfiles);
</script>
@endpush
