## Lumen Order Tracking

This is a sample project to simulate order tracking in general online store. This scenario we would like to focus on basic transaction that happens in general online store in Indonesia.

## Installation

Make sure to read [official lumen](https://lumen.laravel.com/docs/5.2/installation) installation page. In this project, `postgresql` is the main database. Make sure you have access to the database.

Here is some references for Postgresql :

- https://www.digitalocean.com/community/tutorials/how-to-install-and-use-postgresql-on-ubuntu-16-04
- https://www.linode.com/docs/databases/postgresql/use-postgresql-relational-databases-on-ubuntu-16-04
- https://www.digitalocean.com/community/tutorials/how-to-use-roles-and-manage-grant-permissions-in-postgresql-on-a-vps--2

### 1. Code

```
cd /var/www
git clone git@github.com:clasense4/lumen-order-tracking.git
cd lumen-order-tracking
composer install
cp .env.example .env
```
### 2. Environment

Change `.env` as necessary, here is some variable that need to take look closer

1. `DB_HOST`, usually `localhost` or `127.0.0.1` or another IP.
2. `DB_PORT`, usually `5432`.
3. `DB_DATABASE`, make sure it is correct.
4. `DB_USERNAME`, make sure it is correct user.
5. `DB_PASSWORD`, make sure it is correct password.

### 3. Migration and Seed

```
cd /var/www/lumen-order-tracking
php artisan migrate:refresh --seed
```

### 4. Start local php server
```
cd /var/www/lumen-order-tracking
php -t public/ -S 0.0.0.0:8080
# do not close for now
```

### 5. Test
```
# open new tab
cd /var/www/lumen-order-tracking
vendor/bin/phpunit
```

## Insomnia file

I have included [Insomnia Rest](https://insomnia.rest) file to get start with this projects. Import `salestock.rest`. [Read more](https://insomnia.rest/documentation/).

## Troubleshooting

### Error in `composer install`

Well, it must be cache problem, try to install it with `composer install -vvv --profile --prefer-source`.