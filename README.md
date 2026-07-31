# HireHub Laravel MVP

A working Laravel MVP for a manpower and tools hire marketplace.

## Included

- Public manpower and tool catalogue
- Listing detail page
- Customer booking request
- Admin login/logout
- Admin dashboard
- Category CRUD
- Provider CRUD
- Listing CRUD
- Booking assignment and status updates
- Booking status audit history
- MySQL migrations and demo seed data
- Bootstrap CDN UI, so no Node/Vite build is required

## Requirements

- PHP 8.2+
- Composer
- MySQL 8+
- Laravel 12 or 13

## Installation

Create a fresh Laravel project:

```bash
composer create-project laravel/laravel hirehub
cd hirehub
```

Copy every file from this example over the new Laravel project. Keep the Laravel-generated
`vendor/`, `.env`, `storage/`, and `bootstrap/cache/` folders.

Configure `.env`:

```env
APP_NAME=HireHub
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hirehub
DB_USERNAME=root
DB_PASSWORD=
```

Create the database:

```sql
CREATE DATABASE hirehub CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Run:

```bash
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

Open:

- Public website: `http://127.0.0.1:8000`
- Admin login: `http://127.0.0.1:8000/admin/login`

Default admin:

```text
Email: admin@hirehub.test
Password: password
```

Change the password after confirming the demo works.

## Main Routes

```text
GET  /
GET  /manpower
GET  /tools
GET  /listings/{listing:slug}
POST /bookings

GET  /admin/login
POST /admin/login
POST /admin/logout

GET|POST|PUT|DELETE /admin/categories
GET|POST|PUT|DELETE /admin/providers
GET|POST|PUT|DELETE /admin/listings
GET  /admin/bookings
GET  /admin/bookings/{booking}
PUT  /admin/bookings/{booking}
```

## Notes

This is an MVP. Before production use, add:

- Email/phone verification
- Rate limiting for login and booking submissions
- Image uploads with MIME validation
- Online payments
- Provider availability calendar
- Notifications
- Automated tests
- Backups and audit logging
