<?php session_start(); ?>
<?php require "../bd/conexion.php" ?>
<?php require_once "../vistas/parte_superior.php" ?>
<?php 
            $aux = $_SESSION['s_usuario'];
            $consulta = "SELECT * FROM PACIENTE_FORMULARIO WHERE cod_paciente = '$aux'";
            $objeto = new Conexion();
            $conexion = $objeto->Conectar();
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="d-flex justify-content-center">
                <h1 class="text-center align-middle"> BIENVENIDO PACIENTE </h1>
</div>

<?php require_once "../vistas/parte_inferior.php" ?>
           