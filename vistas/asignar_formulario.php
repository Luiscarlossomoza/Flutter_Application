<?php 
ob_start();
session_start(); 
?>
<?php require "../bd/conexion.php" ?>
<?php require_once "../vistas/parte_superior_admin.php" ?>
<?php
    $aux = $_GET['id'];
    $aux2 = $_GET['f'];
    $consulta = "CALL Buscar_pacientes_doctor_sin_formulario('$aux','$aux2')";
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    if(isset($_POST['pacientes'])){
        $paciente_elegido = $_POST['pacientes'];
        $query = "INSERT INTO PACIENTE_FORMULARIO(cod_formulario,cod_paciente) VALUES ('$aux2',' $paciente_elegido')";
        $resultado = $conexion->prepare($query);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        header('Location: ../vistas/dashboard_prueba.php');
        exit();
    }

?>
<div class="container">
    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
        <div class="row caja">
            <div class="col-lg-12">
                <div class="jumbotron">
                    <select name="pacientes" class="form-control">
                        <option value="0">Seleccione paciente:</option>
                        <?php foreach($data as $dat) {?>
                            <option value="<?php echo $dat['cp'];?>"><?php echo $dat['np'] . "Codigo: " . $dat['cp'];?></option>
                        <?php } ?>
                    </select>
                    <input type="submit" value="contestar">
                </div>
            </div>
        </div> 
    </form>
</div>

<?php require_once "../vistas/parte_inferior.php" ?>