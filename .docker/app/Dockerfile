FROM node:14.17-alpine AS buildnode
USER root
USER www-data

FROM php:7.3.6-fpm-alpine3.9 AS base

RUN apk add --no-cache shadow \
    openssl \
    bash \
    mysql-client \
    git \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev

RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
RUN docker-php-ext-install -j$(nproc) gd

RUN touch /home/www-data/.bashrc | echo "PS1='\w\$ '" >>  /home/www-data/.bashrc

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY --from=buildnode /usr/local/bin/node /usr/local/bin/node
COPY --from=buildnode /usr/local/lib/node_modules  /usr/local/lib/node_modules

RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm
RUN ln -s /usr/local/lib/node_modules/npm/bin/npx-cli.js /usr/local/bin/npx


RUN usermod -u 1000 www-data
WORKDIR /var/www

RUN rm -rf /var/www/html && ln -s public html
USER www-data
EXPOSE 9000

FROM base AS dev
USER root
ENV DOCKERIZE_VERSION v0.6.1

RUN wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && rm dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz

ADD .docker/app/entrypoint.sh /entrypoint.sh
USER www-data



