# Proyecto Tecnica - Yii2 

## Requisitos
- git bash 
- Docker
- Docker Compose

## Levantar proyecto

Ejecutar:
puede ejecutar el comando directo en la terminal de visual code

docker compose up --build

## Acceso

http://localhost:8080

## Usuario administrador por defecto

Usuario: admin  
Email: admin@admin.com  
Password: Admin123*  

Usuario: editor  
Email: editor@demo.com 
Password: 123456  

Usuario: viewer 
Email: viewer@demo.com  
Password: 123456  

El usuario se crea automáticamente mediante migration.
RBAC inicializado con `php yii rbac/init`.
