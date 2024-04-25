FROM wyveo/nginx-php-fpm:php82

WORKDIR /var/www/html/quiz

COPY . .

RUN composer install --no-dev --optimize-autoloader

COPY ./docker/config/quiz.conf /etc/nginx/conf.d/default.conf

RUN chown -R www-data:www-data /var/www/html/quiz