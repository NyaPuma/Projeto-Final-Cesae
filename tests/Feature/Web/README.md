# Web -- Automated Browser/Page Tests

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this is part of "The Quality Assurance Lab."

Acceptance tests for the system's web pages (what users see and interact with in the browser). These verify that pages load correctly, forms submit properly, and users are redirected to the right place.

| Test | What It Verifies |
|------|------------------|
| `DashboardRedirectTest` | Logged-in users are sent to the correct dashboard after login |
| `PageControllerTest` | Standard pages load correctly (home, about, dashboard) |
| `PreferencesControllerTest` | User preferences (language, theme) are saved and applied |
| `ProfileControllerTest` | Users can view/update their own profile |
| `RegisterControllerTest` | The registration form works end-to-end |
| `RoomControllerTest` | Room management pages work |
| `UiControllerTest` | Generic UI controller routes respond correctly |
| `LocaleControllerTest` | Language switching works |
| `AssetPipelineTest` | CSS/JS/asset files are served correctly |
| `DesignSystemComponentsTest` | Design system components render correctly |
| `DesignSystemViewsTest` | Design system templates render correctly |
| `UiUsabilityTest` | UI is usable (navigation, labels, links) |

## How to run these tests

```bash
# All tests in this folder
php artisan test tests/Feature/Web

# A single test
php artisan test tests/Feature/Web --filter=TestName
```
