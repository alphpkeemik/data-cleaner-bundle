FROM phpdockerio/php74-fpm

RUN apt-get update
RUN apt-get install -y git

# install composer
RUN curl --silent --show-error https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/html