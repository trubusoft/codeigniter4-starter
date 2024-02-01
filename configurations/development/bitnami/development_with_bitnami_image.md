# Development with the `bitnami/codeigniter` image

Bitnami offers [CodeIgniter development image](https://hub.docker.com/r/bitnami/codeigniter) which you can use as an alternative for the built-in `spark`.

There are some compromises: as per this time of writing, there are some points of discrepancy in the documentations.
We found little to no online answer to issue that we've faced. Plus, the image is close-sourced.

This file attempt to document the configuration that has been working for us.

## Configuration without database

The [bitnami-no-db.yml](bitnami-no-db.yml) is the bare minimum configuration that you can run.
The composed container will not have access to database.
This is useful to try/test codeigniter with the starter template we've provided.

Place this configuration file on the source root of this project, and run:

```
docker compose -f bitnami-no-db.yml up -d
```

The `compose` will mount `/source` at the working directory of the container.
Now, try to open the development session at `localhost:8000`.


For debugging, you should also be able to find this line inside the docker logs:

```
codeigniter4  | codeigniter 03:41:23.82 INFO  ==> An existing project was detected, skipping project creation
```

This confirms that the `/source` has been mounted correctly, 
and that `bitnami/codeigniter` use the provided source code
instead of bootstrapping another new one.

The site should now be served at `localhost:8000`.

## Configuration with MySQL database

First, change the content of [docker-compose.yml](../../../docker-compose.yml) on the root of the project with [bitnami-with-db.yml](bitnami-with-db.yml).

Update your `.env` file to adjust the hostname and port for both main and the test database:

```
database.default.hostname = db-main
database.default.port = 3306

database.tests.hostname = db-test
database.tests.port = 3306
```

Spin up the compose file:

```
docker compose up -d
```

Confirms that your `codeigniter4` container can connect with the MySQL container
by running the test command:

```
docker exec -w /app/starter-ci4/ codeigniter4 composer run-script test
```

The test should be succeeded without any error.

The site should now be served at `localhost:8000`.


## Others

Command can be executed inside the `codeigniter4` container with `docker exec` 
with `/app/<PROJECT_NAME>` as the working directory.
The `PROJECT_NAME` may vary according to what are supplied as `CODEIGNITER_PROJECT_NAME` inside the compose file.

For example, to get the list of all installed PHP Modules:

```
docker exec -w /app/starter-ci4/ codeigniter4 php -v
```
