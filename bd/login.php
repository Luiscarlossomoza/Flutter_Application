<?php
    session_start();
    include "../bd/conexion.php";
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    
    $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
    $contrasena = (isset($_POST['contrasena'])) ? $_POST['contrasena'] : '';

    $query = "SELECT * FROM USUARIO WHERE cod_usuario = '$usuario' AND clave_usuario = '$contrasena'";

    $resultado = $conexion->prepare($query);
    $resultado->execute();

    if($resultado->rowCount() >= 1){
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION["s_usuario"] = $usuario;
        $_SESSION["s_tipo"] = $data[0]["tipo_usuario"];
    }else{
        $_SESSION["s_usuario"] = NULL;
        $data = NULL;
    }

    print json_encode($data);
    $conexion = NULL;