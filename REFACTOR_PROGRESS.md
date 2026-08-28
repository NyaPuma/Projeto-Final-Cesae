# REFACTOR_PROGRESS.md

**Project:** Bearer Labs Gateway — Resources Audit & Refactoring
**Started:** 2026-08-26
**Total Files:** 251 | **Total Lines:** ~24,887

---

## Summary

| File Type | Count | Total Lines | Completed |
|-----------|-------|-------------|-----------|
| `.blade.php` | 119 | 10,583 | 0 |
| `.css` | 23 | 5,550 | 0 |
| `.js` | 109 | 8,754 | 0 |
| **TOTAL** | **251** | **24,887** | **0** |

---

## resources/css/ (5 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 1 | `resources/css/app.css` | 42 | [x] Completed |
| 2 | `resources/css/base.css` | 76 | [x] Completed |
| 3 | `resources/css/layout.css` | 149 | [x] Completed |
| 4 | `resources/css/rtl.css` | 99 | [x] Completed |
| 5 | `resources/css/tokens.css` | 268 | [x] Completed |

## resources/css/components/ (8 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 6 | `resources/css/components/badges.css` | 37 | [x] Completed |
| 7 | `resources/css/components/forms.css` | 76 | [x] Completed |
| 8 | `resources/css/components/locale-modal.css` | 495 | [x] Completed |
| 9 | `resources/css/components/localization-modal.css` | 55 | [x] Completed |
| 10 | `resources/css/components/navigation.css` | 366 | [x] Completed |
| 11 | `resources/css/components/sidebar.css` | 52 | [x] Completed |
| 12 | `resources/css/components/buttons/button-base.css` | 119 | [x] Completed |
| 13 | `resources/css/components/buttons/button-variants.css` | 52 | [x] Completed |
| 14 | `resources/css/components/cards/card-base.css` | 25 | [x] Completed |

## resources/css/pages/ (6 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 15 | `resources/css/pages/calendar.css` | 464 | [x] Completed |
| 16 | `resources/css/pages/definicoes.css` | 515 | [x] Completed |
| 17 | `resources/css/pages/listing.css` | 148 | [x] Completed |
| 18 | `resources/css/pages/login.css` | 5 | [x] Completed |
| 19 | `resources/css/pages/sistema-definicoes.css` | 338 | [x] Completed |
| 20 | `resources/css/pages/tickets.css` | 16 | [x] Completed |

## resources/css/swagger/ (1 file)

| # | File | Lines | Status |
|---|------|-------|--------|
| 21 | `resources/css/swagger/swagger-theme.css` | 790 | [x] Completed |

## resources/css/theme/ (2 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 22 | `resources/css/theme/accessibility.css` | 232 | [x] Completed |
| 23 | `resources/css/theme/variables.css` | 96 | [x] Completed |

## resources/js/ (5 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 24 | `resources/js/alpine.js` | 14 | [x] Completed |
| 25 | `resources/js/analytics.js` | 12 | [x] Completed |
| 26 | `resources/js/api-client.js` | 90 | [x] Completed |
| 27 | `resources/js/app.js` | 70 | [x] Completed |
| 28 | `resources/js/early-theme.js` | 34 | [x] Completed |

## resources/js/auth/ (2 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 29 | `resources/js/auth/login.js` | 88 | [x] Completed |
| 30 | `resources/js/auth/utils.js` | 157 | [x] Completed |

## resources/js/bootstrap/ (1 file)

| # | File | Lines | Status |
|---|------|-------|--------|
| 31 | `resources/js/bootstrap/page-registry.js` | 77 | [x] Completed |

## resources/js/components/ (7 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 32 | `resources/js/components/locale-modal.js` | 300 | [x] Completed |
| 33 | `resources/js/components/localization-modal.js` | 299 | [x] Completed |
| 34 | `resources/js/components/notifications-modal.js` | 233 | [x] Completed |
| 35 | `resources/js/components/input/autocomplete.js` | 145 | [x] Completed |
| 36 | `resources/js/components/input/combobox.js` | 110 | [x] Completed |
| 37 | `resources/js/components/input/otp.js` | 89 | [x] Completed |
| 38 | `resources/js/components/input/password-strength.js` | 76 | [x] Completed |
| 39 | `resources/js/components/listing/feedback.js` | 61 | [x] Completed |
| 40 | `resources/js/components/modal/base.js` | 41 | [x] Completed |

## resources/js/core/ (8 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 41 | `resources/js/core/auth.js` | 57 | [x] Completed |
| 42 | `resources/js/core/auth-box.js` | 102 | [x] Completed |
| 43 | `resources/js/core/dropdown-manager.js` | 93 | [x] Completed |
| 44 | `resources/js/core/layout.js` | 77 | [x] Completed |
| 45 | `resources/js/core/navigation-manager.js` | 77 | [x] Completed |
| 46 | `resources/js/core/search-engine.js` | 97 | [x] Completed |
| 47 | `resources/js/core/sidebar.js` | 84 | [x] Completed |
| 48 | `resources/js/core/theme.js` | 303 | [x] Completed |

## resources/js/pages/ (18 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 49 | `resources/js/pages/audits.js` | 58 | [x] Completed |
| 50 | `resources/js/pages/auth-reset.js` | 81 | [x] Completed |
| 51 | `resources/js/pages/calendar.js` | 581 | [x] Completed |
| 52 | `resources/js/pages/dashboard.js` | 135 | [x] Completed |
| 53 | `resources/js/pages/definicoes-aparencia.js` | 352 | [x] Completed |
| 54 | `resources/js/pages/definicoes-sistema.js` | 137 | [x] Completed |
| 55 | `resources/js/pages/equipments-form.js` | 88 | [x] Completed |
| 56 | `resources/js/pages/equipments-management.js` | 54 | [x] Completed |
| 57 | `resources/js/pages/error-page.js` | 20 | [x] Completed |
| 58 | `resources/js/pages/profile.js` | 158 | [x] Completed |
| 59 | `resources/js/pages/rooms-form.js` | 86 | [x] Completed |
| 60 | `resources/js/pages/rooms-management.js` | 56 | [x] Completed |
| 61 | `resources/js/pages/swagger.js` | 125 | [x] Completed |
| 62 | `resources/js/pages/ticket-create.js` | 13 | [x] Completed |
| 63 | `resources/js/pages/ticket-detail.js` | 142 | [x] Completed |
| 64 | `resources/js/pages/tickets-management.js` | 56 | [x] Completed |
| 65 | `resources/js/pages/users-form.js` | 172 | [x] Completed |
| 66 | `resources/js/pages/users-management.js` | 108 | [x] Completed |

## resources/js/pages/analytics/ (6 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 67 | `resources/js/pages/analytics/activity.js` | 52 | [x] Completed |
| 68 | `resources/js/pages/analytics/charts.js` | 818 | [x] Completed |
| 69 | `resources/js/pages/analytics/export.js` | 63 | [x] Completed |
| 70 | `resources/js/pages/analytics/helpers.js` | 51 | [x] Completed |
| 71 | `resources/js/pages/analytics/index.js` | 171 | [x] Completed |
| 72 | `resources/js/pages/analytics/kpi.js` | 105 | [x] Completed |

## resources/js/pages/audits/ (5 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 73 | `resources/js/pages/audits/api.js` | 18 | [x] Completed |
| 74 | `resources/js/pages/audits/dom.js` | 47 | [x] Completed |
| 75 | `resources/js/pages/audits/filters.js` | 29 | [x] Completed |
| 76 | `resources/js/pages/audits/render.js` | 141 | [x] Completed |
| 77 | `resources/js/pages/audits/state.js` | 7 | [x] Completed |

## resources/js/pages/equipments-management/ (4 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 78 | `resources/js/pages/equipments-management/api.js` | 31 | [x] Completed |
| 79 | `resources/js/pages/equipments-management/dom.js` | 43 | [x] Completed |
| 80 | `resources/js/pages/equipments-management/render.js` | 80 | [x] Completed |
| 81 | `resources/js/pages/equipments-management/state.js` | 7 | [x] Completed |

## resources/js/pages/rooms-management/ (4 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 82 | `resources/js/pages/rooms-management/api.js` | 31 | [x] Completed |
| 83 | `resources/js/pages/rooms-management/dom.js` | 43 | [x] Completed |
| 84 | `resources/js/pages/rooms-management/render.js` | 78 | [x] Completed |
| 85 | `resources/js/pages/rooms-management/state.js` | 7 | [x] Completed |

## resources/js/pages/stock/ (9 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 86 | `resources/js/pages/stock/categories.js` | 109 | [x] Completed |
| 87 | `resources/js/pages/stock/dashboard.js` | 151 | [x] Completed |
| 88 | `resources/js/pages/stock/movements.js` | 90 | [x] Completed |
| 89 | `resources/js/pages/stock/parts.js` | 55 | [x] Completed |
| 90 | `resources/js/pages/stock/parts-form.js` | 91 | [x] Completed |
| 91 | `resources/js/pages/stock/plans.js` | 217 | [x] Completed |
| 92 | `resources/js/pages/stock/suppliers.js` | 52 | [x] Completed |
| 93 | `resources/js/pages/stock/suppliers-form.js` | 76 | [x] Completed |
| 94 | `resources/js/pages/stock/tax-rates.js` | 115 | [x] Completed |

## resources/js/pages/stock/movements/ (4 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 95 | `resources/js/pages/stock/movements/api.js` | 45 | [x] Completed |
| 96 | `resources/js/pages/stock/movements/dom.js` | 45 | [x] Completed |
| 97 | `resources/js/pages/stock/movements/render.js` | 91 | [x] Completed |
| 98 | `resources/js/pages/stock/movements/state.js` | 7 | [x] Completed |

## resources/js/pages/stock/parts/ (4 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 99 | `resources/js/pages/stock/parts/api.js` | 32 | [x] Completed |
| 100 | `resources/js/pages/stock/parts/dom.js` | 46 | [x] Completed |
| 101 | `resources/js/pages/stock/parts/render.js` | 120 | [x] Completed |
| 102 | `resources/js/pages/stock/parts/state.js` | 7 | [x] Completed |

## resources/js/pages/stock/plans/ (4 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 103 | `resources/js/pages/stock/plans/api.js` | 75 | [x] Completed |
| 104 | `resources/js/pages/stock/plans/dom.js` | 39 | [x] Completed |
| 105 | `resources/js/pages/stock/plans/render.js` | 100 | [x] Completed |
| 106 | `resources/js/pages/stock/plans/state.js` | 7 | [x] Completed |

## resources/js/pages/stock/suppliers/ (4 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 107 | `resources/js/pages/stock/suppliers/api.js` | 30 | [x] Completed |
| 108 | `resources/js/pages/stock/suppliers/dom.js` | 39 | [x] Completed |
| 109 | `resources/js/pages/stock/suppliers/render.js` | 78 | [x] Completed |
| 110 | `resources/js/pages/stock/suppliers/state.js` | 7 | [x] Completed |

## resources/js/pages/ticket-create/ (5 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 111 | `resources/js/pages/ticket-create/autocomplete.js` | 101 | [x] Completed |
| 112 | `resources/js/pages/ticket-create/dom.js` | 36 | [x] Completed |
| 113 | `resources/js/pages/ticket-create/file-upload.js` | 14 | [x] Completed |
| 114 | `resources/js/pages/ticket-create/form.js` | 86 | [x] Completed |
| 115 | `resources/js/pages/ticket-create/priority.js` | 52 | [x] Completed |

## resources/js/pages/ticket-detail/ (10 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 116 | `resources/js/pages/ticket-detail/assignment.js` | 48 | [x] Completed |
| 117 | `resources/js/pages/ticket-detail/budget.js` | 147 | [x] Completed |
| 118 | `resources/js/pages/ticket-detail/comments.js` | 67 | [x] Completed |
| 119 | `resources/js/pages/ticket-detail/details.js` | 82 | [x] Completed |
| 120 | `resources/js/pages/ticket-detail/photos.js` | 115 | [x] Completed |
| 121 | `resources/js/pages/ticket-detail/priority-modal.js` | 71 | [x] Completed |
| 122 | `resources/js/pages/ticket-detail/start-actions.js` | 94 | [x] Completed |
| 123 | `resources/js/pages/ticket-detail/state.js` | 27 | [x] Completed |
| 124 | `resources/js/pages/ticket-detail/ui.js` | 20 | [x] Completed |
| 125 | `resources/js/pages/ticket-detail/workflow.js` | 125 | [x] Completed |

## resources/js/pages/tickets-management/ (4 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 126 | `resources/js/pages/tickets-management/api.js` | 34 | [x] Completed |
| 127 | `resources/js/pages/tickets-management/dom.js` | 45 | [x] Completed |
| 128 | `resources/js/pages/tickets-management/render.js` | 107 | [x] Completed |
| 129 | `resources/js/pages/tickets-management/state.js` | 7 | [x] Completed |

## resources/js/pages/users-management/ (4 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 130 | `resources/js/pages/users-management/api.js` | 42 | [x] Completed |
| 131 | `resources/js/pages/users-management/dom.js` | 60 | [x] Completed |
| 132 | `resources/js/pages/users-management/render.js` | 116 | [x] Completed |
| 133 | `resources/js/pages/users-management/state.js` | 12 | [x] Completed |

## resources/js/services/ (1 file)

| # | File | Lines | Status |
|---|------|-------|--------|
| 134 | `resources/js/services/autocomplete-service.js` | 102 | [x] Completed |

## resources/js/utils/ (2 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 135 | `resources/js/utils/api.js` | 169 | [x] Completed |
| 136 | `resources/js/utils/locale.js` | 169 | [x] Completed |

## resources/views/ root (2 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 137 | `resources/views/calendar.blade.php` | 253 | [x] Completed |
| 138 | `resources/views/main.blade.php` | 39 | [x] Completed |

## resources/views/components/ui/analytics/ (10 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 139 | `resources/views/components/ui/analytics/activity-timeline-card.blade.php` | 111 | [x] Completed |
| 140 | `resources/views/components/ui/analytics/aside-card.blade.php` | 28 | [x] Completed |
| 141 | `resources/views/components/ui/analytics/aside-pill.blade.php` | 21 | [x] Completed |
| 142 | `resources/views/components/ui/analytics/chart-card.blade.php` | 55 | [x] Completed |
| 143 | `resources/views/components/ui/analytics/equipment-distribution-card.blade.php` | 54 | [x] Completed |
| 144 | `resources/views/components/ui/analytics/export-actions.blade.php` | 35 | [x] Completed |
| 145 | `resources/views/components/ui/analytics/hero.blade.php` | 62 | [x] Completed |
| 146 | `resources/views/components/ui/analytics/list-card.blade.php` | 38 | [x] Completed |
| 147 | `resources/views/components/ui/analytics/metric-card.blade.php` | 49 | [x] Completed |
| 148 | `resources/views/components/ui/analytics/section-heading.blade.php` | 40 | [x] Completed |

## resources/views/components/ui/auth/ (6 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 149 | `resources/views/components/ui/auth/form-header.blade.php` | 37 | [x] Completed |
| 150 | `resources/views/components/ui/auth/message.blade.php` | 25 | [x] Completed |
| 151 | `resources/views/components/ui/auth/password-field.blade.php` | 63 | [x] Completed |
| 152 | `resources/views/components/ui/auth/shell.blade.php` | 106 | [x] Completed |
| 153 | `resources/views/components/ui/auth/submit-button.blade.php` | 30 | [x] Completed |
| 154 | `resources/views/components/ui/auth/text-field.blade.php` | 35 | [x] Completed |

## resources/views/components/ui/buttons/ (3 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 155 | `resources/views/components/ui/buttons/button.blade.php` | 27 | [x] Completed |
| 156 | `resources/views/components/ui/buttons/icon-button.blade.php` | 37 | [x] Completed |
| 157 | `resources/views/components/ui/buttons/submit.blade.php` | 26 | [x] Completed |

## resources/views/components/ui/dashboard/ (1 file)

| # | File | Lines | Status |
|---|------|-------|--------|
| 158 | `resources/views/components/ui/dashboard/welcome-panel.blade.php` | 45 | [x] Completed |

## resources/views/components/ui/form/ (5 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 159 | `resources/views/components/ui/form/card.blade.php` | 63 | [x] Completed |
| 160 | `resources/views/components/ui/form/field.blade.php` | 35 | [x] Completed |
| 161 | `resources/views/components/ui/form/input.blade.php` | 33 | [x] Completed |
| 162 | `resources/views/components/ui/form/message.blade.php` | 17 | [x] Completed |
| 163 | `resources/views/components/ui/form/select.blade.php` | 23 | [x] Completed |

## resources/views/components/ui/listing/ (4 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 164 | `resources/views/components/ui/listing/filter-field.blade.php` | 28 | [x] Completed |
| 165 | `resources/views/components/ui/listing/filter-panel.blade.php` | 34 | [x] Completed |
| 166 | `resources/views/components/ui/listing/pagination.blade.php` | 17 | [x] Completed |
| 167 | `resources/views/components/ui/listing/table-card.blade.php` | 34 | [x] Completed |

## resources/views/components/ui/page-actions/ (7 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 168 | `resources/views/components/ui/page-actions/action-button.blade.php` | 19 | [x] Completed |
| 169 | `resources/views/components/ui/page-actions/back-button.blade.php` | 34 | [x] Completed |
| 170 | `resources/views/components/ui/page-actions/base-button.blade.php` | 51 | [x] Completed |
| 171 | `resources/views/components/ui/page-actions/base-link.blade.php` | 51 | [x] Completed |
| 172 | `resources/views/components/ui/page-actions/create-link.blade.php` | 26 | [x] Completed |
| 173 | `resources/views/components/ui/page-actions/export-link.blade.php` | 35 | [x] Completed |
| 174 | `resources/views/components/ui/page-actions/group.blade.php` | 11 | [x] Completed |

## resources/views/components/ui/partials/ (1 file)

| # | File | Lines | Status |
|---|------|-------|--------|
| 175 | `resources/views/components/ui/partials/page-header.blade.php` | 57 | [x] Completed |

## resources/views/components/ui/profile/ (4 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 176 | `resources/views/components/ui/profile/delete-account-card.blade.php` | 50 | [x] Completed |
| 177 | `resources/views/components/ui/profile/information-card.blade.php` | 59 | [x] Completed |
| 178 | `resources/views/components/ui/profile/security-card.blade.php` | 131 | [x] Completed |
| 179 | `resources/views/components/ui/profile/summary-card.blade.php` | 42 | [x] Completed |

## resources/views/components/ui/text/ (2 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 180 | `resources/views/components/ui/text/eyebrow.blade.php` | 43 | [x] Completed |
| 181 | `resources/views/components/ui/text/pill.blade.php` | 32 | [x] Completed |

## resources/views/emails/ (3 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 182 | `resources/views/emails/passwordReset.blade.php` | 170 | [x] Completed |
| 183 | `resources/views/emails/test-mail.blade.php` | 130 | [x] Completed |
| 184 | `resources/views/emails/ticketCreated.blade.php` | 112 | [x] Completed |

## resources/views/errors/ (5 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 185 | `resources/views/errors/402.blade.php` | 5 | [x] Completed |
| 186 | `resources/views/errors/403.blade.php` | 5 | [x] Completed |
| 187 | `resources/views/errors/404.blade.php` | 5 | [x] Completed |
| 188 | `resources/views/errors/500.blade.php` | 5 | [x] Completed |
| 189 | `resources/views/errors/minimal.blade.php` | 52 | [x] Completed |

## resources/views/layouts/ (1 file)

| # | File | Lines | Status |
|---|------|-------|--------|
| 190 | `resources/views/layouts/layout.blade.php` | 53 | [x] Completed |

## resources/views/preferences/ (1 file)

| # | File | Lines | Status |
|---|------|-------|--------|
| 191 | `resources/views/preferences/edit.blade.php` | 201 | [x] Completed |

## resources/views/reports/ (3 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 192 | `resources/views/reports/equipments-qr.blade.php` | 123 | [x] Completed |
| 193 | `resources/views/reports/stock-costs-by-equipment.blade.php` | 158 | [x] Completed |
| 194 | `resources/views/reports/tickets.blade.php` | 252 | [x] Completed |

## resources/views/ui/ (15 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 195 | `resources/views/ui/analytics.blade.php` | 218 | [x] Completed |
| 196 | `resources/views/ui/audits.blade.php` | 86 | [x] Completed |
| 197 | `resources/views/ui/auth.blade.php` | 41 | [x] Completed |
| 198 | `resources/views/ui/auth-reset.blade.php` | 54 | [x] Completed |
| 199 | `resources/views/ui/equipments.blade.php` | 54 | [x] Completed |
| 200 | `resources/views/ui/index.blade.php` | 114 | [x] Completed |
| 201 | `resources/views/ui/layout.blade.php` | 186 | [x] Completed |
| 202 | `resources/views/ui/profile.blade.php` | 49 | [x] Completed |
| 203 | `resources/views/ui/rooms.blade.php` | 50 | [x] Completed |
| 204 | `resources/views/ui/ticket-create.blade.php` | 149 | [x] Completed |
| 205 | `resources/views/ui/ticket-detail.blade.php` | 237 | [x] Completed |
| 206 | `resources/views/ui/tickets.blade.php` | 116 | [x] Completed |
| 207 | `resources/views/ui/users.blade.php` | 91 | [x] Completed |
| 208 | `resources/views/ui/users-create.blade.php` | 54 | [x] Completed |
| 209 | `resources/views/ui/users-edit.blade.php` | 78 | [x] Completed |

## resources/views/ui/definicoes/ (2 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 210 | `resources/views/ui/definicoes/aparencia.blade.php` | 160 | [x] Completed |
| 211 | `resources/views/ui/definicoes/sistema.blade.php` | 158 | [x] Completed |

## resources/views/ui/equipments/ (4 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 212 | `resources/views/ui/equipments/create.blade.php` | 141 | [x] Completed |
| 213 | `resources/views/ui/equipments/edit.blade.php` | 141 | [x] Completed |
| 214 | `resources/views/ui/equipments/qr.blade.php` | 94 | [x] Completed |
| 215 | `resources/views/ui/equipments/show.blade.php` | 347 | [x] Completed |

## resources/views/ui/partials/ (18 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 216 | `resources/views/ui/partials/background-effects.blade.php` | 8 | [x] Completed |
| 217 | `resources/views/ui/partials/currency-dropdown.blade.php` | 41 | [x] Completed |
| 218 | `resources/views/ui/partials/currency-modal.blade.php` | 138 | [x] Completed |
| 219 | `resources/views/ui/partials/date-format-dropdown.blade.php` | 31 | [x] Completed |
| 220 | `resources/views/ui/partials/date-format-modal.blade.php` | 106 | [x] Completed |
| 221 | `resources/views/ui/partials/desktop-sidebar.blade.php` | 34 | [x] Completed |
| 222 | `resources/views/ui/partials/language-dropdown.blade.php` | 32 | [x] Completed |
| 223 | `resources/views/ui/partials/language-modal.blade.php` | 101 | [x] Completed |
| 224 | `resources/views/ui/partials/locale-config.blade.php` | 206 | [x] Completed |
| 225 | `resources/views/ui/partials/locale-modal.blade.php` | 108 | [x] Completed |
| 226 | `resources/views/ui/partials/locale-trigger.blade.php` | 9 | [x] Completed |
| 227 | `resources/views/ui/partials/localization-modal.blade.php` | 237 | [x] Completed |
| 228 | `resources/views/ui/partials/mobile-nav.blade.php` | 33 | [x] Completed |
| 229 | `resources/views/ui/partials/notifications-modal.blade.php` | 51 | [x] Completed |
| 230 | `resources/views/ui/partials/number-format-dropdown.blade.php` | 30 | [x] Completed |
| 231 | `resources/views/ui/partials/preferences-dropdowns-js.blade.php` | 4 | [x] Completed |
| 232 | `resources/views/ui/partials/theme-meta.blade.php` | 29 | [x] Completed |
| 233 | `resources/views/ui/partials/topbar.blade.php` | 89 | [x] Completed |

## resources/views/ui/rooms/ (3 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 234 | `resources/views/ui/rooms/create.blade.php` | 95 | [x] Completed |
| 235 | `resources/views/ui/rooms/edit.blade.php` | 95 | [x] Completed |
| 236 | `resources/views/ui/rooms/show.blade.php` | 381 | [x] Completed |

## resources/views/ui/stock/ (7 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 237 | `resources/views/ui/stock/categories.blade.php` | 81 | [x] Completed |
| 238 | `resources/views/ui/stock/dashboard.blade.php` | 90 | [x] Completed |
| 239 | `resources/views/ui/stock/movements.blade.php` | 110 | [x] Completed |
| 240 | `resources/views/ui/stock/parts.blade.php` | 67 | [x] Completed |
| 241 | `resources/views/ui/stock/plans.blade.php` | 136 | [x] Completed |
| 242 | `resources/views/ui/stock/suppliers.blade.php` | 46 | [x] Completed |
| 243 | `resources/views/ui/stock/tax-rates.blade.php` | 107 | [x] Completed |

## resources/views/ui/stock/parts/ (3 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 244 | `resources/views/ui/stock/parts/create.blade.php` | 176 | [x] Completed |
| 245 | `resources/views/ui/stock/parts/edit.blade.php` | 185 | [x] Completed |
| 246 | `resources/views/ui/stock/parts/show.blade.php` | 231 | [x] Completed |

## resources/views/ui/stock/suppliers/ (2 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 247 | `resources/views/ui/stock/suppliers/create.blade.php` | 82 | [x] Completed |
| 248 | `resources/views/ui/stock/suppliers/edit.blade.php` | 82 | [x] Completed |

## resources/views/ui/tickets/public/ (2 files)

| # | File | Lines | Status |
|---|------|-------|--------|
| 249 | `resources/views/ui/tickets/public/create.blade.php` | 158 | [x] Completed |
| 250 | `resources/views/ui/tickets/public/success.blade.php` | 74 | [x] Completed |

## resources/views/vendor/l5-swagger/ (1 file)

| # | File | Lines | Status |
|---|------|-------|--------|
| 251 | `resources/views/vendor/l5-swagger/index.blade.php` | 157 | [x] Completed |
