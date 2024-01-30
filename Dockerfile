# Use the Amazon Linux 2 base image
FROM amazonlinux:2 as build

#common for all docker amazon linux2 images
RUN ln -sf /usr/share/zoneinfo/Asia/Kolkata /etc/localtime
RUN date
RUN yum update -y
RUN yum install -y gcc make telnet network-tools procps tar zip unzip vi which wget net-tools re2c sqlite-devel sqlite3 oniguruma openssl openssl-devel curl oniguruma-devel
# Update and install necessary packages
RUN yum update -y \
    && yum install -y httpd

# Install PHP 8.2
RUN amazon-linux-extras enable php8.2
RUN yum install -y php-cli php-pdo php-fpm php-json php-mysqlnd php-pdo php-zlib php-zip php-devel php-gd php-igbinary php-imagick php-intl php-mbstring php-redis php-ssh2 php-pear

RUN pecl channel-update pecl.php.net
RUN pecl install mongodb
RUN pecl install igbinary
RUN pecl install redis
RUN touch /etc/php.d/60-mongodb.ini
RUN echo "extension=mongodb" > /etc/php.d/60-mongodb.ini && \
    echo "extension=igbinary" >> /etc/php.d/60-mongodb.ini && \
    echo "extension=redis" >> /etc/php.d/60-mongodb.ini
#composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN cp composer.phar /usr/bin/composer
RUN cp composer.phar /usr/local/bin/composer


RUN yum install -y mod_php
RUN yum install -y git
RUN yum install -y awscli
RUN yum install -y gzip libzip zlib

#wkhtmltopdf: 
RUN yum install -y https://github.com/wkhtmltopdf/packaging/releases/download/0.12.6-1/wkhtmltox-0.12.6-1.amazonlinux2.x86_64.rpm
RUN cp /usr/local/bin/wkhtmltopdf /usr/bin/
RUN cp /usr/local/bin/wkhtmltoimage /usr/bin/

#Stage 2
# Use the Amazon Linux 2 base image
FROM amazonlinux:2 as final

# Update and install necessary packages
RUN ln -sf /usr/share/zoneinfo/Asia/Kolkata /etc/localtime
RUN date
RUN yum install -y httpd

# Install PHP 8.2
RUN amazon-linux-extras enable php8.2
RUN yum install -y mod_php
RUN yum install -y awscli
RUN yum install -y wqy-zenhei-fonts
RUN yum install -y php-gd
RUN yum install -y libXrender
RUN yum install -y fontconfig
RUN yum install -y libXext

COPY --from=build /usr/bin/php /usr/bin/php
COPY --from=build /usr/bin/phpize /usr/bin/phpize
COPY --from=build /usr/bin/php-config /usr/bin/php-config
COPY --from=build /usr/bin/php /usr/bin/php
COPY --from=build /usr/include/php /usr/include/php
COPY --from=build /usr/lib64/php/modules /usr/lib64/php/modules
COPY --from=build /usr/bin/composer /usr/bin/composer
COPY --from=build /usr/local/bin/ /usr/local/bin/
COPY --from=build /usr/local/bin/wkhtmltopdf /usr/bin/
COPY --from=build /usr/local/bin/wkhtmltoimage /usr/bin/

RUN echo '<Directory "/var/www/html">' >> /etc/httpd/conf/httpd.conf && \
    echo '    AllowOverride All' >> /etc/httpd/conf/httpd.conf && \
    echo '    Require all granted' >> /etc/httpd/conf/httpd.conf && \
    echo '</Directory>' >> /etc/httpd/conf/httpd.conf
RUN touch /etc/php.d/60-mongodb.ini
RUN echo "extension=mongodb" > /etc/php.d/60-mongodb.ini && \
    echo "extension=igbinary" >> /etc/php.d/60-mongodb.ini && \
    echo "extension=redis" >> /etc/php.d/60-mongodb.ini

RUN rm -r -f /var/cache
# Copy your PHP files to the appropriate directory
COPY . /var/www/html/

# Expose port 80 for Apache
EXPOSE 80

ENTRYPOINT ["/usr/sbin/httpd", "-D", "FOREGROUND"]