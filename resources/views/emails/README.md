# resources/views/emails

HTML email templates for transactional and notification emails.

## Files

| File | Purpose |
|---|---|
| `passwordReset.blade.php` | Password reset email. Contains a branded action button linking to the reset URL, a security box with link expiry and warning text, and a raw URL fallback for restrictive email clients. |
| `test-mail.blade.php` | Mailgun integration test email. Sends a diagnostic validation message with telemetry metadata (driver, status, timestamp). |
| `ticketCreated.blade.php` | New fault/ticket notification email. Displays ticket details (title, equipment, room, priority, reporter, date, description) in a structured table with a "View Details" action button. |

## Notes for developers / AI

- All three templates use inline `<style>` blocks for email-client compatibility — no external CSS.
- User-facing strings use `__('...')` translation keys — do not modify these, only update the translation files in `lang/`.
- `ticketCreated.blade.php` contains a `match` expression on `$ticket->priority` that compares against Portuguese DB values (`alta`, `crítica`, etc.) — this is intentional business logic, not a naming issue.
- `passwordReset.blade.php` uses `config('auth.passwords...')` to dynamically render the link expiry time.

## Recent Refactorings

- No markup changes — **documented exception**: emails must remain fully self-contained (inline `<style>` blocks, compact font sizes, raw hex colors) because email clients (Gmail, Outlook) strip external stylesheets and never execute the runtime theme-JS that produces the design tokens. The Design Kit / token rules do not apply to email rendering; user-facing strings still use `__()` keys.
