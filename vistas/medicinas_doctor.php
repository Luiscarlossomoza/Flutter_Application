<?php 
ob_start();
session_start(); 
?>
<?php require_once "../vistas/parte_superior_admin.php" ?>
<?php 
    $idUsuario = $_GET['id'];
    $doctor = "SELECT * FROM USUARIO AS U, DOCTOR AS D WHERE U.cod_usuario = D.cod_usuario AND U.cod_usuario = '$idUsuario'";
    $resultado = $conexion->prepare( $doctor );
    $resultado->execute();
    $dataDoctor = $resultado->fetchAll(PDO::FETCH_ASSOC);
    $idDoctor = $dataDoctor[0]['cod_doctor'];
    $consulta = "SELECT * FROM MEDICINAS AS M, DOCTOR AS D WHERE D.cod_doctor = '$idDoctor' AND D.cod_doctor = M.cod_doctor";
    
    $resultado = $conexion->prepare( $consulta );
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

    if(isset($_POST['crearPregunta'])){
        header("Location: ../vistas/crear_medicina.php?id=".$idDoctor);
        exit();
    }
?>

<div class="container">
    <div class="row">
        <h4 class="text-center">Crear una nueva medicina</h4>
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <button type="submit" class="btn btn-success" name="crearPregunta">Agregar Medicina</button>
        </form>
    </div>  
        <div class="row caja">
            <div class="col-sm-12">
                <table id="tablaPaciente" class="table table-striped table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($data as $dat) {?>
                        <tr>
                                <td><?php echo $dat['cod_medicinas'] ?></td>
                                <td><?php echo $dat['nombre_medicina'] ?></td>
                                <td><?php echo $dat['desc_medicina'] ?></td>
                                <td class="text-center">
                                    <a href="../vistas/editar_medicina.php?id=<?php echo $dat['cod_medicinas']."&doctor=". $idDoctor;?>" class="btn btn-primary"> Editar </a>
                                    <a href="../vistas/borrar_medicina.php?id=<?php echo $dat['cod_medicinas']."&doctor=". $idDoctor; ?>" class="btn btn-danger"> Borrar </a>
                                </td>
                        </tr>
                    <?php } ?>
                    </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once "../vistas/parte_inferior.php" ?>