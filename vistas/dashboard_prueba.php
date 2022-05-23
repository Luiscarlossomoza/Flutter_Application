<?php session_start(); ?>
<?php require "../bd/conexion.php" ?>
<?php require_once "../vistas/parte_superior_admin.php" ?>
<?php 
            $aux = $_SESSION['s_usuario'];
            $consulta = "CALL Buscar_pacientes_doctor($aux)";
            $objeto = new Conexion();
            $conexion = $objeto->Conectar();
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="container">
        <div class="row">
            <div class="col-sm-4 offset-8">
                <a href="crear.php" class="btn btn-success w-100"> Crear Nuevo Registro</a>
            </div>            
        </div>

        <div class="row caja">
            <div class="col-sm-12">
                <table id="tablaPaciente" class="table table-striped table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Muestra</th>
                            <th>Estatus</th>
                            <th>Formulario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $dat){ ?>
                            <tr>
                                <td><?php echo $dat['cp'] ?></td>
                                <td><?php echo $dat['np'] ?></td>
                                <td><?php echo $dat['m'] ?></td>
                                <td><?php echo $dat['e'] ?></td>
                                <td><?php echo $dat['f'] ?></td>
                                <td class="text-center">
                                    <a href="" class="btn btn-primary"> Ver Perfil </a>
                            </tr>
                        
                        <?php } ?>
                    </tbody>
            </table>
        </div>
    </div>
</div>


<?php require_once "../vistas/parte_inferior.php" ?>
           