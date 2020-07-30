# Reference: https://vuejs.org/v2/cookbook/dockerize-vuejs-app.html

# build stage
FROM node:12-alpine as build-stage

# --no-cache: download package index on-the-fly, no need to cleanup afterwards
# --virtual: bundle packages, remove whole bundle at once, when done
# Reference: https://habr.com/ru/company/ruvds/blog/491710/
RUN apk --no-cache add --virtual builds-deps build-base python

WORKDIR /var/www/app

COPY ./admin/package.json ./
COPY ./admin/yarn.lock ./

RUN yarn install

COPY ./admin/ .

# Uncomment if you need app.json from project root
# COPY ./app.json ./src/config/

RUN yarn build

# production stage
FROM nginx:stable-alpine as production-stage

COPY --from=build-stage /var/www/app/dist /var/www/app
COPY ./docker/admin/nginx.conf /etc/nginx/conf.d/default.conf

CMD ["nginx", "-g", "daemon off;"]
