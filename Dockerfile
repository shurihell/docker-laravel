FROM php:8.0.1-fpm

# 미러 사이트를 kaist로 변경. 필요시 아래 주석 해제 후 사용.
# RUN sed -i 's/deb.debian.org/ftp.kaist.ac.kr/g' /etc/apt/sources.list

# php-fpm 9000번 기본 포트를 80번으로 변경
# 9000번은 xdebug용으로 사용하기 때문에 혼란이 올 수 있어서 Port 번호 교체
# RUN sed -i 's/9000/80/' /usr/local/etc/php-fpm.d/zz-docker.conf

# Install packages & docker configurations.
RUN apt-get update && apt-get install -y \
        build-essential \
        git \
        curl \
        wget \
        openssl \
        unzip \
        libbz2-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libwebp-dev \
        libpng-dev \
        libxml2-dev \
        libicu-dev \
        libzip-dev \
        libonig-dev \
        libpq-dev \
    && phpModules=" \
            bcmath \
            bz2 \
            ctype \
            exif \
            fileinfo \
            gd \
            iconv \
            mbstring \
            opcache \
            pdo \
            pdo_mysql \
            pdo_pgsql \
            tokenizer \
            xml \
            zip \
        " \
    && pecl install xdebug \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) $phpModules

# Composer install
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

# Set volume
# VOLUME ["/var/www/html", "/usr/local/etc/php/conf.d/php.ini"]

# Set working directory
WORKDIR /var/www/html


CMD ["php-fpm"]

# Port expose
EXPOSE 9000
