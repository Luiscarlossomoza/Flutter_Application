<?php 
ob_start();
session_start(); 
?>
<?php require_once "../vistas/parte_superior_admin.php" ?>
<?php 
    $idFormulario = 0;
    if(isset($_GET['id'])){
        $idFormulario = $_GET['id'];
    }else{
        echo "ERROR EN ENVIO";
    }
    $consulta = "CALL buscar_respuesta_formulario($idFormulario)";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    print_r($data);
    if(isset($_POST['crearRegistro'])){
        header("Location: ../vistas/dashboard_prueba.php");
        exit();
    }
?>
<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link href="../css/estilos.css" rel="stylesheet">

    <title>CRUD PHP Y MYSQL</title>
  </head>
  <body>

    <div class="container">
        <div class="row caja">
            <div class="col-lg-12">
                <div class="jumbotron">
                    <?php foreach($data as $dat) {?>
                        <div class="mb-3">
                            <label for="" class="form-label"><?php echo $dat['enunciado']; ?></label>
                            <input type="text" class="form-control" name="" placeholder="<?php echo $dat['respuesta']; ?>" readonly>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                <button type="submit" class="btn btn-primary btn-block" name="crearRegistro">Finalizar</button>
            </form>
        </div>
    </div>    

<?php require_once "../vistas/parte_inferior.php" ?>