export function showMessage(message, isError = false) {
    const element = document.getElementById('ticketMessage');

    if (!element) return;

    element.innerText = message;
    element.className = `mt-4 min-h-6 px-1 text-xs font-medium transition-all duration-300 ${isError ? 'text-rose-500' : 'text-emerald-500'}`;

    setTimeout(() => {
        element.innerText = '';
    }, 5000);
}

export function setHtml(id, html) {
    const element = document.getElementById(id);

    if (element) {
        element.innerHTML = html;
    }
}
