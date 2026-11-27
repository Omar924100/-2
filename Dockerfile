FROM php:8.1-apache
RUN docker-php-ext-install mysqli pdo_mysql \
 && rm -rf /var/lib/apt/lists/*
COPY src/ /var/www/html/
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh \
 && mkdir -p /vault && chown www-data:www-data /vault
# el flag ما عادش COPY — يتحقن runtime
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["apache2-foreground"]
