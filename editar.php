<?php

//echo'editar.php?id=1&color=success&descripcion=este es un color verde'; echo '<br>';

$id = $_GET['id'];
$color = $_GET['color'];
$descripcion = $_GET['descripcion']; 

echo $id; echo '<br>';
echo $color; echo '<br>';
echo $descripcion; echo '<br>';

//#1 Llamamos la conexion.
//#2 Creamos la sentencia update en la tabla y campos respectivos señalando where id.
//#3 Preparamos la Sentencia con la variable que defina la BD, en este caso PDO en el archivo conexion. 
//#4 Ejecutamos la sentencia SQL ya preparada.
include_once 'conexion.php';
$sql_editar = 'UPDATE colores SET color=?, descripcion=? WHERE id=?'; //El WHERE es super importante, sinó esta, esta sentencia cambiará todos los campos del los registros en la tabla colores.
$sentencia_editar = $pdo->prepare($sql_editar);
$sentencia_editar->execute(array($color,$descripcion,$id));

header('location:index.php');
?>