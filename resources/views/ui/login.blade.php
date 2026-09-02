@extends('layouts.layout')

@section('content')
<div class="relative min-h-screen bg-[var(--bg)] text-[var(--text)] antialiased flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    
    {{-- Formulário de Autenticação --}}
    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-primary/20 bg-primary/10 text-xs font-bold uppercase tracking-[0.2em] text-primary mb-4">
            {{ __('Área segura') }}
        </span>
        <h2 class="text-3xl font-black tracking-tight text-[var(--text)]">
            {{ __('Bem-vindo de volta') }}
        </h2>
        <p class="mt-2 text-sm text-[var(--text-soft)] max-w-sm mx-auto">
            {{ __('Introduza o seu email e palavra-passe para continuar.') }}
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md px-4">
        <div class="bg-[var(--surface)] border border-[var(--border)] p-8 shadow-xl rounded-3xl space-y-6">
            
            <form id="loginForm" onsubmit="handleLogin(event)" class="space-y-5">
                <div>
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-[var(--text)] mb-2">
                        {{ __('Email') }}
                    </label>
                    <input type="email" id="email" required
                        placeholder="utilizador@empresa.pt"
                        class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3.5 text-sm font-medium text-[var(--text)] placeholder-[var(--text-soft)] transition focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-xs font-bold uppercase tracking-wider text-[var(--text)]">
                            {{ __('Palavra-passe') }}
                        </label>
                        <button type="button" onclick="togglePasswordVisibility()" class="text-xs font-semibold text-primary hover:underline cursor-pointer" id="btnTogglePass">
                            {{ __('Mostrar') }}
                        </button>
                    </div>
                    <input type="password" id="password" required
                        placeholder="••••••••"
                        class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3.5 text-sm font-medium text-[var(--text)] placeholder-[var(--text-soft)] transition focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                </div>

                <div id="loginFeedback" class="hidden rounded-2xl p-4 text-xs font-bold leading-5"></div>

                <button type="submit" id="btnLogin"
                    class="w-full ui-button ui-button--primary inline-flex items-center justify-center rounded-2xl px-6 py-4 text-sm font-bold shadow-lg shadow-primary/20 transition hover:-translate-y-0.5 hover:shadow-xl hover:shadow-primary/30 min-h-[50px] cursor-pointer">
                    <span id="btnLoginText">{{ __('Iniciar sessão') }}</span>
                </button>
            </form>

        </div>
    </div>
</div>

<script>
    function togglePasswordVisibility() {
        const input = document.getElementById('password');
        const btn = document.getElementById('btnTogglePass');
        if (input.type === 'password') {
            input.type = 'text';
            btn.innerText = {!! json_encode(__('Ocultar')) !!};
        } else {
            input.type = 'password';
            btn.innerText = {!! json_encode(__('Mostrar')) !!};
        }
    }

    async function handleLogin(event) {
        event.preventDefault();
        
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;
        const feedback = document.getElementById('loginFeedback');
        const btn = document.getElementById('btnLogin');
        const btnText = document.getElementById('btnLoginText');

        feedback.classList.add('hidden');
        btn.disabled = true;
        btnText.innerText = {!! json_encode(__('A autenticar...')) !!};

        try {
            const response = await fetch('/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                },
                body: JSON.stringify({ email, password })
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || {!! json_encode(__('Credenciais inválidas.')) !!});
            }

            localStorage.setItem('api_token', data.token || data.api_token);
            if (data.user) {
                localStorage.setItem('user_name', data.user.name || '');
                localStorage.setItem('user_role', data.user.profile?.name || data.user.role || '');
            }

            feedback.className = 'rounded-2xl p-4 text-xs font-bold leading-5 bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 block';
            feedback.innerText = {!! json_encode(__('Autenticação bem-sucedida! A redirecionar...')) !!};

            setTimeout(() => {
                window.location.href = '/ui';
            }, 600);

        } catch (error) {
            feedback.className = 'rounded-2xl p-4 text-xs font-bold leading-5 bg-rose-500/10 border border-rose-500/20 text-rose-600 block';
            feedback.innerText = error.message || {!! json_encode(__('Credenciais inválidas.')) !!};
            btn.disabled = false;
            btnText.innerText = {!! json_encode(__('Iniciar sessão')) !!};
        }
    }
</script>
@endsection