FROM webinventions/php7-fpm-nginx:newrelic

ARG APP_VERSION
ENV APP_VERSION ${APP_VERSION}

# NewRelic config
ARG NEWRELIC_LICENSE
ENV NEWRELIC_LICENSE ${NEWRELIC_LICENSE}
ARG NEWRELIC_APPNAME
ENV NEWRELIC_APPNAME ${NEWRELIC_APPNAME:-PHP Application}
ARG NEWRELIC_ENABLED
ENV NEWRELIC_ENABLED ${NEWRELIC_ENABLED:-false}

# Basic auth
# docker run --entrypoint htpasswd httpd:2.4 -bn yourlogin youpassword
ARG BASIC_AUTH
ENV BASIC_AUTH $BASIC_AUTH

# add configs & data after package install (so packages won't override them)
ADD ./docker-files/etc /etc
ADD ./docker-files/usr /usr

WORKDIR /var/www

# Sources
RUN rm -rf /var/www/*
ADD ./ /var/www

# Composer
RUN \
    rm -rf var/cache/* var/bootstrap.php.cache && \
    composer -n --no-ansi --no-scripts install && \
    composer dump-autoload --optimize && \
    composer run-script --no-interaction symfony-scripts

# Permissions
RUN \
    chown -R www-data:www-data var/

COPY docker-entrypoint.sh /entrypoint.sh

RUN chmod a+x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]