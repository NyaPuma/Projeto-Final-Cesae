<button type="button"
        data-action="open-locale-modal"
        class="locale-trigger inline-flex items-center gap-2 rounded-xl border border-[var(--border)] bg-[var(--surface)] px-3 py-2 text-xs font-semibold text-[var(--text)] shadow-sm transition hover:bg-[var(--surface-2)] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary"
        aria-label="{{ __('common.Alterar idioma e região') }}"
        aria-haspopup="dialog"
        aria-controls="localeModal">
    <span aria-hidden="true">🌐</span>
    <span>{{ strtoupper(substr(app()->getLocale(), 0, 2)) }}</span>
</button>
