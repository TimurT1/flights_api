# FLIGHTS_API
*****************
# Take off ✈️ 
<pre>
docker-compose up -d
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
php -S localhost:8000 -t public
</pre>
## Company
<pre>
GET /api/companies

GET /api/companies/{id}

POST /api/companies
{
    "name": "string"
}
</pre>
****************
## Flight
<pre>
GET /api/flights

GET /api/flights/{id}

POST /api/flights
{
    "flightNumber": "5555",
    "destination": "Mars",
    "departure": "2023-01-15T10:30:13.500Z",
    "gate": "",
    "company":"/api/companies/3"
}
</pre>
****************

## Filters
<pre>
http://localhost:8000/api/flights?
    company=2&flightNumber=AA11&
    company.name=%Company 2%c&
    departure[after]=2023-01-15&
    departure[before]=2023-01-20
</pre>



## Symfony Docker
A [Docker](https://www.docker.com/)-based installer and runtime for the [Symfony](https://symfony.com) web framework, with full [HTTP/2](https://symfony.com/doc/current/weblink.html), HTTP/3 and HTTPS support.

![CI](https://github.com/dunglas/symfony-docker/workflows/CI/badge.svg)

## DOCKER
**From Ubuntu Terminal** (*Ex: PHPStorm/Terminal/Down arrow/Ubuntu*)
1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/)
2. Run `docker-compose build --pull --no-cache` to build fresh images
3. Run `docker-compose up` (the logs will be displayed in the current shell)
4. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
5. Run `docker-compose down --remove-orphans` to stop the Docker containers.
6. Enter in container `docker exec -it [container] sh`
7. See images `docker ps`

## DOCTRINE
* Make entity : php bin/console make:entity
* Make migration : php bin/console make:migration
* Make migrate : php bin/console doctrine:migrations:migrate

## DATABASE
1. Access postgreSQL `pgcli postgres://...`
2. See databases `\list`
3. Quit psql command line `Ctrl+D`

## LOCALHOST
1. `php -S localhost:8000 -t public`

## FIXTURES
1. Install fixtures: composer require --dev orm-fixtures
2. Install faker: composer require fakerphp/faker
3. Create fixtures file : php bin/console make:fixtures FlightFixtures
4. Fulfill fixture file with entity's properties (use php faker)
5. Execute fixtures: php bin/console doctrine:fixtures:load
