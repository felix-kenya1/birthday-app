<<<<<<< HEAD
# Birthday Surprise — Integrated Laravel Application

This is the consolidated Laravel 12 project for the birthday website and its private administration dashboard. It combines the public celebration experience, database-backed content management, administrator authentication, inquiries, and baseline security/SEO features in one Laravel application.

## Requirements

- Windows 10/11
- XAMPP with Apache and MySQL/MariaDB
- PHP 8.2 or newer (use the PHP executable bundled with XAMPP)
- Composer 2
- MySQL database access
- PHP extensions enabled in XAMPP: `curl`, `ctype`, `dom`, `fileinfo`, `filter`, `hash`, `mbstring`, `openssl`, `pcre`, `PDO`, `pdo_mysql`, `session`, `tokenizer`, and `xml`

The public pages use the supplied static CSS and JavaScript under `public/assets`; Node/Vite is not required to run the current public experience.

## Windows + XAMPP installation

1. Extract this project to `C:\xampp\htdocs\birthday-app` (or another folder outside `htdocs`).
2. Open XAMPP Control Panel and start **Apache** and **MySQL**.
3. Open `http://localhost/phpmyadmin`, create a database named `birthday_surprise_db`, and choose `utf8mb4_unicode_ci` if prompted.
4. Open PowerShell in the project folder:

   ```powershell
   cd C:\xampp\htdocs\birthday-app
   ```

5. If PowerShell cannot find `php`, add `C:\xampp\php` to Windows PATH, close and reopen the terminal, then check `php -v`.
6. Create your local environment file and install PHP dependencies:

   ```powershell
   Copy-Item .env.example .env
   composer install
   php artisan key:generate
   ```

   If `.env` already exists, keep your own file and update its database values rather than overwriting it.

7. Configure `.env` for your local MySQL account:

   ```dotenv
   APP_NAME="Birthday Surprise"
   APP_ENV=local
   APP_DEBUG=true
   APP_URL=http://127.0.0.1:8000

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=birthday_surprise_db
   DB_USERNAME=root
   DB_PASSWORD=

   SESSION_DRIVER=file
   CACHE_STORE=file
   QUEUE_CONNECTION=sync
   FILESYSTEM_DISK=public
   ```

   The blank password is only correct for a local XAMPP MySQL account with no password. Use your actual credentials if you have configured one.

8. Run the migrations and create the public upload link:

   ```powershell
   php artisan optimize:clear
   php artisan migrate
   php artisan storage:link
   ```

9. Create the first administrator. The command prompts for a password and requires at least 12 characters:

   ```powershell
   php artisan birthday:make-admin "Site Administrator" admin@example.com
   ```

10. Start Laravel:

    ```powershell
    php artisan serve
    ```

11. Open:
    - Public birthday page: `http://127.0.0.1:8000/birthday`
    - Admin login: `http://127.0.0.1:8000/admin/login`
    - Admin dashboard: `http://127.0.0.1:8000/admin/dashboard`
    - Sitemap: `http://127.0.0.1:8000/sitemap.xml`

## Admin features

- Love letters, reasons, memories, timeline entries, wishes, surprises, future dreams, and music settings.
- Image/video and audio uploads to Laravel's public storage disk.
- Site settings for title, recipient, sender, birthday date, intro text, contact email, notification email, and share message.
- Inquiry inbox with status and internal notes.
- Administrator/editor roles. Administrators can manage accounts and global settings; editors can manage birthday content and inquiries.

## Content setup

After logging into `/admin/dashboard`, use the content cards to add the birthday material. Add at least one published love letter, reasons, memories, timeline entries, wishes and future dreams. Add music only if you have permission to use the audio file. Music autoplay is disabled by design.

## Useful maintenance commands

```powershell
php artisan optimize:clear
php artisan view:clear
php artisan route:list
php artisan test
```

Do not use `php artisan migrate:fresh` on a database containing data you want to keep; it drops all tables.

## Troubleshooting

- **`could not find driver`**: enable `pdo_mysql` in `C:\xampp\php\php.ini`, restart the terminal, and restart Apache if needed.
- **`Class DOMDocument not found`**: enable the `dom`/XML extension in `php.ini`, restart terminal/Apache, and verify with `php -m`.
- **`SQLSTATE[HY000] [2002]`**: start MySQL and verify `DB_HOST`, `DB_PORT`, and that the MySQL port is not occupied by another service.
- **`No application encryption key`**: run `php artisan key:generate`.
- **Missing tables**: run `php artisan migrate` after confirming `.env` points to the intended database.
- **Uploaded media returns 404**: run `php artisan storage:link` and check that `storage/app/public` is writable.
- **Blank/error page**: inspect `storage/logs/laravel.log`; while developing locally, `APP_DEBUG=true` can show the detailed exception. Set `APP_DEBUG=false` in production.

## Security and deployment notes

- Never publish or share `.env`; it is intentionally excluded from this archive.
- Use HTTPS, `APP_DEBUG=false`, a strong database password, and a non-default administrator password in production.
- Configure SMTP credentials before expecting inquiry email notifications to be delivered.
- Back up the database and `storage/app/public` before upgrades.
- Review `public/robots.txt` and `APP_URL` for the actual production domain before deployment.

## Verification scope

The source archive has been statically checked: PHP source files pass PHP lint, Blade templates compile to PHP that passes PHP lint, and Laravel route registration succeeds in the build environment. The build environment does not have the MySQL PDO driver or DOM/mbstring XML extensions enabled, so database migrations and the PHPUnit suite could not be executed here. Run the commands above on the target XAMPP installation and resolve any local environment errors before production use.
=======
# birthday-app
>>>>>>> 894b3d93c6816cd5cfecad6c01387ba9772ee842
