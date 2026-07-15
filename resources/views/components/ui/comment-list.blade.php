<!-- resources/views/components/ui/comment-list.blade.php -->
@props(['comments' => []])

<div class="space-y-6 mt-8" id="comments-section">
    <h3 class="text-sm font-bold uppercase tracking-wider text-[var(--text-soft)]">Histórico de Interação</h3>
    
    <div class="space-y-4" id="comments-container">
        @forelse($comments as $comment)
            <div class="flex gap-4 p-4 rounded-xl border border-[var(--border)] bg-[var(--surface)]">
                <div class="flex-shrink-0 w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center font-bold text-xs text-primary">
                    {{ substr($comment->user_name, 0, 1) }}
                </div>
                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-semibold text-[var(--text)]">{{ $comment->user_name }}</span>
                        <span class="text-[10px] text-[var(--text-soft)]">{{ $comment->created_at }}</span>
                    </div>
                    <p class="mt-1 text-sm text-[var(--text-soft)] leading-relaxed">{{ $comment->content }}</p>
                    
                    @if(!empty($comment->attachments))
                        <div class="mt-3 flex gap-2">
                            @foreach($comment->attachments as $attachment)
                                <a href="{{ $attachment }}" target="_blank" class="w-16 h-16 rounded-lg overflow-hidden border border-[var(--border)] block">
                                    <img src="{{ $attachment }}" class="w-full h-full object-cover">
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="p-8 text-center rounded-xl border border-dashed border-[var(--border)] text-sm text-[var(--text-soft)]">
                Ainda não existem comentários neste ticket.
            </div>
        @endforelse
    </div>
</div>
