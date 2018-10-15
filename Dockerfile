# https://alpinelinux.org/
# minimal container with nginx, php & composer
FROM alpine:latest

EXPOSE 8080

RUN apk update && apk upgrade
RUN apk add nginx php php-fpm composer supervisor

# setup php
ENV PHP_FPM_LISTEN_MODE="0660"
ENV PHP_MEMORY_LIMIT="512M"
ENV PHP_MAX_UPLOAD="50M"
ENV PHP_MAX_FILE_UPLOAD="200"
ENV PHP_MAX_POST="100M"
ENV PHP_DISPLAY_ERRORS="On"
ENV PHP_DISPLAY_STARTUP_ERRORS="On"
ENV PHP_ERROR_REPORTING="E_COMPILE_ERROR\|E_RECOVERABLE_ERROR\|E_ERROR\|E_CORE_ERROR"
ENV PHP_CGI_FIX_PATHINFO=0
ENV TIMEZONE="Europe/Berlin"
RUN echo "listen=/var/run/php-fpm.sock" >> /etc/php7/php-fpm.conf

# setup nginx
RUN rm -rf /etc/nginx/nginx.conf
COPY api-controller/nginx.conf /etc/nginx/nginx.conf

# setup supervisor
RUN rm -rf /etc/supervisord.conf
COPY api-controller/supervisord.conf /etc/supervisord.conf

# create service workdir, add files & install dependencies
RUN mkdir /service
ADD .sources /service/.sources
ADD connector-essentials /service/connector-essentials
ADD api-controller /service/api-controller
WORKDIR /service/api-controller
RUN composer install --no-interaction

# run php-fpm & nginx via supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
