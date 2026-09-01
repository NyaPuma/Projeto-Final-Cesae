# ADR-0002: Fail-Open Resilience and Application-Owned Backups

## Status

Accepted

## Context

Third-party integrations and backup destinations can fail independently of the application. A failure must not turn optional functionality into an application-wide outage, while database and uploaded-file recovery must remain possible.

## Decision

Use cache-backed feature flags for operational rollouts and a circuit breaker for external calls. The breaker records failures, temporarily skips unhealthy dependencies, and returns a safe fallback. Feature-flag and breaker state failures are fail-open for the primary application path and are logged for operators.

The existing native database backup command remains the backup implementation because the currently supported Laravel and PHP versions are not compatible with the newer third-party backup package releases. The command creates a compressed database artifact, archives application storage, removes incomplete artifacts on failure, and can upload private artifacts to a configured Flysystem disk. Off-site upload is disabled by default and must be explicitly enabled with deployment secrets.

## Consequences

AI recommendations and external currency rates degrade to manual or cached behavior when dependencies are unavailable. Backup execution remains verifiable locally and can use S3-compatible storage in production. Recovery procedures must include the configured off-site disk and the retention policy.
