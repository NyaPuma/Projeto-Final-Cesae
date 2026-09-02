#!/bin/sh
set -e

# ---------------------------------------------------------------------------
# Production entrypoint — Laravel Octane (FrankenPHP worker mode)
#
# Generates Laravel caches (config/route/view/event) that are environment
# specific and therefore cannot be baked at build time, then hands off to
# the Octane FrankenPHP server.
# ---------------------------------------------------------------------------

# Persist caches to the volumes mounted without dev override. Skip failures
# (e.g. missing APP_KEY) instead of crashing so the sweep still starts.
php artisan optimize --ansi || echo "[entrypoint] optimize skipped: non-fatal"

exec "$@"