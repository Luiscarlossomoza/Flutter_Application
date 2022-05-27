<?php
    //Incluimos conexión
    include '../bd/conexion.php';

    //Obtener el id enviado de index
    $idPregunta = $_GET['id'];
    $idFormulario = $_GET['f'];
    //Seleccionar datos
    $consulta = "SELECT * FROM PREGUNTA WHERE cod_formulario = '$idFormulario' AND num_pregunta = '$idPregunta'";
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    $resultado = $conexion->prepare( $consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

    $consulta2 = "SELECT * FROM FORMULARIO WHERE cod_formulario = '$idFormulario'";
    $resultado2 = $conexion->prepare( $consulta2);
    $resultado2->execute();
    $data2=$resultado2->fetchAll(PDO::FETCH_ASSOC);
    $doctor = $data2[0]['cod_doctor'];
    if(isset($_POST['borrarRegistro'])){        
        $query = "DELETE FROM PREGUNTA WHERE cod_formulario = '$idFormulario' AND num_pregunta = '$idPregunta'";
        $resultado = $conexion->prepare($query);
        $resultado->execute();
        header('Location: ../vistas/editar_formulario.php?id='.$doctor."&f=".$idFormulario);
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

    <link href="css/estilos.css" rel="stylesheet">

    <title>CRUD PHP Y MYSQL</title>
  </head>
  <body>
    <h1 class="text-center">CRUD PHP Y MYSQL</h1>
    <p class="text-center">Aprende a realizar las 4 operaciones básicas entre PHP y una base de datos, en este caso MYSQL: CRUD(Create, Read, Update, Delete)</p>

    <div class="container">

    <div class="row">
        <h4>Borrar un Registro Existente</h4>
    </div>


        <div class="row caja">
            <div class="col-sm-6 offset-3">
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                <div class="mb-3">
                    <label for="num_pregunta" class="form-label">num_pregunta:</label>
                    <input type="text" class="form-control" name="num_pregunta" placeholder="Ingresa el num_pregunta" value="<?php echo $data[0]['num_pregunta']; ?>" readonly>                    
                </div>
                
                <div class="mb-3">
                    <label for="enunciado" class="form-label">enunciado:</label>
                    <input type="text" class="form-control" name="enunciado" placeholder="Ingresa el enunciado" value="<?php echo $data[0]['enunciado']; ?>" readonly>                    
                </div>
              
                <button type="submit" class="btn btn-primary w-100" name="borrarRegistro">Borrar Registro</button>

                </form>
            </div>
        </div>
    </div>
  </body>
</html>