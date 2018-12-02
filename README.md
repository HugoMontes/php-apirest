# PHP API REST
## create example
* URL: http://localhost/php-apirest/producto/create.php
* METHOD: POST
```
{
    "nombre": "Radio",
    "descripcion": "Radio AM FM.",
    "precio": "200",
    "categoria_id": "2"
}
```
## read example
* URL: http://localhost/php-apirest/producto/read.php
* METHOD: GET

## update example
* URL: http://localhost/php-apirest/producto/update.php
* METHOD: POST
```
{
	"id": "20",
    "nombre": "Parlantes",
    "descripcion": "Parlantes Sony",
    "precio": "200",
    "categoria_id": "2"
}
```
## delete example
* URL: http://localhost/php-apirest/producto/delete.php
* METHOD: POST
``` 
{
	"id": 20
}
```
## find example
* URL: http://localhost/php-apirest/producto/find.php?id=20
* METHOD: GET

Page References: (https://www.codeofaninja.com/2017/02/create-simple-rest-api-in-php.html)