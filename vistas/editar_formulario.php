<?php 
ob_start();
session_start(); 
?>
<?php require_once "../vistas/parte_superior_admin.php" ?>
<?php  

    $aux = $_GET['id'];
    $aux2 = $_GET['f'];
    $data3 = [];
    $vacio = 0;
    $consulta = "SELECT P.* FROM PREGUNTA AS P, FORMULARIO AS F WHERE P.cod_formulario = '$aux2' AND F.cod_formulario = P.cod_formulario";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    print_r($data);
    $cantidad_elementos = count($data);
    echo "CANTIDAD: " . $cantidad_elementos;
    if($data === NULL OR $cantidad_elementos == 0){
        echo "ARRAY VACIO";
        $numero_pregunta = 0;
    }else{
        $vacio = 1;
        if($data[0]['num_pregunta'] === NULL){
            echo "ARRAY SIN PREGUNTAS";
        }else{
            $numero_pregunta = $data[0]['num_pregunta'];
            $preguntaFormulario = "SELECT * FROM PREGUNTA WHERE cod_formulario = '$aux2'";
            $resultado3 = $conexion->prepare( $preguntaFormulario);
            $resultado3->execute();
            $data3 =  $resultado3->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    if(isset($_POST['crearRegistro'])){
        header("Location: ../vistas/revisar_formulario.php");
    }
?>

<div class="container">
    
    <div class="row">
        <h4 class="text-center">Editar formulario</h4>
    </div>  
    <div class="row caja">
        <div class="col-lg-12">
            <div class="jumbotron">
            <?php foreach($data3 as $data) {?>
                <div class="mb-3">
                    <label for="" class="form-label"><?php echo $data['enunciado']; ?></label>
                    <a href="../vistas/editar_pregunta.php?id=<?php echo  $numero_pregunta."&f=". $aux2; ?>" class="btn btn-primary"> Editar </a>
                    <a href="../vistas/borrar_pregunta.php?id=<?php echo  $numero_pregunta."&f=". $aux2; ?>" class="btn btn-danger"> Borrar </a>         
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