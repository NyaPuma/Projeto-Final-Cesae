/**
 * Calendar Page Module
 * Handles FullCalendar initialization and event management
 */

import { authHeader, isAuthenticated } from '../core/auth.js';

let calendar;
let lastFocusedElement = null;

function openModal(title, start, end) {
    // Guarda o elemento focado para devolver o foco após fechar (WCAG 2.4.3)
    lastFocusedElement = document.activeElement;

    document.getElementById('modalTitle').innerText = `🔧 ${title}`;
    document.getElementById('modalStart').innerText = start;
    document.getElementById('modalEnd').innerText = end;

    const modal = document.getElementById('eventModal');
    modal.classList.remove('hidden');

    // Coloca o foco no botão de fechar para rápida interação por teclado
    setTimeout(() => {
        document.getElementById('closeModalBtn').focus();
    }, 50);

    // Fechar modal ao pressionar ESC
    document.addEventListener('keydown', handleEscapeKey);
}

function closeModal() {
    const modal = document.getElementById('eventModal');
    modal.classList.add('hidden');
    document.removeEventListener('keydown', handleEscapeKey);

    // Devolve o foco ao elemento original (WCAG)
    if (lastFocusedElement) {
        lastFocusedElement.focus();
    }
}

function handleEscapeKey(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
}

function goToToday() {
    if (calendar && typeof calendar.today === 'function') {
        calendar.today();
    }
}

export function initCalendar(loginUrl) {
    if (!isAuthenticated()) {
        window.location.href = loginUrl;
        return;
    }

    const calendarEl = document.getElementById("calendar");

    if (calendarEl) {
        calendar = new FullCalendar.Calendar(calendarEl, {
            locale: document.documentElement.lang === 'en' ? 'en' : 'pt',
            initialView: "dayGridMonth",
            height: "auto",
            firstDay: 1, // Começa na Segunda-feira
            nowIndicator: true,
            navLinks: true,
            editable: false,
            selectable: true,
            expandRows: true,
            dayMaxEvents: true,
            weekends: true,

            buttonText: {
                today: "Hoje",
                month: "Mês",
                week: "Semana",
                day: "Dia"
            },

            headerToolbar: {
                left: "prev,next",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay"
            },

            datesSet: function(dateInfo) {
                if (calendar && typeof calendar.refetchEvents === 'function') {
                    // Atualiza os totais e recarrega os dados da rota /calendar/events
                }
            },

            events(fetchInfo, successCallback, failureCallback) {
                fetch("/calendar/events", {
                        headers: authHeader()
                    })
                    .then(response => {
                        if (!response.ok) {
                            if (response.status === 401) {
                                window.location.href = loginUrl;
                                return;
                            }
                            throw new Error("Erro ao carregar eventos da infraestrutura.");
                        }
                        return response.json();
                    })
                    .then(events => {
                        if (!events) return;

                        // Atualiza o total absoluto no painel lateral
                        const totalEl = document.getElementById("eventsTotal");
                        if (totalEl) totalEl.innerText = events.length;

                        // Determinar dinamicamente o mês em visualização ativa
                        const currentPeriod = calendar ? calendar.getDate() : fetchInfo.start;
                        const activeMonth = currentPeriod.getMonth();
                        const activeYear = currentPeriod.getFullYear();

                        // Filtrar eventos do mês ativo na vista do utilizador
                        const totalMonth = events.filter(e => {
                            const eventDate = new Date(e.start);
                            return eventDate.getMonth() === activeMonth && eventDate
                                .getFullYear() === activeYear;
                        }).length;

                        const monthEl = document.getElementById("monthTotal");
                        if (monthEl) monthEl.innerText = totalMonth;

                        successCallback(events);
                    })
                    .catch(error => {
                        console.error(error);
                        failureCallback(error);
                    });
            },

            eventDidMount(info) {
                info.el.style.cursor = "pointer";
                info.el.title = info.event.title;
                // WCAG: Define atributos de acessibilidade nos eventos para leitores de ecrã
                info.el.setAttribute('tabindex', '0');
                info.el.setAttribute('role', 'button');
                info.el.setAttribute('aria-label', `${info.event.title}, clique para ver detalhes`);

                // Permitir acionar o evento via teclado (Enter)
                info.el.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        info.el.click();
                    }
                });
            },

            eventClick(info) {
                const options = {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit'
                };
                const start = info.event.start ? info.event.start.toLocaleString("pt-PT", options) :
                    "-";
                const end = info.event.end ? info.event.end.toLocaleString("pt-PT", options) : "-";

                openModal(info.event.title, start, end);
            },

            loading(isLoading) {
                document.body.style.cursor = isLoading ? "progress" : "default";
            }
        });

        calendar.render();
    }

    // Expose functions globally for inline handlers
    window.calendar = {
        today: goToToday
    };

    // Setup modal close button
    const closeModalBtn = document.getElementById('closeModalBtn');
    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', closeModal);
    }
}

export function init(loginUrl) {
    if (typeof FullCalendar !== 'undefined') {
        initCalendar(loginUrl);

        // Setup event delegation for data-action attributes
        document.addEventListener('click', (e) => {
            const todayBtn = e.target.closest('[data-action="calendar-today"]');
            if (todayBtn) {
                goToToday();
            }

            const closeModalBtn = e.target.closest('[data-action="close-modal"]');
            if (closeModalBtn) {
                closeModal();
            }
        });
    } else {
        console.error('FullCalendar not loaded');
    }
}
