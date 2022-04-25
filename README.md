# Proyecto Final Programación Avanzada
Realizado por: 
- Christian Yesid Galindo Cano-20181020111
- Johan Aguirre Díaz-20181020072
- Jorge Andrés Bohórquez Castellanos-20181020016

## Tienda Online
En este proyecto se realiza la construcción de una plataforma web donde se pueden realizar compras de videojuegos de manera online. 
Para su realización utilizamos html5,css3, además de los lenguajes de programación PHP y JavaScript para darle funcionalidad.
En la parte de almacenamiento de datos usamos el sistema de gestión de bases de datos SQLite ya que tiene una pequeña memoria y una 
única biblioteca que es necesaria para acceder a bases de datos, lo que lo hace ideal para aplicaciones de bases de datos incorporadas
como este ejercicio. Para una aplicación a mayor escala SQLite no es la mejor opción. Por último para el despliegue de la aplicación en un entorno local se hace uso del servidor web Apache proporcionado por XAMPP.

## Tecnologías utilizadas

* [PHP](https://www.php.net/manual/es/intro-whatis.php): Versión 7.4
* [SQLite](https://www.sqlite.org/index.html): Versión 3
* [XAMPP](https://www.apachefriends.org/es/index.html): Versión 7.3.11

## Conexión con base de datos

```php
class MyDB extends SQLite3
    {
       function __construct()
       {
          $this->open('VentasDB.db');
       }
    }

    $db = new MyDB();
    $db->close();
```

## Resultado
***
![Resultado](https://github.com/ChristianGalindo10/Ecommerce_PHP/blob/master/img/resultado%20(1).gif)
