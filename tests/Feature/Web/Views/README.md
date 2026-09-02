# Views -- View / Template Tests

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this is part of "The Quality Assurance Lab."

Tests for the **Blade view templates** -- the HTML templates that render what users see. These verify the templates render without errors and show the correct content.

| Test | What It Verifies |
|------|------------------|
| `AssetPipelineTest` | CSS/JS/Vite assets load correctly on pages |
| `DesignSystemComponentsTest` | Reusable UI components render correctly |
| `DesignSystemViewsTest` | Layout/template files render correctly |
| `UiUsabilityTest` | UI elements are usable and correctly implemented |

## How to run these tests

```bash
# All tests in this folder
php artisan test tests/Feature/Web/Views

# A single test
php artisan test tests/Feature/Web/Views --filter=TestName
```
