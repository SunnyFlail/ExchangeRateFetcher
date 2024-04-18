FROM php:8.3-alpine3.17

RUN docker-php-ext-install pdo_mysql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www

WORKDIR /var/www

CMD ["tail", "-f", "/dev/null"]