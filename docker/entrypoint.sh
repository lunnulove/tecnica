#!/bin/sh

echo "Esperando base de datos..."
sleep 20

echo "Inicializando Yii2..."
php init --env=Development --overwrite=All

echo "Aplicando migraciones..."
php yii migrate --interactive=0 || true

echo "Iniciando Apache..."
apache2-foreground
