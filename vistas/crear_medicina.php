<?php 
ob_start();
session_start(); 
?>
<?php require_once "../vistas/parte_superior_admin.php" ?>
<?php 
        $idDoctor = $_GET['id'];
        if(isset($_POST['crearRegistro'])){
            $nombre = $_POST['nombre_medicina'];
            $descripcion = $_POST['desc_medicina'];
            $consulta = "INSERT INTO MEDICINAS (nombre_medicina,desc_medicina,cod_doctor) VALUES ('$nombre','$descripcion','$idDoctor')";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            header('Location: ../vistas/medicinas_doctor.php?id='.$idDoctor);
            exit();
        }
?>
<div class="container">

        <div class="row">
            <h4 class="text-center">Crear nueva medicina</h4>
        </div>   

        <div class="row caja">

            <div class="col-sm-6 offset-3">
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                <div class="mb-3">
                    <label for="nombre_medicina" class="form-label">nombre_medicina:</label>
                    <input type="text" class="form-control" name="nombre_medicina" placeholder="Ingresa el nombre_medicina">                    
                </div>
                <div class="mb-3">
                    <label for="desc_medicina" class="form-label">desc_medicina:</label>
                    <input type="text" class="form-control" name="desc_medicina" placeholder="Ingresa el desc_medicina">                    
                </div>
                <button type="submit" class="btn btn-primary w-100" name="crearRegistro">Crear Registro</button>

                </form>
            </div>
        </div>
    </div>
<?php require_once "../vistas/parte_inferior.php" ?>