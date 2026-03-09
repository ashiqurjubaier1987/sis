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

## Docker Setup
- Runs via Laradock: containers `laradock82-workspace-1`, `laradock82-php-fpm-1`, `laradock82-apache2-1`, `laradock82-mysql-1`
- Artisan commands must run inside the workspace container:
  ```bash
  docker exec laradock82-workspace-1 bash -c "cd /var/www/sis && php artisan migrate"
  ```

## UI/Form Patterns
- **Create/Edit forms**: Use standard POST with server-side redirect — NOT AJAX/JSON responses
  - "Save" button → redirect to module index with flash success message
  - "Save & Add Another" button → redirect back to create page with flash success message
  - Use `save_action` hidden input to differentiate between the two
- **Index/listing pages**: Use AJAX for data loading, filtering, sorting, pagination (returns JSON)
- **Searchable dropdowns**: Use Select2 (`public/adminend/bower_components/select2/`), supports `multiple` for multi-select
- **Status toggles**: Use Switchery (`public/adminend/bower_components/switchery/`) with hidden input syncing
- **Flash messages**: Use `<div id="sis-flash-success" data-message="{{ session('success') }}">` + `SIS.showFlash()` (SweetAlert)
- **Confirm dialogs**: Use `SIS.confirm(options, onConfirm)` for delete/toggle actions (SweetAlert)
- **Notifications**: Use `notify(msg, "top", "right", "", type, "animated fadeInRight", "animated fadeOutRight")`
- **Form actions**: Use `.form-actions-bar` class (flexbox with wrap, responsive)
- **Module CSS**: Each module gets its own CSS file at `public/adminend/css/{module}.css`

## Global Reusable Assets
- **`public/adminend/js/sis-helpers.js`** — Global JS helpers loaded on all pages:
  - `SIS.formGuard('#formId')` — multi-submit protection
  - `SIS.showFlash()` — SweetAlert success flash from `#sis-flash-success` element
  - `SIS.confirm(options, onConfirm, onCancel)` — SweetAlert confirm dialog
- **`public/adminend/css/sis-helper.css`** — Global shared CSS for all modules (badges, actions, filters, toolbar, form-actions-bar, etc.)

## Module Status

### Subject Module (Complete)
- **Tables**: `subjects` (`id`, `name`, `code`, `description`, `is_active`, timestamps, soft deletes), `teacher_subjects` (pivot: `teacher_id` → `users`, `subject_id` → `subjects`, unique constraint)
- **Model**: `Subject` — fillable: `name`, `code`, `description`, `is_active`; relationship: `teachers()` belongsToMany User via `teacher_subjects` pivot
- **Controllers**: `WEB/SubjectController` (web views + redirects), `API/V1/SubjectController` (API)
- **Views**: `admin/subject/` — `index.blade.php` (AJAX listing), `create.blade.php`, `edit.blade.php`, `export_pdf.blade.php`
- **Create/Edit form fields**: Name (required), Code (optional/unique), Teacher(s) (required/Select2 multiple), Status (Switchery toggle, default active), Description (optional)
- **Index features**: Card + list views, search/filter/sort/paginate, export (Excel/CSV/PDF), show modal, toggle status, delete — all via SweetAlert confirms
- **Routes**: `subjects/` prefix — index, data, create, store, show, edit, update, toggle (`PATCH /{id}/toggle`), destroy, export
- **Permissions**: `subject.create`, `subject.view`, `subject.edit`, `subject.toggle`, `subject.delete`

## Important Notes
- **Do not** modify `app.blade.php` layout structure without checking Adminty template dependencies (JS/CSS paths)
- **Do not** use inline styles — use Adminty's existing CSS classes wherever possible
- All protected routes must go through Sanctum auth middleware
- Role/permission checks should use Spatie's `@can`, `@role` directives in Blade or `$this->authorize()` in controllers
- SMS module will use a third-party SMS gateway (TBD) — keep it behind a service class for easy provider swapping
- Batch can have multiple sections; enrollment ties a student to a specific batch + section
- Modules will expand — keep code modular and avoid tight coupling between modules
