# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a **Laravel 12 OAuth2 resource server** for academic institution management. It exposes a RESTful API protected by Laravel Passport (OAuth2) and includes a Filament 5 admin dashboard built with React + Inertia.js.

## Commands

### Development

```bash
composer dev          # Start all services concurrently (server + queue + Vite)
composer dev:ssr      # Same with Inertia SSR mode
```

Or individually:

```bash
php artisan serve     # Laravel dev server
npm run dev           # Vite asset compiler (React)
php artisan queue:work # Queue worker
```

### Setup (first time)

```bash
docker-compose up -d
composer install && npm install
cp .env.example .env   # Configure DB to match docker-compose.yml
php artisan key:generate
php artisan migrate
php artisan db:seed
```

### Testing

```bash
php artisan test                        # Run all tests (Pest)
php artisan test --filter TestName      # Run a single test
php artisan test tests/Feature/SomeTest.php  # Run a specific file
```

### Code Quality

```bash
php artisan pint          # PHP style fixer
npm run lint              # ESLint with auto-fix
npm run types             # TypeScript type checking
npm run format            # Prettier formatting
```

### Build

```bash
npm run build             # Production assets
npm run build:ssr         # Production assets with SSR
```

## Architecture

### Request Flow (API)

```
OAuth2 Client → nginx → Laravel bootstrap/app.php
  → routes/api.php (v1 group, `clients` middleware)
  → auth:api middleware (Passport token validation)
  → CheckPermission middleware (RBAC)
  → Controller extends BaseResourceController
  → PermissionService (resolves allowed columns)
  → Eloquent Model + Resource transformer
  → Paginated JSON response
```

### Key Abstractions

**`BaseResourceController`** (`app/Http/Controllers/Api/BaseResourceController.php`):
All API controllers extend this. Subclasses set `$model` and `$resource` properties; the base handles permission checks, search, and pagination uniformly. Do not duplicate this logic in individual controllers.

**`PermissionService`** (`app/Services/PermissionService.php`):
Central permission resolver. Given a client/user and an action+model, it returns which columns are accessible. Used by controllers to filter response fields.

**`Resource` classes** (`app/Http/Resources/`):
Transform Eloquent models to JSON. They receive `$allowedColumns` from PermissionService and omit restricted fields.

### Authorization Model

```
Client / User
  └─ Roles  →  Permissions
                ├─ action:  view | create | update | delete
                ├─ model:   App\Models\Resources\Personnel, etc.
                └─ columns: ['id', 'name', ...]  (column-level control)
```

OAuth2 scopes (`admin.read`, `user.read`, `general.read`, `machine`, `student`) provide coarse-grained access; RBAC permissions provide row- and column-level control. See `Authorization.md` for full flows.

### Admin Dashboard (Filament)

Filament resources live in `app/Filament/Resources/` with corresponding `Imports/` and `Exports/` subdirectories. The admin panel respects the same RBAC permissions as the API.

### Data Transformer

`app/Transformers/DataTransformer.php` handles multi-source data integration — it maps fields from external data sources to internal models using configurable `TransformerMapping` records. See `DataTransformer.md` for details.

### Frontend (Inertia + React)

React pages are in `resources/js/pages/`. Inertia bridges server-side Laravel controllers to client-side React components without a separate API layer for the admin UI. TypeScript types are in `resources/js/types/`.

## Infrastructure

- **Database**: PostgreSQL 16 (container: `postgres`)
- **Cache / Queue**: Redis (container: `redis`)
- **WebSockets**: Laravel Reverb + Laravel Echo
- **API Docs**: Scramble auto-generates OpenAPI docs at `/docs`
- **Audit Trail**: OwenIt Laravel Auditing (config: `config/audit.php`)
- **LDAP**: Optional directory auth (config: `config/ldap.php`)

## Conventions

- API routes are versioned under `/api/v1/` and registered in `routes/api.php`.
- All new domain models go in `app/Models/Resources/`.
- New API controllers must extend `BaseResourceController` and set `$model` / `$resource`.
- Permissions follow the pattern `action|App\Models\Resources\ModelName`.
- Filament resources for admin CRUD go in `app/Filament/Resources/`.
