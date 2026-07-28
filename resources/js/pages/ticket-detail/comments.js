import { authHeader } from '../../utils/api.js';
import { state } from './state.js';
import { showMessage } from './ui.js';

export async function fetchComments() {
    const section = document.getElementById('commentsSection');
    if (!section) return;

    try {
        const response = await fetch(`/tickets/${state.ticketId}/comments`, { headers: authHeader() });
        if (!response.ok) return;

        const data = await response.json();
        const comments = data.comments || data;

        if (!comments || comments.length === 0) {
            section.innerHTML = '<p class="py-1 italic text-[var(--text-soft)]">Sem mensagens registadas.</p>';
            return;
        }

        section.innerHTML = comments.map((comment) => `
            <div class="space-y-1 border-b border-[var(--border)]/50 py-2">
                <div class="flex justify-between font-bold text-[var(--text)]">
                    <span>${comment.user ? comment.user.name : 'Sistema'}</span>
                    <span class="font-mono text-[10px] text-[var(--text-soft)]">${comment.created_at || ''}</span>
                </div>
                <p class="text-[var(--text-soft)]">${comment.comment || comment.message || ''}</p>
            </div>
        `).join('');
    } catch {
        section.innerHTML = '<p class="py-1 italic text-rose-500">Erro ao carregar histórico.</p>';
    }
}

export function bindCommentForm() {
    document.getElementById('commentForm')?.addEventListener('submit', async (event) => {
        event.preventDefault();

        const text = document.getElementById('commentText')?.value.trim();
        if (!text) return;

        const response = await fetch(`/tickets/${state.ticketId}/comments`, {
            method: 'POST',
            headers: { ...authHeader(), 'Content-Type': 'application/json' },
            body: JSON.stringify({ comment: text }),
        });

        if (!response.ok) return;

        document.getElementById('commentText').value = '';
        await fetchComments();
        showMessage('Mensagem enviada!');
    });
}
