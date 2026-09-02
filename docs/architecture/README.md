# Architecture Decision Records

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../NON_TECHNICAL_PROJECT_GUIDE.md)

This folder is the **blueprint and decision journal** for the SGM application. Think of it as a diary where the team writes down the big, important choices about how the system is built — **and, just as importantly, WHY those choices were made**.

When a developer is new to the project (or comes back to it months later), they inevitably ask: "Why is this done this way?" These records answer that question before it even has to be asked.

## What is an Architecture Decision Record (ADR)?

An **Architecture Decision Record (ADR)** is simply a short written note that captures one important decision about how the software is structured or operated. Each record is deliberately small and follows a common, easy-to-read pattern:

- **Context** — the situation or problem that forced us to make a choice (the "why").
- **Decision** — the choice we made and what we actually did (the "what").
- **Consequences** — what happened afterwards: the trade-offs, what became easier, and what we now need to watch out for.

Keeping this journal matters because software decisions are rarely obvious from the code alone. Code tells you *what* is built, but it almost never tells you *why it was built that way*. Without these records, a future developer might "fix" something that was a deliberate choice — and break an important guarantee. A well-kept journal means the reasoning survives even when the people who made the decisions have moved on.

## The decision records in this folder

Here are the decisions recorded so far, each summarized in plain English:

### ADR-0001 — Layered Observability with Safe Defaults
- **Context:** The app needs to let operators see what's happening (logs, errors, performance) during production, without forcing every install to pay for or depend on outside services.
- **Decision:** The app writes its own detailed logs (as machine-readable JSON) and keeps them locally for two weeks. It can also report to Sentry, an error-tracking service, but only if someone provides the credentials — so it works out of the box with no setup. Sensitive information like passwords and payment cards is removed from reports. Slow requests, slow database queries, and background job problems are recorded in a consistent format.
- **Consequences:** Operators can feed these logs into whichever monitoring tool they like. Local development still works with no extra configuration. Operators can tune warning thresholds per environment without touching code.

### ADR-0002 — Fail-Open Resilience and Application-Owned Backups
- **Context:** Outside services (like AI features or currency-rate feeds) can fail or go offline on their own. When that happens, the whole application should not come crashing down. At the same time, the database and uploaded files must always be recoverable.
- **Decision:** Optional features use "feature flags" and a "circuit breaker". If an outside service fails repeatedly, the breaker stops calling it for a while and returns a safe, built-in fallback (so the app keeps working). Backups are handled by the app's own command, which compresses the database, archives uploaded files, cleans up any failed or partial backups, and can send copies to an external storage service (but only if an administrator turns that on).
- **Consequences:** When an outside dependency is unavailable, the affected features fall back to manual or cached behavior instead of failing entirely. Backups can be tested locally and can use cloud storage in production. Anyone doing a recovery must remember the external storage location and its retention rules.

## How this folder is organized

This `architecture/` folder is part of a family of related documentation folders. Each one tracks a different kind of work:

- **`architecture/`** — the decision journal itself. This is where important *choices* about how the system is built are recorded (the two ADRs above live here).
- **`refactor/`** — tracks a large effort to clean up and reorganize the codebase. It contains progress reports (`progress.md`), a machine-readable status manifest (`manifest.json`), a glossary, database naming reports, and session notes. If you want to know *what people are currently changing in the code and why*, look here.
- **`i18n/`** — tracks internationalization: the work of translating the app into many languages. It holds the tools/scripts that generate translations, audit reports, and an archive of the old translation files. The overall progress of this effort is summarized in `docs/i18n-progress.md`.

In short: **`architecture/` records the decisions that shaped the design, `refactor/` tracks the ongoing reorganisation of the code, and `i18n/` tracks the translation work.** Together they tell the story of *how* and *why* the application looks the way it does today.
