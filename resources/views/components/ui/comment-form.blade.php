<!-- resources/views/components/ui/comment-form.blade.php -->
@props(['ticketId'])

<form id="commentForm" class="mt-8 p-6 rounded-2xl border border-[var(--border)] bg-[var(--surface-2)]/50" onsubmit="submitComment(event)">
    @csrf
    <input type="hidden" name="ticket_id" value="{{ $ticketId }}">

    <h4 class="text-sm font-semibold text-[var(--text)] mb-4">Adicionar Resposta</h4>

    <textarea
        name="content"
        required
        rows="3"
        class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface)] p-4 text-sm focus:ring-2 focus:ring-primary/20 outline-none"
        placeholder="Escreva a sua resposta ou atualização sobre este ticket..."
    ></textarea>

    <div class="mt-4">
        <x-ui.file-upload name="attachments" label="Adicionar fotografias (opcional)" :multiple="true" />
    </div>

    <div class="mt-6 flex justify-end">
        <button type="submit" class="btn btn-primary px-6 py-2.5 rounded-xl font-bold text-sm bg-primary text-black hover:opacity-90">
            Enviar Comentário
        </button>
    </div>
</form>

<script>
async function submitComment(e) {
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);

    try {
        const response = await fetch('/api/comments', {
            method: 'POST',
            headers: authHeader(),
            body: formData
        });

        if (!response.ok) throw new Error('Erro ao enviar comentário');

        // Limpar formulário e recarregar ou adicionar dinamicamente
        form.reset();
        document.getElementById('attachments-preview').innerHTML = '';
        window.location.reload(); // Alternativa simples para refrescar a lista
    } catch (err) {
        alert('Falha ao submeter comentário. Tente novamente.');
    }
}
</script>
