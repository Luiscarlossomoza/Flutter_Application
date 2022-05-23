<?php require "../bd/conexion.php" ?>
<?php
    $idFormulario = $_GET['id']; 
    $consulta = "SELECT MAX(num_pregunta) AS numero FROM PREGUNTA WHERE cod_formulario = $idFormulario";
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    echo 'El numero es:'.$data[0]['numero'];
    print_r($data);

    $cod_formulario = '';
    $num_pregunta = '';
    $enunciado = '';
    $respuesta = '';
    $tipo_respuesta = '';
    if($data[0]['numero'] === NULL ){
        $numeroPregunta = 1;
    }
    if(isset($_POST['crearRegistro'])){
        if($numeroPregunta == 1){
            //$consulta = 'INSERT'
        }
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

        <div class="row">
            <h4 class="text-center">Crear nueva pregunta</h4>
        </div>   

        <div class="row caja">

            <div class="col-sm-6 offset-3">
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" placeholder="Ingresa el nombre">                    
                </div>
                
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos:</label>
                    <input type="text" class="form-control" name="apellidos" placeholder="Ingresa los apellidos">                    
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Telefono:</label>
                    <input type="number" class="form-control" name="telefono" placeholder="Ingresa el teléfono">                    
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" placeholder="Ingresa el email">                    
                </div>
              
                <button type="submit" class="btn btn-primary w-100" name="crearRegistro">Crear Registro</button>

                </form>
            </div>
        </div>
    </div>
  </body>
</html>