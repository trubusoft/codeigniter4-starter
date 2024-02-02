
# Production Configuration

This file provides a working example of serving the source code of this repo
on a  production grade environment.

Use case:
- The source code will be served with PHP-FPM
- NGINX will be used to do reverse proxy to the PHP-FPM (other tool can also be used, as long as it's compatible with FastCGI Protocol). 

For the sake of simplicity, the architecture is detailed at [example.yml](example.yml).
It can then be converted to a vps-style serving, docker swarm, or kubernetes, as needed.

## Preparing the CodeIgniter 4 Image

### Building the image

[Dockerfile](../../source/Dockerfile) is supplied inside `/source`, so image can be built like so:

```
cd source
docker build -t my-application:1
```

The source code will be copied inside the official [PHP-FPM Image](https://hub.docker.com/_/php).

### Passing environment variables

Currently, there are 13 environment variables that can be adjusted:

| Variable name       | Description                                              |
|---------------------|----------------------------------------------------------| 
| CI_ENVIRONMENT      | Environment for the site (`development` or `production`) |
| DB_DEFAULT_HOSTNAME | Host name for the default database                       |
| DB_DEFAULT_DATABASE | Name for the default database                            |
| DB_DEFAULT_USERNAME | Username for the default database                        |
| DB_DEFAULT_PASSWORD | Password for the default database                        |
| DB_DEFAULT_DBDRIVER | DB Driver for the default database (`SQLite3`, `MySQLi`) |
| DB_DEFAULT_PORT     | Port for the default database                            |
| DB_TESTS_HOSTNAME   | Host name for the test database                          |
| DB_TESTS_DATABASE   | Name for the test database                               |
| DB_TESTS_USERNAME   | Username for the test database                           |
| DB_TESTS_PASSWORD   | Password for the test database                           |
| DB_TESTS_DBDRIVER   | DB Driver for the test database (`SQLite3`, `MySQLi`)    |
| DB_TESTS_PORT       | Port for the default database                            |

The `/source/.env` file will be ignored when creating the image.
Please use the appropriate way from the stack you've picked to pass an environment variables.

For example, in docker compose you would do it like this:

```
services:
  fpm:
    environment:
      - CI_ENVIRONMENT=production
      - DB_DEFAULT_HOSTNAME=db-main
      - DB_DEFAULT_DATABASE=main
      - DB_DEFAULT_USERNAME=root
      - DB_DEFAULT_PASSWORD=root
      - DB_DEFAULT_DBDRIVER=MySQLi
      - DB_DEFAULT_PORT=3306
      - DB_TESTS_HOSTNAME=db-test
      - DB_TESTS_DATABASE=test
      - DB_TESTS_USERNAME=root
      - DB_TESTS_PASSWORD=root
      - DB_TESTS_DBDRIVER=MySQLi
      - DB_TESTS_PORT=3306
```

In Kubernetes, insert them inside the specification and mix its usage with `ConfigMap` or `Secret` as necessary.

## Preparing the NGINX

The [nginx.conf](nginx/nginx.conf) is provided as a baseline for serving CodeIgniter and PHP in general.
You may want to modify it as you need:

- Change `server_name` from `example.com` to the domain you intended to use.
- Confirm that `root` points to the `/source/public` folder, where CodeIgniter should start form.
  If NGINX and PHP-FPM are not being installed on the same device, 
  you may want to make sure NGINX can access the source code inside the PHP-FPM.
- Confirm that `fastcgi_pass` points to the PHP-FPM's address.

## Additional Notes

### PHP-FPM related notes

We can make the image work without any configuration change. 
But if needed, the PHP-FPM main configuration file is located at `/usr/local/etc/php-fpm.conf`.
In that file, it will include all other files located at `/usr/local/etc/php-fpm.d/`.

The most related configuration file is probably the `www.conf`, 
in which it already set these by default, and you may want to change this according to the needs.

```
user = www-data
group = www-data
listen = 127.0.0.1:9000

;listen.owner = www-data
;listen.group = www-data
;listen.mode = 0660

;security.limit_extensions = .php .php3 .php4 .php5 .php7

;env[HOSTNAME] = $HOSTNAME
;env[PATH] = /usr/local/bin:/usr/bin:/bin
;env[TMP] = /tmp
;env[TMPDIR] = /tmp
;env[TEMP] = /tmp
```

In any case that the default configuration path is invalid, 
you may need to get it by:

```
docker exec -ti fpm php-fpm -tt
```

### Useful reference

- https://github.com/atsanna/codeigniter4-docker
- https://github.com/LERUfic/codeigniter-docker
- https://github.com/firmanJS/Dockerize-Codeigniter-With-docker-compose
