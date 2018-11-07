FROM doc88/clt-php-nginx

# PHP-FPM
ADD docker/conf/php.ini /etc/php/7.2/fpm/php.ini
ADD docker/conf/www.conf /etc/php/7.2/fpm/pool.d/www.conf

# NGINX config files
ADD docker/conf/nginx.conf /etc/nginx/nginx.conf
ADD docker/conf/nginx-site.conf /etc/nginx/sites-available/default.conf
RUN rm /etc/nginx/sites-enabled/default && \
    ln -s /etc/nginx/sites-available/default.conf /etc/nginx/sites-enabled/default && \
    mkdir -p /run/php

ADD docker/conf/supervisord.conf /etc/supervisord.conf

# Copy start.sh
ADD docker/scripts/start.sh /usr/bin/start.sh

# Setup directories
RUN chmod 755 /usr/bin/start.sh && \
    rm -Rf /var/www/*

# Copy application
COPY . /var/www/html/
RUN cp -arf /var/www/html/env-local/.env /var/www/html/.env
RUN ls -l /var/www/html/.env
# Expose port
EXPOSE 80

# Set the workdir
WORKDIR /var/www/html

# Start the container
CMD ["start.sh"]


