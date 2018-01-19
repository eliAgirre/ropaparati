# ropaparati #

Se trata de una página web para usuarios que les guste comprar la ropa personalizada, tanto por ellos como por otros usuarios.

### Estructura de la web ###

| Nombre                             | Descripción                                                 |
| ---------------------------------- |:-----------------------------------------------------------:|
| **config**/database.php            | Conexión con la base de datos ClearDB (nube).               |
| **controller**/                    | Intermediario entre el modelo y la vista.                   |
| **controller**/class.messages.php  | Una clase para controlar mediante los mensajes de error.    |
| **css**/                           | Fichero estático para almacenar los diseños.                |
| **js**/                            | JavaScript por parte del cliente.                           |
| **image**/                         | Se almacenan las imágenes.                                  |
| **include**/                       | Son ficheros de HTML o PHP para incluir en otros archivos.  |
| **model**/                         | Es la parte del servidor para obtener y manejar datos.      |
| **view**/                          | El cliente visualiza la web.                                |
| index.php                          | Página principal.                                           |




### Funcionamiento de la web: ###

    ClearDB → Base de datos en la nube MySQL.
    Controller→ Controlar los datos de la base de datos y los que introduce el usuario.
    View → Visualizar datos para el usuario.

### Tecnologías a usar: ###

    - HTML5 / CSS3.
    - PHP → php -S localhost:8080 (el puerto que quieras).
    - MySQL → Base de datos relacional.

### Sistema operativo: ###

    - Ubuntu 14.04