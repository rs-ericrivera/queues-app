# Use an official PHP runtime as a parent image with Apache
FROM php:8.3-fpm
# Install required packages
RUN apt-get update && apt-get install -y \
    git \
    curl \
    openssl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libldap2-dev \
    zip \
    unzip
# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# Install PHP extesudonsions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd soap pdo
# Set working directory inside the container
WORKDIR /app
# Copy the application files to the container
COPY . /app
# Set permissions
#RUN chown -R ${user} \
#        /app/storage \
#        /app/bootstrap/cache
# Install Composer dependencies
RUN composer install
# Generate application keys
RUN cp .env.example .env

RUN  php artisan key:generate

# Expose port 8080 to access the container
EXPOSE 8081
# Expose port 8080 and start server
#CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
ENTRYPOINT ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8081"]
