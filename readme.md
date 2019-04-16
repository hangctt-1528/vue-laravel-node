# Full stack image for developing and running Laravel project
This image contains:

* Ubuntu 16.04
* PHP 7.1
* Mysql 5.7
* Nginx
* Redis
* Mongo DB
* Nodejs, npm, gulp
* Ruby, SASS

# Config .env
### Create file .env
* cp .env.example .env
### Edit
* DB_CONNECTION=mysql
* DB_HOST=kenini_mysql
* DB_PORT=3306
* DB_DATABASE=kenini
* DB_USERNAME=root
* DB_PASSWORD=root

# Run docker
* docker-compose up -d
# Exec Docker
* docker exec -it kenini_workspace bash
* php artisan config:clear
* php artisan cache:clear
# Connect workbench
* docker inspect kenini_mysql
