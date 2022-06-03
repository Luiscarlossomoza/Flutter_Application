<?php 
ob_start();
session_start(); 
?>
<?php require_once "../vistas/parte_superior_admin.php" ?>
<?php 
    $flagnp = 0;
    $dataMedicinasR = [];
    $dataComidasR = [];
    $dataDoctor = [];
    if(isset($_GET['np'])){
        $np = $_GET['np'];
        $np = $np + 1;
        $flagnp = 1;
    }else{
        $np = 1;
    }
    if(isset($_GET['cod_tratamiento'])){
        $idTratamiento = $_GET['cod_tratamiento'];
        $consulta = "SELECT * FROM MEDICINAS_TRATAMIENTO WHERE cod_tratamiento = '$idTratamiento'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $dataMedicinasR=$resultado->fetchAll(PDO::FETCH_ASSOC);

        $consulta = "SELECT * FROM COMIDAS WHERE cod_tratamiento = '$idTratamiento'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $dataComidasR = $resultado->fetchAll(PDO::FETCH_ASSOC);;
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $consulta = "SELECT D.* FROM DOCTOR AS D, USUARIO AS U WHERE U.cod_usuario = '$id' AND D.cod_usuario = U.cod_usuario";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $dataDoctor=$resultado->fetchAll(PDO::FETCH_ASSOC);
    }
    if(isset($_GET['flag'])){
        $flag = $_GET['flag'];
        if($flag==0){
            $consulta = "SELECT * FROM PACIENTE";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $dataPaciente=$resultado->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    if(isset($_POST['pacientes'])){
        $paciente_elegido = $_POST['pacientes'];
        header("Location: ../vistas/crear_tratamiento_doctor.php?id=".$id."&flag=1"."&cod_paciente=".$paciente_elegido);
        exit();
    }
    if((isset($_POST['crearMedicina']) OR isset($_POST['crearComida'])) && isset($_GET['id']) && isset($_GET['flag']) && isset($_GET['cod_paciente']) && $flag==1){
        $paciente_elegido = $_GET['cod_paciente'];
        $doctor = $dataDoctor[0]['cod_doctor'];
        if(!isset($_GET['cod_tratamiento'])){
            $crearTratamiento = "INSERT INTO TRATAMIENTO (desc_tratamiento,cod_paciente, cod_doctor) VALUES ('SIN DEFINIR','$paciente_elegido','$doctor')";
            $resultado = $conexion->prepare($crearTratamiento);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            $ultimoTratamiento = "SELECT MAX(cod_tratamiento) as ultimo FROM TRATAMIENTO";
            $resultado = $conexion->prepare($ultimoTratamiento);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            $cod_tratamiento = $data[0]['ultimo'];
            $agregarPacienteTratamiento = "INSERT INTO PACIENTE_TRATAMIENTO (cod_tratamiento, cod_paciente) VALUES ('$cod_tratamiento','$paciente_elegido')";
            $resultado = $conexion->prepare($agregarPacienteTratamiento);
            $resultado->execute();
        }else{
            $cod_tratamiento = $_GET['cod_tratamiento'];
        }
        
        if(isset($_POST['crearMedicina'])){
            if( $flagnp == 1){
                header("Location: ../vistas/agregar_medicina.php?id=".$id."&flag=1"."&cod_paciente=".$paciente_elegido."&cod_tratamiento=".$cod_tratamiento."&np=".$np);
                exit();
            }else{
                header("Location: ../vistas/agregar_medicina.php?id=".$id."&flag=1"."&cod_paciente=".$paciente_elegido."&cod_tratamiento=".$cod_tratamiento);
                exit();
            }
        }
        if(isset($_POST['crearComida'])){
            header("Location: ../vistas/agregar_comida.php?id=".$id."&flag=1"."&cod_paciente=".$paciente_elegido."&cod_tratamiento=".$cod_tratamiento."&np=".$np);
            exit();
        }
    }
    if(isset($_POST['crearRegistro'])){
        header("Location: ../vistas/dashboard_prueba.php?id=".$dataDoctor[0]['cod_doctor']);
        exit();
    }
?>
<div class="container">
    <div class="row">
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <button type="submit" class="btn btn-success" name="crearMedicina">Agregar Medicina</button>
            <button type="submit" class="btn btn-success" name="crearComida">Agregar Comida</button>
        </form>
    </div>  
    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
    <div class="row caja">
        <div class="col-lg-12">
            <div class="jumbotron">
            <?php if($flag== 0){foreach($dataPaciente as $dat) {     ?>
            <select name="pacientes" class="form-control">
                        <option value="0">Seleccione paciente:</option>
                            <option value="<?php echo $dat['cod_paciente'];?>"><?php echo $dat['nombre_paciente'];?></option>
                
                    </select>
                <input type="submit" value="contestar">
            <?php } }else{
                echo "<h2 class='text-center'>Medicinas</h2>";
                foreach($dataMedicinasR as $dat) {
                    $idMedicina = $dat['cod_medicinas'];
                    $infoMedicina = "SELECT * FROM MEDICINAS WHERE cod_medicinas = '$idMedicina' ";
                    $resultadoM = $conexion->prepare($infoMedicina);
                    $resultadoM->execute();
                    $dataM=$resultadoM->fetchAll(PDO::FETCH_ASSOC);
                    echo "<hr>";
                    echo "Codigo --> " .$dataM[0]['cod_medicinas'] . " - ";
                    echo "<br>";
                    echo "Nombre --> " .$dataM[0]['nombre_medicina'] . " - ";
                    echo "<br>";
                    echo "Descripcion --> " .$dataM[0]['desc_medicina'];
                    echo "<br>";
                    echo "<hr>";
                }
                echo "<h2 class='text-center'>Comidas</h2>";
                foreach($dataComidasR as $dat2) {
                    echo "<hr>";
                    echo "Codigo --> " .$dat2['cod_comida'];
                    echo "<br>";
                    echo "Descripcion --> " .$dat2['desc_comida'] . " - ";
                    echo "<br>";
                    echo "Tipo --> " .$dat2['tipo_comida'];
                    echo "<br>";
                    echo "<hr>";
                }
            }?>
    </div>
    </form>
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <button type="submit" class="btn btn-primary btn-block" name="crearRegistro">Finalizar</button>
        </form>
    </div>   
</div>
<?php require_once "../vistas/parte_inferior.php" ?>