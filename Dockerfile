FROM alpine:3.6

RUN apk --no-cache add \
    php7 \
    php7-fpm \
    php7-xml \
    php7-mbstring \
    php7-mcrypt \
    php7-ldap \
    nginx \
    supervisor \
    curl \
    ca-certificates \
    ; \
    rm -rf /var/cache/apk/* ;

# Debug pack
RUN apk --no-cache add \
    nano \
    bash \
    bind-tools \
    ; \
    rm -rf /var/cache/apk/* ;

# Configure nginx
COPY assets/nginx.conf /etc/nginx/nginx.conf

# Configure PHP-FPM
COPY assets/fpm-pool.conf /etc/php7/php-fpm.d/z_custom_fpm-pool.conf
COPY assets/php.ini /etc/php7/conf.d/z_custom_php.ini

# Configure supervisord
COPY assets/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Install Self Service Password
ENV TZ=Europe/Moscow
ENV SSP_VERSION=1.3
RUN echo '>> Downloading Self Service Password version '${SSP_VERSION} && \
  curl -sSL https://github.com/ltb-project/self-service-password/archive/v1.3.tar.gz -o temp.tar.gz && \
  mkdir -p /var/www/html && \
  tar zxf temp.tar.gz --strip 1 -C /var/www/html && \
  rm temp.tar.gz;

# Replace config with local
#COPY assets/config.inc.php /var/www/html/conf/config.inc.php

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
