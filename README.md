<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Project setup (local)

Run migrations and seed test data locally for development:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
```

Seeds include a test member and user:

- Member membership number: `MS-2026-0001`
- Member DOB: `1990-01-01`
- Member email: `testmember@example.test`
- User password for UI login (if needed): `password123`

Member web login uses membership number + date of birth (no password). The dashboard will be linked to an application `User` account on first successful member login.

---

## Deployment & Production Notes

Quick production checklist (Ubuntu + Nginx):

1. Install PHP 8.1+, Composer, MySQL, Node.js.
2. Place project in `/var/www/kasambya_sacco` and set ownership to web server user.
3. Install dependencies and build assets:
   - `composer install --no-dev --optimize-autoloader`
   - `npm ci && npm run build`
4. Configure `.env` for production (`APP_ENV=production`, `APP_DEBUG=false`, correct DB credentials).
5. Run migrations: `php artisan migrate --force` and cache configs: `php artisan config:cache && php artisan route:cache && php artisan view:cache`.
6. Set proper permissions on `storage` and `bootstrap/cache`.

### Nginx example

```nginx
server {
	listen 80;
	server_name example.com; # replace with your domain
	root /var/www/kasambya_sacco/public;

	index index.php;

	location / {
		try_files $uri $uri/ /index.php?$query_string;
	}

	location ~ \.php$ {
		include snippets/fastcgi-php.conf;
		fastcgi_pass unix:/run/php/php8.1-fpm.sock;
	}

	location ~ /\.ht {
		deny all;
	}
}
```

### Database dump

I attempted to create a local SQL dump using the `.env` DB configuration and saved it as `database/kasambya_sacco_dump.sql`.

If you prefer to create a fresh dump yourself, run locally:

```bash
mysqldump -h 127.0.0.1 -P 3306 -u <user> <database> > database/kasambya_sacco_dump.sql
```

---

If you want, I can try to push these changes to `https://github.com/JimmyBiverson/kasambya_sacco.git` — please ensure your local Git credentials are configured, or I can provide the exact git commands for you to run.

