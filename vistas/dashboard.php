<?php 
    session_start(); 
    if($_SESSION["s_usuario"] === null){
        header("Location: ../bd/login.php");
    }else{
        if($_SESSION["s_tipo"] == "admin"){
            header("Location: ../vistas/dashboard_prueba.php");
        }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="../css/estilos.css" rel="stylesheet">
   
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="jumbotron">
                    <h1 class="display-4 text-center">Bienvenido</h1>
                    <h2 class="text-center">Usuario: <?php echo $_SESSION["s_usuario"];?></h2>
                    <h2 class="text-center">Rol: <?php echo $_SESSION["s_tipo"];?></h2>
                    <p class="lead text-center">Esta es la pagina de inicio</p>
                    <hr class="my-4">
                    <a class="btn btn-danger" href="../bd/logout.php" role="button">Cerrar Sesion</a>
                </div>
            </div>
        </div>
    </div>
    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script src="../js/index.js"></script>
  </body>
</html>
