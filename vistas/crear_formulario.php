<?php 
ob_start();
session_start(); 
?>
<?php require_once "../vistas/parte_superior_admin.php" ?>
<?php  

    $idRegistro = $_GET['id']; 
    if(isset( $_GET['flag']) && $_GET['flag']!= NULL){
        $flag = $_GET['flag'];
    }else{
        $flag = -1;
    } 
    if(isset( $_GET['p']) && $_GET['p']!= NULL){
        $insertoPregunta = $_GET['p'];
    }else{
        $insertoPregunta = -1;
    } 
    $pregunta = 0;
    $idFormulario = '';
    $data3 = [];
    
    if(isset($_POST['crearRegistro']) && $insertoPregunta === -1 && $flag === -1){
        header("Location: ../vistas/dashboard_prueba.php");
        exit();
    }

    if(isset($_POST['crearRegistro']) && $insertoPregunta === '1' && $flag === '1'){
        echo "formulario creado correctamente";
        header("Location: ../vistas/dashboard_prueba.php");
        exit();
    }

    if($insertoPregunta === "1"){
        $ultimoInsert = "SELECT MAX(cod_formulario) AS ultimo FROM FORMULARIO";
        $resultado2 = $conexion->prepare( $ultimoInsert);
        $resultado2->execute();
        $data2 = $resultado2->fetchAll(PDO::FETCH_ASSOC);
        $idFormulario = $data2[0]['ultimo'];

        $preguntaFormulario = "SELECT * FROM PREGUNTA WHERE cod_formulario = '$idFormulario'";
        $resultado3 = $conexion->prepare( $preguntaFormulario);
        $resultado3->execute();
        $data3 =  $resultado3->fetchAll(PDO::FETCH_ASSOC);
    }
    if(isset($_POST['crearPregunta'])){

        $numero_pregunta = "SELECT COUNT(num_pregunta) FROM PREGUNTA WHERE cod_formulario = '$idFormulario'";
        //VERIFICAR SI ES LA PRIMERA PREGUNTA O YA HAY MAS PREGUNTAS
        if( $insertoPregunta === -1){
            //CREAMOS EL NUEVO FORMULARIO
            $consulta = "INSERT INTO FORMULARIO(cod_doctor) VALUES('$idRegistro')";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        }
        
        //BUSCAMOS EL ULTIMO FORMULARIO CREADO 
        $ultimoInsert = "SELECT MAX(cod_formulario) AS ultimo FROM FORMULARIO";
        $resultado2 = $conexion->prepare( $ultimoInsert);
        $resultado2->execute();
        $data2 = $resultado2->fetchAll(PDO::FETCH_ASSOC);
        $idFormulario = $data2[0]['ultimo'];

        $pregunta = "1";

        //BUSCAMOS TODAS LAS PREGUNTAS ASOCIADAS A ESE FORMULARIO
        $preguntaFormulario = "SELECT * FROM PREGUNTA WHERE cod_formulario = '$idFormulario'";
        $resultado3 = $conexion->prepare( $preguntaFormulario);
        $resultado3->execute();
        $data3 =  $resultado3->fetchAll(PDO::FETCH_ASSOC);
        header("Location: ../vistas/crear_pregunta.php?id=".$idFormulario."&p=". $pregunta);
        exit();
        ob_end_flush();
    }

    
?>

<div class="container">
    
    <div class="row">
        <h4 class="text-center">Crear un nuevo formulario</h4>
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <button type="submit" class="btn btn-success" name="crearPregunta">Agregar Pregunta</button>
        </form>
    </div>  
    <div class="row caja">
        <div class="col-lg-12">
            <div class="jumbotron">
            <?php foreach($data3 as $data) {?>
                <div class="mb-3">
                    <label for="" class="form-label"><?php echo $data['enunciado']; ?></label>
                    <input type="<?php echo $data['tipo_respuesta']; ?>" class="form-control" name="" placeholder="">                    
                </div>
                        <?php } ?>
            </div>
        </div>
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <button type="submit" class="btn btn-primary btn-block" name="crearRegistro">Finalizar</button>
        </form>
    </div>   
</div>
<?php require_once "../vistas/parte_inferior.php" ?>
           