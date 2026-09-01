# Integrated Maintenance Management System (SGM)

![Status](https://img.shields.io/badge/status-production--ready-brightgreen)
![Tests](https://img.shields.io/badge/tests-1410%20passed-brightgreen)
![PHP Version](https://img.shields.io/badge/PHP-8.2%2B-blue)
![Laravel Version](https://img.shields.io/badge/Laravel-12-red)

An enterprise-grade web platform built with **Laravel 12** for digitalization, centralization, and optimization of the complete maintenance and fault management lifecycle within an organization's **Maintenance Department**.

The system mitigates communication failures and extended infrastructure downtime by organizing workflows, improving traceability, and distributing operational intelligence across three user roles: **Operator** (Standard User), **Technician**, and **Administrator** (Operations Director).

---

## 🎯 Key Features

- **Fault/Ticket Management**: Create, assign, track, and resolve maintenance tickets with full workflow control
- **Preventive Maintenance**: Schedule and manage preventive maintenance plans with automatic alerts
- **Stock & Inventory**: Track parts inventory, movements, costs, and low-stock notifications
- **Role-Based Access Control (RBAC)**: Three-tier permission system (Operator, Technician, Admin)
- **Real-Time Notifications**: Dashboard alerts and notifications via database/email/broadcast
- **Audit Trail**: Complete audit history of all changes with user tracking and timestamps
- **AI-Assisted**: Smart ticket categorization and technician recommendations via OpenAI
- **Multi-Language Support**: 50+ locales with per-user preferences (currency, date format, language)
- **Advanced Reporting**: CSV/PDF/Excel exports with analytics and insights
- **Responsive Design**: Mobile-friendly interface with Tailwind CSS and component-based UI

---

## 🛠️ Technology Stack

### Backend
| Technology | Purpose |
|---|---|
| **PHP 8.2+** | Runtime language |
| **Laravel 12** | Web framework |
| **MySQL / SQLite** | Database (SQLite for dev, MySQL for prod) |
| **Redis** | Caching, sessions, and queue driver |
| **Octane (FrankenPHP)** | Production app server with worker mode |
| **OpenAI API** | AI-powered ticket classification |

### Frontend
| Technology | Purpose |
|---|---|
| **Blade Templates** | Server-side templating |
| **Tailwind CSS** | Utility-first CSS framework |
| **Bootstrap** | Component library |
| **FullCalendar v6** | Event scheduling and visualization |
| **Vite** | Asset bundling and development server |
| **Alpine.js** | Lightweight DOM interactions |

### Quality & DevOps
| Technology | Purpose |
|---|---|
| **PHPUnit** | Testing framework (1410+ tests) |
| **Vitest** | JavaScript testing |
| **PHPStan** | Static analysis (Level 5) |
| **Laravel Pint** | Code formatting |
| **Docker** | Containerization (Multi-stage build) |
| **OpenAPI/Swagger** | API documentation |

---

## 📦 Installation & Setup

### Prerequisites
- **PHP 8.2+** with common extensions (PDO, OpenSSL, JSON)
- **Composer 2.0+**
- **Node.js 18+** and npm
- **MySQL 8.0+** or SQLite (for development)
- **Redis** (optional but recommended for production)

### Local Development Setup

#### 1. Clone the repository
```bash
git clone https://github.com/NyaPuma/Projeto-Final-Cesae.git
cd Projeto-Final-Cesae
```

#### 2. Install dependencies
```bash
composer install
npm install
```

#### 3. Configure environment
```bash
cp .env.example .env
php artisan key:generate
```

Then edit `.env` with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sgm
DB_USERNAME=root
DB_PASSWORD=

QUEUE_CONNECTION=database
CACHE_STORE=database
```

#### 4. Set up database and assets
```bash
php artisan migrate --seed
php artisan storage:link
npm run dev
```

#### 5. Start the application

**Terminal 1 - Queue Worker** (processes emails, exports, notifications):
```bash
php artisan queue:work
```

**Terminal 2 - Scheduler** (runs daily tasks like low-stock checks):
```bash
php artisan schedule:work
```

**Terminal 3 - Development Servers** (Laravel + Vite):
```bash
php artisan serve   # Runs on http://localhost:8000
npm run dev         # Vite dev server
```

The application will be available at **http://localhost:8000**

---

## 🧪 Testing

Run the full test suite:
```bash
php artisan test
```

Expected output:
```
Tests:    1410 passed
Assertions: 4563
Duration: ~240s
Failures: 0
```

Run specific test suites:
```bash
php artisan test --filter=AuthFlow              # Authentication tests
php artisan test --filter=Performance           # Performance benchmarks
php artisan test --filter=Security              # Security tests
php artisan test --filter=Feature               # Feature tests
php artisan test tests/Unit/Models/            # Model unit tests
```

Generate coverage report:
```bash
php artisan test --coverage
```

---

## 🚀 Production Deployment

### Docker Deployment

#### Build the image:
```bash
docker build -t sgm:latest .
```

#### Run the container:
```bash
docker run -d \
  --name sgm \
  -p 8000:80 \
  -e APP_ENV=production \
  -e APP_DEBUG=false \
  -e DB_HOST=postgres.internal \
  -e DB_PORT=5432 \
  -e REDIS_HOST=redis.internal \
  sgm:latest
```

#### Health check:
```bash
curl http://127.0.0.1:8000/health
# Response: {"status":"ok","timestamp":"...","uptime":"..."}
```

### Pre-Deployment Checklist

```bash
# 1. Run migrations (if pending)
php artisan migrate --force

# 2. Cache configuration (Octane workers boot once per container)
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 3. Optimize autoloader
composer install --no-dev --optimize-autoloader

# 4. Check environment
php artisan config:show octane
# Expected: server = frankenphp

# 5. Verify all tests pass
php artisan test

# 6. Check security
composer audit --locked
```

### Runtime Configuration

Key `.env` variables for production:

```env
APP_ENV=production
APP_DEBUG=false

LOG_CHANNEL=stderr
LOG_LEVEL=error

DB_CONNECTION=mysql
REDIS_HOST=redis.internal
CACHE_STORE=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

OCTANE_SERVER=frankenphp
OCTANE_WORKERS=8
OCTANE_MAX_EXECUTION_TIME=30

MAIL_MAILER=smtp
MAIL_HOST=smtp.example.com
MAIL_PORT=587
```

---

## 📚 Documentation

Comprehensive architectural and operational documentation is available in the `/docs` directory:

### Strategy & Management
- [Project Plan](docs/plano-projeto.md) — Sprint planning, team composition, risk matrix
- [Product Backlog](docs/product-backlog.md) — Feature list, priorities, acceptance criteria
- [Process Analysis (As-Is vs To-Be)](docs/analise-processos.md) — Operational improvements and AI-assisted workflows

### Engineering & Architecture
- [Requirements](docs/requisitos.md) — Functional (RF) and Non-Functional (RNF) requirements
- [Authorization & Permissions (RBAC)](docs/permissoes.md) — Role-based access control matrix
- [Data Architecture (ER Diagram)](docs/diagrama-arquitetura.md) — Relational model, indexing, constraints
- [API Endpoints](docs/api-endpoints.md) — REST API specification and contracts

### Quality & Operations
- [User Guide](docs/guia-utilizador.md) — Step-by-step instructions for each user role
- [Test Plan](docs/plano-testes.md) — QA scenarios, RBAC security testing, validation matrix
- [Workflow & Integrations](docs/workflow-integracoes.md) — Unified data flow and notification architecture

---

## 🏗️ Project Architecture

### Layered Architecture

```
┌─────────────────────────────────────┐
│  HTTP Layer                         │ → Controllers, Middleware, Routes
├─────────────────────────────────────┤
│  Service Layer                      │ → Business logic orchestration
├─────────────────────────────────────┤
│  Action/Domain Layer                │ → Single-purpose command handlers
├─────────────────────────────────────┤
│  Repository Layer                   │ → Data access abstraction
├─────────────────────────────────────┤
│  Model Layer (Eloquent ORM)         │ → Database mapping
├─────────────────────────────────────┤
│  Database (MySQL/SQLite)            │ → Persistent storage
└─────────────────────────────────────┘
```

### Key Design Patterns

- **Repository Pattern**: Data access abstraction via interfaces and implementations
- **Action Classes**: Single-responsibility command handlers for complex operations
- **Service Layer**: Business logic orchestration across domains
- **DTOs (Data Transfer Objects)**: Strongly-typed data passing between layers
- **Value Objects**: Immutable domain concepts (Email, Money, SerialNumber)
- **Model Observers**: Automatic lifecycle hooks (audit trail, cache invalidation)
- **Policy-based Authorization**: Granular permission checks via Laravel Policies

### Directory Structure

```
app/
├── Actions/                 # Single-purpose command handlers
├── Http/                    # Controllers, middleware, requests, resources
├── Models/                  # Eloquent ORM models
├── Services/                # Business logic services
├── Repositories/            # Data access layer
├── DTOs/                    # Data Transfer Objects
├── Enums/                   # PHP 8.1+ enums
├── Events/                  # Domain events
├── Jobs/                    # Queued background jobs
├── Listeners/               # Event listeners
├── Mail/                    # Mailable classes
├── Notifications/           # User notifications
├── Observers/               # Model lifecycle observers
├── Policies/                # Authorization policies
├── Traits/                  # Shared traits (Auditable, etc.)
├── ValueObjects/            # Immutable value objects
└── Console/                 # Artisan commands
```

---

## 📊 Project Status

### ✅ Current State
- **Test Suite**: 1410 tests passing (100% green)
- **Security**: Enterprise-grade hardening applied
- **Performance**: Optimized for Octane worker mode with Redis caching
- **Deployment**: Production-ready Docker setup with multi-stage build
- **Code Quality**: Strict types, clean architecture, SOLID principles
- **Localization**: 100% English code identifiers, 50+ language support

### 🚀 Recent Improvements (2026-08-28 to 2026-09-01)

1. **Security Hardening**
   - Rate limiting on 28 sensitive endpoints
   - CSRF token validation
   - SQL injection prevention verified
   - HMAC-SHA256 token hashing

2. **Performance Optimization**
   - N+1 query elimination via eager loading
   - Query result caching (analytics, dashboard, themes)
   - Lazy loading for large datasets
   - Async job processing for heavy operations

3. **Production Readiness**
   - Octane/FrankenPHP worker mode configured
   - Multi-stage Docker build
   - Health check endpoints
   - OPcache enabled with production settings

4. **Code Quality**
   - 185 files with strict types declaration
   - API Resources for all endpoints
   - Error handling standardization
   - Dependency injection container

5. **Localization**
   - 100% English code identifiers (routes, methods, classes)
   - 50+ language packs
   - Per-user preferences (language, currency, date format)
   - Currency conversion support

---

## 🔒 Security Features

- ✅ **Authentication**: JWT tokens, session management, password reset via secure links
- ✅ **Authorization**: Role-based access control (RBAC) with three tiers
- ✅ **Input Validation**: Strict FormRequest validation on all endpoints
- ✅ **SQL Injection Prevention**: Parameterized queries, safe aggregation functions
- ✅ **CSRF Protection**: Token validation on all state-changing requests
- ✅ **Rate Limiting**: Throttling on auth, API, and sensitive operations
- ✅ **Secure Headers**: HTTPS-only cookies, HttpOnly flag, SameSite policy
- ✅ **Audit Trail**: Complete change tracking with user and timestamp
- ✅ **Dependency Security**: Regular audits, no known vulnerabilities

---

## ⚡ Performance Features

- ✅ **Query Optimization**: Eager loading, select-only columns, chunk processing
- ✅ **Database Indexes**: All foreign keys and filter columns indexed
- ✅ **Caching Strategy**: Redis integration, cache invalidation via observers
- ✅ **Async Processing**: Queue-based job handling (emails, exports, AI)
- ✅ **Octane Worker Mode**: Single-boot app serving multiple requests
- ✅ **OPcache**: Enabled in production with no timestamp validation
- ✅ **Asset Optimization**: Vite code splitting, minified CSS/JS, hashed filenames

---

## 🤝 Contributing

To contribute to this project:

1. **Fork the repository**
2. **Create a feature branch** (`git checkout -b feature/amazing-feature`)
3. **Follow code standards** (see `.pint.json` and `phpstan.neon`)
4. **Write tests** for new features (maintain 80%+ coverage)
5. **Run the full test suite** (`php artisan test`)
6. **Commit with clear messages** (`git commit -m 'Add amazing feature'`)
7. **Push to the branch** (`git push origin feature/amazing-feature`)
8. **Open a Pull Request**

### Code Standards

- Declare strict types: `declare(strict_types=1);` at file top
- Use type hints on all parameters and returns
- Follow PSR-12 coding standard (enforced by Laravel Pint)
- Run `composer lint` before committing
- Maintain or improve test coverage

---

## 📄 License

This project is licensed under the MIT License — see the [LICENSE](LICENSE) file for details.

---

## 👥 Team & Attribution

**Project Lead**: André Moreira  
**Organization**: CESAE Digital  
**Program**: Final Project (Integrated Systems & Database Administration)  
**Year**: 2026

---

## 📞 Support & Contact

For issues, questions, or feature requests:

1. **Check existing documentation** in `/docs`
2. **Search GitHub issues** for similar problems
3. **Review test cases** in `/tests` for usage examples
4. **Open an issue** with clear reproduction steps
5. **Contact**: Project maintainers via GitHub

---

**Last Updated**: September 1, 2026  
**Status**: ✅ Production-Ready
- **Repository Pattern:** Abstração de acesso a dados com Query Objects
- **Action Classes:** Classes dedicadas para casos de uso específicos
- **DTOs:** Data Transfer Objects para validação e transporte de dados
- **Observers:** Event-driven model lifecycle management
- **Caching Strategy:** Cache com invalidação automática via observers
- **Jobs:** Operações assíncronas (exportação, email, IA) processadas em fila

### Frontend Refactoring
- **Blade Components:** Sistema de componentes reutilizáveis
- **Modular CSS:** CSS organizado por responsabilidade (components, pages)
- **ES Modules:** JavaScript modularizado por feature
- **Design System:** Variáveis CSS e tokens para consistência visual
- **No Inline Code:** Eliminação completa de CSS/JS inline nas Blade views (com exceções sancionadas: script anti-FOUC do tema, config i18n `window.SGM_*` e blocos de dados `type="application/json"`)
- **Accessibility:** ARIA labels, roles, focus management, keyboard navigation
- **Responsive Design:** Layouts adaptativos para todos os breakpoints

### Quality Assurance
- **PHPStan/Larastan:** Análise estática nível máximo (Level 5)
- **Laravel Pint:** Formatação de código consistente
- **Test Suite:** Testes unitários, feature e integration
- **Security:** CSRF, XSS, SQL injection protection, RBAC

A plataforma encontra-se na sua versão estável de produção, com arquitetura enterprise-ready, código limpo e manutenível.


---

# Licença

Este projeto encontra-se licenciado sob a **MIT License**.

Consulte o ficheiro **LICENSE** para mais informações.
