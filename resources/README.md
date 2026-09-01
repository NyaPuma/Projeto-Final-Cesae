# `resources/`

Frontend source assets for the SGM application: Blade templates, JavaScript modules, stylesheets, and design documentation compiled by Vite.

---

## Directory Structure

| Directory | Purpose | Entry Point |
|---|---|---|
| **`views/`** | Blade template files (HTML + PHP) | `views/app.blade.php` (main layout) |
| **`js/`** | JavaScript source modules (ES6+) | `js/bootstrap.ts` (app initialization) |
| **`css/`** | Stylesheet source (Tailwind, custom CSS) | `css/app.css` (main stylesheet) |
| **`docs/`** | Internal design and architecture documentation | Design system specs, component guides |

---

## Build Process (Vite)

### Input
```
resources/
├── views/           ← Blade templates (processed by Laravel)
├── js/              ← JavaScript source
│   └── bootstrap.ts (entry point)
└── css/             ← Stylesheets
    └── app.css (entry point)
```

### Output (via `npm run build`)
```
public/build/
├── assets/
│   ├── app-HASH.js
│   ├── app-HASH.css
│   └── app.js (manifest)
└── manifest.json (asset manifest)
```

### Development
- **Development server**: `npm run dev` runs Vite with hot module replacement
- **Source maps**: Generated for easy debugging in browser DevTools
- **Asset imports**: Use `@vite(['resources/js/app.js', 'resources/css/app.css'])` in Blade

### Production
- **Minification**: All JavaScript and CSS minified
- **Asset hashing**: Filenames include content hash for cache busting
- **Code splitting**: Separate bundles for vendor and app code
- **Optimization**: Tree-shaking unused code, gzip compression

---

## Views (`resources/views/`)

### Directory Structure

```
views/
├── app.blade.php              # Main layout wrapper
├── layouts/
│   ├── app.blade.php          # Authenticated layout
│   └── guest.blade.php        # Public/auth layout
├── components/                # Reusable Blade components
│   ├── button/
│   ├── card/
│   ├── input/
│   └── ui/                    # UI-specific components
├── errors/                    # Error pages (401, 403, 404, 500, etc.)
├── emails/                    # Email templates (Markdown)
├── pages/                     # Page templates (tickets, equipment, etc.)
├── reports/                   # Report templates (PDF exports)
└── auth/                      # Authentication pages (login, register, reset)
```

### Key Views

| File | Purpose | Route |
|---|---|---|
| `layouts/app.blade.php` | Authenticated user layout | All protected routes |
| `layouts/guest.blade.php` | Public/guest layout | Login, register, forgot password |
| `pages/dashboard.blade.php` | Main dashboard | `GET /` (authenticated) |
| `pages/tickets/` | Ticket management | `GET /tickets`, `/tickets/{id}` |
| `pages/equipment/` | Equipment management | `GET /equipment`, `/equipment/{id}` |
| `pages/stock/` | Stock/inventory management | `GET /stock/*` |
| `errors/404.blade.php` | Not found error | Any non-existent route |
| `errors/500.blade.php` | Server error | Unhandled exceptions |

### Blade Components

#### Location: `resources/views/components/`

**Button Components** (`button/button.blade.php`):
```blade
<x-button.button type="submit" color="primary">
    Save Changes
</x-button.button>
```

**Card Components** (`card/card.blade.php`, `card/badge.blade.php`):
```blade
<x-card.card title="Summary">
    <x-card.badge color="success">Active</x-card.badge>
</x-card.card>
```

**Input Components** (`input/input.blade.php`, `input/password.blade.php`):
```blade
<x-input.input 
    name="email" 
    type="email" 
    required 
    label="Email Address" 
/>
```

**Alert Components** (`card/alert.blade.php`):
```blade
<x-card.alert type="danger">
    This action cannot be undone.
</x-card.alert>
```

### Blade Conventions

- ✅ Use `{{ }}` for echo (auto-escapes HTML)
- ✅ Use `{!! !!}` only for trusted content (HTML, Markdown-rendered)
- ✅ Use `@if`, `@foreach`, `@forelse` for control structures
- ✅ Use `@each` for looping with sub-templates
- ✅ Use `@csrf` for CSRF token on forms
- ✅ Use `{{ old('field') }}` to repopulate form fields
- ✅ Use `{{ __('key') }}` for localized strings
- ✗ Never use `eval()` or raw user data in templates

### Inline Scripts

Three sanctioned patterns for inline `<script>` tags:

1. **Anti-FOUC Theme Script** (in `<head>`):
```blade
<script type="module">
    const theme = localStorage.getItem('theme') || 
                  (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
    document.documentElement.setAttribute('data-theme', theme);
</script>
```

2. **i18n Bootstrap** (locale configuration):
```blade
<script>
    window.SGM_LOCALE = @json(app()->getLocale());
    window.SGM_UI_I18N = @json(__('ui'));
    // ... other translation globals
</script>
```

3. **Non-Executing Data Blocks** (JSON data):
```blade
<script type="application/json" id="page-data">
@json(['tickets' => $tickets])
</script>
```

❌ **Prohibited**: Inline event handlers (`onclick`, `onload`), dynamic script generation, or user-driven content in scripts.

---

## JavaScript (`resources/js/`)

### Directory Structure

```
js/
├── bootstrap.ts               # App initialization
├── core/
│   ├── auth.ts               # Authentication helpers
│   ├── theme.ts              # Theme switching
│   └── api.ts                # API client (fetch wrapper)
├── utils/
│   ├── locale.ts             # Localization helpers
│   ├── url.ts                # URL builders
│   └── validators.ts         # Input validation
├── components/               # Component behavior (Alpine.js)
├── pages/                    # Page-specific JavaScript
│   ├── dashboard.ts
│   ├── tickets/
│   └── stock/
├── plugins/                  # Third-party integrations
│   ├── axios.ts             # HTTP client setup
│   └── alpine.ts            # Alpine.js setup
└── bootstrap/               # Startup configuration
    ├── page-registry.ts     # Page initialization registry
    └── locale-config.ts     # i18n configuration
```

### Key Modules

#### `core/auth.ts` — Authentication
```typescript
export function isAuthenticated(): boolean
export function getUserRole(): string | null
export function isTechnician(): boolean
export function logout(): Promise<void>
```

#### `core/api.ts` — API Client
```typescript
export async function apiCall(
    method: string,
    url: string,
    data?: Record<string, any>
): Promise<any>
```

#### `core/theme.ts` — Theme Management
```typescript
export function getTheme(): string
export function setTheme(theme: string): void
export function toggleTheme(): void
```

#### `utils/locale.ts` — Localization
```typescript
export function formatCurrency(amount: number): string
export function formatDate(date: Date): string
export function formatDateTime(date: Date): string
```

### Alpine.js Usage

**Data Components** (form state, UI state):
```html
<div x-data="{ open: false }">
    <button @click="open = !open">Toggle</button>
    <div x-show="open">Content</div>
</div>
```

**Event Handling** (form submission, API calls):
```html
<form @submit.prevent="handleSubmit">
    <input x-model="email" type="email" />
    <button type="submit">Submit</button>
</form>
```

**Conditional Rendering**:
```html
<template x-if="authenticated">
    <div>Welcome, {{ userName }}!</div>
</template>
```

### Page Initialization

Pages are registered in `bootstrap/page-registry.ts`:

```typescript
const pages: Record<string, () => void> = {
    'dashboard': () => import('../pages/dashboard'),
    'tickets': () => import('../pages/tickets/render'),
    'equipment': () => import('../pages/equipments-form'),
    // ...
};
```

Each page module exports a default function that initializes page-specific behavior:

```typescript
// pages/tickets/render.ts
export default function initialize() {
    // Set up event listeners, fetch data, render components
}
```

---

## Stylesheets (`resources/css/`)

### Directory Structure

```
css/
├── app.css                   # Entry point (imports all)
├── tokens.css               # Design tokens (colors, spacing, fonts)
├── theme.css                # Theme system (dark/light modes)
├── layout.css               # Page layouts (grid, sidebar)
├── components.css           # Component styles
└── pages/                   # Page-specific styles
    ├── dashboard.css
    ├── tickets.css
    ├── equipment.css
    └── stock.css
```

### Design Tokens

**Colors**:
```css
--color-primary: #007bff;
--color-success: #28a745;
--color-danger: #dc3545;
--color-warning: #ffc107;
```

**Spacing**:
```css
--spacing-xs: 0.25rem;
--spacing-sm: 0.5rem;
--spacing-md: 1rem;
--spacing-lg: 1.5rem;
--spacing-xl: 2rem;
```

**Typography**:
```css
--font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto;
--font-size-base: 1rem;
--line-height-base: 1.5;
```

### Tailwind CSS

**Utility Classes** (from Tailwind):
```html
<div class="flex gap-4 p-6 bg-gray-100 rounded-lg">
    <span class="text-lg font-semibold text-gray-900">Title</span>
</div>
```

**Custom Components** (via `@apply`):
```css
@layer components {
    .btn-primary {
        @apply px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600;
    }
}
```

**Theme Variants** (dark mode):
```css
@media (prefers-color-scheme: dark) {
    :root {
        --color-bg: #1a1a1a;
        --color-text: #ffffff;
    }
}
```

---

## Documentation (`resources/docs/`)

Internal design documentation:

- **Design System**: Component library with usage examples
- **Architecture**: Frontend module organization and patterns
- **Localization**: i18n strategy and implementation
- **Accessibility**: WCAG compliance guidelines
- **Performance**: Asset loading and optimization best practices

---

## Development Workflow

### Adding a New Page

1. **Create Blade template** in `views/pages/my-page.blade.php`
2. **Register route** in `routes/web.php` with a unique page key (in meta)
3. **Create page module** in `js/pages/my-page.ts`
4. **Register page** in `js/bootstrap/page-registry.ts`
5. **Add styles** in `css/pages/my-page.css`
6. **Test locally**: `npm run dev` and open in browser

### Adding a New Component

1. **Create Blade component** in `views/components/my-component/my-component.blade.php`
2. **Add component CSS** in `css/components.css`
3. **Add component JS** (if needed) in `js/components/my-component.ts`
4. **Document usage** in `resources/docs/components.md`

### Building for Production

```bash
npm run build              # Minify and optimize assets
# Output: public/build/
```

### Testing

```bash
npm run test              # Run JavaScript tests (Vitest)
npm run test:watch       # Watch mode
npm run test:coverage    # Coverage report
```

---

## Performance Optimization

### Asset Loading
- ✅ Use `@vite()` helper for cache-busting asset URLs
- ✅ Lazy load images with `loading="lazy"`
- ✅ Use WebP images with PNG fallbacks
- ✅ Defer non-critical JavaScript with `async` or `defer`

### CSS
- ✅ Use Tailwind utilities instead of custom CSS where possible
- ✅ Avoid inline styles (use classes)
- ✅ Use CSS variables for theming
- ✗ Never embed images or fonts as base64 (use assets folder)

### JavaScript
- ✅ Use Alpine.js for simple interactivity (avoid Vue/React)
- ✅ Minimize DOM manipulation (batch updates)
- ✅ Use event delegation for dynamic elements
- ✅ Cache DOM queries in variables
- ✗ Never load large libraries for simple tasks

---

## Browser Support

- ✅ Chrome / Edge 90+
- ✅ Firefox 88+
- ✅ Safari 14+
- ✅ Mobile browsers (iOS Safari 14+, Chrome Mobile 90+)
- ❌ Internet Explorer 11 (not supported)

---

## Related Documentation

- [Vite Configuration](../vite.config.js)
- [Blade Components](views/components/README.md)
- [JavaScript Modules](js/README.md)
- [Stylesheet Architecture](css/README.md)

---

**Last Updated**: September 1, 2026  
**Status**: Production-Ready
