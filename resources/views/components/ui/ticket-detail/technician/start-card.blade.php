<div id="techStartCard" class="hidden rounded-2xl border border-blue-500/30 bg-blue-500/5 p-6 shadow-sm space-y-4">
    <div class="flex items-start gap-3">
        <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-blue-500/20">
            <svg class="h-5 w-5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
            </svg>
        </div>
        <div class="flex-1">
            <h3 class="text-sm font-bold text-[var(--text)]">{{ __('Iniciar Reparação') }}</h3>
            <p class="mt-1 text-xs text-[var(--text-soft)]">
                {{ __('Assuma a responsabilidade por este ticket e inicie a intervenção técnica. O sistema verificará se existem tickets mais prioritários pendentes.') }}
            </p>
        </div>
    </div>

    <div class="rounded-xl border border-blue-500/20 bg-blue-500/5 p-3 text-xs text-[var(--text-soft)]">
        <div class="flex items-center gap-2">
            <span class="h-2 w-2 rounded-full bg-blue-500 animate-pulse"></span>
            <span>{{ __('O ticket está no estado') }} <strong class="text-[var(--text)]">&quot;{{ __('Aberta') }}&quot;</strong>. {{ __('Clique no botão abaixo para começar.') }}</span>
        </div>
    </div>

    <div class="flex gap-3 pt-1">
        <button id="btnStartRepair" type="button" class="flex-1 inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-xs font-bold text-white shadow-sm transition-all hover:bg-blue-500 cursor-pointer">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z"></path></svg>
            {{ __('Iniciar Intervenção') }}
        </button>
        <button id="btnStartRepairForce" type="button" class="hidden flex-1 inline-flex items-center justify-center gap-2 rounded-xl bg-amber-600 px-4 py-2.5 text-xs font-bold text-white shadow-sm transition-all hover:bg-amber-500 cursor-pointer">
            <span>⚠️</span>
            {{ __('Forçar Início (ignorar prioritários)') }}
        </button>
    </div>
</div>
