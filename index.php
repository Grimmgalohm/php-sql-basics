<?php
include_once 'db.php';
/*
 * En este ejercicio tomamos los conceptos básicos de una conexión a una base de datos sql
 * y los metodos más comunes con los que trabajamos en datos que son
 * crear un nuevo elemento en la tabla, modificar o actualizar el elemento
 * y borrar o eliminar el elemento de la tabla de bases de datos
 *
 * este ejercicio está hecho con fines educativos unicamente por lo que los metodos usados
 * pueden no ser los más correctos para una aplicacion en ambientes de producción por temas
 * de seguridad o simplemente de codigo.
 *
 * Entiendase como una simple practica :D
 *
 * */

?>

<form action="index.php" method="POST">
<input type="text" name="texto" placeholder="Nombre de la pizza">
<input type="submit">
</form>

<?php

if(isset($_POST['texto'])){ //Comprobamos que el input del form con metodo post contenga texto o el valor requerido.

	$texto = $_POST['texto']; //Asignamos ese texto a una variable con la que vamos a trabajar

	$sql = "INSERT INTO pizzas.pizzas (especialidad, is_avilable) value ('$texto', 0)";

	//Le pasamos la instrución de sql como parametro al metodo query
	//y evaluamos si el resultado que nos retorna es verdadero
	
	if($connection->query($sql) === true){

		//imprimimos el texto del input por ahora

		echo "<div>Insertado con éxito.</div>";
		
	}else{
		//En caso de que algo salga mal mandamos un mensaje de error
		die("Error al conectarse: ".$connection->error);
	}

}else if(isset($_POST['completar'])){ //validamos que exista un metodo post llamado completar.
	$id = $_POST['completar'];
	$sql = "UPDATE pizzas.pizzas SET is_avilable = 0 WHERE idpizzas = $id";

	if($connection->query($sql) === true){

	}else{
		die("Error al actualizar los datos: ".$connection->error);
	}
}else if(isset($_POST['eliminar'])){
	$id = $_POST['eliminar'];
	$sql = "DELETE FROM pizzas.pizzas WHERE idpizzas = $id";

	if($connection->query($sql) === true){

	}else{
		die("Error al eliminar los datos: ".$connection->error);
	}
}

$sql = "SELECT * FROM pizzas.pizzas WHERE is_avilable = 1";//la instrucción en sql para la consulta

$result = $connection->query($sql); //se almacena la respuesta de la peticion en la variable result

if($result->num_rows > 0){ //si el numero de filas de la respuesta es inexistente o igual a cero

	while($row = $result->fetch_assoc()){ //se asigna el objeto del resultado 

?>
<div>
	<form method="POST" id="form-<?php echo $row['idpizzas']; ?>" action="">
		<li><input name="completar" value="<?php echo $row['idpizzas']; ?>" id="<?php echo $row['idpizzas']; ?>" type="checkbox" onchange="completarPendiente(this)"> <?php echo $row['especialidad']; ?></li>
	</form>

	<form method="POST" id="delete_<?php $row['idpizzas']; ?>" action="index.php">
		<input type="hidden" name="eliminar" value="<?php echo $row['idpizzas']; ?>">
		<input type="submit" value="eliminar">    
	</form>
</div>
<?php

		//echo '<li><input type="checkbox"> '.$row['especialidad'].'</li>';

	}

}
?>
<script>

function completarPendiente(e){
	let id = "form-"+e.id;
	let formulario = document.getElementById(id);
	formulario.submit();
}

</script>
