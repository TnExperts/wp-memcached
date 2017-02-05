FROM ubuntu:latest
RUN apt-get update -y && apt-get install nginx -y && apt-get install php-fpm -y
CMD service start nginx
CMD service start php-fpm

