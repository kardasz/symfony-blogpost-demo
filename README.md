# Symfony demo

## Setup

- `docker-compose up` start containers
- `docker-compose exec symfony composer -n --no-ansi --no-scripts install` install dependencies
- `docker-compose exec symfony composer run-script --no-interaction symfony-scripts` run symfony scripts
- `docker-compose exec symfony bin/console bin/console doctrine:schema:update --force` schema install
-  http://127.0.0.1:8080/ open browser


