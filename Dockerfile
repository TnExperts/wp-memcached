FROM fedora:latest
RUN yum upgrade -y && yum install nginx -y && yum install mysql-server && yum install php-fpm
CMD service start nginx
CMD service start mysqld
CMD service start php-fpm

