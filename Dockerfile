FROM wyveo/nginx-php-fpm:php82

WORKDIR /var/www/html/quiz

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN mkdir -p storage/framework/sessions && mkdir -p storage/framework/views && mkdir -p storage/framework/cache
RUN chmod -R 777 storage/framework/sessions && chmod -R 777 storage/framework/views && chmod -R 777 storage/framework/cache

RUN mkdir -p storage/logs && touch storage/logs/laravel.log
RUN chmod -R 777 storage/logs/laravel.log

COPY ./docker/config/quiz.conf /etc/nginx/conf.d/default.conf

RUN chown -R www-data:www-data /var/www/html/quiz