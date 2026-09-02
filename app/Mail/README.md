# app/Mail

Mailable classes for email notifications. All mailables are queued where applicable.

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this folder is explained as "The Post Office" that composes and sends email messages.

## Overview

This folder contains **3 mailable classes** that extend `Illuminate\Mail\Mailable`. Each mailable defines its envelope (subject), content (Blade view + data), and optionally attachments. Mailables that implement `ShouldQueue` are sent asynchronously via the queue worker.

**Summary:**

| Mailable | Queued? | Template | Purpose |
|---|---|---|---|
| `PasswordResetMail` | Yes | `emails.passwordReset` | Password reset link email |
| `TestMail` | No | `emails.test-mail` | System test email |
| `TicketCreated` | Yes | `emails.ticketCreated` | New ticket alert to admins |

---

## Files

### `PasswordResetMail.php`

**What it is:** A queued mailable that sends a password reset link to a user. The email contains a URL with a unique token that allows the user to set a new password.

**Class:** `App\Mail\PasswordResetMail`

**Implements:** `ShouldQueue` (queued delivery).

**Uses:** `Queueable`, `SerializesModels`

**Constructor parameters:**
| Parameter | Type | Description |
|---|---|---|
| `$token` | `string` | The unique password reset token (public readonly). |

**Queue configuration:**
- `$tries = 3`
- `$backoff = [5, 15, 30]` — exponential backoff between retries.

**`envelope()` — email metadata:**
- **Subject:** `__('notifications.mail_password_reset_subject')` — e.g. "Recuperação de Palavra-passe" (Portuguese: "Password Recovery").

**`content()` — email body:**
- **Template:** `emails.passwordReset` (Blade view at `resources/views/emails/passwordReset.blade.php`).
- **Data passed to view:**
  ```php
  'url' => route('api.password.reset.form', ['token' => $this->token])
  ```
  The `$url` variable is the full password reset URL generated from the named route `api.password.reset.form` with the token as a query parameter. The Blade template renders this URL as a clickable link.

**WHO sends it and WHEN:**
- `app/Http/Controllers/PasswordResetController.php:32`:
  ```php
  Mail::to($user)->send(new PasswordResetMail($token));
  ```
  Sent when an authenticated or unauthenticated user requests a password reset via `POST /password/forgot` (the `sendResetLink` method). The controller:
  1. Creates a reset token via `PasswordResetService::createResetToken($email)`.
  2. Looks up the user by normalized email.
  3. Sends the mailable to the user.

**Blade template:** `resources/views/emails/passwordReset.blade.php`
- Receives `$url` — the clickable reset link.

---

### `TestMail.php`

**What it is:** A non-queued mailable for sending test emails from the system settings page. It verifies that the configured mailer (e.g. Mailgun, SMTP, SES) is working correctly.

**Class:** `App\Mail\TestMail`

**Implements:** Does **not** implement `ShouldQueue` — sent synchronously.

**Uses:** `Queueable`, `SerializesModels`

**Constructor parameters:**
| Parameter | Type | Description |
|---|---|---|
| `$recipientName` | `string` | The recipient's display name (public readonly). Automatically injected into the Blade view as a public property. |

**Queue configuration:**
- Not queued — `$tries` and `$backoff` are not set.

**`envelope()` — email metadata:**
- **Subject:** `__('notifications.mail_test_subject')` — e.g. "Email de Teste" (Portuguese: "Test Email").

**`content()` — email body:**
- **Template:** `emails.test-mail` (Blade view at `resources/views/emails/test-mail.blade.php`).
- **Data:** The `$recipientName` property is automatically available in the view as a public property of the Mailable class (no explicit `with` array needed).

**WHO sends it and WHEN:**
- `app/Jobs/SendTestEmailJob.php:52` — via the queue job:
  ```php
  $mailClient->to($this->email)->send(new TestMail($this->name));
  ```
  The `SendTestEmailJob` resolves the configured mailer from `config('services.custom.notification.mailer')` and sends the mailable to the specified email address.

- The `SendTestEmailJob` is dispatched from `app/Http/Controllers/NotificationController.php:97`:
  ```php
  SendTestEmailJob::dispatch($user->email, $user->name);
  ```
  Triggered when an authenticated user calls `POST /notifications/test-email`.

**Important:** Although `TestMail` itself is not queued, it is **sent via a queued job** (`SendTestEmailJob`), so the email delivery is still asynchronous from the user's perspective.

**Blade template:** `resources/views/emails/test-mail.blade.php`
- Receives `$recipientName` — the name of the person receiving the test email.

---

### `TicketCreated.php`

**What it is:** A queued mailable that notifies administrators when a new ticket (fault or incident) is created in the system.

**Class:** `App\Mail\TicketCreated`

**Implements:** `ShouldQueue` (queued delivery).

**Uses:** `Queueable`, `SerializesModels`

**Constructor parameters:**
| Parameter | Type | Description |
|---|---|---|
| `$ticket` | `App\Models\Ticket` | The newly created ticket (public readonly). |

**Queue configuration:**
- Not explicitly set — uses Laravel defaults (`$tries = 25`, `$timeout = 60`).

**`envelope()` — email metadata:**
- **Subject:** `__('notifications.mail_ticket_created_subject', ['id' => $this->ticket->id])` — e.g. "Novo Ticket #42" (Portuguese: "New Ticket #42").

**`content()` — email body:**
- **Template:** `emails.ticketCreated` (Blade view at `resources/views/emails/ticketCreated.blade.php`).
- **Data:** The `$ticket` property is automatically available in the view as a public property of the Mailable class. The Blade template can access all ticket attributes (id, title, priority, status, description, etc.).

**`attachments()` — file attachments:**
- Returns an empty array `[]` — no file attachments are included.

**WHO sends it and WHEN:**
- `app/Services/BudgetNotificationService.php:97-104` — via `notifyTicketCreated()`:
  ```php
  $this->creator->createForAdmins(
      title: "New Ticket - #{$ticket->id}",
      message: "New ticket created: {$ticket->title}",
      type: NotificationTypeEnum::TicketCreated->value,
      link: "/ui/tickets/{$ticket->id}",
  );
  ```
  This is called via the service chain:
  1. `NotificationService::notifyTicketCreated()` → `BudgetNotificationService::notifyTicketCreated()` → `NotificationCreatorService::createForAdmins()`.

  However, note that `BudgetNotificationService::notifyTicketCreated()` creates **in-app notifications** (via `NotificationCreatorService`), not `Mail::send()` calls. The `App\Mail\TicketCreated` mailable is **not directly dispatched** by any production code path found in the codebase — it may be used by the `NotificationCreatorService` internally or intended for future use.

  **If** the mailable were sent directly, it would use:
  ```php
  Mail::to($admin)->queue(new TicketCreated($ticket));
  ```

**Blade template:** `resources/views/emails/ticketCreated.blade.php`
- Receives `$ticket` — the full `Ticket` model with all attributes and relations.

---

## Notes for developers / AI

- Email subject lines are in Portuguese — managed by the i18n project, not this refactor.
- `PasswordResetMail` and `TicketCreated` implement `ShouldQueue`; `TestMail` does not.
- `PasswordResetMail` uses the `api.password.reset.form` named route for the reset URL.
- `TestMail` receives `$recipientName` as a constructor parameter which is automatically injected into the Blade view as a public property.
- `TicketCreated` receives the full `$ticket` model which is serialized/deserialized by `SerializesModels` for queue delivery.
- The `App\Mail\TicketCreated` mailable class is imported in the test file `tests/Unit/Mail/MailablesTest.php` for unit testing, but no production `Mail::to()->send(new TicketCreated(...))` or `Mail::to()->queue(new TicketCreated(...))` calls were found in the application code.
- The `emails.ticketCreated` Blade template is referenced but may be the same template used by the `NotificationCreatorService` for admin notifications about new tickets.
