<?php 
    session_start(); 
    unset($_SESSION["s_usuario"]);
    unset($_SESSION["s_tipo"]);
    session_destroy();
    header("Location: ../src/index.php");
?>