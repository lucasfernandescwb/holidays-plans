# Laravel Holidays Plans API

This is an API project with Laravel, made for a test I was asked to do. Follow the steps below to configure and run the application locally.

## Clone application

Clone the application repository:

```bash
git clone https://gitlab.com/lucasfernandescwb/full-stack-test.git
```

## Entrar na Pasta Full Stack Test e Trocar para a Branch Develop

```bash
cd full-stack-test
git checkout develop
```

## Backend configuration

1. Copie o arquivo `.env.example` e renomeie para `.env`. Configure os campos `DB_USERNAME` como `xrosoff` e `DB_PASSWORD` como `pocky123`.

2. Instale as dependências com o Composer:

```bash
composer install
```

3. Execute os comandos Docker:

```bash
docker-compose up -d
docker-compose exec app bash
```

4. Gere a chave da aplicação (caso necessário):

```bash
php artisan key:generate
```

5. Rode as migrations:

```bash
php artisan migrate:fresh
```

6. Ative o link simbólico:

```bash
php artisan storage:link
```

## Autor

Lucas Fernandes Lima
