# Start from a basic PHP 8.2 CLI image
FROM php:8.2-cli

# Create and use /app as the working directory
WORKDIR /app

# Copy all files from your project into the container
COPY . /app

# Install dependencies needed to build and run Symfony
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    libcurl4-openssl-dev pkg-config libssl-dev \
    && docker-php-ext-install pdo_mysql zip


# Install MongoDB extension
RUN pecl install mongodb && docker-php-ext-enable mongodb

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin \
    --filename=composer

# Install PHP dependencies (you can drop --no-dev if you need dev packages)
RUN composer install --no-dev --optimize-autoloader

# Expose port 8000 to the host
EXPOSE 8000

# Run PHP’s built-in server, serving files from the "public" directory
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]