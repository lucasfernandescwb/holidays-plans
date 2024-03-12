# Laravel Holidays Plans API

This is an API project with Laravel, made for a test I was asked to do. Follow the steps below to configure and run the application locally.

## Clone application

Clone the application repository:

```bash
git clone https://github.com/lucasfernandescwb/holidays-plans
```

## Enter in "holidays-plans" directory and change its branch to develop

```bash
cd holidays-plans
git checkout develop
```

## Backend configuration

1. Copy `.env.example` file and rename it to `.env`. Configure the following fields: `DB_USERNAME` = `xrosoff` and `DB_PASSWORD` = `pocky123`.

2. Install Composer dependencies:

```bash
composer install
```

3. Execute Docker commands:

```bash
docker-compose up -d
docker-compose exec app bash
```

4. Generate application key (if there's none):

```bash
php artisan key:generate
```

5. Run migrations:

```bash
php artisan migrate:fresh
```

6. Enable symoblic link:

```bash
php artisan storage:link
```

7. Run tests (optional):

```bash
php artisan test
```

## Author

Lucas Fernandes Lima
