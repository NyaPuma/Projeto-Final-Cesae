# `app/Http/Controllers`

HTTP controllers for the SGM application. Each controller handles a specific resource or feature, translating incoming HTTP requests into calls to services, actions, or other collaborators.

## Overview

Controllers are **final** classes extending a base `Controller` (which provides `authorize()` via `AuthorizesRequests`). They are responsible for:

- **Input retrieval** – extracting data from `Request` objects (query params, route params, body).
- **Authorization** – delegating policy checks via `$this->authorize()`.
- **Response formatting** – returning JSON (`JsonResponse`), views (`View`), file downloads (`Response`), or redirects (`RedirectResponse`).

Controllers do **not** contain business logic; they delegate to:
- **Action classes** (single-purpose command handlers) in `app/Actions/` and `app/Domain/*/Actions/`.
- **Service classes** (orchestration / query logic) in `app/Services/`.
- **Policies** (authorization rules) in `app/Policies/`.

## Directory Structure

| Subdirectory | Purpose |
|---|---|
| Root (`Controllers/`) | General-purpose controllers (tickets, equipment, rooms, users, stock, etc.) |
| `Ui/` | Controllers that serve Blade views for the web UI (HTML pages) |
| `Auth/` | Authentication controllers (login, register, OAuth callbacks, password reset) |
| `Profile/` | User profile management (view, edit, avatar, password change) |
| `Settings/` | Application and system settings controllers |

## Key Patterns

### Controller Structure

```php
final class SomeController extends Controller
{
    public function __construct(
        private readonly SomeService $service,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $this->authorize('viewAny', SomeModel::class);

        $items = $this->service->list(...);

        return response()->json([
            'items' => SomeResource::collection($items),
        ]);
    }
}
```

### Resource Controllers

Most controllers follow the standard RESTful pattern:

| Method | Purpose | Typical Response |
|---|---|---|
| `index()` | Paginated listing with filters | JSON with `data` + pagination metadata |
| `show()` / `showDetail()` | Single resource detail | JSON with resource |
| `store()` | Create a resource | JSON 201 with resource + success message |
| `update()` | Modify a resource | JSON with resource + success message |
| `destroy()` / `delete()` | Soft-delete a resource | JSON with success message |

### Ui Controllers

UI controllers (in `Ui/` subdirectory) return Blade views instead of JSON:

```php
final class SomeUiController extends Controller
{
    public function index(Request $request): View
    {
        return view('ui.some-page', [
            'user' => $request->user(),
        ]);
    }
}
```

### Authorization

Controllers use policy-based authorization:

```php
$this->authorize('viewAny', SomeModel::class);  // Collection access
$this->authorize('update', $model);              // Single resource access
```

Policies are defined in `app/Policies/` and auto-discovered by Laravel.

### Response Format

All JSON responses follow a consistent shape:

```json
{
    "items": [...],
    "meta": {
        "current_page": 1,
        "per_page": 15,
        "last_page": 5,
        "total": 72
    }
}
```

Success responses include a `message` key:

```json
{
    "message": "Record created successfully.",
    "item": { ... }
}
```

### OpenAPI Documentation

API controllers use `#[OA\...]` attributes (from `@nicegoodthings/openapi-laravel`) for Swagger documentation. These attributes define the endpoint's summary, tags, parameters, request body, and responses.

## Controller Inventory

| Controller | Purpose |
|---|---|
| `ActivityFeedController` | Activity feed listing and stats |
| `AdminController` | Admin dashboard (stats, metrics) |
| `AdminEquipmentController` | Admin CRUD for equipment |
| `AdminUserController` | Admin user management |
| `AnalyticsController` | Reporting and analytics data |
| `AuditController` | Audit log listing and export |
| `AuditLogController` | Audit log for specific resources |
| `Auth/AuthController` | Login, register, logout, session management |
| `Auth/ForgotPasswordController` | Password reset request |
| `Auth/LoginController` | Authentication (login form + submit) |
| `Auth/OAuthController` | OAuth provider redirects and callbacks |
| `Auth/RegisterController` | User registration |
| `Auth/ResetPasswordController` | Password reset form + submit |
| `Auth/SocialAuthController` | Social login (Google, GitHub) |
| `Auth/VerificationController` | Email verification |
| `BudgetController` | Budget allocation CRUD |
| `DashboardController` | Main dashboard (charts, summary) |
| `EquipmentController` | Equipment CRUD (admin) |
| `EquipmentController` | Equipment operations (stock, QR) |
| `MaintenancePlanController` | Preventive maintenance plan CRUD |
| `MfaController` | Multi-factor authentication setup |
| `NotificationController` | User notifications |
| `PartController` | Part CRUD (stock catalog) |
| `PartCategoryController` | Part category CRUD |
| `PasswordController` | Password change operations |
| `Profile/AvatarController` | Profile picture upload/delete |
| `Profile/ProfileController` | User profile view/update |
| `PublicTicketController` | Public ticket submission (guest) |
| `QrCodeController` | QR code generation and download |
| `ReportController` | Report generation |
| `ResetPasswordController` | Password reset link handling |
| `Settings/SettingsController` | Application settings UI |
| `Settings/SystemSettingsController` | System-level settings |
| `StockDashboardController` | Stock dashboard data (JSON) |
| `StockMovementController` | Stock movement CRUD |
| `SupplierController` | Supplier CRUD |
| `TaxRateController` | VAT rate CRUD |
| `ThemeController` | Theme presets and custom CSS |
| `TicketController` | Ticket CRUD + assignment |
| `TicketUiController` | Ticket UI (views) |
| `UiController` | Main UI pages (dashboard, equipment, rooms, users, profile) |
| `UserController` | User CRUD |
| `HealthCheckController` | Health/liveness probes |

## Dependencies

| Dependency | Used For |
|---|---|
| `App\Services\*` | Business logic delegation |
| `App\Actions\*` | Single-purpose command execution |
| `App\Policies\*` | Authorization checks |
| `App\Http\Resources\*` | Response serialization |
| `App\Http\Requests\*` | Form validation (Request classes) |
| `Illuminate\Http\*` | Response types (JsonResponse, View, etc.) |
| `Illuminate\View\View` | Blade view rendering |
| `OpenApi\Attributes as OA` | API documentation |

## Related Folders

| Path | Relationship |
|---|---|
| `app/Http/Requests/` | Form validation requests used by controllers |
| `app/Http/Resources/` | API resource transformers for responses |
| `app/Http/Middleware/` | Request preprocessing (auth, CORS, etc.) |
| `app/Services/` | Business logic layer |
| `app/Actions/` | Command/action classes |
| `app/Domain/` | Domain-specific actions and services |
| `app/Policies/` | Authorization policies |
| `resources/views/ui/` | Blade templates rendered by Ui controllers |
