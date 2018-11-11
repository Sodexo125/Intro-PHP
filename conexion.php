<?php
//msql=gestor bd, podía ir oracle-postgress entre otros.
$link = 'mysql:host=localhost;dbname=yt_colores';//asignamos a la variable [ Gestor, host, nombre Bd ]
$usuario = 'root';//Credenciales de phpmyadmin
$pass = '';

//hacemos un try y un catch, 
//Si existe la conexion o no hay problemas entra al try sinó entra al catch
try{
    $pdo = new PDO($link,$usuario,$pass);//conexion a la bd
    //echo 'Conectado';
}catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}


?>