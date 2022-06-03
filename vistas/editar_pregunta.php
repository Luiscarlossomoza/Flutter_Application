<?php 
ob_start();
session_start(); 
?>
<?php require_once "../vistas/parte_superior_admin.php" ?>
<?php  

    $idPregunta = $_GET['id'];
    $idFormulario = $_GET['f'];
    $data3 = [];
    $vacio = 0;
    $consulta = "SELECT * FROM PREGUNTA AS P  WHERE P.cod_formulario = '$idFormulario' AND P.num_pregunta = '$idPregunta'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    print_r($data);
    $cantidad_elementos = count($data);
    echo "CANTIDAD: " . $cantidad_elementos;

    $consulta2 = "SELECT * FROM FORMULARIO WHERE cod_formulario = '$idFormulario'";
    $resultado3 = $conexion->prepare( $consulta2);
    $resultado3->execute();
    $data3=$resultado3->fetchAll(PDO::FETCH_ASSOC);
    $doctor = $data3[0]['cod_doctor'];

    if(isset($_POST['crearRegistro'])){
        $enunciado = $_POST['enunciado'];
        $actualizar = "UPDATE PREGUNTA SET enunciado = '$enunciado' WHERE cod_formulario = $idFormulario AND num_pregunta = '$idPregunta'";
        $resultado2 = $conexion->prepare($actualizar);
        $resultado2->execute();
        header('Location: ../vistas/editar_formulario.php?id='.$doctor."&f=".$idFormulario);
        exit();
    }
?>

<div class="container">
    
    <div class="row">
        <h4 class="text-center">Editar pregunta</h4>
    </div>  
    <div class="row caja">
        <div class="col-lg-12">
            <div class="jumbotron">
                <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                    <?php foreach($data as $dat) {?>

                        <div class="mb-3">
                            <input type="text" class="form-control" name="enunciado" placeholder="Ingresa el enunciado" value="<?php echo $dat['enunciado']; ?>">                    
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="crearRegistro">Finalizar</button>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>   
</div>
<?php require_once "../vistas/parte_inferior.php" ?>