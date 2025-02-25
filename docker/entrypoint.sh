#!/bin/bash
set -e

# Ir al directorio de la aplicación
cd /var/www || exit

# Instalar dependencias si es necesario (Composer, etc.)
# composer install --no-dev --optimize-autoloader

# Iniciar el servidor PHP en el puerto 8000
php -S 0.0.0.0:8000 -t src
