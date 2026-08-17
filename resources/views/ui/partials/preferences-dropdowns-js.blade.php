<script>
// Fechar todos os dropdowns de preferências quando se clica fora
function closeAllPreferenceDropdowns() {
    document.getElementById('languageDropdownPanel')?.setAttribute('hidden', '');
    document.getElementById('currencyDropdownPanel')?.setAttribute('hidden', '');
    document.getElementById('dateFormatDropdownPanel')?.setAttribute('hidden', '');
    
    // Atualizar aria-expanded
    document.querySelectorAll('.ui-topbar__dropdown button[aria-expanded]').forEach(btn => {
        btn.setAttribute('aria-expanded', 'false');
    });
}

// Fechar dropdowns quando se clica fora
document.addEventListener('click', function(e) {
    const languageDropdown = document.getElementById('languageDropdown');
    const currencyDropdown = document.getElementById('currencyDropdown');
    const dateFormatDropdown = document.getElementById('dateFormatDropdown');
    
    if (languageDropdown && !languageDropdown.contains(e.target) &&
        currencyDropdown && !currencyDropdown.contains(e.target) &&
        dateFormatDropdown && !dateFormatDropdown.contains(e.target)) {
        closeAllPreferenceDropdowns();
    }
});

// Função para abrir apenas um dropdown e fechar os outros
function openPreferenceDropdown(dropdownId, panelId) {
    // Fechar todos
    closeAllPreferenceDropdowns();
    
    // Abrir o solicitado
    const panel = document.getElementById(panelId);
    const button = document.querySelector('#' + dropdownId + ' button[aria-expanded]');
    
    if (panel && button) {
        panel.removeAttribute('hidden');
        button.setAttribute('aria-expanded', 'true');
    }
}

// Função genérica para atualizar preferências
function setPreference(url, data, dropdownId) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
    
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Fechar dropdown
            closeAllPreferenceDropdowns();
            // Recarregar página para aplicar mudanças
            location.reload();
        }
    })
    .catch(error => console.error('Error:', error));
}

// Exportar funções para uso nos dropdowns individuais
window.openPreferenceDropdown = openPreferenceDropdown;
window.closeAllPreferenceDropdowns = closeAllPreferenceDropdowns;
window.setPreference = setPreference;
</script>
