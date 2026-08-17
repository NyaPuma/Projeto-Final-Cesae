@extends('layouts.app')

@section('title', __('preferences.Preferências do Utilizador'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
            {{ __('preferences.Preferências do Utilizador') }}
        </h1>

        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">
                {{ __('preferences.Configurações Independentes') }}
            </h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                {{ __('preferences.Ajuste as suas preferências de língua, moeda, formato de data e números independentemente.') }}
            </p>
        </div>

        <form method="POST" action="{{ route('preferences.update_all') }}" class="space-y-8">
            @csrf

            <!-- Língua -->
            <div>
                <label for="language" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('preferences.Língua') }}
                </label>
                <select 
                    id="language" 
                    name="language" 
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                    data-ajax-url="{{ route('preferences.update_language') }}"
                >
                    @foreach($supportedLocales as $code => $meta)
                        <option value="{{ $code }}" {{ $currentLanguage === $code ? 'selected' : '' }}>
                            {{ $meta['name'] ?? $code }}
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    {{ __('preferences.Controla a língua da interface da aplicação.') }}
                </p>
            </div>

            <!-- Moeda -->
            <div>
                <label for="currency" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('preferences.Moeda') }}
                </label>
                <select 
                    id="currency" 
                    name="currency" 
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                    data-ajax-url="{{ route('preferences.update_currency') }}"
                >
                    @foreach($supportedCurrencies as $currency)
                        <option value="{{ $currency }}" {{ $currentCurrency === $currency ? 'selected' : '' }}>
                            {{ $currency }}
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    {{ __('preferences.Formato de valores monetários (ISO 4217).') }}
                </p>
            </div>

            <!-- Formato de Data -->
            <div>
                <label for="date_format" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('preferences.Formato de Data') }}
                </label>
                <select 
                    id="date_format" 
                    name="date_format" 
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                    data-ajax-url="{{ route('preferences.update_date_format') }}"
                >
                    @foreach($supportedDateFormats as $format)
                        <option value="{{ $format }}" {{ $currentDateFormat === $format ? 'selected' : '' }}>
                            {{ $format }} ({{ now()->format($format) }})
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    {{ __('preferences.Formato usado para exibir datas.') }}
                </p>
            </div>

            <!-- Formato de Hora -->
            <div>
                <label for="time_format" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('preferences.Formato de Hora') }}
                </label>
                <select 
                    id="time_format" 
                    name="time_format" 
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                    data-ajax-url="{{ route('preferences.update_time_format') }}"
                >
                    @foreach($supportedTimeFormats as $format => $meta)
                        <option value="{{ $format }}" {{ $currentTimeFormat === $format ? 'selected' : '' }}>
                            {{ $meta['label'] }} ({{ $meta['example'] }})
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    {{ __('preferences.Formato usado para exibir horas.') }}
                </p>
            </div>

            <!-- Formato de Números -->
            <div>
                <label for="number_format" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('preferences.Formato de Números') }}
                </label>
                <select 
                    id="number_format" 
                    name="number_format" 
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                    data-ajax-url="{{ route('preferences.update_number_format') }}"
                >
                    @foreach($supportedNumberFormats as $key => $format)
                        <option value="{{ json_encode($format) }}" {{ $currentNumberFormat === json_encode($format) ? 'selected' : '' }}>
                            {{ $format['example'] ?? $key }}
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    {{ __('preferences.Formato usado para exibir números (separadores decimal e de milhar).') }}
                </p>
            </div>

            <div class="pt-6">
                <button 
                    type="submit" 
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                >
                    {{ __('preferences.Guardar Todas as Preferências') }}
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
// Atualização via AJAX para cada campo
function setupAjaxUpdate() {
    document.querySelectorAll('select[data-ajax-url]').forEach(select => {
        select.addEventListener('change', function() {
            const url = this.dataset.ajaxUrl;
            const formData = new FormData();
            formData.append(this.name, this.value);
            
            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.message || 'Atualizado com sucesso!', 'success');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Ocorreu um erro ao atualizar.', 'error');
            });
        });
    });
}

// Função para mostrar notificações (simples)
function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 px-4 py-2 rounded-md shadow-lg ${
        type === 'success' 
            ? 'bg-green-500 text-white' 
            : 'bg-red-500 text-white'
    }`;
    notification.textContent = message;
    notification.style.zIndex = '1000';
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Inicializar quando a página carregar
document.addEventListener('DOMContentLoaded', setupAjaxUpdate);
</script>
@endpush
@endsection
