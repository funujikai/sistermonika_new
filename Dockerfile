FROM php:7.3-apache

LABEL author="FZL"

#ENV ACCEPT_EULA=Y

# Microsoft SQL Server Prerequisites
RUN apt-get update && apt-get install -y gnupg2 && apt-get install -y apt-transport-https && apt install -y git \
    && curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
    && curl https://packages.microsoft.com/config/ubuntu/18.04/prod.list > /etc/apt/sources.list.d/mssql-release.list \
    && apt-get update \
    && ACCEPT_EULA=Y apt-get install -y msodbcsql17 \
	&& apt-get install -y unixodbc-dev

RUN pecl install sqlsrv-5.8.0 pdo_sqlsrv-5.8.0 && docker-php-ext-enable sqlsrv pdo_sqlsrv


RUN cp /etc/ssl/openssl.cnf /etc/ssl/openssl.cnf.ORI && \
    sed -i "s/\(MinProtocol *= *\).*/\1TLSv1.0 /" "/etc/ssl/openssl.cnf" && \
    sed -i "s/\(CipherString *= *\).*/\1DEFAULT@SECLEVEL=1 /" "/etc/ssl/openssl.cnf" && \
    (diff -u /etc/ssl/openssl.cnf.ORI /etc/ssl/openssl.cnf || exit 0)

RUN a2enmod rewrite

RUN apt-get install -y zip unzip
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/bin/composer
# RUN composer install

COPY . /var/www/html
# RUN chown www-data:www-data /var/www/html && chmod -R 777 /var/www/html/sistermonika
# CMD ["/bin/bash","chmod -R 777 /var/www/html/sistermonika"]
# CMD ["/bin/bash", "-c", "chmod 777 /var/www/html/sistermonika"]
# php artisan config:cache
# php artisan route:clear
# php artisan view:clear
# composer dump-autoload