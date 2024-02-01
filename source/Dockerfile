# Warning: this is still a template script and hasn't been tested yet

FROM php:8.3.2-fpm

WORKDIR /var/www

COPY . codeigniter4

RUN apt-get update && \
    apt-get install -y \
    git \
    zip \
    curl

RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mysqli

# may not be necessary
# RUN docker-php-ext-enable pdo_mysql

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

EXPOSE 9000

CMD ["php-fpm"]