<?php
    class  Conexion {
        public static function Conectar(){
            define('servidor',"127.0.0.1");
            define('nombre_bd',"flutter_prueba");
            define('usuario',"root");
            define('contrasena',"12345678");
            $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
            try{
                $pdo = new PDO ("mysql:host=".servidor.";dbname=".nombre_bd,usuario,contrasena);
                return $pdo;
            }catch(Exception $e){
                die('ERROR DE CONEXION'.$e->getMessage());
            }
        }
    }
  



