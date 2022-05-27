<?php 
ob_start();
session_start(); 
?>
<?php require "../bd/conexion.php" ?>
<?php require_once "../vistas/parte_superior_admin.php" ?>
<?php 
            $aux = $_SESSION['s_usuario'];
            $consulta = "SELECT * FROM FORMULARIO WHERE cod_doctor = '$aux'";
            $objeto = new Conexion();
            $conexion = $objeto->Conectar();
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link href="../css/estilos.css" rel="stylesheet">

    <title>CRUD PHP Y MYSQL</title>
  </head>
  <body>

    <div class="container">
    <div class="row">
            <div class="col-sm-4 offset-8">
                <a href="../vistas/crear_formulario.php?id=<?php echo $aux; ?>&flag=0" class="btn btn-success w-100"> Crear Nuevo Formulario</a>
            </div>            
        </div>

        <div class="row caja">
            <div class="col-sm-12">
                <table id="tablaPaciente" class="table table-striped table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Codigo</th>
                            <th>Acciones</th>
                            <th>Asignar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $dat){ ?>
                            <tr>
                                <td><?php echo $dat['cod_formulario'] ?></td>
                                <td class="text-center">
                                    <a href="../vistas/editar_formulario.php?id=<?php echo $aux."&f=".$dat['cod_formulario']; ?>" class="btn btn-primary"> Editar </a>
                                    <a href="../vistas/borrar_formulario.php?id=<?php echo $aux."&f=".$dat['cod_formulario']; ?>" class="btn btn-danger"> Borrar </a>
                                </td>
                                <td class="text-center">
                                    <a href="../vistas/asignar_formulario.php?id=<?php echo $aux."&f=".$dat['cod_formulario']; ?>" class="btn btn-primary"> Asignar </a>
                                </td>
                            </tr>
                        
                        <?php } ?>
                    </tbody>
            </table>
        </div>
      
    </div>
<?php require_once "../vistas/parte_inferior.php" ?>