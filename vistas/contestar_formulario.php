<?php ob_start(); session_start(); ?>
<?php require "../bd/conexion.php" ?>
<?php require_once "../vistas/parte_superior.php" ?>
<?php
    $cod_paciente = $_GET['id'];
    $cod_formulario = $_GET['f'];
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    $preguntaFormulario = "SELECT * FROM PREGUNTA WHERE cod_formulario = ' $cod_formulario'";
    $resultado3 = $conexion->prepare( $preguntaFormulario);
    $resultado3->execute();
    $data =  $resultado3->fetchAll(PDO::FETCH_ASSOC);
    $flag = 1;

    if(isset($_POST['crearRegistro'])){
        foreach($data as $dat){
            if(isset($_POST[$dat['num_pregunta']]) && $_POST[$dat['num_pregunta']] != '' ){
                foreach($data as $dat){
                    $respuesta = $_POST[$dat['num_pregunta']];
                    $numero_pregunta = $dat['num_pregunta'];
                    echo  $respuesta;
                    $insertar_respuesta = "UPDATE PREGUNTA SET respuesta = '$respuesta' WHERE cod_formulario = '$cod_formulario' AND num_pregunta = '$numero_pregunta' ";
                    echo $insertar_respuesta;
                    echo "<br>";
                    $resultado3 = $conexion->prepare( $insertar_respuesta );
                    $resultado3->execute();
                    echo "<br>";
                }
            }else{
                echo "ERROR LA PREGUNTA " . $dat['num_pregunta'] . " ESTA VACIA";
                $flag = 0;
            }
            if( $flag == 1 ){
                echo "TODO SALIO BIEN";
                echo "<br>";
                $hoy = date("Y-m-d H:i:s"); 
                $actualizar_formulario = "UPDATE PACIENTE_FORMULARIO SET contestado = 1, fecha_contestado = ' $hoy' WHERE cod_formulario = '$cod_formulario' AND cod_paciente = '$cod_paciente' ";
                echo $actualizar_formulario;
                $resultado3 = $conexion->prepare( $actualizar_formulario );
                $resultado3->execute();
                header("Location: ../vistas/lista_formulario.php");
                exit();
                ob_end_flush();
            }else{
                echo "CONTESTE TODAS LAS PREGUNTAS";
                echo "<br>";
            }
        }
    }
?>
<div class="container">
    <div class="row caja">
        <div class="col-lg-12">
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                <div class="jumbotron">
                    <?php foreach($data as $dat) {?>
                        <div class="mb-3">
                            <label for="<?php echo $dat['num_pregunta']; ?>" class="form-label"><?php echo $dat['enunciado']; ?></label>
                            <input type="<?php echo $dat['tipo_respuesta']; ?>" class="form-control" name="<?php echo $dat['num_pregunta']; ?>" placeholder="<?php echo $dat['tipo_respuesta']; ?>">                    
                        </div>
                    <?php } ?>
                </div>
                <button type="submit" class="btn btn-primary btn-block" name="crearRegistro">Finalizar</button>
            </form>
        </div>
    </div>      
</div> 
<?php require_once "../vistas/parte_inferior.php" ?>