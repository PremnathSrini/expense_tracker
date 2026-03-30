# Context

- Project type: Laravel 11 expense tracking web app with separate user and admin areas.
- Runtime stack: PHP `^8.2`, Laravel `^11.31`.
- Backend packages:
- `laravel/socialite` for Google OAuth.
- `barryvdh/laravel-dompdf` for PDF generation.
- `simplesoftwareio/simple-qrcode` for invoice QR code generation.
- Frontend tooling:
- Vite 6 configured (`vite.config.js`).
- Tailwind present in `resources/css/app.css`.
- Material Dashboard static assets heavily used from `public/admin_assets`.
- Frontend libs in active use:
- Chart.js.
- daterangepicker.
- SweetAlert2.
- toastr + jQuery via CDN in Blade layouts.

## Core Modules

- Auth module:
- User login/register/logout (`UserAuthController`).
- Admin login/logout (`admin/AuthController`).
- Role-based middleware gates (`AuthUser`, `AuthAdmin`).
- Google login (`GoogleController`).
- Email verification (`UserEmailVerificationController`, `VerifyEmail` mailable).
- Finance module:
- Transactions CRUD (`TransactionController`) with optional attachment upload.
- Bills CRUD (`BillController`) with due-date logic and recurring fields.
- Categories seeded in `CategorySeeder`.
- Invoices generated via PDF/QR (`InvoiceController`).
- Notifications and async module:
- Queue job `BillDueMailSendJob`.
- Artisan command `app:send-bill-due-mail`.
- Mail + database notifications (`BillDueNotification`, `BillDueDatabaseNotification`).

## Project Structure

- Routes centralized in `routes/web.php`.
- Controllers split by area:
- `app/Http/Controllers/user/*`.
- `app/Http/Controllers/admin/*`.
- Shared/global controllers in `app/Http/Controllers/*`.
- Blade composition pattern:
- `resources/views/user/layouts/default.blade.php` with `sidebar`, `navbar`, `footer`, `settings` includes.
- `resources/views/admin/layouts/default.blade.php` with equivalent includes.
- Primary domain models:
- `User`, `Role`, `Transaction`, `Category`, `Attachment`, `Bill`, `Invoice`.

## Data and Behavior Notes

- Role model is used through `users.role_id`.
- Seed conventions: `role_id=1` admin, `role_id=2` user.
- `transactions.type` is enum: `income|expense`.
- IDs for edit/delete links are often base64-encoded in Blade and decoded in controllers.
- Controller write pattern commonly uses:
- validation (`Validator::make` or `$request->validate`).
- transaction boundaries (`DB::beginTransaction`, commit, rollback).
- flash responses (`to_route(...)->with(...)` or `back()->with(...)`).

## Known Quirks (Documented Constraints)

- Route/login naming has mixed patterns in places.
- `user.logout` is declared as `DELETE`, while some UI links navigate directly.
- Bill destroy route parameter is named `bilId` in route definition.
- Some form radio values use `1/2` where DB enum expects `income/expense`.
- Some Eloquent relationships are non-idiomatic; preserve behavior unless cleanup is explicitly requested.
