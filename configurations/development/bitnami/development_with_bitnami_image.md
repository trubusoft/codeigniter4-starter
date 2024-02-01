# Development with the `bitnami/codeigniter` image

Bitnami offers [CodeIgniter development image](https://hub.docker.com/r/bitnami/codeigniter) which you can use as an alternative for the built-in `spark`.

There are some compromises: as per this time of writing, there are some points of discrepancy in the documentations.
We found little to no online answer to issue that we've faced. Plus, the image is close-sourced.

This file attempt to document the configuration that has been working for us.

## No database configuration

The [bitnami-no-db.yml](bitnami-no-db.yml) is the bare minimum configuration that you can run.
The composed container will not have access to database.
This is useful to try/test codeigniter with the starter template we've provided.

The composer will mount `/source` at the working directory of the container.
Upon starting, you can open the development session at `localhost:8000`.
