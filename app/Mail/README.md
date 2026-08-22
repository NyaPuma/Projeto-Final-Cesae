# app/Mail

Mailable classes for email notifications. All mailables are queued where applicable.

## Files

| File | Purpose |
|---|---|
| `PasswordResetMail.php` | Queued mailable that sends the password reset link to a user |
| `TestMail.php` | Non-queued mailable for sending test emails from the system settings |
| `TicketCreated.php` | Queued mailable that notifies admins when a new ticket (fault/incident) is created |

## Notes for developers / AI

- Email subject lines are in Portuguese — managed by the i18n project, not this refactor.
- `PasswordResetMail` and `TicketCreated` implement `ShouldQueue`; `TestMail` does not.
- `PasswordResetMail` uses the `api.password.reset.form` named route for the reset URL.
