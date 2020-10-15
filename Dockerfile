FROM alpine:3.12

RUN apk --no-cache add php7 php7-fpm php7-opcache php7-mysqli php7-json php7-openssl php7-curl \
    php7-zlib php7-xml php7-phar php7-intl php7-dom php7-xmlreader php7-ctype php7-session \
    php7-mbstring php7-gd nginx supervisor curl && \
    rm /etc/nginx/conf.d/default.conf

COPY ./docker/nginx.conf /etc/nginx/nginx.conf

COPY ./docker/fpm-pool.conf /etc/php7/php-fpm.d/www.conf
COPY ./docker/php.ini /etc/php7/conf.d/custom.ini

COPY ./docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN mkdir -p /var/www

RUN chown -R nobody.nobody /var/www && \
  chown -R nobody.nobody /run && \
  chown -R nobody.nobody /var/lib/nginx && \
  chown -R nobody.nobody /var/log/nginx

USER nobody

WORKDIR /var/www
COPY --chown=nobody ./ /var/www/

## Deleting unused file or directories
RUN rm -Rf /var/www/docker
RUN rm /var/www/Dockerfile
RUN rm -Rf /var/www/.git
RUN rm -Rf /var/www/.github
RUN rm /var/www/README.md

EXPOSE 8080

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

HEALTHCHECK --timeout=10s CMD curl --silent --fail http://127.0.0.1:8080/fpm-ping