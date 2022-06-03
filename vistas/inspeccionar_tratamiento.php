<?php session_start(); ?>
<?php require_once "../vistas/parte_superior.php" ?>
<?php 
            $aux = $_SESSION['s_usuario'];
            $consulta = "SELECT * FROM PACIENTE AS P, USUARIO AS U WHERE P.cod_usuario = U.cod_usuario AND U.cod_usuario = '$aux'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            print_r( $data);
            echo "<br>";
            $idPaciente = $data[0]['cod_paciente'];
            $tratamientos = "CALL Buscar_tratamientos_paciente_sin_doctor(' $idPaciente ');";
            $resultado = $conexion->prepare($tratamientos);
            echo "<br>";
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container">

        <div class="row caja">
            <div class="col-sm-12">
                <table id="tablaPaciente" class="table table-striped table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Codigo Tratamiento</th>
                            <th>Descripcion</th>
                            <th>Doctor</th>
                            <th>Verificado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $dat){ ?>
                            <tr>
                                <td><?php echo $dat['cod_tratamiento'] ?></td>
                                <td><?php echo $dat['desc_tratamiento'] ?></td>
                                <td><?php echo $dat['cod_doctor'] ?></td>
                                <td class="text-center">
                                    <a href=<?php if($dat['contestado'] == 0){echo "../vistas/revisar_tratamiento_paciente.php?id=".$dat['cod_tratamiento'];}else{echo "../vistas/inspeccionar_tratamiento.php";} ?> class="<?php if($dat['contestado'] == 0){echo "btn btn-primary";}else{echo "btn btn-success";} ?>"> <?php if($dat['contestado'] == 0){echo "REVISAR";}else{echo "LISTO";} ?> </a>
                                </td>
                                </tr>
                        
                        <?php } ?>
                    </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once "../vistas/parte_inferior.php" ?>