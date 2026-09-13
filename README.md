# East Africa Store

Laravel 13 ecommerce starter for East Africa.

## Local setup
1. Install PHP 8.3+, Composer, Node.js, and PostgreSQL/MySQL.
2. Copy `.env.example` to `.env`.
3. Run `composer install`.
4. Run `php artisan key:generate`.
5. Configure the database in `.env`.
6. Run `php artisan migrate --seed`.
7. Run `npm install && npm run build`.
8. Run `php artisan serve`.

Admin credentials are configured through ADMIN_* environment variables.

## Render
Use Docker. Set production secrets in Render Environment Variables, never in GitHub.
