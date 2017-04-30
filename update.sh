#!/bin/bash

git pull

php ../composer/composer.phar install

php bin/console doctrine:schema:update --force
php bin/console cache:clear --env=prod
php bin/console assets:install --env=prod
