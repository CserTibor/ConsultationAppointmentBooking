FROM webdevops/php-nginx-dev:8.0

RUN echo date.timezone = "Europe/Budapest" >> /opt/docker/etc/php/php.ini

WORKDIR "./app"
COPY . /app

RUN chown -R application:application /app

RUN chmod -R 775 /app/storage
RUN chmod -R 775 /app/bootstrap/cache
