FROM fedora:latest
RUN yum upgrade -y && yum install nginx -y && yum install mysql-server -y && yum install php-fpm -y
CMD service start nginx
CMD service start mysqld
CMD service start php-fpm

