FROM php:8.1-fpm-buster

# Get repository and install wget and vim
RUN apt-get update && apt-get install -y \
    wget \
    apt-utils \
    gnupg \
    software-properties-common \
    apt-transport-https \
    libxml2-dev \
    unixodbc-dev

# Install PHP extensions deps
RUN apt-get update \
&& apt-get install --no-install-recommends -y \
libfreetype6-dev \
libjpeg62-turbo-dev \
libmcrypt-dev \
libpng-dev \
zlib1g-dev \
libicu-dev \
libldap-dev \
g++ \
unixodbc-dev

RUN wget -qO - https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
    && wget -qO - https://packages.microsoft.com/config/debian/10/prod.list \
        > /etc/apt/sources.list.d/mssql-release.list
RUN apt-get update

RUN ACCEPT_EULA=Y apt-get install -y msodbcsql17 mssql-tools

RUN apt-get install --no-install-recommends -y libxml2-dev \
 libaio-dev \
 libmemcached-dev \
 freetds-dev \
 libssl-dev \
 openssl

# Install composer requirements and the latest version of Composer
RUN apt-get install -y git zip libzip-dev
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer


# Install nodejs and npm
RUN apt-get install -y nodejs npm
RUN curl -sL https://deb.nodesource.com/setup_16.x | sh - && apt-get update
RUN apt-get install -y nodejs
RUN npm install npm@latest -g

# Install PHP extensions
RUN pecl install sqlsrv-5.10.0beta2 pdo_sqlsrv-5.10.0beta2
##RUN pecl install sqlsrv pdo_sqlsrv
RUN docker-php-ext-install iconv sockets pdo pdo_mysql zip ldap
RUN docker-php-ext-enable sqlsrv pdo_sqlsrv

# Clean repository
RUN apt-get autoremove -y && apt-get clean
