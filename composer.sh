#!/bin/bash

cd /var/www/html

if [ -f composer.json ]; then
    composer install --no-interaction
fi

npm install

service ssh start

exec apache2-foreground
