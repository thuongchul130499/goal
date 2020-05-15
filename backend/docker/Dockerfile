FROM php:7.2-apache-stretch

COPY . /var/www/html
COPY docker/start.sh /usr/local/bin/start

RUN chown -R www-data:www-data /var/www/html \
    && chmod u+x /usr/local/bin/start \
    && a2enmod rewrite

RUN apt-get update \
  && apt-get install -y zlib1g-dev libzip-dev libicu-dev wget gnupg g++ git openssh-client libpng-dev iproute2 \
  && docker-php-ext-configure intl \
  && docker-php-ext-install intl pdo_mysql zip gd pcntl

RUN pecl install -f xdebug && docker-php-ext-enable xdebug;

RUN curl -sL https://deb.nodesource.com/setup_12.x | bash - \
  && curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
  && echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list

RUN apt-get update \
  && apt-get install -y nodejs \
  && apt-get install -y yarn

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

CMD ["/usr/local/bin/start"]
