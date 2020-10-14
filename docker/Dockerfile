FROM ubuntu:18.04

MAINTAINER Andrej Nankov <andrejnankov@gmail.com>

# Set global env
ENV TZ=Europe/Minsk
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Start up
RUN \
apt-get -y update && \ 
apt-get -y upgrade && \
apt-get -y dist-upgrade

# Install php 7.2
RUN \
apt-get install -y software-properties-common && \
add-apt-repository ppa:ondrej/php -y && \
apt-get update -y && \
apt-get install php7.2 -y

# Install php extra modules
RUN \
apt-get install php7.2-mbstring -y && \
apt-get install php7.2-ctype -y && \
apt-get install php7.2-bcmath -y && \
apt-get install php7.2-gd -y && \
apt-get install php-dev libmcrypt-dev php-pear -y &&\
apt-get install -y php7.2-json && \
apt-get install -y php7.2-curl && \
apt-get install -y php7.2-mysql && \
apt-get install -y php7.2-sqlite3 && \
apt-get install -y php7.2-imap && \
apt-get install -y php7.2-zip && \
apt-get install -y php-redis && \
apt-get install php-mbstring -y

# Install composer
RUN \
apt-get update && \
apt-get install -y composer

# Install apache2 web server
RUN \
apt-get update -y && \
apt-get install apache2 -y

# Change php.ini
RUN \
sed -i 's|max_execution_time = 30|max_execution_time = 0|g' /etc/php/7.2/apache2/php.ini && \
sed -i 's|post_max_size = 8M|post_max_size = 512M|g' /etc/php/7.2/apache2/php.ini && \
sed -i 's|upload_max_filesize = 2M|upload_max_filesize = 256M|g' /etc/php/7.2/apache2/php.ini

# Permissions
#RUN chown -R www-data:www-data /var/www/

WORKDIR /var/www

# Expose ports
EXPOSE 80

# On execute container
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]