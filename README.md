# silex

Install the project with all libraries

``
composer update
``


How to run a local server

``
php -S localhost:8080 -t web web/index.php
``

## How to configure Nginx

If you are using nginx, configure your vhost to forward non-existent resources to index.php:

``
server {
    #site root is redirected to the app boot script
    location = / {
        try_files @site @site;
    }

    #all other locations try other files first and go to our front controller if none of them exists
    location / {
        try_files $uri $uri/ @site;
    }

    #return 404 for all php files as we do have a front controller
    location ~ \.php$ {
        return 404;
    }

    location @site {
        fastcgi_pass   unix:/var/run/php-fpm/www.sock;
        include fastcgi_params;
        fastcgi_param  SCRIPT_FILENAME $document_root/index.php;
        #uncomment when running via https
        #fastcgi_param HTTPS on;
    }
}
``