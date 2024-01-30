# Code Igniter 4 Starter Template

Starter template for CodeIgniter 4.4.5 on Ubuntu 20.04 LTS

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

- `curl`: for composer
- `intl`: for CI4
- `dom`: for PHPUnit
- `mbstring`: for PHPUnit

```
sudo apt install php8.3-curl
sudo apt install php8.3-intl
sudo apt install php8.3-dom
sudo apt install php8.3-mbstring
```

Check that above modules exist by running `php -m`.

### Installing Composer

Refer to: https://getcomposer.org/download/

### Installing Dependencies

```
cd source
composer install
```

### Environment setting

- Copy & rename either `env.dev`, `env.staging`, or `env.prod` to `.env`.
- Modify as needed
- Confirm the currently active environment with `./spark env`

### Running the starter template

```
cd source
./spark serve
```

## Useful external resources
- 25 minutes of [basic MVC in CodeIgniter 4](https://youtu.be/c8zHxE-mN4c?si=pNoCCJwCjGoRfYQp)
