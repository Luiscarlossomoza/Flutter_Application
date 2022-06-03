<?php 
ob_start();
session_start(); 
?>
<?php require_once "../vistas/parte_superior_admin.php" ?>
<?php 
    $idTratamiento = $_GET['cod_tratamiento'];
    $consulta = "SELECT * FROM TRATAMIENTO WHERE cod_tratamiento = '$idTratamiento'";
    $resultado = $conexion->prepare( $consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    if(isset($_POST['borrarRegistro'])){        
        $query = "DELETE FROM TRATAMIENTO WHERE cod_tratamiento = '$idTratamiento'";
        $resultado = $conexion->prepare($query);
        $resultado->execute();
        header('Location: ../vistas/revisar_tratamiento_doctor.php');
        exit();
    }   
?>
<div class="container">

        <div class="row">
            <h4 class="text-center">Borrar un Registro Existente</h4>
        </div>


        <div class="row caja">
            <div class="col-sm-6 offset-3">
                <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                    <div class="mb-3">
                        <label for="num_pregunta" class="form-label">cod_tratamiento:</label>
                        <input type="text" class="form-control" name="num_pregunta" placeholder="Ingresa el num_pregunta" value="<?php echo $data[0]['cod_tratamiento']; ?>" readonly>                    
                    </div>
                    
                    <div class="mb-3">
                        <label for="enunciado" class="form-label">desc_tratamiento:</label>
                        <input type="text" class="form-control" name="enunciado" placeholder="Ingresa el enunciado" value="<?php echo $data[0]['desc_tratamiento']; ?>" readonly>                    
                    </div>
                    <div class="mb-3">
                        <label for="enunciado" class="form-label">cod_paciente:</label>
                        <input type="text" class="form-control" name="enunciado" placeholder="Ingresa el enunciado" value="<?php echo $data[0]['cod_paciente']; ?>" readonly>                    
                    </div>
                    <div class="mb-3">
                        <label for="enunciado" class="form-label">muestra:</label>
                        <input type="text" class="form-control" name="enunciado" placeholder="NULO" value="<?php echo $data[0]['muestra']; ?>" readonly>                    
                    </div>
                    <div class="mb-3">
                        <label for="enunciado" class="form-label">fecha_muestra:</label>
                        <input type="text" class="form-control" name="enunciado" placeholder="NULO" value="<?php echo $data[0]['fecha_muestra']; ?>" readonly>                    
                    </div>
                    <div class="mb-3">
                        <label for="enunciado" class="form-label">cod_doctor:</label>
                        <input type="text" class="form-control" name="enunciado" placeholder="Ingresa el enunciado" value="<?php echo $data[0]['cod_doctor']; ?>" readonly>                    
                    </div>
                    <div class="mb-3">
                        <label for="enunciado" class="form-label">contestado:</label>
                        <input type="text" class="form-control" name="enunciado" placeholder="Ingresa el enunciado" value="<?php echo $data[0]['contestado']; ?>" readonly>                    
                    </div>
                    <button type="submit" class="btn btn-primary w-100" name="borrarRegistro">Borrar Registro</button>

                </form>
            </div>
        </div>
</div>
<?php require_once "../vistas/parte_inferior.php" ?>