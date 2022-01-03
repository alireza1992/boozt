# The Boozt assessment

This is the boozt task for backend position

## Overview

1. [Install prerequisites](#install-prerequisites)

   Before installing project make sure the following prerequisites have been met:
   A. docker B. git

3. [Clone the project](#clone-the-project)

   You can download the code from its repository on GitHub.

4. [Install docker on your machine](#install-docker-on-your-machine) [`Optional`]

   Another way of running the project would be running

```sh 
php -S 127.0.0.1:8000 in the 
```

in the public folder

5. [Run the application](#run-the-application)

   Please run :

```sh
docker-compose up -d
``` 

```sh
docker-compose logs -f # Follow log output
```

in the root of the porject

6. [Migration](#use-makefile)

   You can migrate tables using this command :

```sh
cd web/app/Core/Database
docker-compose exec php php app/Core/Database/Migrations.php
```

This project use the following ports :

| Server     | Port |
|------------|------|
| MySQL      | 3306 |
| PHPMyAdmin | 8010 |
| Nginx      | 8080 |
| PHP        | 9000 |

___

### Project tree

```sh
.
|
├── README.md
├── docker-compose.yml
├── docker
│   ├── nginx
│   │   ├── default.conf
│   │   └── default.template.conf
│   ├── php
│   │   └── php.ini
│   ├── mysql
│   │   └── data
│   └── ssl
└── web
    ├── app
    │   ├── Controllers
    │   ├── Core
    │   ├── Migrations
    │   ├── Models
    │   ├── Public
    │   ├── Runtime
    │   ├── Tests
    │   ├── vendor
    │   ├── Views
    │   ├── phpunit.xml.dist

```

___

## Use Docker commands

### Installing package with composer

```sh
docker run --rm -v $(pwd)/web/app:/app composer require symfony/yaml
```

### Updating PHP dependencies with composer

```sh
docker run --rm -v $(pwd)/web/app:/app composer update
```

### Testing PHP application with PHPUnit

```sh
docker-compose exec -T php ./app/vendor/bin/phpunit --colors=always --configuration ./app
```

### Checking installed PHP extensions

```sh
docker-compose exec php php -m
```

### Handling database

#### MySQL shell access

```sh
docker exec -it mysqldb bash
```

___

## Thank you

