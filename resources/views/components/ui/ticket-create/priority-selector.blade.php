{{--|-------------------------------------------------------------------------- |Ticket Priority Selection Component (Otimizado)Componente de seleção de prioridade de tickets com suporte a validação.• Persistência automática de estado via old() do Laravel.• Totalmente acessível e sem CSS ou JS inline.--}}
<input
    id="ticketPriority"
    name="priority"
    type="hidden"
    value="{{ old('priority', 'media') }}"
    required
>

<div class="grid gap-4 md:grid-cols-4">
    <x-ui.ticket-create.priority-card
        priority="baixa"
        :label="__('Baixa')"
        :title="__('Manutenção Ligeira')"
        :description="__('Anomalia menor. Máquina operacional sem risco imediato.')"
        dot_class="bg-emerald-500"
        active_border_class="border-emerald-500"
        hover_border_class="hover:border-emerald-500/50"
        :active="old('priority', 'media') === 'baixa'"
    />

    <x-ui.ticket-create.priority-card
        priority="media"
        :label="__('Média')"
        :title="__('Degradação Parcial')"
        :description="__('Funcionamento condicionado. Existe alternativa na sala.')"
        dot_class="bg-amber-500"
        active_border_class="border-amber-500"
        hover_border_class="hover:border-amber-500/50"
        :active="old('priority', 'media') === 'media'"
    />

    <x-ui.ticket-create.priority-card
        priority="alta"
        :label="__('Alta')"
        :title="__('Paragem Crítica / Risco')"
        :description="__('Linha/Máquina inoperacional ou risco de segurança.')"
        dot_class="bg-red-500"
        active_border_class="border-red-500"
        hover_border_class="hover:border-red-500/50"
        :active="old('priority', 'media') === 'alta'"
    />

    <x-ui.ticket-create.priority-card
        priority="critica"
        :label="__('Crítica')"
        :title="__('Emergência Imediata')"
        :description="__('Risco iminente de acidente ou paragem total da operação. Exige ação urgente.')"
        dot_class="bg-purple-600"
        active_border_class="border-purple-600"
        hover_border_class="hover:border-purple-600/50"
        :active="old('priority', 'media') === 'critica'"
    />
</div>
