import { authHeader, isAuthenticated } from '../utils/api.js';

let calendarInstance;
let lastFocusedElement;

function openModal(title, start, end) {
    lastFocusedElement = document.activeElement;

    document.getElementById('modalTitle').innerText = title.includes('🛡️') || title.includes('🔧') ? title : `🛡️ ${title}`;
    document.getElementById('modalStart').innerText = start;
    document.getElementById('modalEnd').innerText = end;

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
    const eqSelect = document.getElementById('sched_equipment_id');
    const techSelect = document.getElementById('sched_technician_id');

    try {
        const eqRes = await fetch('/equipments', { headers: authHeader() });
        if (eqRes.ok) {
            const eqData = await eqRes.json();
            const list = eqData.equipments?.data ?? eqData.equipments ?? eqData ?? [];
            const selectPlaceholder = eqSelect.dataset.placeholderSelect || 'Selecione um equipamento...';
            eqSelect.innerHTML = `<option value="">${selectPlaceholder}</option>` +
                list.map(e => `<option value="${e.id}">${e.name} (${e.room?.name || 'Sem Sala'})</option>`).join('');
        }

        const techRes = await fetch('/admin/users?role=technician', { headers: authHeader() });
        if (techRes.ok) {
            const techData = await techRes.json();
            const techList = techData.users?.data ?? techData.users ?? techData ?? [];
            const autoAssignLabel = techSelect.dataset.placeholderAuto || 'Atribuição Automática';
            techSelect.innerHTML = `<option value="">${autoAssignLabel}</option>` +
                techList.map(t => `<option value="${t.id}">${t.name}</option>`).join('');
        }
    } catch (err) {
        console.error("Erro ao carregar dados do formulário:", err);
    }
}

async function submitPreventiveMaintenance(e) {
    e.preventDefault();
    const btn = document.getElementById('btnSubmitSched');
    const feedback = document.getElementById('schedFeedback');
    feedback.classList.add('hidden');

    const payload = {
        title: document.getElementById('sched_title').value.trim(),
        equipment_id: document.getElementById('sched_equipment_id').value,
        scheduled_at: document.getElementById('sched_date').value,
        assigned_to: document.getElementById('sched_technician_id').value || null,
        description: document.getElementById('sched_description').value.trim()
    };

    const labelScheduling = btn.dataset.labelScheduling || 'A agendar...';
    const labelConfirm = btn.dataset.labelConfirm || 'Confirmar Agendamento';
    const errMessage = feedback.dataset.errMessage || 'Erro ao agendar manutenção preventiva.';

    btn.disabled = true;
    btn.innerText = labelScheduling;

    try {
        const res = await fetch('/admin/maintenance/schedule', {
            method: 'POST',
            headers: Object.assign({ 'Content-Type': 'application/json' }, authHeader()),
            body: JSON.stringify(payload)
        });

        if (!res.ok) {
            const errData = await res.json().catch(() => ({}));
            throw new Error(errData.message || errMessage);
        }

        closeScheduleModal();
        if (calendarInstance) calendarInstance.refetchEvents();
        document.getElementById('preventiveForm').reset();
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

function initCalendar() {
    if (!isAuthenticated()) {
        window.location.href = "/ui/login";
        return;
    }

    const userRole = (localStorage.getItem('user_role') || '').toLowerCase();
    if (userRole === 'admin' || userRole === 'administrador') {
        document.getElementById('btnAdminSchedule')?.classList.remove('hidden');
    }

    const calendarEl = document.getElementById("calendar");

    if (calendarEl) {
        const calendarLocale = calendarEl.dataset.locale || 'pt';
        const btnToday = calendarEl.dataset.btnToday || 'Hoje';
        const btnMonth = calendarEl.dataset.btnMonth || 'Mês';
        const btnWeek = calendarEl.dataset.btnWeek || 'Semana';
        const btnDay = calendarEl.dataset.btnDay || 'Dia';

        calendarInstance = new FullCalendar.Calendar(calendarEl, {
            locale: calendarLocale,
            initialView: "dayGridMonth",
            height: "auto",
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

            headerToolbar: {
                left: "prev,next",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay"
            },

            eventContent: function(arg) {
                const isPreventive = arg.event.extendedProps?.scheduled || arg.event.title.toLowerCase().includes('preventiv') || arg.event.title.toLowerCase().includes('troca');
                const icon = isPreventive ? '🛡️' : '🔧';
                const title = arg.event.title;
                const time = arg.timeText;

                const customEl = document.createElement('div');
                customEl.className = 'flex items-center gap-2 overflow-hidden py-0.5 px-0.5';
                customEl.innerHTML = `
                    <span class="text-lg filter drop-shadow flex-shrink-0 leading-none">${icon}</span>
                    <div class="truncate min-w-0">
                        <div class="font-extrabold text-xs truncate leading-tight text-white">${title}</div>
                        ${time ? `<div class="text-[10px] opacity-90 font-mono text-white/90 leading-none mt-0.5">${time}</div>` : ''}
                    </div>
                `;
                return { domNodes: [customEl] };
            },

            events(fetchInfo, successCallback, failureCallback) {
                document.querySelectorAll('.fc-day-has-scheduled').forEach(el => {
                    el.classList.remove('fc-day-has-scheduled');
                });

                fetch("/calendar/events", { headers: authHeader() })
                    .then(response => {
                        if (!response.ok) {
                            if (response.status === 401) {
                                window.location.href = "/ui/login";
                                return;
                            }
                            throw new Error("Erro ao carregar eventos da infraestrutura.");
                        }
                        return response.json();
                    })
                    .then(events => {
                        if (!events) return;

                        const totalEl = document.getElementById("eventsTotal");
                        if (totalEl) totalEl.innerText = events.length;

                        const currentPeriod = calendarInstance ? calendarInstance.getDate() : fetchInfo.start;
                        const activeMonth = currentPeriod.getMonth();
                        const activeYear = currentPeriod.getFullYear();

                        const totalMonth = events.filter(e => {
                            const eventDate = new Date(e.start);
                            return eventDate.getMonth() === activeMonth && eventDate.getFullYear() === activeYear;
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
                const options = { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit' };
                const start = info.event.start ? info.event.start.toLocaleString("pt-PT", options) : "-";
                const end = info.event.end ? info.event.end.toLocaleString("pt-PT", options) : "-";

                openModal(info.event.title, start, end);
            },

            loading(isLoading) {
                document.body.style.cursor = isLoading ? "progress" : "default";
            }
        });

        calendarInstance.render();
    }
}

function init() {
    initCalendar();

    document.querySelectorAll('[data-action="schedule"]').forEach(el => {
        el.addEventListener('click', openScheduleModal);
    });

    document.querySelectorAll('[data-action="today"]').forEach(el => {
        el.addEventListener('click', () => {
            if (calendarInstance) calendarInstance.today();
        });
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