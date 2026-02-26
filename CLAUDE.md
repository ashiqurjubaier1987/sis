# Student Information System (SIS) — Project Guide

## Project Overview
A Student Information/Management System built with Laravel. It manages students, teachers, parents, batches, attendance, exams, fees, and more. Designed for schools and coaching centers.

## Tech Stack
- **Backend:** Laravel (PHP)
- **Frontend:** Laravel Blade + HTML + JavaScript + CSS
- **UI Template:**
  - `resources/views/layouts/app.blade.php` → Adminty Template (https://colorlib.com/polygon/adminty/default/pages/index.html)
  - `resources/views/layouts/auth.blade.php` → Custom auth template
- **Database:** MySQL
- **Authentication:** Laravel Sanctum
- **Authorization/Roles:** Spatie Laravel Permission
- **Asset Bundling:** Vite

## Roles & Permissions
Roles are managed via Spatie Laravel Permission. Current roles:
- `superadmin` — Full system access
- `admin` — School/institute level management
- `teacher` — Class management, attendance, results
- `teacher_assistant` — Limited teacher access
- `teacher_accountant` — Fee and financial access
- `student` — View own profile, results, attendance
- `parent` — View child's info, fees, attendance

> Roles may expand as the project grows. Always assign permissions via Spatie roles, never hardcode access checks beyond `role` or `permission` middleware.

## Project Structure
```
app/
├── Http/
│   ├── Controllers/       # Route controllers per module
│   └── Middleware/        # Auth and role middleware
├── Models/                # Eloquent models
├── Policies/              # Authorization policies (if used)
resources/
├── views/
│   ├── layouts/
│   │   ├── app.blade.php      # Main layout (Adminty template)
│   │   └── auth.blade.php     # Auth layout (custom template)
│   ├── auth/                  # Login, register, password views
│   └── [module]/              # One folder per module
routes/
├── web.php                # Web routes
├── api.php                # API routes (Sanctum protected)
database/
├── migrations/            # All DB migrations
├── seeders/               # Role/permission seeders, dummy data
DB_BACKUP/                 # Manual DB backups
```

## Modules
Modules will grow over time. Current planned modules:

1. **Student Registration** — Student profile creation and management
2. **Attendance** — Mark and track student/teacher attendance
3. **Exam & Results / Report Card** — Manage exams, enter marks, generate report cards
4. **Fee Management** — Fee collection, invoices, payment tracking
5. **Teacher Management** — Teacher profiles, assignments
6. **Site Settings** — Global application settings
7. **Company/Coaching Details** — Institute profile, logo, contact info
8. **Student Enrollment** — Enroll students into batches; batches can have multiple sections
9. **Parents Management** — Parent profiles linked to students
10. **SMS Module** — Send SMS notifications to Students, Parents, and Teachers
11. **Class/Section Timetable Routine** — Manage timeslots and class schedules per section

## Database Conventions
- Use migrations for all schema changes — never edit DB directly
- Foreign keys should follow Laravel convention: `{table_singular}_id`
- Soft deletes (`SoftDeletes`) should be used on major models (students, teachers, etc.)
- Use seeders for roles, permissions, and initial settings

## Naming Conventions
- Controllers: `PascalCase` + `Controller` suffix (e.g., `StudentController`)
- Models: singular `PascalCase` (e.g., `Student`, `BatchSection`)
- Blade views: `snake_case` inside module folders (e.g., `resources/views/student/index.blade.php`)
- Routes: use `kebab-case` for URIs, named routes in `dot.notation` (e.g., `student.index`)
- Database tables: `snake_case` plural (e.g., `batch_sections`, `fee_payments`)

## Key Commands
```bash
# Install dependencies
composer install
npm install

# Run dev server
npm run dev

# Run migrations
php artisan migrate

# Seed roles and permissions
php artisan db:seed --class=RolePermissionSeeder

# Clear caches
php artisan optimize:clear

# Run application
php artisan serve
```

## Environment Setup
1. Copy `.env.example` to `.env`
2. Set `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` for MySQL
3. Set `APP_URL` correctly for Sanctum to work
4. Run `php artisan key:generate`
5. Run `php artisan migrate --seed`

## Important Notes
- **Do not** modify `app.blade.php` layout structure without checking Adminty template dependencies (JS/CSS paths)
- **Do not** use inline styles — use Adminty's existing CSS classes wherever possible
- All protected routes must go through Sanctum auth middleware
- Role/permission checks should use Spatie's `@can`, `@role` directives in Blade or `$this->authorize()` in controllers
- SMS module will use a third-party SMS gateway (TBD) — keep it behind a service class for easy provider swapping
- Batch can have multiple sections; enrollment ties a student to a specific batch + section
- Modules will expand — keep code modular and avoid tight coupling between modules
