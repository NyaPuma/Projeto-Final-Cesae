# AGENTS.md — Bearer Labs Gateway

## Project Overview

Bearer Labs Gateway is an early-stage cryptocurrency startup platform (Node.js / Express 5 / TypeScript / Prisma / PostgreSQL) for managing EVM chain deployments. It provides:
- A **public landing page** (React via Vite)
- An **admin dashboard** (React via Vite at `/admin`)
- A **REST API** (Express at `/api`)

The project is **actively migrating from raw Prisma queries to a custom repository layer** with dependency injection, and from manually-written Passport strategies to `@PassportLabz/passport-snap`.

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Runtime | Node.js (ESM, `"type": "module"`) |
| HTTP | Express 5 (`express@5.2.1`) |
| Language | TypeScript (strict, with paths alias `@/*` → `./src/*`) |
| ORM | Prisma (`prisma@6.21.1`, `@prisma/client`) |
| Database | PostgreSQL |
| Auth | Passport.js (JWT, Google OAuth2, GitHub OAuth2, SnapConnect via `@PassportLabz/passport-snap`) |
| Session | `express-session` with `connect-pg-simple` (PostgreSQL session store) |
| Validation | Zod (`@hono/zod-validator`, custom middleware) |
| Frontend | React 19, Vite, TanStack Router, TanStack Query, MUI, Bootstrap, TailwindCSS |
| Build | Vite (separate configs for landing, admin landing, and admin app) |
| Testing | Vitest (with `@vitest/coverage-v8`) |
| Logging | Custom logger wrapping `pino` with `pino-pretty` |

## Project Structure

```
src/
├── app.ts                    # Express app factory (all middleware + routes registered here)
├── server.ts                 # Entry point — loads env, creates app, starts HTTP server
├── app.d.ts                  # Global TypeScript declarations (AugmentExpressRequest)
├── config/
│   ├── index.ts              # Environment config with safe defaults
│   ├── logger.ts             # Custom logger class wrapping pino
│   ├── passport/
│   │   ├── google.ts         # Google OAuth2 strategy (GoogleStrategy type)
│   │   ├── github.ts         # GitHub OAuth2 strategy (GitHubStrategy type)
│   │   ├── jwt.ts            # JWT Bearer strategy
│   │   └── registry.ts       # Central passport.initialize()/serialize/deserialize
│   └── passport-snap.ts      # SnapConnect passport strategies (local + jwt)
├── constants/
│   ├── auth.ts               # Auth-related constants
│   └── env.ts                # Environment variable names
├── middleware/
│   ├── auth/                 # requireAuth (JWT + session), requireAuthAdmin (JWT-only)
│   ├── errorHandler.ts       # Global error handler
│   ├── health.ts             # /health and /health/liveness endpoints
│   ├── notFoundHandler.ts    # 404 handler
│   └── validateRequest.ts    # Zod schema validation middleware
├── modules/
│   ├── auth/                 # Auth module (login, register, OAuth, MFA, 2FA, sessions)
│   │   ├── controller.ts     # AuthController class — all auth route handlers
│   │   ├── services/         # AuthService, OAuthService, MFAService, SessionService
│   │   ├── repository/       # SessionRepository (raw SQL)
│   │   ├── routes.ts         # /api/auth/* routes
│   │   ├── middleware/       # requireGuest, requireUser, rateLimiters
│   │   └── types/            # Strategy types, DTOs
│   ├── deployments/          # Chain deployments management
│   │   ├── controller.ts     # DeploymentController — fully migrated to repository
│   │   ├── services/
│   │   │   ├── index.ts      # DeploymentService (base service)
│   │   │   └── v2/           # DeploymentServiceV2 (extended service)
│   │   ├── repository/       # DeploymentRepository — uses DI container
│   │   ├── routes.ts         # /api/deployments/*, /api/project-deployments/*
│   │   ├── middleware/        # validateDeploymentCreateUpdate, requireDeploymentExists, requireProjectExists
│   │   └── types/            # DTOs (input + output)
│   └── users/                # User management (migration incomplete)
│       ├── controller.ts     # UsersController — still calls prisma directly
│       ├── services/         # UsersService — uses repository
│       ├── repository/       # UserRepository — uses DI container
│       ├── routes.ts         # /api/users/* routes
│       └── types/            # DTOs (input + output)
├── repositories/             # Legacy repository layer (being replaced)
│   ├── base.repository.ts    # BaseRepository class
│   ├── user.repository.ts    # UserRepository (legacy, raw SQL)
│   ├── session.repository.ts # SessionRepository (legacy, raw SQL)
│   └── project-deployment/   # ProjectDeploymentRepository (being replaced by DI)
├── container.ts              # DI container (tsyringe) — repos + services registered here
├── factories/
│   └── repository.factory.ts # Creates legacy repositories with PrismaClient injection
├── prisma/
│   ├── client.ts             # PrismaClient singleton
│   └── index.ts              # Re-exports
├── types/
│   └── index.ts              # Shared types (AuthTypes namespace)
└── utils/
    ├── apiError.ts           # ApiError class (custom HTTP errors)
    ├── date.ts               # Date formatting helpers
    ├── errorHandler.ts       # Error handling utilities
    ├── response.ts           # Standardized API response helpers
    ├── token.ts              # JWT token generation/verification
    └── url.ts                # URL helpers
```

## Key Commands

```bash
# Install dependencies
npm install

# Development (runs landing + admin landing + admin app + API server concurrently)
npm run dev

# Build all
npm run build

# Run API server (production)
npm run start

# Database
npm run prisma:generate          # Generate Prisma client
npm run prisma:migrate:dev       # Run migrations (development)
npm run prisma:migrate:deploy    # Apply migrations (production)
npm run prisma:seed              # Seed database
npm run db:reset                 # Reset database + seed
npm run db:studio                # Open Prisma Studio

# Testing
npm test                         # Run all tests (vitest run)
npm run test:ui                  # Vitest UI
npm run test:watch               # Watch mode
npm run test:coverage            # With coverage (v8)

# Linting
npm run lint                     # ESLint

# CORS testing (from tools/)
cd tools/cors-test && npm test
cd tools/cors-test-react && npm test
```

## Environment Variables

**Required:**
- `DATABASE_URL` — PostgreSQL connection string
- `JWT_SECRET` — JWT signing secret
- `JWT_SECRET_SESSION` — Separate secret for session JWTs
- `ENCRYPTION_KEY` — AES encryption key for sensitive data (exactly 32 chars / 256-bit)
- `SNAP_API_KEY` — SnapConnect API key (format: `snappy_*.sk.*`)

**Optional (with defaults):**
- `PORT` — API server port (default: 3001)
- `LANDING_PORT` — Landing page dev port (default: 3002)
- `ADMIN_LANDING_PORT` — Admin landing dev port (default: 3004)
- `ADMIN_PORT` — Admin app dev port (default: 3005)
- `GOOGLE_CLIENT_ID` / `GOOGLE_CLIENT_SECRET` — Google OAuth
- `GITHUB_CLIENT_ID` / `GITHUB_CLIENT_SECRET` — GitHub OAuth
- `SESSION_SECRET` — Express session secret
- `ENCRYPTION_ALGORITHM` — Default: `aes-256-gcm`
- `ACCESS_TOKEN_EXPIRY` — Default: `15m`
- `REFRESH_TOKEN_EXPIRY` — Default: `7d`
- `NODE_ENV` — `development` / `test` / `production`

## Testing

- **Framework:** Vitest (ESM-compatible)
- **Location:** Tests live next to source as `*.test.ts`
- **Config:** `vitest.config.ts` at project root
- **Environment:** Tests use `vitest-environment-node` (not jsdom)
- **Pattern:** Arrange/Act/Assert with descriptive `describe`/`it` blocks
- **Mocking:** Heavy use of `vi.mock()` for ESM module mocking
- **Coverage:** V8 provider with statements/branches/functions/lines at 80% global threshold
- **Setup:** `vitest.setup.ts` for global test configuration

### Running Tests
```bash
npm test                    # Run once (CI mode)
npm run test:watch          # Watch mode
npm run test:ui             # Browser-based UI
npm run test:coverage       # With coverage report
npx vitest run <path>       # Run specific test file
```

## Code Style & Conventions

- **ESM** throughout (`"type": "module"`)
- **TypeScript strict mode** with path alias `@/*` mapping to `./src/*`
- **Classes for controllers and services** (e.g., `AuthController`, `DeploymentService`)
- **Dependency injection** via `tsyringe` container (`src/container.ts`)
- **Repository pattern** — each module has its own `repository/` with a repository class
- **Service layer** — each module has `services/` with a base service and optional V2 variants
- **Zod** for input validation and DTO definitions (`input.dto.ts` / `output.dto.ts`)
- **Named exports** preferred over default exports
- **Logger** via `@/config/logger` (wraps pino with structured logging)
- **Error handling** via custom `ApiError` class thrown in services/controllers, caught by global `errorHandler`
- **Response format** — use standardized helpers from `@/utils/response` (e.g., `sendSuccess`, `sendError`)
- **Route registration** pattern: each module defines a `registerRoutes(app, basePath, ...middleware)` function, called from `app.ts`
- **Middleware per module** lives in `modules/<name>/middleware/`
- **Types directory** per module: `types/input.dto.ts` and `types/output.dto.ts`

## Application Entry Points

### API Server (`src/server.ts`)
1. Loads environment config
2. Creates Express app via `src/app.ts`
3. Starts HTTP server on configured port

### Express App (`src/app.ts`)
All middleware and routes are registered here in order:
1. CORS, body parsing (urlencoded + JSON with `verify` for rawBody)
2. Static file serving (`/landing`, `/admin-landing`, `/admin`)
3. Session management (`express-session` with pg store)
4. Passport initialization + session serialization
5. Health endpoints (`/health`, `/health/liveness`)
6. API routes (`/api/auth/*`, `/api/users/*`, `/api/deployments/*`, `/api/project-deployments/*`)
7. Catch-all for SPA routes (serves `index.html` for landing, admin-landing, and admin)
8. 404 handler + global error handler

### Frontend Apps
- **Landing page:** `landing/index.html` (Vite, TanStack Router)
- **Admin landing:** `admin-landing/index.html` (Vite, React)
- **Admin dashboard:** `admin/index.html` (Vite, TanStack Router + Query, MUI + Bootstrap + TailwindCSS)

## API Route Structure

```
/api/
├── auth/
│   ├── POST /login                           # Email/password login
│   ├── POST /register                        # User registration
│   ├── POST /logout                          # Logout + session destroy
│   ├── POST /refresh                         # Refresh JWT tokens
│   ├── GET  /me                              # Get current user
│   ├── GET  /sessions                        # List user sessions
│   ├── DELETE /sessions                       # Revoke all sessions
│   ├── DELETE /sessions/:id                   # Revoke specific session
│   ├── POST /mfa/setup                        # Setup MFA (TOTP)
│   ├── POST /mfa/verify                       # Verify MFA setup
│   ├── POST /mfa/login                        # MFA login
│   ├── POST /mfa/disable                      # Disable MFA
│   ├── POST /password/forgot                  # Forgot password (send email)
│   ├── POST /password/reset                   # Reset password (with token)
│   ├── POST /password/change                  # Change password (authenticated)
│   ├── POST /otp/verify                       # Verify email OTP
│   ├── POST /otp/resend                       # Resend email OTP
│   ├── GET  /oauth/google                     # Google OAuth redirect
│   ├── GET  /oauth/google/callback            # Google OAuth callback
│   ├── GET  /oauth/github                     # GitHub OAuth redirect
│   ├── GET  /oauth/github/callback            # GitHub OAuth callback
│   └── GET  /oauth/snapconnect                # SnapConnect OAuth redirect
├── users/
│   ├── GET    /                               # List users (paginated, filterable)
│   ├── GET    /me                             # Get current user
│   ├── POST   /                               # Create user
│   ├── GET    /userId/:userId                 # Get user by ID
│   ├── PUT    /userId/:userId                 # Update user
│   ├── DELETE /userId/:userId                 # Delete user
│   ├── POST   /userId/:userId/change-password # Change password
│   ├── PUT    /userId/:userId/profile-picture # Upload profile picture
│   └── DELETE /userId/:userId/profile-picture # Delete profile picture
├── deployments/
│   ├── GET    /                               # List deployments (paginated, filterable, sortable)
│   ├── POST   /                               # Create deployment
│   ├── GET    /user/:userId                   # Get deployments by user
│   ├── GET    /id/:id                         # Get deployment by ID
│   ├── PUT    /id/:id                         # Update deployment
│   ├── DELETE /id/:id                         # Delete deployment
│   ├── POST   /id/:id/send-transaction        # Send a transaction
│   └── GET    /id/:id/transaction-history     # Get transaction history
├── project-deployments/
│   ├── GET    /                               # List project deployments (paginated)
│   ├── POST   /                               # Create project deployment
│   ├── GET    /id/:id                         # Get project deployment by ID
│   ├── PUT    /id/:id                         # Update project deployment
│   ├── DELETE /id/:id                         # Delete project deployment
│   └── POST   /id/:id/upgrade                 # Upgrade project deployment
└── health                                     # Health check
```

**Note:** Most routes require authentication via `requireAuth()` or `requireAuthAdmin()` middleware. Guest-only routes (login, register, OAuth, forgot password, reset password) use `requireGuest()`.

## Auth Flow

1. **Registration:** `POST /api/auth/register` → creates user → returns JWT tokens + sets session
2. **Login:** `POST /api/auth/login` → validates credentials → returns JWT tokens + sets session
3. **OAuth:** `GET /api/auth/oauth/:provider` → redirects to provider → callback creates/links account → returns JWT tokens
4. **JWT:** Bearer token in `Authorization` header → `requireAuth` middleware validates + attaches `req.user`
5. **Session:** Express session with PostgreSQL store → passport serializes/deserializes user → used for OAuth redirect flow
6. **MFA:** Optional TOTP-based MFA → setup/verify/disable endpoints
7. **2FA:** SnapConnect-based 2FA via `@PassportLabz/passport-snap`
8. **Admin check:** `requireAuthAdmin` middleware checks `role === "ADMIN"` on the User record

## Database Schema (Prisma Models)

- **User** — id (CUID), email (unique), username (unique), passwordHash, role (USER/ADMIN), isVerified, profilePicture, mfaEnabled, mfaSecret, lastLogin, lastFailedLogin, failedLoginAttempts, lockedUntil
- **Session** — id (UUID), userId, token, ipAddress, userAgent, isValid, expiresAt, lastActivityAt, createdAt
- **RefreshToken** — id (UUID), userId, token, expiresAt, userAgent, ipAddress
- **EmailVerificationToken** — id, userId, token, expiresAt
- **PasswordResetToken** — id, userId, token, expiresAt
- **TwoFactorBackupCode** — id, userId, code, used, usedAt, createdAt
- **Chain** — id (UUID), name, chainId (unique), currency, blockTime, explorerUrl, isTestnet, isEVMCompatible, createdAt, updatedAt
- **Deployment** — id (UUID), name, chainId, addresses (json), deploymentType (RELAY/INDEXER/BRIDGE), userId, contractName, constructorArgs (json), compilerVersion, optimization, networkType, status, deployedAt, createdAt, updatedAt
- **ProjectDeployment** — id (UUID), projectId (unique), userId, chainId, programAddress, explorerUrl, cliVersion, config (json), features (json), status, deployedAt, createdAt, updatedAt

## DI Container

Defined in `src/container.ts` using `tsyringe`:

**Repositories (singletons):**
- `PrismaClient` — registered as value
- `UserRepository` — implements `IUserRepository`
- `SessionRepository`
- `ProjectDeploymentRepository` — implements `IProjectDeploymentRepository`
- `DeploymentRepository`

**Services (transient):**
- `UserService`
- `SessionService`
- `DeploymentService`

**Modules:** Each module creates its own container scope via `requestContainer.createChildContainer()`.

## Migration Status: Repository Layer

The project is actively migrating from raw Prisma queries to a repository pattern. Current status:

| Module | Repository | Service | Controller | Status |
|--------|-----------|---------|------------|--------|
| deployments | ✅ `DeploymentRepository` (DI) | ✅ `DeploymentService` + `V2` | ✅ `DeploymentController` | **Fully migrated** |
| users | ✅ `UserRepository` (DI) | ✅ `UsersService` | ❌ Still calls `prisma` directly | **Partially migrated** |
| auth | ❌ Raw SQL queries | ✅ Service classes | ✅ Controller class | **Not migrated** (raw queries in service/repository) |

The legacy `src/repositories/` directory contains older repository classes (e.g., `BaseRepository`, `UserRepository`, `ProjectDeploymentRepository`) that are being replaced by module-specific repositories in `src/modules/*/repository/`.

## Frontend Structure

### Admin App (`admin/src/`)
- **Router:** TanStack Router with `createRootRoute` and route tree in `routeTree.gen.ts`
- **Data fetching:** TanStack Query (`@tanstack/react-query`)
- **UI:** MUI DataGrid, Bootstrap components, TailwindCSS utility classes
- **Auth:** AuthProvider context with login/logout methods, JWT stored and sent via API client
- **API client:** `src/lib/api.ts` (fetch wrapper with token refresh)
- **Pages:** Dashboard, Users (CRUD), Deployments (CRUD), Chain Management, Roles, Settings, Analytics
- **Components:** Custom components in `src/components/`, shared UI in `src/components/ui/`

### Landing Page (`landing/src/`)
- **Router:** TanStack Router
- **UI:** TailwindCSS, custom components
- **Purpose:** Marketing / public-facing page

### Admin Landing (`admin-landing/src/`)
- **UI:** React + Bootstrap
- **Purpose:** Admin-facing landing page (pre-login)

## Common Patterns

### Route Registration
Each module exports a `registerRoutes` function:
```typescript
export function registerRoutes(app: Router, basePath: string, ...middlewares: RequestHandler[]) {
  const controller = new XxxController();
  app.use(basePath, ...middlewares, controller.getRouter());
}
```

### Controller Pattern
Controllers create an Express Router and attach methods:
```typescript
class XxxController {
  getRouter(): Router {
    const router = Router();
    router.get("/", this.list.bind(this));
    return router;
  }
  async list(req: Request, res: Response, next: NextFunction) { ... }
}
```

### Middleware Chain
Routes use a composable middleware chain pattern:
```typescript
router.get("/", ...middlewareChain(this.methodA, this.methodB, this.methodC));
```

### Error Handling
- Services throw `ApiError` (or subclass) for business logic errors
- Global `errorHandler` middleware catches all errors and returns standardized JSON responses
- Validation errors (Zod) are caught by `validateRequest` middleware

### Response Format
```json
{
  "success": true,
  "data": { ... },
  "message": "Optional message"
}
```
Or for errors:
```json
{
  "success": false,
  "message": "Error description",
  "errors": [...]
}
```

## Important Notes

1. **ESM throughout** — all imports use `import/export`, no CommonJS
2. **Path aliases** — `@/` maps to `./src/` in TypeScript, configured in both `tsconfig.json` and `vitest.config.ts`
3. **Dual session management** — both Express sessions (for OAuth redirect flow) and JWT tokens (for API auth) are used simultaneously
4. **Prisma client** — always import from `@/prisma` or `@/prisma/client`, not directly from `@prisma/client`
5. **Test patterns** — use `vi.mock()` at top of file, `describe`/`it` blocks, `expect` assertions; mocks return `mockResolvedValue`/`mockRejectedValue` for async functions
6. **No Prisma migrations committed** — the `prisma/migrations/` directory exists but `migration_lock.toml` is present, indicating migrations are managed via CLI
7. **Concurrent dev servers** — `npm run dev` runs landing, admin landing, admin app, and API server simultaneously on different ports
8. **`/health` and `/health/liveness`** — both return `{ status: "ok", timestamp, uptime }` and are exempt from auth
9. **SnapConnect integration** — uses `@PassportLabz/passport-snap` for WebAuthn-based 2FA; the Snap API URL is `https://api-beta.snapco.dev`
