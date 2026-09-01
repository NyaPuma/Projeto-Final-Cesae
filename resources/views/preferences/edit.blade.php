@extends('ui.layout')

@section('page_key', 'preferences')

@section('content')
<x-ui.partials.page-header
    :title="__('preferences.Preferências do Utilizador')"
    :subtitle="__('preferences.Ajuste as suas preferências de língua, moeda, formato de data e números independentemente.')"
>
    <div class="mt-6 max-w-5xl">
        <x-ui.form.card
            x-data="{
                saving: false,
                feedback: '',
                async save(select) {
                    this.saving = true;
                    this.feedback = '';
                    const url = select.dataset.ajaxUrl;
                    const body = new FormData();
                    body.append(select.name, select.value);
                    try {
                        const tokenEl = document.querySelector('meta[name=csrf-token]');
                        const res = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': tokenEl ? tokenEl.content : '',
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body
                        });
                        const data = await res.json();
                        this.feedback = res.ok && data.success
                            ? 'Preferências atualizadas com sucesso.'
                            : 'Por favor, tente novamente mais tarde.';
                    } catch (e) {
                        this.feedback = 'Por favor, tente novamente mais tarde.';
                    } finally {
                        this.saving = false;
                    }
                }
            }"
        >
            <form method="POST" action="{{ route('preferences.update_all') }}" class="space-y-8">
                @csrf

                <x-ui.form.field :id="'language'" :label="__('preferences.Língua')">
                    <select id="language" name="language"
                        class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15"
                        data-ajax-url="{{ route('preferences.update_language') }}"
                        @change="save($event.target)"
                    >
                        @foreach($supportedLocales as $code => $meta)
                            <option value="{{ $code }}" {{ $currentLanguage === $code ? 'selected' : '' }}>
                                {{ $meta['name'] ?? $code }}
                            </option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-xs text-[var(--text-soft)]">
                        {{ __('preferences.Controla a língua da interface da aplicação.') }}
                    </p>
                </x-ui.form.field>

                <x-ui.form.field :id="'currency'" :label="__('preferences.Moeda')">
                    <select id="currency" name="currency"
                        class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15"
                        data-ajax-url="{{ route('preferences.update_currency') }}"
                        @change="save($event.target)"
                    >
                        @foreach($supportedCurrencies as $currency)
                            <option value="{{ $currency }}" {{ $currentCurrency === $currency ? 'selected' : '' }}>
                                {{ $currency }}
                            </option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-xs text-[var(--text-soft)]">
                        {{ __('preferences.Formato de valores monetários (ISO 4217).') }}
                    </p>
                </x-ui.form.field>

                <x-ui.form.field :id="'date_format'" :label="__('preferences.Formato de Data')">
                    <select id="date_format" name="date_format"
                        class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15"
                        data-ajax-url="{{ route('preferences.update_date_format') }}"
                        @change="save($event.target)"
                    >
                        @foreach($supportedDateFormats as $format)
                            <option value="{{ $format }}" {{ $currentDateFormat === $format ? 'selected' : '' }}>
                                {{ $format }} ({{ now()->format($format) }})
                            </option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-xs text-[var(--text-soft)]">
                        {{ __('preferences.Formato usado para exibir datas.') }}
                    </p>
                </x-ui.form.field>

                <x-ui.form.field :id="'time_format'" :label="__('preferences.Formato de Hora')">
                    <select id="time_format" name="time_format"
                        class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15"
                        data-ajax-url="{{ route('preferences.update_time_format') }}"
                        @change="save($event.target)"
                    >
                        @foreach($supportedTimeFormats as $format => $meta)
                            <option value="{{ $format }}" {{ $currentTimeFormat === $format ? 'selected' : '' }}>
                                {{ $meta['label'] }} ({{ $meta['example'] }})
                            </option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-xs text-[var(--text-soft)]">
                        {{ __('preferences.Formato usado para exibir horas.') }}
                    </p>
                </x-ui.form.field>

                <x-ui.form.field :id="'number_format'" :label="__('preferences.Formato de Números')">
                    <select id="number_format" name="number_format"
                        class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15"
                        data-ajax-url="{{ route('preferences.update_number_format') }}"
                        @change="save($event.target)"
                    >
                        @foreach($supportedNumberFormats as $key => $format)
                            <option value="{{ json_encode($format) }}" {{ $currentNumberFormat === json_encode($format) ? 'selected' : '' }}>
                                {{ $format['example'] ?? $key }}
                            </option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-xs text-[var(--text-soft)]">
                        {{ __('preferences.Formato usado para exibir números (separadores decimal e de milhar).') }}
                    </p>
                </x-ui.form.field>

                <p x-show="feedback" x-cloak x-text="feedback" class="text-sm font-semibold text-success"></p>

                <div class="flex items-center justify-end gap-3 border-t border-[var(--border)] pt-6">
                    <x-ui.buttons.submit size="md" weight="bold">
                        {{ __('preferences.Guardar Todas as Preferências') }}
                    </x-ui.buttons.submit>
                </div>
            </form>
        </x-ui.form.card>
    </div>
</x-ui.partials.page-header>
@endsection