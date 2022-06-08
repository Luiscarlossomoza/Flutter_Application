<?php 
ob_start();
session_start(); 
?>
<?php require_once "../vistas/parte_superior_admin.php" ?>
<?php 
            $aux = $_SESSION['s_usuario'];
            $consulta = "SELECT D.* FROM DOCTOR AS D, USUARIO AS U WHERE U.cod_usuario = '$aux' AND D.cod_usuario = U.cod_usuario";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $dataDoctor=$resultado->fetchAll(PDO::FETCH_ASSOC);
            $idDoctor = $dataDoctor[0]['cod_doctor'];
            $consulta2 = "SELECT * FROM TRATAMIENTO WHERE cod_doctor = '$idDoctor'";
            $resultado = $conexion->prepare($consulta2);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);


?>
<div class="container">

        <div class="row caja">
            <div class="col-sm-12">
                <table id="tablaPaciente" class="table table-striped table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Codigo</th>
                            <th>Descripcion</th>
                            <th>Paciente</th>
                            <th>Acciones</th>
                            <th>Contestado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $dat){ ?>
                            <tr>
                                <td><?php echo $dat['cod_tratamiento'] ?></td>
                                <td><?php echo $dat['desc_tratamiento'] ?></td>
                                <td><?php echo $dat['cod_paciente'] ?></td>
                                <td class="text-center">
                                    <a href="../vistas/borrar_tratamiento.php?id=<?php echo $idDoctor."&cod_tratamiento=".$dat['cod_tratamiento']; ?>" class="btn btn-danger"> Borrar </a>
                                </td>
                                <td class="text-center">
                                    <a href="../vistas/ver_respuestas_tratamiento.php?id=<?php echo $idDoctor."&cod_tratamiento=".$dat['cod_tratamiento']; ?>" class="btn btn-primary"> Revisar </a>
                                </td>
                            </tr>
                        
                        <?php } ?>
                    </tbody>
            </table>
        </div>
      
    </div>
<?php require_once "../vistas/parte_inferior.php" ?>