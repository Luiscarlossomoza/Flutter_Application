<?php 
ob_start();
session_start(); 
?>
<?php require_once "../vistas/parte_superior_admin.php" ?>
<?php 
    
    $cod_tratamiento = $_GET['cod_tratamiento'];
    $id = $_GET['id'];
    $flag = $_GET['flag'];
    $cod_paciente = $_GET['cod_paciente'];
    if(isset($_GET['np'])){
        $cod_comida = $_GET['np'];
        echo $cod_comida;
    }else{
        echo "PRIMERA COMIDA";
    }
    if(isset($_POST['crearRegistro'])){
        $desc_comida = $_POST['desc_comida'];
        $tipo_comida = $_POST['tipo_comida'];
        $periocidad = $_POST['PERIOCIDAD'];
        $fecha_consumo = $_POST['fecha_consumo'];
        $consulta = "INSERT INTO COMIDAS(cod_tratamiento,cod_comida,desc_comida,tipo_comida,PERIOCIDAD,fecha_consumo) VALUES ('$cod_tratamiento', '$cod_comida','$desc_comida','$tipo_comida','$periocidad ','$fecha_consumo')";
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        header("Location: ../vistas/crear_tratamiento_doctor.php?id=". $id . "&flag=". $flag."&cod_paciente=".$cod_paciente."&cod_tratamiento=".$cod_tratamiento."&np=".$cod_comida);
        exit();
    }
?>
<div class="container">

<div class="row">
    <h4 class="text-center">Crear comida a tratamiento</h4>
</div>   

<div class="row caja">

    <div class="col-sm-6 offset-3">
    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
        <div class="mb-3">
            <label for="desc_comida" class="form-label">desc_comida:</label>
            <input type="text" class="form-control" name="desc_comida" placeholder="Ingresa la comida">                    
        </div>
        <div class="mb-3">
            <label for="tipo_comida" class="form-label">tipo_comida:</label>
            <input type="text" class="form-control" name="tipo_comida" placeholder="Ingresa el tipo_comida">                    
        </div>
        <div class="mb-3">
            <label for="PERIOCIDAD" class="form-label">Periocidad:</label>
            <input type="text" class="form-control" name="PERIOCIDAD" placeholder="Ingresa PERIOCIDAD">                    
        </div>
        <div class="mb-3">
            <label for="fecha_consumo" class="form-label">fecha_consumo:</label>
            <input type="time" class="form-control" name="fecha_consumo" placeholder="Ingresa la hora a la que debe tomar la medicina">                    
        </div>
        <button type="submit" class="btn btn-primary w-100" name="crearRegistro">Crear Registro</button>

        </form>
    </div>
</div>
</div>
<?php require_once "../vistas/parte_inferior.php" ?>
