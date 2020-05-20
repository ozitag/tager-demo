# Reference: https://dockerfile.readthedocs.io/en/latest/content/DockerImages/dockerfiles/php-nginx.html
FROM webdevops/php-nginx:7.4-alpine as dev

WORKDIR /var/www/app

COPY /docker/backend/bootstrap.sh /opt/docker/provision/entrypoint.d/bootstrap.sh
COPY /docker/backend/supervisor/queue.conf /opt/docker/etc/supervisor.d/queue.conf


FROM webdevops/php-nginx:7.4-alpine as production

WORKDIR /var/www/app

COPY /backend/composer.json composer.json
COPY /backend/composer.lock composer.lock

RUN composer i  --ignore-platform-reqs

COPY /backend .

COPY /docker/backend/bootstrap.production.sh /opt/docker/provision/entrypoint.d/bootstrap.sh
COPY /docker/backend/supervisor/queue.conf /opt/docker/etc/supervisor.d/queue.conf
