FROM php:7.4-fpm-alpine

ARG COMPOSER_ARGS=""

RUN apk add --no-cache \
    oniguruma-dev \
    mysql-client \
    libxml2-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    git \
    vim \
    zip \
    unzip \
    curl

RUN docker-php-ext-install \
    bcmath \
    mbstring \
    pdo \
    pdo_mysql \
    tokenizer \
    xml

RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

WORKDIR /var/www/html

COPY composer.json composer.lock ./

RUN composer install \
    --no-interaction \
    --no-scripts \
    --no-autoloader \
    --no-progress ${COMPOSER_ARGS}

COPY . .
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

RUN chown -R www-data:www-data ./ && chmod -R 775 ./storage
RUN composer dump-autoload --optimize

EXPOSE 9000

CMD ["php-fpm"]






#FROM composer:1.9 as vendor
#
#COPY ./database ./database
#COPY ./tests ./tests
#
#COPY composer.json composer.json
#COPY composer.lock composer.lock
#
#RUN composer install \
#    --ignore-platform-reqs \
#    --no-interaction \
#    --no-plugins \
#    --no-scripts \
#    --prefer-dist
#
#
#FROM php:7.4-fpm-alpine
#
#WORKDIR /var/www/html
#
#COPY . .
#COPY --from=vendor /app/vendor ./vendor/
#COPY ./docker/php/php.ini /usr/local/etc/php/php.ini
#
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
#
#RUN apk add --no-cache \
#    oniguruma-dev \
#    mysql-client \
#    libxml2-dev \
#    libpng-dev \
#    libjpeg-turbo-dev \
#    freetype-dev \
#    git \
#    vim \
#    zip \
#    unzip \
#    curl
#
#RUN docker-php-ext-install \
#    bcmath \
#    mbstring \
#    pdo \
#    pdo_mysql \
#    tokenizer \
#    xml
#
#RUN docker-php-ext-configure gd --with-freetype --with-jpeg
#RUN docker-php-ext-install gd
#
#RUN adduser www-data www-data
#
#RUN chown -R www-data:www-data .
#
#USER www-data
#
#EXPOSE 9000
#
#CMD ["php-fpm"]
