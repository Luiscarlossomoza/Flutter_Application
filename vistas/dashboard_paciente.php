<?php session_start(); ?>
<?php require_once "../vistas/parte_superior.php" ?>
<?php 
            $aux = $_SESSION['s_usuario'];
            $consulta = "SELECT * FROM PACIENTE_FORMULARIO WHERE cod_paciente = '$aux'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

            $consultaPaciente = "SELECT P.* FROM PACIENTE AS P, USUARIO AS U WHERE U.cod_usuario = '$aux' AND P.cod_usuario = U.cod_usuario";
            $resultado2 = $conexion->prepare( $consultaPaciente);
            $resultado2->execute();
            $data2=$resultado2->fetchAll(PDO::FETCH_ASSOC);
            $nombrePaciente = $data2[0]['nombre_paciente'];
?>
<div class="d-flex justify-content-center">
                <h1 class="text-center align-middle"> <?php echo "Bienvenido " .$nombrePaciente ?></h1>
</div>

<?php require_once "../vistas/parte_inferior.php" ?>
           