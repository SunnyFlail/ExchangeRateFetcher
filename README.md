# Exchange rate fetcher

## Requirements
Application requires `docker` installed and at least `docker compose 2`.

## Using
First start the containers by running
```bash
docker compose up -d
```
To access container you can use
```bash
docker compose exec php sh
```
To fetch currencies from api, run below command from container
```bash
./bin/console app:fetch-currencies
```