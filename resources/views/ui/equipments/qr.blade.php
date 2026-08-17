@extends('ui.layout')

@section('page_key', 'equipment-qr')

@section('content')
<x-ui.partials.page-header
    :title="__('common.Código QR')"
    :subtitle="trim(($equipment->brand ?? '') . ' ' . ($equipment->model ?? '')) ?: $equipment->name"
    :badge="$equipment->serial"
>
    <x-slot:actions>
        <x-ui.page-actions.group>
            <x-ui.page-actions.back-button :href="route('ui.equipments.show', $equipment)" :label="__('equipment.Voltar ao Equipamento')" />
        </x-ui.page-actions.group>
    </x-slot:actions>

    <div class="grid items-start gap-6 lg:grid-cols-[1fr_1.1fr]">

        {{-- QR Code --}}
        <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-8 shadow-sm">
            <div class="mb-4 flex items-center justify-between border-b border-[var(--border)] pb-3">
                <h3 class="text-xs font-black uppercase tracking-wider text-[var(--text)]">{{ __('equipment.QR Code do Equipamento') }}</h3>
                <span class="rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-2 py-0.5 text-[9px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ $equipment->asset_tag ?? __('common.sem etiqueta') }}</span>
            </div>

            <div class="mx-auto flex w-fit flex-col items-center rounded-2xl border border-[var(--border)] bg-white p-5 shadow-inner">
                <img src="{{ $qrDataUri }}" alt="{{ __('common.QR Code de :name', ['name' => $equipment->name]) }}" class="h-64 w-64">
                <p class="mt-4 text-center text-[11px] font-semibold leading-5 text-[var(--text)]">{{ $equipment->name }}</p>
                <p class="text-center text-[10px] text-[var(--text-soft)]">{{ __('ui.Aponte a câmara para abrir o formulário de avaria.') }}</p>
            </div>

            <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                <a href="{{ route('ui.equipments.qr.download', $equipment) }}"
                    class="inline-flex flex-1 items-center justify-center gap-2 rounded-xl bg-primary px-4 py-3 text-xs font-black uppercase tracking-wider text-white shadow-lg shadow-primary/20 transition hover:opacity-90">
                    ⬇ {{ __('ui.Descarregar PNG') }}
                </a>
                <button type="button" onclick="window.print()"
                    class="inline-flex flex-1 items-center justify-center gap-2 rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-xs font-black uppercase tracking-wider text-[var(--text)] transition hover:bg-[var(--border)]">
                    🖨 {{ __('common.Imprimir') }}
                </button>
            </div>
        </div>

        {{-- Informação e Ações --}}
        <div class="space-y-6">
            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
                <h3 class="mb-4 text-xs font-black uppercase tracking-wider text-[var(--text)]">{{ __('equipment.Informação do Equipamento') }}</h3>
                <dl class="grid gap-x-6 gap-y-4 sm:grid-cols-2">
                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Número de Série') }}</dt>
                        <dd class="mt-1 font-mono text-xs font-semibold text-[var(--text)]">{{ $equipment->serial ?? __('common.Não definido') }}</dd>
                    </div>
                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('equipment.Etiqueta de Ativo') }}</dt>
                        <dd class="mt-1 font-mono text-xs font-semibold text-[var(--text)]">{{ $equipment->asset_tag ?? __('common.Não definida') }}</dd>
                    </div>
                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Categoria') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ $equipment->category?->name ?? __('common.Sem categoria') }}</dd>
                    </div>
                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('room.Sala') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ $equipment->room?->name ?? __('common.Não associada') }}</dd>
                    </div>
                </dl>
            </div>

            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
                <h3 class="mb-4 text-xs font-black uppercase tracking-wider text-[var(--text)]">{{ __('common.Link Codificado') }}</h3>
                <div class="rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3">
                    <p class="break-all font-mono text-[11px] leading-5 text-[var(--text-soft)]">{{ $ticketUrl }}</p>
                </div>
                <p class="mt-3 text-[11px] leading-5 text-[var(--text-soft)]">
                    {{ __('equipment.Este endereço abre o formulário público de reporte para este equipamento, sem necessidade de conta.') }}
                </p>
            </div>

            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
                <h3 class="mb-3 text-xs font-black uppercase tracking-wider text-[var(--text)]">{{ __('common.Exportação em Lote') }}</h3>
                <p class="mb-4 text-[11px] leading-5 text-[var(--text-soft)]">
                    {{ __('equipment.Gere um PDF com os QR Codes de todos os equipamentos ativos para impressão e afixação.') }}
                </p>
                <div data-async-message class="mb-4 hidden rounded-xl border px-4 py-3 text-xs font-medium"></div>
                <a href="{{ route('ui.equipments.qr.export') }}"
                    data-async-export="pdf"
                    data-processing-label="A gerar PDF..."
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-xs font-black uppercase tracking-wider text-[var(--text)] transition hover:bg-[var(--border)]">
                    📄 {{ __('common.Exportar Todos (PDF)') }}
                </a>
            </div>
        </div>
    </div>
</x-ui.partials.page-header>
@endsection
