<?php
//Here will go the db connections

/*
 * Esta es la forma basica en la que una conexión a una base de datos sql
 * es hecha, para ello requerimos de 4 parametros necesarios que son
 * la dirección del servidor al que nos vamos a conectar, que puede estar dada como una dirección ip o una url (si es un ambiente local puede ser simplemente localhost)
 * el nombre de usuario con el que se va a conectar
 * el password de acceso a la base de datos que debes de mantener seguro en todo momento
 * y la base de datos a la que estás apuntanto, de forma que solo accedas a los datos de una de ellas :D
* */

$servidor = "";
$username = "";
$password = "";
$db = "";

/*
 * Vamos a crear una nueva variable a la que le vamos a asignar una nueva clase de mysql improved
 * que representa una nueva conexión a la base de datos y le pasamos los parametros anteriores
 *
 * */

$connection = new mysqli($servidor, $username, $password, $db);

/*
 * Creamos una condición en la cual si la conexión nos regresa el metodo connect_error
 * matamos el proceso imprimiendo un mensaje de fallo de conexión concatenando el error que nos devuelve
 * el metodo de la clase
*/

if($connection->connect_error){
	die("Conexión fallida ".$connection-> connect_error);
}

/*
 * si la conexión no presenta ningun tipo de problema entonces simplemente imprimimos un mensaje de exito.
*/

echo "Conexión exitosa...";

?>
