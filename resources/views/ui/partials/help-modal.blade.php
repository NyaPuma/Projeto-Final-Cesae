<div id="quickHelpModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/70 backdrop-blur-sm p-4 overflow-y-auto">
    <div class="relative w-full max-w-2xl rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 sm:p-8 shadow-2xl transition-all my-auto animate-[fadeIn_0.2s_ease-out]">
        
        {{-- Cabeçalho do Modal --}}
        <div class="flex items-start justify-between pb-4 border-b border-[var(--border)]">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-primary/10 text-primary">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M12 18h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-black text-[var(--text)]">{{ __('Centro de Ajuda & Guia Operacional') }}</h3>
                    <p class="text-xs text-[var(--text-soft)]">
                        {{ __('Guia de utilização adaptado ao perfil:') }} 
                        <span class="font-bold text-primary">{{ __(auth()->user()->profile->name ?? auth()->user()->role ?? 'Utilizador') }}</span>
                    </p>
                </div>
            </div>
            <button onclick="closeQuickHelpModal()" class="rounded-xl p-1.5 text-[var(--text-soft)] hover:bg-[var(--surface-2)] hover:text-[var(--text)] transition-colors cursor-pointer">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        {{-- Conteúdo Dinâmico por Perfil --}}
        <div class="py-6 space-y-6 text-xs text-[var(--text)]">

            @if(auth()->check() && (auth()->user()->isAdmin()))
                {{-- Guia de Administrador --}}
                <div class="space-y-4">
                    <div class="flex items-start gap-3 rounded-2xl border border-[var(--border)] bg-[var(--surface-2)]/60 p-4">
                        <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg bg-orange-500/10 font-bold text-orange-500">1</span>
                        <div>
                            <h4 class="font-bold text-sm">{{ __('Monitorização Global & Analytics') }}</h4>
                            <p class="text-[var(--text-soft)] mt-1 leading-relaxed">
                                {{ __('Acompanhe no Dashboard e no Centro Analítico indicadores em tempo real como MTTR (tempo médio de resolução), taxa de SLA e custos acumulados por intervenção.') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 rounded-2xl border border-[var(--border)] bg-[var(--surface-2)]/60 p-4">
                        <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg bg-orange-500/10 font-bold text-orange-500">2</span>
                        <div>
                            <h4 class="font-bold text-sm">{{ __('Controlo Orçamental') }}</h4>
                            <p class="text-[var(--text-soft)] mt-1 leading-relaxed">
                                {{ __('Orçamentos submetidos por técnicos com valor superior a 100€ requerem aprovação explícita na secção de Orçamentos antes da reparação avançar.') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 rounded-2xl border border-[var(--border)] bg-[var(--surface-2)]/60 p-4">
                        <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg bg-orange-500/10 font-bold text-orange-500">3</span>
                        <div>
                            <h4 class="font-bold text-sm">{{ __('Gestão de Ativos & Auditoria') }}</h4>
                            <p class="text-[var(--text-soft)] mt-1 leading-relaxed">
                                {{ __('Adicione e edite Equipamentos, Salas e Utilizadores. Consulte os registos de Auditoria para histórico detalhado de alterações no sistema.') }}
                            </p>
                        </div>
                    </div>
                </div>

            @elseif(auth()->check() && (auth()->user()->isTechnician()))
                {{-- Guia de Técnico --}}
                <div class="space-y-4">
                    <div class="flex items-start gap-3 rounded-2xl border border-[var(--border)] bg-[var(--surface-2)]/60 p-4">
                        <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg bg-emerald-500/10 font-bold text-emerald-500">1</span>
                        <div>
                            <h4 class="font-bold text-sm">{{ __('Gestão e Assunção de Tickets') }}</h4>
                            <p class="text-[var(--text-soft)] mt-1 leading-relaxed">
                                {{ __('Assuma tickets abertos ou consulte as ocorrências que lhe foram atribuídas. Lembre-se de que tickets de prioridade Crítica não podem ser libertados voluntariamente.') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 rounded-2xl border border-[var(--border)] bg-[var(--surface-2)]/60 p-4">
                        <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg bg-emerald-500/10 font-bold text-emerald-500">2</span>
                        <div>
                            <h4 class="font-bold text-sm">{{ __('Submissão de Orçamentos') }}</h4>
                            <p class="text-[var(--text-soft)] mt-1 leading-relaxed">
                                {{ __('Se a intervenção requerer custos adicionais, submeta a estimativa com discriminação de peças e mão-de-obra. Valores até 100€ são auto-aprovados instantaneamente.') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 rounded-2xl border border-[var(--border)] bg-[var(--surface-2)]/60 p-4">
                        <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg bg-emerald-500/10 font-bold text-emerald-500">3</span>
                        <div>
                            <h4 class="font-bold text-sm">{{ __('Conclusão de Intervenções') }}</h4>
                            <p class="text-[var(--text-soft)] mt-1 leading-relaxed">
                                {{ __('Ao concluir uma reparação, anexe o relatório técnico, tempo despendido e confirme o encerramento do ticket.') }}
                            </p>
                        </div>
                    </div>
                </div>

            @else
                {{-- Guia de Utilizador Comum / Operador --}}
                <div class="space-y-4">
                    <div class="flex items-start gap-3 rounded-2xl border border-[var(--border)] bg-[var(--surface-2)]/60 p-4">
                        <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg bg-blue-500/10 font-bold text-blue-500">1</span>
                        <div>
                            <h4 class="font-bold text-sm">{{ __('Reportar Avarias') }}</h4>
                            <p class="text-[var(--text-soft)] mt-1 leading-relaxed">
                                {{ __('Clique em "+ Criar Ticket", descreva detalhadamente a avaria, selecione a sala e equipamento afetado e adicione uma fotografia se aplicável.') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 rounded-2xl border border-[var(--border)] bg-[var(--surface-2)]/60 p-4">
                        <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg bg-blue-500/10 font-bold text-blue-500">2</span>
                        <div>
                            <h4 class="font-bold text-sm">{{ __('Acompanhamento de Estado') }}</h4>
                            <p class="text-[var(--text-soft)] mt-1 leading-relaxed">
                                {{ __('Verifique o progresso das suas ocorrências em tempo real na vista de Tickets. Receberá alertas quando um técnico for atribuído ou quando a intervenção for concluída.') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 rounded-2xl border border-[var(--border)] bg-[var(--surface-2)]/60 p-4">
                        <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg bg-blue-500/10 font-bold text-blue-500">3</span>
                        <div>
                            <h4 class="font-bold text-sm">{{ __('Comentários & Cancelamento') }}</h4>
                            <p class="text-[var(--text-soft)] mt-1 leading-relaxed">
                                {{ __('Pode trocar mensagens diretamente com a equipa técnica através dos comentários do ticket ou cancelar o pedido caso a situação se resolva.') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

        </div>

        {{-- Rodapé --}}
        <div class="flex items-center justify-end pt-4 border-t border-[var(--border)]">
            <button type="button" onclick="closeQuickHelpModal()" class="px-5 py-2.5 text-xs font-bold text-white bg-primary hover:opacity-90 rounded-xl shadow-sm transition-all cursor-pointer">
                {{ __('Entendido') }}
            </button>
        </div>

    </div>
</div>

<script>
function openQuickHelpModal() {
    const modal = document.getElementById('quickHelpModal');
    if (!modal) return;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.classList.add('overflow-hidden');
}

function closeQuickHelpModal() {
    const modal = document.getElementById('quickHelpModal');
    if (!modal) return;
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.classList.remove('overflow-hidden');
}
</script>