{{-- Configuração de locale disponibilizada ao JavaScript (formatação intl). --}}
@php
    $authTranslations = [
        'profile' => __('auth_box.profile'),
        'logout' => __('auth_box.logout'),
        'signin' => __('auth_box.signin'),
        'loginRegister' => __('auth_box.login_register'),
    ];
    $uiTranslations = [
        'resultsCount' => __('ui.results_count'),
        'noResults' => __('ui.no_results'),
    ];
    $equipmentTranslations = [
        'code' => __('common.Código / Nº Série'),
        'equipment' => __('equipment.Equipamento'),
        'location' => __('room.Sala / Localização'),
        'status' => __('common.Estado'),
        'operational' => __('equipment.operational'),
        'inactive' => __('equipment.inactive'),
        'openTicket' => __('equipment.open_ticket'),
        'edit' => __('equipment.edit'),
        'details' => __('equipment.details'),
        'generic' => __('equipment.generic'),
        'empty' => __('common.Nenhum equipamento encontrado com os filtros aplicados.'),
    ];
    $ticketMediaTranslations = [
        'empty' => __('ticket_media.empty'),
        'removePhoto' => __('ticket_media.remove_photo'),
        'removeFile' => __('ticket_media.remove_file'),
        'loadError' => __('ticket_media.load_error'),
        'confirmRemove' => __('ticket_media.confirm_remove'),
        'removeError' => __('ticket_media.remove_error'),
        'removed' => __('ticket_media.removed'),
        'sent' => __('ticket_media.sent'),
        'file' => __('ticket_media.file'),
    ];
    $ticketDetailTranslations = [
        'status' => [
            'aberto' => __('tickets.Aberto'),
            'aberta' => __('common.Aberta'),
            'em curso' => __('common.Em Curso'),
            'fechado' => __('tickets.Fechado'),
            'fechada' => __('common.Fechada'),
            'pendente orçamento' => __('common.Pendente Orçamento'),
            'pendente de orçamento' => __('common.Pendente de Orçamento'),
            'recusada' => __('common.Recusada'),
            'cancelada' => __('ui.Cancelada'),
        ],
        'priority' => [
            'baixa' => __('tickets.Baixa'),
            'média' => __('common.Média'),
            'alta' => __('tickets.Alta'),
            'crítica' => __('common.Crítica'),
        ],
        'inProgress' => __('common.Em Curso'),
        'closed' => __('common.Fechada'),
        'noComments' => __('ticket_detail.no_comments'),
        'commentsError' => __('ticket_detail.comments_error'),
        'messageSent' => __('ticket_detail.message_sent'),
        'incidentId' => __('ticket_detail.incident_id'),
        'description' => __('ticket_detail.description'),
        'priorityLevel' => __('ticket_detail.priority_level'),
        'equipment' => __('ticket_detail.equipment'),
        'room' => __('ticket_detail.room'),
        'technician' => __('ticket_detail.technician'),
        'pendingAssignment' => __('ticket_detail.pending_assignment'),
        'reportedBy' => __('ticket_detail.reported_by'),
        'source' => __('ticket_detail.source'),
        'qrCode' => __('ticket_detail.qr_code'),
        'web' => __('ticket_detail.web'),
        'system' => __('ticket_detail.system'),
        'noDescription' => __('ticket_detail.no_description'),
    ];
    $roomTranslations = [
        'equipmentCount' => __('room.equipment_count'),
        'edit' => __('room.edit'),
        'details' => __('room.details'),
        'empty' => __('room.empty'),
    ];
    $stockPartTranslations = [
        'min' => __('stock_part.min'),
        'out' => __('stock_part.out'),
        'low' => __('stock_part.low'),
        'ok' => __('stock_part.ok'),
        'details' => __('stock_part.details'),
        'edit' => __('stock_part.edit'),
        'empty' => __('stock_part.empty'),
    ];
    $stockDashboardTranslations = [
        'currentStock' => __('stock.Stock atual'),
        'minimumStock' => __('stock.Stock mínimo'),
        'inStock' => __('stock_dashboard.in_stock'),
        'month' => __('stock_dashboard.month'),
        'months' => __('stock_dashboard.months'),
        'consumption' => __('stock_dashboard.consumption'),
    ];
    $paginationTranslations = [
        'previous' => __('pagination.previous'),
        'next' => __('pagination.next'),
        'page' => __('pagination.page'),
        'of' => __('pagination.of'),
    ];
    $maintenancePlanTranslations = [
        'days' => __('maintenance_plan.days'),
        'usageHours' => __('maintenance_plan.usage_hours'),
        'cycles' => __('maintenance_plan.cycles'),
        'active' => __('maintenance_plan.active'),
        'inactive' => __('maintenance_plan.inactive'),
        'parts' => __('maintenance_plan.parts'),
        'edit' => __('maintenance_plan.edit'),
        'delete' => __('maintenance_plan.delete'),
        'empty' => __('maintenance_plan.empty'),
    ];
    $userManagementTranslations = [
        'edit' => __('ui.Editar'),
        'delete' => __('ui.Eliminar'),
        'active' => __('equipment.Ativo'),
        'inactive' => __('equipment.Inativo'),
        'admin' => __('common.Administrador'),
        'technician' => __('common.Técnico'),
        'user' => __('common.Utilizador'),
        'profileLoading' => __('ui.A carregar perfis...'),
    ];
    $auditTranslations = [
        'allEvents' => __('common.Todas as Ações'),
        'create' => __('auth.Registo Criado'),
        'update' => __('auth.Registo Atualizado'),
        'delete' => __('auth.Registo Eliminado'),
        'created' => __('auth.Registo Criado'),
        'updated' => __('auth.Registo Atualizado'),
        'deleted' => __('auth.Registo Eliminado'),
    ];
    $analyticsTranslations = [
        'resolution' => __('analytics.resolution'),
        'waiting' => __('analytics.waiting'),
        'open' => __('analytics.open'),
        'resolved' => __('analytics.resolved'),
        'mttr' => __('analytics.mttr'),
        'assignment' => __('analytics.assignment'),
        'active' => __('analytics.active'),
        'completed' => __('analytics.completed'),
        'minute' => __('analytics.minute'),
        'minutes' => __('analytics.minutes'),
        'hour' => __('analytics.hour'),
        'hours' => __('analytics.hours'),
        'day' => __('analytics.day'),
        'days' => __('analytics.days'),
        'tickets' => __('tickets.Tickets'),
    ];
    $enumTranslations = [
        'movement' => [
            'in' => __('common.Entrada'),
            'out' => __('common.Saída'),
            'adjust' => __('common.Ajuste'),
            'return' => __('common.Devolução'),
        ],
        'unit' => [
            'unit' => __('common.Unidade'),
            'meter' => __('common.Metro'),
            'liter' => __('common.Litro'),
            'kg' => __('common.Quilograma (kg)'),
            'pair' => __('common.Par'),
            'set' => __('common.Kit / Conjunto'),
            'roll' => __('common.Rolo'),
            'other' => __('common.Outro'),
        ],
    ];
    $analyticsDataTranslations = [
        'urgent' => __('analytics_data.urgent'),
        'normal' => __('analytics_data.normal'),
        'web' => __('analytics_data.web'),
        'qr' => __('analytics_data.qr'),
        'api' => __('analytics_data.api'),
        'mobile' => __('analytics_data.mobile'),
        'phone' => __('analytics_data.phone'),
        'ticket_updated' => __('analytics_data.ticket_updated'),
        'ticket_assigned' => __('analytics_data.ticket_assigned'),
        'comment_added' => __('analytics_data.comment_added'),
        'attachment_added' => __('analytics_data.attachment_added'),
        'budget_request' => __('analytics_data.budget_request'),
    ];
@endphp
<script>
    window.SGM_LOCALE = {
        locale: @json(app()->getLocale()),
        currency: @json(\App\Services\LocaleService::currency()),
        tax_id: @json(\App\Services\LocaleService::taxIdentifierLabel()),
        unit_system: @json(\App\Services\LocaleService::unitSystem()),
        rtl: @json(\App\Services\LocaleService::isRtl(app()->getLocale())),
    };
    window.SGM_AUTH_I18N = @json($authTranslations);
    window.SGM_TICKETS_I18N = Object.assign(window.SGM_TICKETS_I18N || {}, @json($uiTranslations));
    window.SGM_EQUIPMENT_I18N = @json($equipmentTranslations);
    window.SGM_TICKET_MEDIA_I18N = @json($ticketMediaTranslations);
    window.SGM_TICKET_DETAIL_I18N = @json($ticketDetailTranslations);
    window.SGM_ROOM_I18N = @json($roomTranslations);
    window.SGM_STOCK_PART_I18N = @json($stockPartTranslations);
    window.SGM_STOCK_DASHBOARD_I18N = @json($stockDashboardTranslations);
    window.SGM_PAGINATION_I18N = @json($paginationTranslations);
    window.SGM_MAINTENANCE_PLAN_I18N = @json($maintenancePlanTranslations);
    window.SGM_USER_MANAGEMENT_I18N = @json($userManagementTranslations);
    window.SGM_AUDIT_I18N = @json($auditTranslations);
    window.SGM_ANALYTICS_I18N = @json($analyticsTranslations);
    window.SGM_ENUM_I18N = @json($enumTranslations);
    window.SGM_ANALYTICS_DATA_I18N = @json($analyticsDataTranslations);
</script>
