<?php session_start(); ?>
<?php require_once "../vistas/parte_superior_admin.php" ?>
<?php 
            $aux = $_SESSION['s_usuario'];
            $consulta = "CALL buscar_formularios_contestados_doctor($aux)";
 
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            
?>
<div class="container">

        <div class="row caja">
            <div class="col-sm-12">
                <table id="tablaPaciente" class="table table-striped table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Codigo formulario</th>
                            <th>Paciente</th>
                            <th>Fecha contestado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $dat){ ?>
                            <tr>
                                <td><?php echo $dat['cod_formulario'] ?></td>
                                <td><?php 
                                    $paciente = $dat['cod_paciente'];
                                    $consultaPaciente = "SELECT * FROM PACIENTE WHERE cod_paciente = '$paciente'";
                                    $resultado = $conexion->prepare($consultaPaciente);
                                    $resultado->execute();
                                    $dataPaciente=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                    echo $dataPaciente[0]['nombre_paciente'];
                                ?></td>
                                <td><?php echo $dat['fecha_contestado'] ?></td>
                                <td class="text-center">
                                    <a href="../vistas/revisar_respuestas.php?id=<?php echo $dat['cod_formulario'] ?>" class="btn btn-primary"> Revisar </a>
                            </tr>
                        
                        <?php } ?>
                    </tbody>
            </table>
        </div>
    </div>
</div>


<?php require_once "../vistas/parte_inferior.php" ?>
           