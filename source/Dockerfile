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

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY composer.json codeigniter4/composer.json
COPY composer.lock codeigniter4/composer.lock
RUN cd codeigniter4 && composer install

COPY . codeigniter4

RUN chown -R www-data:www-data codeigniter4/
RUN chmod -R 755 codeigniter4/writable/

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

EXPOSE 9000

CMD ["php-fpm"]
