FROM php:8.2-apache

RUN docker-php-ext-install mysqli pdo_mysql \
    && a2enmod rewrite

# LFI flag as the last pseudo-user in /etc/passwd (readable via path traversal)
RUN echo "viewer_flag:x:999:999:FLAG{tr4v3rs3_7h3_p4th}:/home/viewer:/bin/false" >> /etc/passwd

# Command injection flag on disk
RUN echo "FLAG{sh3ll_1nj3c710n_rce}" > /var/nexus_secret.txt

COPY src/ /var/www/html/

RUN mkdir -p /var/www/html/uploads \
    && chown -R www-data:www-data /var/www/html/uploads

EXPOSE 80