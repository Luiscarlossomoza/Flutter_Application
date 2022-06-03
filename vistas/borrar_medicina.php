<?php 
ob_start();
session_start(); 
?>
<?php require_once "../vistas/parte_superior_admin.php" ?>
<?php 
    $idMedicina = $_GET['id'];
    $idDoctor = $_GET['doctor'];
    $consulta = "SELECT * FROM MEDICINAS WHERE cod_medicinas = '$idMedicina'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

    if(isset($_POST['crearRegistro'])){
        $borrar = "DELETE FROM MEDICINAS WHERE cod_medicinas = '$idMedicina'";
        $resultado2 = $conexion->prepare($borrar);
        $resultado2->execute();
        header('Location: ../vistas/medicinas_doctor.php?id='.$idDoctor);
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
                            <input type="text" class="form-control" name="nombre" placeholder="" value="<?php echo $dat['cod_medicinas']; ?>" readonly>                    
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="nombre" placeholder="" value="<?php echo $dat['nombre_medicina']; ?>" readonly>                    
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="nombre" placeholder="" value="<?php echo $dat['desc_medicina']; ?>" readonly>                    
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="crearRegistro">Finalizar</button>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>   
</div>
<?php require_once "../vistas/parte_inferior.php" ?>