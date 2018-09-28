# flex-example
An example of using flex for APIs

## Installation

> Run:
```
git clone https://github.com/ovidiuj/flex-example
cd flex-example
composer update
```

### Docker
To create a virtual host using docker, you need to install [Docker](https://docs.docker.com/machine/)
```
cd flex-example/docker
./start-docker.sh
```

The above code will raise up the docker machine and docker containers:
* Nginx
* php-fpm
* Mysql
* Phpmyadmin

After rasing up the docker containers we need to know the  docker machine IP Address to be used in symfony configuration.

> Get the docker machine IP address and update the .env file (DATABASE_URL)
```
docker-machine ls
```

The application should be now available if you access http://flex.dc:8080/ in you browser.

### Setting up the database

> Run:
```
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```

### CLI command 
> Run:
```
php bin/console app:get-data
php bin/console app:get-data ES Madrid
php bin/console app:get-data DE Dusseldorf
php bin/console app:get-data AT Vienna
php bin/console app:get-data PL Warsaw
php bin/console app:get-data NL Amsterdam
php bin/console app:get-data UK London
```
> Phpmyadmin can be accessed using http://flex.dc:81/ where you can see if the database is populated already.

### API

##### Endpoints:
1. [http://flex.dc:8080/](http://flex.dc:8080/) - for {"hello":"world!"}
2. [http://flex.dc:8080/city-data](http://flex.dc:8080/city-data)  - reporting table data
3. [http://flex.dc:8080/avg-temp](http://flex.dc:8080/avg-temp) - reporting average temperature per city
4. [http://flex.dc:8080/countries](http://flex.dc:8080/countries) - the list of countries
5. [http://flex.dc:8080/country-cities](http://flex.dc:8080/country-cities) - the list of cities for a specific country
6. [http://flex.dc:8080/best-weekend](http://flex.dc:8080/best-weekend) - reporting the best weekend weather per city

##### Parameters:
* **page** - can be used for all endpoints. If it not used, then complete data will be returned.
* **start_date** - (e.g. 2018-01-01) can be used for the endpoints 2, 3, 6.
* **end_date** - (e.g. 2018-12-01) can be used for the endpoints 2, 3, 6.
* **temperature** - (e.g. less|higher) can be used for the endpoints 2, 3, 6.
* **country_code** - (e.g. de) can be used for endpoint 5.