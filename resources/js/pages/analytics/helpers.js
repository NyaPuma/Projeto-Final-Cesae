/**
 * Analytics Dashboard Helpers
 * Theme colors, data fetching, and utility functions
 */

export function getThemeColors() {
    const style = getComputedStyle(document.documentElement);
    const isDark = document.documentElement.classList.contains('dark');
    
    return {
        text: style.getPropertyValue('--text').trim() || (isDark ? '#f8fafc' : '#0f172a'),
        textSoft: style.getPropertyValue('--text-soft').trim() || (isDark ? '#cbd5e1' : '#475569'),
        border: style.getPropertyValue('--border').trim() || (isDark ? '#2d3748' : '#e2e8f0'),
        primary: style.getPropertyValue('--primary').trim() || '#4f46e5',
        primaryHover: style.getPropertyValue('--primary-hover').trim() || '#4338ca',
        primaryLight: style.getPropertyValue('--primary-light').trim() || 'rgba(79, 70, 229, 0.1)',
    };
}

export async function fetchAnalytics() {
    try {
        const response = await fetch("/analytics", {
            method: "GET",
            headers: {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                ...((typeof window.authHeader === "function") ? window.authHeader() : {})
            },
            credentials: "include"
        });

        if (!response.ok) throw new Error(`Status ${response.status}`);
        return await response.json();
    } catch (error) {
        console.error("Dashboard Error:", error);
        return null;
    }
}

export function showMessage(element, message, type = "success") {
    if (!element) return;
    const box = element;
    box.className = `mt-6 rounded-2xl border px-5 py-4 text-sm font-medium ${type === 'error' ? 'border-red-300 bg-red-50 text-red-700' : 'border-emerald-300 bg-emerald-50 text-emerald-700'}`;
    box.textContent = message;
}

export function clearMessage(element) {
    if (element) element.className = "hidden";
}
