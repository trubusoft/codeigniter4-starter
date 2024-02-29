# CodeIgniter 4 Starter Template

![Status Badge](https://github.com/trubusoft/codeigniter4-starter/actions/workflows/php.yml/badge.svg?branch-main)
![Coverage Badge](https://github.com/trubusoft/codeigniter4-starter/blob/coverage-data/coverage.svg)

Starter template for CodeIgniter 4.4.5+ with:
- Docker configuration for both development & production.
- Test & Coverage workflow template with GitHub runner

Tested for development & production on Ubuntu 20.04 LTS.

## Folder Structure

- `configurations`: various development/deployment configurations (e.g. docker/kubernetes config for dev, staging, and production)
- `documents`: all files that not directly related to the code and will not be included inside source image (e.g. requirements, notes, diagram)
- `source`: root folder for the CI4 project

## Installation


### Installing PHP

```
sudo apt install software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt update
sudo apt install php8.3
php -v
```

### Installing Required PHP Module for CI4

- `mysql`: for connecting with MySQL
- `curl`: for composer
- `intl`: for CI4
- `dom`: for PHPUnit
- `mbstring`: for PHPUnit
- `xdebug`: code coverage driver for PHPUnit

```
sudo apt install php8.3-mysql
sudo apt install php8.3-curl
sudo apt install php8.3-intl
sudo apt install php8.3-dom
sudo apt install php8.3-mbstring
sudo apt install php8.3-xdebug
```

Check that above modules exist by running `php -m`.

#### Optional PHP Modules

Should only be installed if required, or any error occurred that mentions them.

- `sqlite3`: for CI4 default testing with sqlite3 database

```
sudo apt install php8.3-sqlite3
```


### Installing Composer

Refer to: https://getcomposer.org/download/

### Installing Dependencies

```
cd source
composer install
```

### Running the starter template

Try running the bare minimum settings now with:

```
cd source
php spark serve
```

A page should now be served at `http://localhost:8080/`.

If you can see the page, then CodeIgniter 4  related modules & packages have been installed successfully.

## Development Configuration

### Environment setting

- Copy & rename `env.dev` to `.env`.
- Modify as needed
- Confirm the currently active environment with `./spark env`. It should now show `development` instead of `production`.

### Spin up MySQL Database

The provided [docker-compose.yml](docker-compose.yml) will spin up 2 database (main and test).

```
docker compose up -d
```

### Run the development session

You can start the development session with the built-in `spark`:
```
cd source
php spark serve
```

The [bitnami/codeigniter](https://hub.docker.com/r/bitnami/codeigniter) image can also be used instead 
as an alternative to the `spark`. 
For this, please refer to [development_with_bitnami_image.md](configurations/development/bitnami/development_with_bitnami_image.md).

### Testing

Run the tests with: 

```
cd source
composer test
```

or generate coverage report with:

```
cd source
composer coverage
```

Coverage report will be created at `/source/build/logs`.

### Debugging
- Use the provided [Debug Toolbar](https://codeigniter4.github.io/userguide/tutorial/index.html#debug-toolbar)
- Error logs will be printed on `writable/logs`

## Production Configuration

This repo offers a working configuration for serving the source code on a production environment
with PHP-FPM and NGINX. 
More about this can be found at [production.md](configurations/production/production.md).

## Useful external resources
- 25 minutes of [basic MVC in CodeIgniter 4](https://youtu.be/c8zHxE-mN4c?si=pNoCCJwCjGoRfYQp)
