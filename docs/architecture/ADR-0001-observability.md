# ADR-0001: Layered Observability with Safe Defaults

## Status

Accepted

## Context

The application needs actionable production telemetry without making an external monitoring service, a cache server, or a specific log collector a runtime requirement.

## Decision

Use Laravel logging and Sentry as complementary layers. Application logs are emitted as JSON through the daily channel with fourteen-day local retention. Request context includes a request ID, authenticated user ID when available, client IP, route, and elapsed time. Sentry is optional and is enabled only when a DSN is configured. Sentry payloads redact credentials, tokens, authorization data, and payment-card fields.

Slow requests, slow queries, high memory usage, queue duration, and queue failures use stable metric identifiers in structured log context. Laravel's health endpoint is excluded from transaction tracing to avoid monitoring noise.

## Consequences

Operators can ingest the same structured events into a log platform or Sentry. Local development remains functional without Sentry credentials. Thresholds are environment-configurable, so deployments can tune alert volume without code changes.
