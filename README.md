# flex-example
An example of using flex for APIs

## Installation

```
git clone https://github.com/ovidiuj/flex-example
cd flex-example/docker
./start-docker.sh
```

The above code will clone the repository and raise up the docker machine & containers.
The application should be available if you access http://flex.dc:8080/ in you browser.

### Setting up the database

> Get the docker machine IP address and update the .env file
```
docker-machine ls
```

> Run:
```
composer update
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```

### CLI command 
> Run:
```
php bin/console app:get-data ES Madrid
or
php bin/console app:get-data
```
> Go to http://flex.dc:81/ to access phpmyadmin where the database should be populated already