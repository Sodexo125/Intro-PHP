<?php 
include_once 'conexion.php'; //incluimos la conxion.

//LEER
$sql_leer = 'SELECT * FROM colores';//sql_leer guarda la sentencia sql.
$gsent = $pdo->prepare($sql_leer);//llamamos pdo de conexion.php y preparamos la sentencia.
$gsent ->execute();//ejecutamos la sentencia sqlo cualquier query.
$resultado = $gsent->fetchAll();
//var_dump($resultado);


//AGREGAR
if($_POST){
   //echo $_POST['color'];
   $color = $_POST['color'];//optenemos valores el form 
   $descripcion =$_POST['descripcion'];//optenemos valores el form

   $sql_agregar = 'INSERT INTO colores(color,descripcion) VALUES (?,?)';//los signos de interrogación es por parámetros de segurida. a la hora del execute hay que trabajarlos en Array.
   $sentencia_agregar = $pdo->prepare($sql_agregar);
   $sentencia_agregar->execute(array($color,$descripcion));
   
   header('location:index.php');
}

if($_GET){
    //capturamos el id desde el foreach El cual lo acciona el icono del lapiz
    $id = $_GET['id'];
    $sql_unico = 'SELECT * FROM colores WHERE id=?';//seleccionamos toda la informacion de la tabla mientra el registro coincida con el id que capturamos por GET 
    $gsent_unico = $pdo->prepare($sql_unico);//Preparamos la sentencia con el pod de la db
    $gsent_unico->execute(Array($id));//CREAMOS EL ARRAY, para ejecutar gsent_unico debemos enviar el parametro  que se enlistó en $sql_unico 
    $resultado_unico =$gsent_unico->fetch();//Cambiamos fetchAll() por fetch debido a que solo necesitamos el el id y los registros de ella.
    //var_dump ($resultado_unico);
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <title>Intro PHP lml</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <!--Cajas de Colores Precargadas-->
            <div class="col-md-6">
                <?php foreach($resultado as  $dato):  ?><!--Los dos puntos : indica que la sentencia php queda abierta, se cierra hasta el end-->
                    <div class="alert alert-<?php echo $dato['color'] ?> text-uppercase" role="alert">
                        <?php echo $dato['color'] ?>
                        <?php echo $dato['descripcion'] ?>

                        <a href="eliminar.php?id=<?php echo $dato['id'] ?>" class="float-right ml-3"><!--agregamos en la ruta url el id-->
                            <i class="far fa-trash-alt"></i>
                        </a>  

                        <a href="index.php?id=<?php echo $dato['id'] ?>" class="float-right"><!--agregamos en la ruta url el id-->
                            <i class="fas fa-pencil-alt"></i>
                        </a>

                              

                    </div>
                <?php endforeach ?>
            </div>

            <!--Agregar nuevo item-->
            <?php if(!$_GET) : ?>
                <div class="col-md-6">
                    <h2>AGREGAR ELEMENOS</h2>
                    <form method="POST">
                        <input type="text" class="form-control" name="color">
                        <input type="text" class="form-control mt-3" name="descripcion">
                        <button class="btn btn-success mt-3">AGREGAR</button>
                    </form>
                </div>
            <?php endif ?> 

            <!--Modificar item-->
            <?php if($_GET): ?>
                <div class="col-md-6">  
                    <h2>EDITAR ELEMENOS</h2>
                    <form method="GET" action="editar.php">
                        <input type="text" class="form-control" name="color" value="<?php echo $resultado_unico['color']?>" >
                        <input type="text" class="form-control mt-3" name="descripcion" value="<?php echo $resultado_unico['descripcion']?>" >
                        <input type="hidden" name="id" value="<?php echo $resultado_unico['id']?>" >
                        <button class="btn btn-warning mt-3">EDITAR</button>
                    </form>
                </div>
            <?php endif ?>   

        </div><!--row-->
    </div><!--end container-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>

</html>
