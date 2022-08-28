# Psychic Funicular

This is just a CRUD example.

## Running local

This project uses [Laravel Sail](https://laravel.com/docs/9.x/sail) which is a good and easy tool to deploy Laravel applications for development purposes.

I create an [alpine/Dockerfile](docker/alpine/Dockerfile). The default docker image is an Ubuntu. But, I like the [Alpine](image) a little more when we talk about docker image containers.

### To consider

We'll need to clone the [repository](https://github.com/natanaugusto/psychic-funicular) and after that, We'll run docker-compose and the other commands to run this project locally.

(Certify if you have [docker](https://docs.docker.com/engine/install) and [docker-compose](https://docs.docker.com/compose/install/) correctly installed)

### Let's start
The fellow commands will clone, start and deploy a development instance for this project.

```shell
$ git clone https://github.com/natanaugusto/psychic-funicular
$ cd psychic-funicular

$ cp .env.example .env
$ sed -i 's/DB_HOST=127.0.0.1/DB_HOST=mariadb/g' .env
$ sed -i 's/DB_USERNAME=root/DB_USERNAME=sail/g' .env
$ sed -i 's/DB_PASSWORD=/DB_PASSWORD=password/g' .env

$ docker-compose up -d
# If you get an error here, just try again one more time to be sure
$ sudo chown $USER:$USER -R vendor
$ docker-compose exec -u sail laravel.test composer install --verbose
$ docker-compose down

$ sail build
$ sail up -d
$ sail artisan key:generate
$ sail artisan migrate
$ sail npm install --verbose
$ sail npm run build
```
### Creating dummy data
We'll use [Laravel Tinker](https://laravel.com/docs/9.x/artisan#tinker) to create fake data. This will create 200 companies on database.

```shell
$ sail tinker

Psy Shell v0.11.8 (PHP 8.1.9 — cli) by Justin Hileman
>>> Company::factory(200)->create()
```
### If all goes right

Our local instance is up and filled with dummy data.

- [Register a user](http://localhost/register)
- [Login](http://localhost/register)
