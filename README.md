# Centralized Company Search & Reports (Laravel + Blade + Tailwind)

This pack contains **drop-in code** to satisfy the test task:

- Unified search across **Singapore (SG)** and **Mexico (MX)** databases
- Company details page with correct report availability + pricing rules per country
- Session-based cart that supports **mixed-country** reports and dynamic totals

> ✅ Copy these files into a fresh Laravel app, configure two DB connections, and run.

---

## 1) Create a fresh Laravel project

```bash
composer create-project laravel/laravel centralized-search
cd centralized-search
php artisan key:generate
```

## 2) Install Tailwind (optional for local dev)

The views include a CDN fallback, so you can skip this for a quick demo.
If you want full build tooling, follow the Laravel + Tailwind guide.

## 3) Configure TWO database connections

Edit `config/database.php` and add two connections (keep your default `mysql` as-is for sessions if you want).
Add these blocks under `connections`:

```php
'connections' => [
    // ... your default mysql here ...

    'mysql_sg' => [
        'driver' => 'mysql',
        'url' => env('DATABASE_URL'),
        'host' => env('DB_SG_HOST', '127.0.0.1'),
        'port' => env('DB_SG_PORT', '3306'),
        'database' => env('DB_SG_DATABASE', 'companies_house_sg'),
        'username' => env('DB_SG_USERNAME', 'root'),
        'password' => env('DB_SG_PASSWORD', ''),
        'unix_socket' => env('DB_SG_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => null,
        'options' => extension_loaded('pdo_mysql') ? array_filter([
            PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
        ]) : [],
    ],

    'mysql_mx' => [
        'driver' => 'mysql',
        'url' => env('DATABASE_URL'),
        'host' => env('DB_MX_HOST', '127.0.0.1'),
        'port' => env('DB_MX_PORT', '3306'),
        'database' => env('DB_MX_DATABASE', 'companies_house_mx'),
        'username' => env('DB_MX_USERNAME', 'root'),
        'password' => env('DB_MX_PASSWORD', ''),
        'unix_socket' => env('DB_MX_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => null,
        'options' => extension_loaded('pdo_mysql') ? array_filter([
            PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
        ]) : [],
    ],
],
```

Add the following to your `.env`:

```env
# Singapore DB
DB_SG_HOST=127.0.0.1
DB_SG_PORT=3306
DB_SG_DATABASE=companies_house_sg
DB_SG_USERNAME=root
DB_SG_PASSWORD=

# Mexico DB
DB_MX_HOST=127.0.0.1
DB_MX_PORT=3306
DB_MX_DATABASE=companies_house_mx
DB_MX_USERNAME=root
DB_MX_PASSWORD=
```

> The task provides ready SQL dumps. Import them locally:
>
> ```bash
> mysql -u root -p companies_house_mx < job_mx.sql
> mysql -u root -p companies_house_sg < job_sg.sql
> ```

## 4) Copy files from this pack

Copy the folders from this pack into your Laravel project root. Overwrite if prompted.

```
app/
resources/
routes/
```

## 5) Run the app

```bash
php artisan serve
```

Go to: http://127.0.0.1:8000

- Search companies from both SG & MX
- Click a result → Company details with report list
- Add reports to cart, view cart, remove/clear items

## 6) Deployment

Any free PHP hosting that supports Laravel (e.g., Laravel Forge + a VPS, or a free-tier PaaS if available).
For quick demo, you can also run on a small VM or use a service like Render/railway (free tier fluctuates).

---

## Notes & Assumptions

- **SG**: reports table must contain a `price` (**numeric**) column. If your SG dump lacks it,
  add a `price` column or adjust `SgReport::$fillable` and `PricingService` accordingly.
- **MX**: prices come from `report_state.amount` joined by `company.state_id`.
- Searching millions: ensure DB indexes on `companies.name`, `companies.slug`. For bonus,
  you can add MySQL FULLTEXT index and switch to `MATCH … AGAINST` in `CompanySearchService`.

## Project structure (key files)

- `routes/web.php` — routes
- `app/Http/Controllers/SearchController.php`
- `app/Http/Controllers/CompanyController.php`
- `app/Http/Controllers/CartController.php`
- `app/Services/CompanySearchService.php`
- `app/Services/PricingService.php`
- `app/Services/CartService.php`
- `app/Models/Sg/*` and `app/Models/Mx/*`
- `resources/views/*` — Blade + Tailwind UI

---

## How to add a new country later

1. Create a new connection in `config/database.php` (e.g., `mysql_us`).
2. Create models in a new namespace `App\Models\Us\...`.
3. Extend `CompanySearchService` with a new search function and merge results.
4. Extend `PricingService` with a new price resolver for that country.
5. Add a new case in `CompanyController@show` to load basic info and reports.

