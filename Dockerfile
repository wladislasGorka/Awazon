# Backend
FROM php:8.2-cli AS backend
WORKDIR /app/backend
COPY backend/ .
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    netcat-traditional \
    && docker-php-ext-install pdo pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-scripts
 
# Frontend
FROM node:16 AS frontend
WORKDIR /app/frontend
COPY frontend/ .
RUN npm install
RUN npm run build
 
# Final stage
FROM nginx:alpine
COPY --from=backend /app/backend/public /var/www/html/backend
COPY --from=frontend /app/frontend/build /var/www/html/frontend
