FROM php:latest

WORKDIR usr/src/app

COPY . .

CMD ["php", "-S", "0.0.0.0:8080", "-t", "/usr/src/app"]