FROM php:7.4.30-fpm

ENV ACCEPT_EULA=Y

# Fix debconf warnings upon build
# ARG DEBIAN_FRONTEND=noninteractive

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install apt-utils libxml2-dev gnupg apt-transport-https git

# Install MS ODBC Driver for SQL Server
# RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
#     && curl https://packages.microsoft.com/config/debian/11/prod.list > /etc/apt/sources.list.d/mssql-release.list \
#     && apt-get update \
#     && apt-get -y install msodbcsql18 mssql-tools18 unixodbc-dev \
#     && pecl install sqlsrv \
#     && pecl install pdo_sqlsrv \
#     && echo "extension=pdo_sqlsrv.so" >> `php --ini | grep "Scan for additional .ini files" | sed -e "s|.*:\s*||"`/30-pdo_sqlsrv.ini \
#     && echo "extension=sqlsrv.so" >> `php --ini | grep "Scan for additional .ini files" | sed -e "s|.*:\s*||"`/20-sqlsrv.ini 

# Install required extensions
# RUN docker-php-ext-install intl mysqli pdo pdo_mysql

# Install packages for running laravel
RUN apt-get install -y sudo && \
apt-get install -y systemd && \
apt-get install -y software-properties-common && \
apt-get install -y iputils-ping && \
apt-get install -y wget && \
apt-get install -y curl && \
apt-get install -y net-tools && \
apt-get install -y nano && \
apt-get install -y vim && \
apt-get install -y unzip

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
php composer-setup.php && \
php -r "unlink('composer-setup.php');"

RUN mv composer.phar /usr/local/bin/composer

WORKDIR /var/www

RUN composer create-project laravel/laravel:^8.0 example-app

WORKDIR /var/www/example-app

# for write permission 
RUN chmod o+w storage/logs && \
chmod o+w storage/framework/sessions && \
chmod o+w storage/framework/views
