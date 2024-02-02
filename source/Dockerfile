FROM php:8.3.2-fpm

WORKDIR /var/www

RUN apt-get update && \
    apt-get install -y \
    git \
    zip \
    curl \
    libicu-dev

RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install intl

COPY . codeigniter4

RUN chown -R www-data:www-data codeigniter4/
RUN chmod -R 755 codeigniter4/writable/

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

EXPOSE 9000

CMD ["php-fpm"]
