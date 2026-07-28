@extends('ui.layout')

@section('content')
<script>
window.requireAuthOnLoad = true;
</script>

@component('ui.partials.page-card', [
    'title' => __('Editar Utilizador'),
    'subtitle' => __('Atualize as credenciais, fotografia e permissões de acesso do perfil de utilizador.'),
    'actions' => '<a href="/ui/users" class="inline-flex items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface)] px-3 py-2 text-sm font-semibold text-[var(--text)] transition hover:bg-[var(--surface-2)]">← Voltar</a>'
])
    <div class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
        <form id="editUserForm" class="space-y-6" enctype="multipart/form-data">
            
            {{-- Secção Visual do Avatar / Fotografia de Perfil --}}
            <div class="flex flex-col sm:flex-row items-center gap-6 p-4 bg-[var(--surface-2)] rounded-2xl border border-[var(--border)]">
                <div class="relative w-24 h-24 rounded-2xl overflow-hidden border-2 border-primary/30 shadow-md bg-[var(--surface)] flex-shrink-0 flex items-center justify-center">
                    <img id="avatarPreview" 
                         src="{{ $targetUser->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($targetUser->name) . '&background=f97316&color=ffffff&bold=true' }}" 
                         alt="Foto de Perfil" 
                         class="w-full h-full object-cover">
                </div>

                <div class="space-y-2 text-center sm:text-left">
                    <h4 class="text-sm font-bold text-[var(--text)]">{{ __('Fotografia do Utilizador') }}</h4>
                    <p class="text-xs text-[var(--text-soft)]">{{ __('Carregue uma imagem (PNG, JPG ou WEBP até 2MB).') }}</p>
                    
                    <div class="flex flex-wrap items-center justify-center sm:justify-start gap-3 pt-1">
                        <label for="avatarInput" class="cursor-pointer px-4 py-2 bg-primary/10 hover:bg-primary/20 text-primary font-bold text-xs rounded-xl border border-primary/30 transition shadow-sm inline-flex items-center gap-1.5">
                            📷 {{ __('Escolher Fotografia') }}
                        </label>
                        <input type="file" id="avatarInput" name="avatar" accept="image/*" class="hidden" onchange="previewUserAvatar(this)">
                        <span id="avatarFileName" class="text-xs text-[var(--text-soft)] truncate max-w-[180px]">{{ __('Nenhum ficheiro selecionado') }}</span>
                    </div>
                </div>
            </div>

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
                <a href="/ui/users" class="ui-button ui-button--outline inline-flex items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface)] px-5 py-3 text-sm font-semibold text-[var(--text)] transition hover:bg-[var(--surface-2)]">Cancelar</a>
            </div>
        </form>
    </div>
@endcomponent
@endsection

@push('scripts')
<script>
const targetUserId = "{{ $targetUser->id }}";
const targetProfileId = "{{ $targetUser->profile_id }}";

// Função de cabeçalhos sem Content-Type fixo (crucial para FormData)
function authHeader() {
    const token = localStorage.getItem('api_token');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const headers = { 'Accept': 'application/json' };
    if (token) headers['X-Auth-Token'] = token;
    if (csrfToken) headers['X-CSRF-TOKEN'] = csrfToken;
    return headers;
}

// Pré-visualização instantânea da fotografia
function previewUserAvatar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatarPreview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
        document.getElementById('avatarFileName').innerText = input.files[0].name;
    }
}

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

            let label = p.name;
            if (p.name === 'admin') label = 'Administrador';
            else if (p.name === 'technician') label = 'Técnico de Manutenção';
            else if (p.name === 'user') label = 'Utilizador Comum';

            opt.textContent = label;

            if (String(p.id) === String(targetProfileId)) {
                opt.selected = true;
            }

            select.appendChild(opt);
        });
    } catch (e) {
        select.innerHTML = '<option value="">Erro ao carregar perfis de acesso</option>';
    }
}

// Submissão do Formulário usando FormData
document.getElementById('editUserForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const message = document.getElementById('formMessage');
    const submitBtn = document.getElementById('submitBtn');

    const formData = new FormData();
    // Spoofing de método para garantir compatibilidade
    formData.append('_method', 'PATCH');

    formData.append('name', document.getElementById('userName').value.trim());
    formData.append('email', document.getElementById('userEmail').value.trim());
    formData.append('profile_id', document.getElementById('userProfileId').value);
    formData.append('active', document.getElementById('userActive').checked ? '1' : '0');

    const password = document.getElementById('userPassword').value;
    if (password) {
        formData.append('password', password);
    }

    const avatarInput = document.getElementById('avatarInput');
    if (avatarInput && avatarInput.files && avatarInput.files[0]) {
        formData.append('avatar', avatarInput.files[0]);
    }

    message.textContent = 'A guardar alterações...';
    message.className = 'min-h-6 text-sm font-medium text-[var(--text-soft)]';
    submitBtn.disabled = true;

    try {
        const res = await fetch(`/admin/users/${targetUserId}`, {
            method: 'POST',
            headers: authHeader(),
            body: formData
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