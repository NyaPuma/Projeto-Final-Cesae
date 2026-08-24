<div id="qrCodeModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/70 backdrop-blur-sm p-4 overflow-y-auto">
    <div class="relative w-full max-w-sm rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-2xl transition-all my-auto text-center">
        
        <h3 class="text-base font-bold text-[var(--text)]" id="qrModalTitle">{{ __('Etiqueta QR Code') }}</h3>
        <p class="text-xs text-[var(--text-soft)] mt-1" id="qrModalSubtitle">{{ __('Digitalize para criar ticket instantâneo') }}</p>

        <div class="my-6 flex justify-center">
            <div id="qrCodeContainer" class="p-4 bg-white rounded-2xl border border-slate-200 shadow-sm inline-block">
                {{-- Imagem do QR Code gerada dinamicamente via API leve --}}
                <img id="qrCodeImg" src="" alt="QR Code" class="w-48 h-48 mx-auto" />
            </div>
        </div>

        <div class="flex items-center justify-center gap-2 pt-2 border-t border-[var(--border)]">
            <button type="button" onclick="window.print()" class="px-4 py-2 text-xs font-bold text-white bg-primary hover:opacity-90 rounded-xl shadow-sm transition-all cursor-pointer">
                🖨️ {{ __('Imprimir Etiqueta') }}
            </button>
            <button type="button" onclick="closeQrModal()" class="px-4 py-2 text-xs font-semibold text-[var(--text)] bg-[var(--surface-2)] border border-[var(--border)] rounded-xl hover:bg-[var(--border)] transition-all cursor-pointer">
                {{ __('Fechar') }}
            </button>
        </div>

    </div>
</div>

<script>
function showAssetQrCode(type, id, name) {
    const title = document.getElementById('qrModalTitle');
    const subtitle = document.getElementById('qrModalSubtitle');
    const img = document.getElementById('qrCodeImg');
    const modal = document.getElementById('qrCodeModal');

    const baseUrl = window.location.origin;
    const targetUrl = type === 'equipment' 
        ? `${baseUrl}/ui/tickets/create?equipment_id=${id}`
        : `${baseUrl}/ui/tickets/create?room_id=${id}`;

    if (title) title.textContent = name;
    if (subtitle) subtitle.textContent = type === 'equipment' ? `{{ __('Equipamento #') }}${id}` : `{{ __('Sala #') }}${id}`;

    // Gerador de QR Code standard e rápido
    img.src = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(targetUrl)}`;

    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    document.body.classList.add('overflow-hidden');
}

function closeQrModal() {
    const modal = document.getElementById('qrCodeModal');
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
    document.body.classList.remove('overflow-hidden');
}
</script>