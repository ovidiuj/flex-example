FROM nginx:latest

# Install general Dependencies
RUN apt-get update && apt-get install -y curl \
    build-essential \
    apt-utils \
    libpq-dev \
    git

COPY default.conf /etc/nginx/conf.d/

RUN echo "upstream php-upstream { server php:9001; }" > /etc/nginx/conf.d/upstream.conf
RUN usermod -u 1000 www-data

EXPOSE 80 9000

WORKDIR /var/www

RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

CMD ["nginx", "-g", "daemon off;"]