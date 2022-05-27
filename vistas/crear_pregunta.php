<?php require "../bd/conexion.php" ?>
<?php
    $idFormulario = $_GET['id']; 
    $pregunta = $_GET['p'];
    $consulta = "SELECT MAX(num_pregunta) AS numero FROM PREGUNTA WHERE cod_formulario = '$idFormulario'";
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    //echo 'El numero es:'.$data[0]['numero'];
    //print_r($data);
    $flag = 0;
    $enunciado = '';
    $respuesta = '';
    $tipo_respuesta = '';

    if($data[0]['numero'] === NULL ){
        $numeroPregunta = 1;
    }else{
        $numeroPregunta = $data[0]['numero']+1;
    }
    
    if(isset($_POST['crearRegistro'])){
        if(isset($_POST['tipoPregunta'])){
            $tipo_respuesta =  $_POST['tipoPregunta'];
            echo $tipo_respuesta;
            echo "<br>";
        }else{
            echo "SELECCIONE UN TIPO DE PREGUNTA";
            echo "<br>";
        }
        
        if($numeroPregunta == 1){
            //echo "Entrando a crear Registro";
            $enunciado = $_POST['enunciado'];
           // echo "<br>";
            //echo "Enunciado: " . $enunciado;
           // echo "<br>";
           // echo "Tipo: ".$tipo_respuesta;
            $consulta = "INSERT INTO PREGUNTA (cod_formulario,num_pregunta,enunciado,respuesta,tipo_respuesta) VALUES ('$idFormulario',1,'$enunciado',NULL,'$tipo_respuesta')";
            $resultado4 = $conexion->prepare($consulta);
            $resultado4->execute();
            $data4=$resultado4->fetchAll(PDO::FETCH_ASSOC);
            //print_r($data4);
            $flag = '1';
            header("Location: ../vistas/crear_formulario.php?id=".$idFormulario."&flag=".$flag."&p=".$pregunta);
            exit();
        }else{
            $enunciado = $_POST['enunciado'];
            $consulta = "INSERT INTO PREGUNTA (cod_formulario,num_pregunta,enunciado,respuesta,tipo_respuesta) VALUES ('$idFormulario','$numeroPregunta','$enunciado',NULL,'$tipo_respuesta')";
            $resultado4 = $conexion->prepare($consulta);
            $resultado4->execute();
            $data4=$resultado4->fetchAll(PDO::FETCH_ASSOC);
            print_r($data4);
            $flag = '1';
            header("Location: ../vistas/crear_formulario.php?id=".$idFormulario."&flag=".$flag."&p=".$pregunta);
            exit();
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
                    <label for="enunciado" class="form-label">enunciado:</label>
                    <input type="text" class="form-control" name="enunciado" placeholder="Ingresa el enunciado">                    
                </div>

                <div class="mb-3">
                    <!--                    
                    <label for="tipo_respuesta" class="form-label">tipo_respuesta:</label>
                    <input type="text" class="form-control" name="tipo_respuesta" placeholder="Ingresa el tipo_respuesta">  
                    -->           
                    <select name="tipoPregunta" class="form-control">
                        <option value="0">Seleccione el tipo de pregunta:</option>
                            <option value="email">email</option>
                            <option value="number">number</option>
                            <option value="tel">tel</option>
                            <option value="text">text</option>
                            <option value="date">date</option>
                            <option value="color">color</option>
                            <option value="muestra">muestra de sangre</option>
                    </select>    
                </div>
              
                <button type="submit" class="btn btn-primary w-100" name="crearRegistro">Crear Registro</button>

                </form>
            </div>
        </div>
    </div>
  </body>
</html>