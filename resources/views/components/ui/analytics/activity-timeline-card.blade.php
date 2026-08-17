{{--
|--------------------------------------------------------------------------
| Activity Timeline Component
|--------------------------------------------------------------------------
|
| Linha de tempo de atividades reativa com suporte a AJAX, loading e estados vazios.
| • 100% livre de CSS ou JS inline.
| • Integração com Alpine.js para carregamento dinâmico de dados.
| • Acessibilidade WCAG avançada (aria-busy, aria-live, role="feed").
|
--}}

@props([
    'endpoint' => '/api/activities',
    'emptyMessage' => __('dashboard.Nenhuma atividade recente encontrada.'),
    'loadingMessage' => __('ui.A carregar atividade...'),
    'loadingDescription' => __('common.A obter os eventos mais recentes da plataforma.'),
    'errorMessage' => __('ui.Não foi possível carregar as atividades.'),
])

<div
    {{ $attributes->class(['overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]']) }}
    x-data="{
        loading: true,
        activities: [],
        error: null,
        async init() {
            try {
                const headers = {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                };

                // Integração opcional com a store de autenticação se disponível
                if (window.Alpine && Alpine.store('auth') && typeof Alpine.store('auth').authHeader === 'function') {
                    Object.assign(headers, Alpine.store('auth').authHeader());
                }

                const response = await fetch(@js($endpoint), { headers });
                if (!response.ok) throw new Error('Erro na resposta do servidor');

                const data = await response.json();
                this.activities = Array.isArray(data) ? data : (data.data || []);
            } catch (e) {
                console.error('Erro ao buscar atividades:', e);
                this.error = @js($errorMessage);
            } finally {
                this.loading = false;
            }
        }
    }"
    role="feed"
    :aria-busy="loading ? 'true' : 'false'"
    aria-live="polite"
>
    <div class="divide-y divide-[var(--border)]">
        {{-- Estado de Carregamento (Skeleton / Loading State) --}}
        <template x-if="loading">
            <div class="flex items-start gap-5 p-6 animate-pulse">
                <div class="mt-1 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-500/10" aria-hidden="true">
                    <div class="h-3 w-3 rounded-full bg-emerald-500"></div>
                </div>
                <div class="flex-1">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <h3 class="font-semibold text-[var(--text)]">{{ $loadingMessage }}</h3>
                        <span class="text-xs text-[var(--text-soft)]">--</span>
                    </div>
                    <p class="mt-2 text-sm text-[var(--text-soft)]">{{ $loadingDescription }}</p>
                </div>
            </div>
        </template>

        {{-- Estado de Erro --}}
        <template x-if="!loading && error">
            <div class="flex items-start gap-5 p-6">
                <div class="mt-1 flex h-12 w-12 items-center justify-center rounded-2xl bg-red-500/10" aria-hidden="true">
                    <div class="h-3 w-3 rounded-full bg-red-500"></div>
                </div>
                <div class="flex-1">
                    <h3 class="font-semibold text-red-600 dark:text-red-400" x-text="error"></h3>
                    <p class="mt-2 text-sm text-[var(--text-soft)]">{{ __('common.Por favor, tente novamente mais tarde.') }}</p>
                </div>
            </div>
        </template>

        {{-- Estado Vazio --}}
        <template x-if="!loading && !error && activities.length === 0">
            <div class="p-8 text-center">
                <p class="text-sm text-[var(--text-soft)]">{{ $emptyMessage }}</p>
            </div>
        </template>

        {{-- Lista de Atividades Dinâmicas --}}
        <template x-if="!loading && !error && activities.length > 0">
            <template x-for="activity in activities" :key="activity.id ?? activity.created_at">
                <article class="flex items-start gap-5 p-6 transition-colors hover:bg-[var(--surface-2)]">
                    <div class="mt-1 flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl" :class="activity.icon_bg || 'bg-emerald-500/10'" aria-hidden="true">
                        <div class="h-3 w-3 rounded-full" :class="activity.dot_color || 'bg-emerald-500'"></div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap items-center justify-between gap-3">
                            <h3 class="font-semibold text-[var(--text)] truncate" x-text="activity.title"></h3>
                            <span class="text-xs text-[var(--text-soft)] shrink-0" x-text="activity.time_ago"></span>
                        </div>
                        <p class="mt-2 text-sm text-[var(--text-soft)]" x-text="activity.description"></p>
                    </div>
                </article>
            </template>
        </template>
    </div>
</div>
