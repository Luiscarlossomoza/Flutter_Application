<?php 
ob_start();
session_start(); 
?>
<?php require "../bd/conexion.php" ?>
<?php require_once "../vistas/parte_superior_admin.php" ?>
<?php  
    $idRegistro = $_GET['id']; 
    $idFormulario = '';

    $consulta = "INSERT INTO FORMULARIO(cod_doctor) VALUES($idRegistro)";
    $ultimoInsert = "SELECT MAX(cod_formulario) AS ultimo FROM FORMULARIO";

    //CREAMOS EL NUEVO FORMULARIO
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    
    //BUSCAMOS EL ULTIMO FORMULARIO CREADO 
    $resultado2 = $conexion->prepare( $ultimoInsert);
    $resultado2->execute();
    $data2 = $resultado2->fetchAll(PDO::FETCH_ASSOC);
    $idFormulario = $data2[0]['ultimo'];

    //BUSCAMOS TODAS LAS PREGUNTAS ASOCIADAS A ESE FORMULARIO
    $preguntaFormulario = "SELECT * FROM PREGUNTA WHERE cod_formulario = $idFormulario";
    $resultado3 = $conexion->prepare( $preguntaFormulario);
    $resultado3->execute();
    $data3 =  $resultado3->fetchAll(PDO::FETCH_ASSOC);

    if(isset($_POST['crearRegistro'])){
        if(!isset($archivoActual)){
            header("Location: ../vistas/dashboard_prueba.php");
        }
    }
    if(isset($_POST['crearRegistro']) && !isset($_POST['crearPregunta'])){
        $destruir = "DELETE FROM FORMULARIO WHERE cod_formulario = $idFormulario";
        $resultado4 = $conexion->prepare($consulta);
        $resultado4->execute();
        header("Location: ../vistas/dashboard_prueba.php");
    }
    if(isset($_POST['crearPregunta'])){
        
        header("Location: ../vistas/crear_pregunta.php?id=".$idFormulario);
        ob_end_flush();
    }

    
?>

<div class="container">
    
    <div class="row">
        <h4 class="text-center">Crear un nuevo formulario</h4>
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <button type="submit" class="btn btn-success" name="crearPregunta">Agregar Pregunta</button>
        </form>
    </div>  
    <div class="row caja">
        <div class="col-lg-12">
            <div class="jumbotron">
            <?php foreach($data3 as $dat){ ?>
                            <tr>
                                <td><?php echo $dat['cod_formulario'] ?></td>
                                <td><?php echo $dat['num_pregunta'] ?></td>
                                <td><?php echo $dat['enunciado'] ?></td>
                                <td><?php echo $dat['respuesta'] ?></td>
                                <td><?php echo $dat['tipo_respuesta'] ?></td>
                            </tr>
                        <?php } ?>
            </div>
        </div>
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <button type="submit" class="btn btn-primary btn-block" name="crearRegistro">Finalizar</button>
        </form>
    </div>   
</div>
<?php require_once "../vistas/parte_inferior.php" ?>
           