@extends('ui.layout')

@section('content')
<script>
window.requireAuthOnLoad = true;
</script>

@component('ui.partials.page-card', [
    'title' => __('Roadmap & Futuras Funcionalidades'),
    'subtitle' => __('Visão estratégica e próximas expansões arquiteturais da plataforma de gestão técnica.'),
    'actions' => '<a href="/ui" class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold text-[var(--text)] bg-[var(--surface-2)] hover:bg-[var(--border)] border border-[var(--border)] rounded-xl transition-all"><span>←</span> ' . __('Voltar ao painel') . '</a>'
])

    {{-- Bento Grid de Inovações Futuras --}}
    <div class="grid gap-6 md:grid-cols-2">

        {{-- 1. Manutenção Preventiva --}}
        <div class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm hover:border-primary/40 transition-all flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-500/10 text-2xl">⚙️</span>
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/20 uppercase tracking-wider">
                        {{ __('Planeado para v2.1') }}
                    </span>
                </div>
                <h3 class="text-base font-bold text-[var(--text)]">{{ __('Manutenção Preventiva & Recorrente') }}</h3>
                <p class="mt-2 text-xs text-[var(--text-soft)] leading-relaxed">
                    {{ __('Automação de rotinas periódicas de inspeção, calibração e lubrificação de equipamentos. Geração programada de tickets por cron jobs sem intervenção humana.') }}
                </p>
            </div>
            <div class="mt-6 pt-4 border-t border-[var(--border)] flex items-center gap-2 text-[11px] font-semibold text-primary">
                <span>✦ {{ __('Impacto: Redução do MTTR e paragens não planeadas') }}</span>
            </div>
        </div>

        {{-- 2. Gestão de Stock e Peças --}}
        <div class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm hover:border-primary/40 transition-all flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-500/10 text-2xl">📦</span>
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-500/20 uppercase tracking-wider">
                        {{ __('Planeado para v2.2') }}
                    </span>
                </div>
                <h3 class="text-base font-bold text-[var(--text)]">{{ __('Catálogo de Peças & Gestão de Stock') }}</h3>
                <p class="mt-2 text-xs text-[var(--text-soft)] leading-relaxed">
                    {{ __('Abate automático de consumíveis e peças no ato de fecho de tickets. Alertas inteligentes de stock mínimo para aprovisionamento preventivo no armazém central.') }}
                </p>
            </div>
            <div class="mt-6 pt-4 border-t border-[var(--border)] flex items-center gap-2 text-[11px] font-semibold text-blue-500">
                <span>✦ {{ __('Impacto: Controlo de inventário e transparência financeira') }}</span>
            </div>
        </div>

        {{-- 3. Avaliação CSAT --}}
        <div class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm hover:border-primary/40 transition-all flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-500/10 text-2xl">⭐</span>
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20 uppercase tracking-wider">
                        {{ __('Planeado para v2.3') }}
                    </span>
                </div>
                <h3 class="text-base font-bold text-[var(--text)]">{{ __('Inquéritos de Satisfação (CSAT & Qualidade)') }}</h3>
                <p class="mt-2 text-xs text-[var(--text-soft)] leading-relaxed">
                    {{ __('Envio imediato de micro-inquérito de 1 a 5 estrelas ao requerente assim que a avaria é concluída, com dashboards de produtividade e satisfação por técnico.') }}
                </p>
            </div>
            <div class="mt-6 pt-4 border-t border-[var(--border)] flex items-center gap-2 text-[11px] font-semibold text-emerald-500">
                <span>✦ {{ __('Impacto: Métricas reais de qualidade de serviço') }}</span>
            </div>
        </div>

        {{-- 4. Base de Conhecimento & IA --}}
        <div class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm hover:border-primary/40 transition-all flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-purple-500/10 text-2xl">🧠</span>
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-purple-500/10 text-purple-600 dark:text-purple-400 border border-purple-500/20 uppercase tracking-wider">
                        {{ __('Planeado para v2.4') }}
                    </span>
                </div>
                <h3 class="text-base font-bold text-[var(--text)]">{{ __('Base de Conhecimento IA & Manuais Técnicos') }}</h3>
                <p class="mt-2 text-xs text-[var(--text-soft)] leading-relaxed">
                    {{ __('Repositório de procedimentos operacionais padrão (SOPs) e manuais PDF indexados por inteligência artificial para diagnósticos assistidos aos técnicos.') }}
                </p>
            </div>
            <div class="mt-6 pt-4 border-t border-[var(--border)] flex items-center gap-2 text-[11px] font-semibold text-purple-500">
                <span>✦ {{ __('Impacto: Redução do tempo de diagnóstico') }}</span>
            </div>
        </div>

    </div>

@endcomponent
@endsection