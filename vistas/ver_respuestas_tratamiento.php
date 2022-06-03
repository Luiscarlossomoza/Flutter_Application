<?php 
ob_start();
session_start(); 
?>
<?php require_once "../vistas/parte_superior_admin.php" ?>
<?php 
    $cod_tratamiento = $_GET['cod_tratamiento'];
    $consulta = "CALL Buscar_comidas_tratamiento('$cod_tratamiento')";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $dataComida=$resultado->fetchAll(PDO::FETCH_ASSOC);
    $consulta = "CALL Buscar_medicinas_tratamiento('$cod_tratamiento')";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $dataMedicina=$resultado->fetchAll(PDO::FETCH_ASSOC);
    $muestrasangre = "SELECT muestra, fecha_muestra FROM TRATAMIENTO WHERE cod_tratamiento = '$cod_tratamiento'";
    $resultado = $conexion->prepare($muestrasangre);
    $resultado->execute();
    $dataSangre=$resultado->fetchAll(PDO::FETCH_ASSOC);
    echo "<br>";
    if(isset($_POST['crearRegistro'])){
        header("Location: ../vistas/revisar_tratamiento_doctor.php");
        exit();
    }
?>
<div class="container">
    
    <div class="row caja">
        <div class="col-lg-12">
            <div class="jumbotron">
                <h4 class="text-center">Comidas</h4>
                <?php foreach($dataComida as $dat){ ?>
                    <div class="mb-3">
                        <label for="" class="form-label"><?php if($dat['consumido'] == 1){
                            echo  "nombre de comida --> ".$dat['desc_comida'].' ' .
                            "<svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' fill='currentColor' class='bi bi-check' viewBox='0 0 16 16'>
                        <path d='M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z'/>
                        </svg>";
                        }else{echo "nombre de comida --> ".$dat['desc_comida'].' '."<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-x-circle-fill' viewBox='0 0 16 16'>
                            <path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z'/>
                        </svg>";} ?>
                        </label>       
                        <hr>           
                    </div>
                <?php } ?>
                <h4 class="text-center">Medicinas</h4>
                <?php foreach($dataMedicina as $dat){ ?>
                    <div class="mb-3">
                        <label for="" class="form-label"><?php if($dat['consumido'] == 1){
                            echo "nombre de la medicina --> ".$dat['nombre_medicina'].
                            "<svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' fill='currentColor' class='bi bi-check' viewBox='0 0 16 16'>
                        <path d='M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z'/>
                        </svg>";
                        }else{echo "nombre de la medicina --> ".$dat['nombre_medicina']."<svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' fill='currentColor' class='bi bi-x-circle-fill' viewBox='0 0 16 16'>
                            <path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z'/>
                        </svg>";} ?>
                        </label>   
                        <hr>                   
                    </div>
                <?php } ?>
                <h4 class="text-center">Muestra de sangre</h4>
                <div class="mb-3">
                        <label for="muestra" class="form-label">Muestra de sangre</label>
                        <input type="number" class="form-control" name="muestra" placeholder="" value="<?php echo $dataSangre[0]['muestra']?>" readonly>                    
                </div>
            </div>
        </div>
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <button type="submit" class="btn btn-primary btn-block" name="crearRegistro">Finalizar</button>
        </form>
    </div>   
</div>
<?php require_once "../vistas/parte_inferior.php" ?>