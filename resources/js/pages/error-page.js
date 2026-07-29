export function init() {
    const recoveryBtn = document.getElementById('error-recovery-btn');
    const recoveryText = document.getElementById('error-recovery-text');

    if (!recoveryBtn || !recoveryText) {
        return;
    }

    const hasToken = localStorage.getItem('auth_token') || document.cookie.split('; ').reduce((acc, cookie) => {
        const [key, value] = cookie.split('=');
        return key === 'auth_token' ? value : acc;
    }, null);

    if (!hasToken) {
        return;
    }

    recoveryBtn.href = '/ui';
    recoveryText.innerText = 'Voltar ao Dashboard';
}
