FROM nginx/unit:1.26.0-php8.0

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN apt-get update -y && apt-get install -y --no-install-recommends \
curl \
wget \
zip \
unzip \
git \
procps \
libfreetype6-dev \
libjpeg62-turbo-dev \
libpng-dev \
libssh-dev \
libpcre3 \
libpcre3-dev \
libnghttp2-dev \
libhiredis-dev \
nano \
supervisor \
libzip-dev \
icu-devtools \
zlib1g-dev \
libgmp3-dev \
libicu-dev \
libxml2-dev \
g++ \
inotify-tools \
libonig-dev \
libwebp-dev \
libxpm-dev \
libbz2-dev \
libgd-dev \
libc-client-dev \
libkrb5-dev \
libldb-dev \
libldap2-dev \
libreadline-dev \
libxslt-dev \
unixodbc-dev \
libmemcached-dev \
libsnmp-dev \
freetds-bin \
freetds-dev \
freetds-common \
snmp \
libpspell-dev \
aspell-en \
libpq-dev \
libtidy-dev \
librabbitmq-dev \
imagemagick \
libmagickwand-dev \
ghostscript && \
wget https://get.symfony.com/cli/installer -O - | bash && \
mv /root/.symfony/bin/symfony /usr/local/bin/symfony && \
ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/include/gmp.h && \
ln -s /usr/lib/x86_64-linux-gnu/libldap.so /usr/lib/libldap.so && \
ln -s /usr/lib/x86_64-linux-gnu/liblber.so /usr/lib/liblber.so && \
ln -s /usr/lib/x86_64-linux-gnu/libsybdb.a /usr/lib/libsybdb.a && \
git clone https://github.com/Imagick/imagick && \
cd imagick && \
phpize && \
./configure && \
make && \
make install && \
docker-php-ext-enable imagick && \
cd .. && \
rm -rf imagick && \
docker-php-ext-configure gd \
--with-webp \
--with-jpeg \
--with-xpm \
--with-freetype && \
docker-php-ext-configure intl && \
docker-php-ext-configure imap --with-kerberos --with-imap-ssl && \
docker-php-ext-install \
mysqli \
pdo_mysql \
pdo_dblib \
pdo_pgsql \
pgsql \
bz2 \
gettext \
gmp \
pspell \
ffi \
shmop \
sockets \
gd \
imap \
ldap \
soap \
sysvmsg \
sysvsem \
sysvshm \
xsl \
zip \
intl \
pcntl \
snmp \
tidy \
opcache && \
docker-php-ext-enable opcache && \
pecl install redis && docker-php-ext-enable redis && \
pecl install inotify && docker-php-ext-enable inotify && \
pecl install igbinary && docker-php-ext-enable igbinary && \
echo no | pecl install memcached-3.1.5 && docker-php-ext-enable memcached && \
pecl install msgpack && docker-php-ext-enable msgpack && \
curl -sSLf https://codeload.github.com/php-amqp/php-amqp/tar.gz/df1241852b359cf12c346beaa68de202257efdf1 | tar xz && \
cd php-amqp-df1241852b359cf12c346beaa68de202257efdf1 && \
phpize && \
./configure && \
make -j$(nproc) && \
make install && \
cd .. && \
rm -rf php-amqp-df1241852b359cf12c346beaa68de202257efdf1 && \
docker-php-ext-enable amqp && \
curl -sS https://getcomposer.org/installer | php && \
mv composer.phar /usr/local/bin/composer && \
composer self-update --clean-backups && \
cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini && \
mkdir -p /var/www/html && \
docker-php-source delete && \
apt-get autoremove -y && \
apt-get clean && \
rm -rf /var/lib/apt/lists/* && \
rm -rf /tmp/* && \
apt-get purge -y --auto-remove && \
rm -rf /tmp/pear && \
rm -rf /tmp/src && \
rm -rf tmp/pickle && \
apt-get remove --purge -y libfreetype6-dev \
libjpeg62-turbo-dev \
libpng-dev \
libssh-dev \
libpcre3-dev \
libnghttp2-dev \
libhiredis-dev \
libzip-dev \
icu-devtools \
zlib1g-dev \
libgmp3-dev \
libicu-dev \
libxml2-dev \
libonig-dev \
libwebp-dev \
libxpm-dev \
libbz2-dev \
libgd-dev \
libc-client-dev \
libkrb5-dev \
libldb-dev \
libldap2-dev \
libreadline-dev \
libxslt-dev \
unixodbc-dev \
libmemcached-dev \
libsnmp-dev \
freetds-dev \
libpspell-dev \
libpq-dev \
libtidy-dev \
librabbitmq-dev \
imagemagick \
libmagickwand-dev

COPY docker-entrypoint.sh /usr/local/bin/

EXPOSE 80

WORKDIR /var/www/html