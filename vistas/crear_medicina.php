<?php 
ob_start();
session_start(); 
?>
<?php require_once "../vistas/parte_superior_admin.php" ?>
<?php 
        $idDoctor = $_GET['id'];
        if(isset($_POST['crearRegistro'])){
            $nombre = $_POST['nombre_medicina'];
            $descripcion = $_POST['desc_medicina'];
            if(isset($_POST['pacientes'])){
                $medicina_elegida = $_POST['pacientes'];
                $consulta = "INSERT INTO MEDICINAS (nombre_medicina,desc_medicina,cod_doctor,tipo_medicina) VALUES ('$nombre','$descripcion','$idDoctor','$medicina_elegida')";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                header('Location: ../vistas/medicinas_doctor.php?id='.$idDoctor);
                exit();
            }else{
            }
        }
?>
<div class="container">

        <div class="row">
            <h4 class="text-center">Crear nueva medicina</h4>
        </div>   

        <div class="row caja">

            <div class="col-sm-6 offset-3">
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                <div class="mb-3">
                    <label for="nombre_medicina" class="form-label">Ingrese el nombre de la medicina:</label>
                    <input type="text" class="form-control" name="nombre_medicina" placeholder="Ingresa el nombre_medicina">                    
                </div>
                <div class="mb-3">
                    <label for="desc_medicina" class="form-label">Ingrese los datos de la medicina:</label>
                    <input type="text" class="form-control" name="desc_medicina" placeholder="Ingresa el desc_medicina">                    
                </div>
                <div class="mb-3">
                    <select name="pacientes" class="form-control">
                        <option value="0">Seleccione como se administra:</option>
                        <option value="PASTILLA">Pastilla</option>
                        <option value="INYECCION">Inyeccion</option>
                        <option value="CUCHARA">Cuchara</option>
                        <option value="LIQUIDO">Liquido</option>
                    </select>                
                </div>
                <button type="submit" class="btn btn-primary w-100" name="crearRegistro">Crear Registro</button>

                </form>
            </div>
        </div>
    </div>
<?php require_once "../vistas/parte_inferior.php" ?>