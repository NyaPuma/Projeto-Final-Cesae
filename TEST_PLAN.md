# 🧪 Comprehensive Test Plan — Sistema Integrado de Gestão de Manutenção

## Coverage Analysis

Based on thorough analysis of all documentation, routes, controllers, models, middleware, migrations, and existing tests:

### Existing Coverage (101 tests, 0 failures)
- ✅ Auth: login, logout, password change, CSRF protection, rate limiting
- ✅ Custom Auth Middleware: token validation, profile verification, active status
- ✅ Role Middleware: RBAC isolation for each role
- ✅ Ticket CRUD (basic): create via API, list, show
- ✅ Ticket search: keyword, priority, date range
- ✅ Ticket comments: add, permissions (own vs others)
- ✅ Ticket photos: upload, validation (type, size), delete
- ✅ Admin Management: users CRUD, rooms CRUD, equipment CRUD, inventory routes
- ✅ Audit endpoints: list, pagination, forbidden for non-admin
- ✅ Analytics: stats endpoint
- ✅ Notifications: list, mark read, test email
- ✅ Dashboard redirect after login
- ✅ Swagger documentation available
- ✅ Design system views render
- ✅ Mailgun test email
- ✅ CSRF middleware handling
- ✅ Seeders compliance

### Missing Coverage — To Implement

#### Unit Tests
- [ ] **Models**: Ticket, User, Room, Equipment, Category, TicketAttachment, TicketComment, TicketStatus, TicketType, Audit, Notification, UserProfile, EquipmentCategory
- [ ] **Services**: AIService
- [ ] **Traits**: Auditable, ControllerHelpers
- [ ] **Exports**: TicketsExport

#### Feature Tests — Missing Endpoints/Scenarios
- [ ] **Ticket workflow**: start repair (technician), close ticket (technician), cancel ticket (owner), reopen
- [ ] **Budget workflow**: request budget, approve budget, reject budget
- [ ] **Analytics**: charts endpoint, CSV export, PDF export, Excel export
- [ ] **Admin**: storeUser (create user), updateUser, profiles, storePreventive, approveBudget
- [ ] **UI Controller**: all view methods return correct views
- [ ] **Notifications**: real ticket notifications (NewTicketNotification, TicketStatusChanged)

#### Validation Tests
- [ ] All form requests/validators edge cases for every endpoint
- [ ] SQL injection attempts in search fields
- [ ] XSS attempts in text fields
- [ ] Mass assignment protection

#### Security Tests
- [ ] IDOR: user cannot access another user's tickets
- [ ] IDOR: user cannot access another user's notifications
- [ ] IDOR: user cannot access another user's comments
- [ ] Privilege escalation attempts
- [ ] Token manipulation
- [ ] Brute force protection on login

#### Database Tests
- [ ] Foreign key constraints (cascade, restrict, nullOnDelete)
- [ ] Unique constraints (email, serial)
- [ ] Soft deletes
- [ ] Scopes and query builders

#### Performance/Regression Tests
- [ ] N+1 query prevention
- [ ] Pagination consistency
- [ ] Route list completeness

## Implementation Order

### Phase 1: Unit Tests (Models, Traits, Services)
### Phase 2: Feature Tests — Critical Business Flows
### Phase 3: Security & Authorization Tests
### Phase 4: Validation & Edge Case Tests
### Phase 5: Integration & Export Tests
