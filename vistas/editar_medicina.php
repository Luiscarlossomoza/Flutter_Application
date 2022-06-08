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
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $tipo_medicina = $_POST['tipo_medicina'];
        $actualizar = "UPDATE MEDICINAS SET nombre_medicina = '$nombre', desc_medicina = '$descripcion', tipo_medicina = '$tipo_medicina' WHERE cod_medicinas = '$idMedicina'";
        $resultado2 = $conexion->prepare($actualizar);
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
                            <input type="text" class="form-control" name="nombre" placeholder="" value="<?php echo $dat['nombre_medicina']; ?>">                    
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="descripcion" placeholder="" value="<?php echo $dat['desc_medicina']; ?>">                    
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="tipo_medicina" placeholder="" value="<?php echo $dat['tipo_medicina']; ?>">                    
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="crearRegistro">Finalizar</button>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>   
</div>
<?php require_once "../vistas/parte_inferior.php" ?>