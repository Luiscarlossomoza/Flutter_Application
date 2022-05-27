<?php session_start(); ?>
<?php require "../bd/conexion.php" ?>
<?php require_once "../vistas/parte_superior.php" ?>
<?php
     $aux = $_SESSION['s_usuario'];
     $consulta = "SELECT * FROM PACIENTE_FORMULARIO AS PF, USUARIO AS U, PACIENTE AS P WHERE PF.cod_paciente = P.cod_paciente AND P.cod_usuario = U.cod_usuario AND U.cod_usuario = '$aux'";
     $objeto = new Conexion();
     $conexion = $objeto->Conectar();
     $resultado = $conexion->prepare($consulta);
     $resultado->execute();
     $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
     $paciente = $data[0]['cod_paciente'];
?>
<div class="container">

        <div class="row caja">
            <div class="col-sm-12">
                <table id="tablaPaciente" class="table table-striped table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Codigo</th>
                            <th>contestado</th>
                            <th>fecha contestado</th>
                            <th>ultima muestra</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $dat){ ?>
                            <tr>
                                <td><?php echo $dat['cod_formulario'] ?></td>
                                <td><?php echo $dat['contestado'] ?></td>
                                <td><?php echo $dat['fecha_contestado'] ?></td>
                                <td><?php echo $dat['ultima_muestra'] ?></td>
                                <td class="text-center">
                                    <a href="<?php if($dat['contestado'] == 1){ echo "../vistas/lista_formulario.php";}else{ echo "../vistas/contestar_formulario.php?id=".$paciente."&f=".$dat['cod_formulario'];}?>" class="<?php if($dat['contestado'] == 1){ echo "btn btn-success";}else{ echo "btn btn-primary";}?>"> <?php if($dat['contestado'] == 1){ echo "LISTO";}else{ echo "Contestar";}?> </a>
                                </td>
                            </tr>
                        
                        <?php } ?>
                    </tbody>
            </table>
        </div>
    </div>
</div> 
<?php require_once "../vistas/parte_inferior.php" ?>