FROM php:8-apache AS builder

RUN apt-get update && apt-get install -y git libzip-dev libpng-dev zip \
    && git clone --depth=1 https://github.com/rathena/FluxCP /fluxcp \
    && rm -rf /fluxcp/.git \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

FROM php:8-apache

RUN apt-get update && apt-get install -y libzip-dev libpng-dev zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --chown=www-data:www-data --from=builder /fluxcp /var/www/html

WORKDIR /var/www/html

COPY --chown=www-data:www-data ./fluxcp-image/config/application-env.php ./fluxcp-image/config/servers-env.php /var/www/html/config/

RUN sed -i 's/application.php/application-env.php/g' /var/www/html/index.php \
    && sed -i 's/servers.php/servers-env.php/g' /var/www/html/index.php \
    && docker-php-ext-configure zip \
    && docker-php-ext-install pdo pdo_mysql zip gd mysqli

ENV BASE_PATH="" \
    SITE_TITLE="Flux Control Panel" \
    DOMAIN="localhost" \
    RO_SERVER_NAME="rAthena" \
    INSTALLER_PASSWORD="secretpassword" \
    DB_HOST="db" \
    DB_USER="ragnarok" \
    DB_PASSWORD="ragnarok" \
    DB_NAME="ragnarok" \
    LOGIN_SERVER_HOST="login" \
    CHAR_SERVER_HOST="char" \
    MAP_SERVER_HOST="map"

EXPOSE 80
