# Proyecto de Conexión y Registro con Base de Datos


Este proyecto permite al usuario registrarse, iniciar sesión y acceder a una página de bienvenida (`welcome.php`) donde se muestran los datos del usuario una vez que la sesión ha comenzado. El sistema requiere que se configure manualmente la conexión a la base de datos antes de poder usarlo.

## Archivos Importantes

1. **connection.php**  
   Este archivo contiene la lógica de conexión a la base de datos. **Debe ser configurado manualmente** antes de usar el sistema. Es necesario que modifique las credenciales (usuario, contraseña, nombre de la base de datos) de acuerdo con la configuración local de la base de datos.

2. **script.sql**  
   Este archivo contiene las sentencias SQL necesarias para crear la base de datos y las tablas de usuarios, tal como lo hicimos en la implementación original del proyecto. Puede ejecutar este archivo directamente en su servidor de base de datos para crear la estructura necesaria.

3. **welcome.php**  
   Una vez que el usuario inicia sesión correctamente, es redirigido a esta página, donde se muestran los datos del usuario y se confirma que la sesión ha comenzado.

## Instrucciones de Uso

### 1. Modificar `connection.php`

Para que el sistema se conecte a la base de datos, necesita editar el archivo `connection.php`. Abra el archivo y modifique las siguientes líneas con la configuración de su base de datos:

```php
$db_host = "localhost"; // O la dirección de su servidor de base de datos
$username = "tu_usuario"; // El nombre de usuario de la base de datos
$password = "tu_contraseña"; // La contraseña de su base de datos
$dbname = "nombre_de_la_base_de_datos"; // El nombre de la base de datos a la que desea conectarte
```



### Requisitos
- Servidor web (por ejemplo, Apache)
- PHP
- Sistema de gestión de bases de datos compatible con SQL (por ejemplo, MySQL)
#### Ejecución
1. Modificar connection.php con los datos de conexión de su base de datos.
2. Ejecutar script.sql en su sistema de gestión de bases de datos para crear la estructura de tablas.
3. Acceder a la aplicación web e interactuar con el sistema de registro e inicio de sesión.

