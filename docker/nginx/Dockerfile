FROM nginx:latest

# Copies nginx configurations to override the default.
ADD ./default.conf /etc/nginx/conf.d/

# Make html directory
RUN mkdir -p /var/www/html