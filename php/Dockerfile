FROM php:8.2-fpm

ARG INSTALL_XDEBUG=false

RUN apt-get update \
  && apt-get install -y --no-install-recommends \
     curl \
     git \
     pkg-config \
     icu-devtools \
     libicu-dev \
     libcurl4-openssl-dev \
     libfreetype6-dev \
     libjpeg62-turbo-dev \
     libpng-dev \
     libbz2-dev \
     libssl-dev \
     libgmp-dev \
     libtidy-dev \
     libxml2-dev \
     libxslt1-dev \
     libonig-dev \
     libzip-dev \
  && ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/include/gmp.h \
  && docker-php-ext-install -j$(nproc) \
     mysqli \
     pdo_mysql \
     intl \
     zip \
     bz2 \
     calendar \
     bcmath \
     exif \
     gettext \
     gmp \
     mbstring \
     pcntl \
     shmop \
     sockets \
     sysvmsg \
     sysvsem \
     sysvshm \
     tidy \
     xsl \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install -j$(nproc) gd \
  && docker-php-source delete \
  && apt-get purge -y --auto-remove \
  && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer \
  && chmod 755 /usr/bin/composer

RUN if [ "$INSTALL_XDEBUG" = "true" ]; then \
      pecl install xdebug \
      && docker-php-ext-enable xdebug; \
    fi

WORKDIR /var/www/html

CMD ["php-fpm"]
