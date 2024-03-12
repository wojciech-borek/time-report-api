#!/bin/bash
composer install --no-dev --optimize-autoloader
supervisord -c /etc/supervisor/supervisord.conf
apache2-foreground
