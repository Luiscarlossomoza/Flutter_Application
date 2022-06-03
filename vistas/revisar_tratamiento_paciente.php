<?php ob_start();session_start(); ?>
<?php require_once "../vistas/parte_superior.php" ?>
<?php 
    $idTratamiento = $_GET['id'];
    $dataMedicina = [];
    $dataComida = [];
    $extraerComida = "CALL Buscar_comidas_tratamiento('$idTratamiento')";
    $resultado = $conexion->prepare( $extraerComida );
    $resultado->execute();
    $dataComida = $resultado->fetchAll(PDO::FETCH_ASSOC);
    $extraerMedicina = "CALL Buscar_medicinas_tratamiento('$idTratamiento')";
    $resultado = $conexion->prepare( $extraerMedicina );
    $resultado->execute();
    $dataMedicina = $resultado->fetchAll(PDO::FETCH_ASSOC);
    if(isset($_POST['crearRegistro'])){
        $muestra = $_POST['muestra'];
        $fecha_muestra = date("Y-m-d H:i:s");    
        if(!empty($_POST['medicinas_list'])){
            foreach ($_POST['medicinas_list'] as $selected){
               
               $actualizarMedicina = "UPDATE MEDICINAS_TRATAMIENTO SET consumido = 1 WHERE cod_tratamiento = '$idTratamiento' AND cod_medicinas = '$selected'";
               $resultado = $conexion->prepare( $actualizarMedicina );
               $resultado->execute();
               echo $actualizarMedicina;
               echo "<br>";
            }
        }
        if(!empty($_POST['check_list'])){
            foreach ($_POST['check_list'] as $selected){
                $actualizarComida = "UPDATE COMIDAS SET consumido = 1 WHERE cod_tratamiento = '$idTratamiento' AND cod_comida = '$selected'";
                $resultado = $conexion->prepare( $actualizarComida );
                $resultado->execute();
                echo $actualizarComida;
                echo "<br>";
  
            }
        }
        $actualizarTratamiento = "UPDATE TRATAMIENTO SET contestado = 1, muestra = '$muestra',fecha_muestra = '$fecha_muestra'  WHERE cod_tratamiento = '$idTratamiento'";
        $resultado = $conexion->prepare(  $actualizarTratamiento );
        $resultado->execute();
        header("Location: ../vistas/inspeccionar_tratamiento.php");
        exit();
        ob_end_flush();
    }
?>
<div class="container">
    
    <div class="row caja">
        <div class="col-lg-12">
            <div class="jumbotron">
                <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                    <h2 class="text-center">REVISION DE MEDICINAS</h2>
                    <?php foreach($dataMedicina as $dat) {?>
                        <label>
                            <input type="checkbox" name="medicinas_list[]" value="<?php echo $dat['cod_medicinas'] ?>"><?php echo "Codigo -- > ".$dat['cod_medicinas']. ">>>>>" . $dat['desc_medicina'] ?></input>
                        </label>
                        <br>
                    <?php } ?>
                    <h2 class="text-center">REVISION DE COMIDAS</h2>
                    <?php foreach($dataComida as $dat) {?>
                        <label>
                            <input type="checkbox" name="check_list[]" value="<?php echo $dat['cod_comida'] ?>"><?php echo "Codigo -- > ".$dat['cod_comida'] . ">>>>>" . $dat['desc_comida']?></input>
                        </label>
                        <br>
                    <?php } ?>
                    <div class="mb-3">
                        <label for="muestra" class="form-label">Ingrese la muestra de sangre</label>
                        <input type="number" class="form-control" name="muestra" placeholder="">                    
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="crearRegistro">Finalizar</button>
                </form>
            </div>
        </div>
    </div>   
</div>
<?php require_once "../vistas/parte_inferior.php" ?>