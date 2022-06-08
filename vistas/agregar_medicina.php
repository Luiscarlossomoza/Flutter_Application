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
    $consulta = "SELECT  *
    FROM    MEDICINAS AS M
    WHERE   NOT EXISTS
            (
            SELECT  NULL
            FROM    MEDICINAS_TRATAMIENTO MT
            WHERE   MT.cod_medicinas = M.cod_medicinas
            AND MT.cod_tratamiento = '$cod_tratamiento'
            )";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    if(isset($_POST['pacientes'])){
        $medicina_elegida = $_POST['pacientes'];
        $periocidad = $_POST['PERIOCIDAD'];
        $fecha_consumo = $_POST['fecha_consumo'];
        $cantidad_recomendada = $_POST['cantidad_recomendada'];
        $query = "INSERT INTO MEDICINAS_TRATAMIENTO (cod_tratamiento, cod_medicinas,PERIOCIDAD,fecha_consumo,cantidad_recomendada) VALUES ('$cod_tratamiento','$medicina_elegida','$periocidad ','$fecha_consumo','$cantidad_recomendada')";
        $resultado = $conexion->prepare($query);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        header('Location: ../vistas/crear_tratamiento_doctor.php?id='. $id . "&flag=". $flag."&cod_paciente=".$cod_paciente."&cod_tratamiento=".$cod_tratamiento);
        exit();
    }

?>
<div class="container">
    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
        <div class="row caja">
            <div class="col-lg-12">
                <div class="jumbotron">
                    <select name="pacientes" class="form-control">
                        <option value="0">Seleccione la medicina:</option>
                        <?php foreach($data as $dat) {?>
                            <option value="<?php echo $dat['cod_medicinas']?>"><?php echo $dat['cod_medicinas']?></option>
                        <?php } ?>
                    </select>
                    <div class="mb-3">
                        <label for="PERIOCIDAD" class="form-label">Ingrese la periodicidad con la que debe tomar la medicina:</label>
                        <input type="text" class="form-control" name="PERIOCIDAD" placeholder="Periodicidad">                    
                    </div>
                    <div class="mb-3">
                        <label for="fecha_consumo" class="form-label">Ingrese la hora a la que debe tomar la medicina:</label>
                        <input type="time" class="form-control" name="fecha_consumo" placeholder="Hora">                    
                    </div>
                    <div class="mb-3">
                        <label for="cantidad_recomendada" class="form-label">Ingrese la cantidad de comida que el paciente debe tomar:</label>
                        <input type="number" class="form-control" name="cantidad_recomendada" placeholder="Cantidad">                    
                    </div>
                    <input type="submit" value="contestar">
                </div>
            </div>
        </div> 
    </form>
</div>
<?php require_once "../vistas/parte_inferior.php" ?>
