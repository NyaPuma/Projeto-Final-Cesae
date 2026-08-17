import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import localesAll from '@fullcalendar/core/locales-all';
import { authHeader } from '../utils/api.js';
import { formatDateTime } from '../utils/locale.js';

let calendarInstance;
let lastFocusedElement;
let calendarEl;
let equipmentList = [];

function openModal({ title, start, end, description, technician, url }) {
    lastFocusedElement = document.activeElement;

    document.getElementById('modalTitle').innerText = title;
    document.getElementById('modalStart').innerText = start;
    document.getElementById('modalEnd').innerText = end;
    document.getElementById('modalDescription').innerText = description || '—';
    document.getElementById('modalTechnician').innerText = technician || '—';

    const openTicket = document.getElementById('modalTicketLink');
    if (openTicket) {
        if (url) {
            openTicket.href = url;
            openTicket.classList.remove('hidden');
        } else {
            openTicket.classList.add('hidden');
        }
    }

    const modal = document.getElementById('eventModal');
    modal.classList.remove('hidden');

    setTimeout(() => {
        document.getElementById('closeModalBtn').focus();
    }, 50);

    document.addEventListener('keydown', handleEscapeKey);
}

function closeModal() {
    const modal = document.getElementById('eventModal');
    modal.classList.add('hidden');
    document.removeEventListener('keydown', handleEscapeKey);

    if (lastFocusedElement) {
        lastFocusedElement.focus();
    }
}

function openScheduleModal() {
    const modal = document.getElementById('scheduleModal');
    modal.classList.remove('hidden');
    document.getElementById('schedFeedback').classList.add('hidden');

    const searchInput = document.getElementById('sched_equipment_search');
    const equipmentId = document.getElementById('sched_equipment_id');
    if (searchInput) {
        searchInput.value = '';
    }
    if (equipmentId) {
        equipmentId.value = '';
    }
    hideEquipmentSearchEmpty();

    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    tomorrow.setHours(9, 0, 0, 0);
    document.getElementById('sched_date').value = tomorrow.toISOString().slice(0, 16);

    loadScheduleFormData();
}

function closeScheduleModal() {
    document.getElementById('scheduleModal').classList.add('hidden');
}

async function loadScheduleFormData() {
    const techSelect = document.getElementById('sched_technician_id');

    try {
        const eqRes = await fetch('/equipments', { headers: authHeader() });
        if (eqRes.ok) {
            const eqData = await eqRes.json();
            equipmentList = eqData.equipments?.data ?? eqData.equipments ?? [];
        }

        const techRes = await fetch('/admin/users', { headers: authHeader() });
        if (techRes.ok) {
            const techData = await techRes.json();
            const allUsers = techData.users?.data ?? techData.users ?? [];
            const techList = allUsers.filter(t => t.profile?.name === 'technician');
            const list = techList.length ? techList : allUsers;
            const autoAssignLabel = techSelect.dataset.placeholderAuto || 'Atribuição Automática';
            techSelect.innerHTML = `<option value="">${autoAssignLabel}</option>` +
                list.map(t => `<option value="${t.id}">${t.name}</option>`).join('');
        }
    } catch (err) {
        console.error('Erro ao carregar dados do formulário:', err);
    }
}

function showEquipmentSearchEmpty() {
    const el = document.getElementById('equipmentSearchEmpty');
    if (el) el.classList.remove('hidden');
}

function hideEquipmentSearchEmpty() {
    const el = document.getElementById('equipmentSearchEmpty');
    if (el) el.classList.add('hidden');
}

function initEquipmentSearch() {
    const input = document.getElementById('sched_equipment_search');
    const hiddenInput = document.getElementById('sched_equipment_id');
    const dropdown = document.getElementById('equipmentSuggestions');
    const list = document.getElementById('equipmentSuggestionsList');
    if (!input || !hiddenInput || !dropdown || !list) {
        return;
    }

    let highlighted = -1;

    function closeSuggestions() {
        dropdown.classList.add('hidden');
        input.setAttribute('aria-expanded', 'false');
        highlighted = -1;
    }

    function applyHighlight() {
        const items = list.querySelectorAll('li');
        items.forEach((item, index) => {
            item.classList.toggle('is-highlighted', index === highlighted);
        });
    }

    function selectEquipment(item) {
        input.value = item.name;
        hiddenInput.value = item.id;
        input.setAttribute('aria-activedescendant', '');
        closeSuggestions();
        hideEquipmentSearchEmpty();
    }

    function renderSuggestions(query) {
        const q = query.trim().toLowerCase();
        const matches = equipmentList.filter(e => !q || (e.name || '').toLowerCase().includes(q));

        list.innerHTML = '';
        highlighted = -1;

        if (!matches.length) {
            const empty = document.createElement('li');
            empty.className = 'equipment-search__empty';
            empty.textContent = 'Sem resultados';
            list.appendChild(empty);
            dropdown.classList.remove('hidden');
            input.setAttribute('aria-expanded', 'true');
            return;
        }

        matches.forEach(item => {
            const li = document.createElement('li');
            li.className = 'equipment-search__item';
            li.setAttribute('role', 'option');

            const name = document.createElement('span');
            name.className = 'equipment-search__item-name';
            name.textContent = item.name;

            const room = document.createElement('span');
            room.className = 'equipment-search__item-room';
            room.textContent = item.room?.name || 'Sem Sala';

            li.appendChild(name);
            li.appendChild(room);
            li.addEventListener('click', () => selectEquipment(item));
            list.appendChild(li);
        });

        dropdown.classList.remove('hidden');
        input.setAttribute('aria-expanded', 'true');
    }

    input.addEventListener('input', () => {
        hiddenInput.value = '';
        renderSuggestions(input.value);
    });

    input.addEventListener('focus', () => {
        if (input.value) {
            renderSuggestions(input.value);
        }
    });

    input.addEventListener('keydown', (e) => {
        const items = list.querySelectorAll('li');
        if (e.key === 'ArrowDown') {
            e.preventDefault();
            if (items.length) {
                highlighted = Math.min(highlighted + 1, items.length - 1);
                applyHighlight();
            }
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            if (items.length) {
                highlighted = Math.max(highlighted - 1, 0);
                applyHighlight();
            }
        } else if (e.key === 'Enter') {
            if (highlighted > -1 && items[highlighted]) {
                e.preventDefault();
                items[highlighted].click();
            } else if (hiddenInput.value) {
                closeSuggestions();
            }
        } else if (e.key === 'Escape') {
            closeSuggestions();
        }
    });

    document.addEventListener('click', (e) => {
        if (!input.contains(e.target) && !dropdown.contains(e.target)) {
            closeSuggestions();
        }
    });
}

async function submitPreventiveMaintenance(e) {
    e.preventDefault();
    const btn = document.getElementById('btnSubmitSched');
    const feedback = document.getElementById('schedFeedback');
    const modal = document.getElementById('scheduleModal');
    feedback.classList.add('hidden');

    const endpoint = modal.dataset.scheduleUrl || '/calendar/maintenance';
    const labelScheduling = btn.dataset.labelScheduling || 'A agendar...';
    const labelConfirm = btn.dataset.labelConfirm || 'Confirmar Agendamento';
    const errMessage = feedback.dataset.errMessage || 'Erro ao agendar manutenção preventiva.';

    const payload = {
        title: document.getElementById('sched_title').value.trim(),
        equipment_id: document.getElementById('sched_equipment_id').value,
        scheduled_at: document.getElementById('sched_date').value,
        assigned_to: document.getElementById('sched_technician_id').value || null,
        description: document.getElementById('sched_description').value.trim()
    };

    if (!payload.equipment_id) {
        feedback.innerText = errMessage;
        feedback.classList.remove('hidden');
        showEquipmentSearchEmpty();
        return;
    }

    btn.disabled = true;
    btn.innerText = labelScheduling;

    try {
        const res = await fetch(endpoint, {
            method: 'POST',
            headers: Object.assign({ 'Content-Type': 'application/json' }, authHeader()),
            body: JSON.stringify(payload)
        });

        if (!res.ok) {
            const errData = await res.json().catch(() => ({}));
            throw new Error(errData.message || errMessage);
        }

        closeScheduleModal();
        document.getElementById('preventiveForm').reset();
        if (calendarInstance) calendarInstance.refetchEvents();
    } catch (err) {
        feedback.innerText = err.message;
        feedback.classList.remove('hidden');
    } finally {
        btn.disabled = false;
        btn.innerText = labelConfirm;
    }
}

function handleEscapeKey(e) {
    if (e.key === 'Escape') {
        closeModal();
        closeScheduleModal();
    }
}

function saveEventMove(info) {
    const event = info.event;
    const start = event.start;
    const end = event.end;

    const prefix = calendarEl ? calendarEl.dataset.reschedulePrefix : '';
    if (!prefix) {
        info.revert();
        return;
    }

    const payload = {
        start: start ? start.toISOString() : null,
        end: end ? end.toISOString() : null,
    };

    fetch(`${prefix}/${event.id}`, {
        method: 'PATCH',
        headers: Object.assign({ 'Content-Type': 'application/json' }, authHeader()),
        body: JSON.stringify(payload)
    })
        .then(response => {
            if (response.status === 401) {
                window.location.href = '/ui/login';
                return null;
            }
            if (!response.ok) {
                throw new Error('Erro ao reagendar o evento.');
            }
            return response.json();
        })
        .then(data => {
            if (data && calendarInstance) {
                calendarInstance.refetchEvents();
            }
        })
        .catch(error => {
            console.error(error);
            if (typeof info.revert === 'function') {
                info.revert();
            }
        });
}

function initCalendar() {
    const calendarElLocal = document.getElementById('calendar');
    if (!calendarElLocal) {
        return;
    }

    calendarEl = calendarElLocal;

    const appLocale = document.documentElement.lang || calendarEl.dataset.locale || 'pt-PT';
    const localeMap = {
        'en-GB': 'en-gb',
        'en-US': 'en-gb',
        'es-ES': 'es',
        'fr-FR': 'fr',
        'pt-BR': 'pt-br',
        'pt-PT': 'pt',
        'zh-CN': 'zh-cn',
        'ar-AE': 'ar',
    };
    const calendarLocale = localeMap[appLocale] || appLocale.split('-')[0].toLowerCase();
    const btnToday = calendarEl.dataset.btnToday || '';
    const btnMonth = calendarEl.dataset.btnMonth || '';
    const btnWeek = calendarEl.dataset.btnWeek || '';
    const btnDay = calendarEl.dataset.btnDay || '';

    calendarInstance = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
        locales: localesAll,
        locale: calendarLocale,
        initialView: 'dayGridMonth',
        height: 'auto',
        firstDay: 1,
        nowIndicator: true,
        navLinks: true,
        editable: false,
        selectable: true,
        expandRows: true,
        dayMaxEvents: true,
        weekends: true,

        buttonText: {
            today: btnToday,
            month: btnMonth,
            week: btnWeek,
            day: btnDay
        },

        dayHeaderContent: (arg) => new Intl.DateTimeFormat(appLocale, {
            weekday: 'short',
        }).format(arg.date),

        datesSet: (info) => {
            const titleElement = calendarEl.querySelector('.fc-toolbar-title');
            if (!titleElement) return;

            const options = info.view.type === 'dayGridMonth'
                ? { month: 'long', year: 'numeric' }
                : { day: 'numeric', month: 'long', year: 'numeric' };

            titleElement.textContent = new Intl.DateTimeFormat(appLocale, options).format(info.view.currentStart);
        },

        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },

        eventContent: function (arg) {
            const isScheduled = arg.event.extendedProps?.scheduled !== false;
            const icon = isScheduled ? '🛡️' : '🔧';
            const title = arg.event.title;
            const time = arg.timeText;

            const customEl = document.createElement('div');
            customEl.className = 'fc-custom-event';
            customEl.innerHTML = `
                <span class="fc-custom-event__icon">${icon}</span>
                <div class="fc-custom-event__body">
                    <div class="fc-custom-event__title">${title}</div>
                    ${time ? `<div class="fc-custom-event__time">${time}</div>` : ''}
                </div>
            `;
            return { domNodes: [customEl] };
        },

        events(fetchInfo, successCallback, failureCallback) {
            document.querySelectorAll('.fc-day-has-scheduled').forEach(el => {
                el.classList.remove('fc-day-has-scheduled');
            });

            fetch('/calendar/events', { headers: authHeader() })
                .then(response => {
                    if (response.status === 401) {
                        window.location.href = '/ui/login';
                        return null;
                    }
                    if (!response.ok) {
                        throw new Error('Erro ao carregar eventos da infraestrutura.');
                    }
                    return response.json();
                })
                .then(data => {
                    if (!data) {
                        return;
                    }

                    const events = data.events ?? [];

                    const totalEl = document.getElementById('eventsTotal');
                    if (totalEl) {
                        totalEl.innerText = events.length;
                    }

                    const currentPeriod = calendarInstance ? calendarInstance.getDate() : new Date();
                    const activeMonth = currentPeriod.getMonth();
                    const activeYear = currentPeriod.getFullYear();

                    const totalMonth = events.filter(event => {
                        const eventDate = new Date(event.start);
                        return eventDate.getMonth() === activeMonth && eventDate.getFullYear() === activeYear;
                    }).length;

                    const monthEl = document.getElementById('monthTotal');
                    if (monthEl) {
                        monthEl.innerText = totalMonth;
                    }

                    successCallback(events);
                })
                .catch(error => {
                    console.error(error);
                    failureCallback(error);
                });
        },

        eventDidMount(info) {
            const isScheduled = info.event.extendedProps?.scheduled !== false;
            info.el.classList.add(isScheduled ? 'fc-event--scheduled' : 'fc-event--regular');
            info.el.style.cursor = 'pointer';
            info.el.title = info.event.title;
            info.el.setAttribute('tabindex', '0');
            info.el.setAttribute('role', 'button');
            info.el.setAttribute('aria-label', `${info.event.title}, clique para ver detalhes`);

            if (info.event.start) {
                const dateStr = info.event.start.toISOString().split('T')[0];
                const dayCell = document.querySelector(`.fc-daygrid-day[data-date="${dateStr}"]`);
                if (dayCell) {
                    dayCell.classList.add('fc-day-has-scheduled');
                }
            }

            info.el.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    info.el.click();
                }
            });
        },

        eventClick(info) {
            info.jsEvent.preventDefault();

            const props = info.event.extendedProps || {};

            openModal({
                title: info.event.title,
                start: info.event.start ? formatDateTime(info.event.start) : '-',
                end: info.event.end ? formatDateTime(info.event.end) : '-',
                description: props.description,
                technician: props.technician,
                url: info.event.url || props.url,
            });
        },

        eventDrop: saveEventMove,
        eventResize: saveEventMove,

        loading(isLoading) {
            document.body.style.cursor = isLoading ? 'progress' : 'default';
        }
    });

    calendarInstance.render();
}

function init() {
    initCalendar();

    initEquipmentSearch();

    document.querySelectorAll('[data-action="schedule"]').forEach(el => {
        el.addEventListener('click', openScheduleModal);
    });

    document.querySelectorAll('[data-action="close-modal"]').forEach(el => {
        el.addEventListener('click', closeModal);
    });

    document.querySelectorAll('[data-action="close-schedule"]').forEach(el => {
        el.addEventListener('click', closeScheduleModal);
    });

    document.getElementById('preventiveForm')?.addEventListener('submit', submitPreventiveMaintenance);
}

export { init };
