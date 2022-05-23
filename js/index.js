$('#form-login').submit(function(e){
    e.preventDefault();
    var usuario = $.trim($('#usuario').val());
    var contrasena = $.trim($('#contrasena').val());
    if(usuario.length == ""){
        Swal.fire({
            icon:'error',
            title:'Usuario vacio',
        });
    }else{
        $.ajax({
            url:"../bd/login.php",
            type:"POST",
            datatype: "json",
            data: {usuario:usuario, contrasena: contrasena},
            success:function(data){
                if(data == "null"){
                    Swal.fire({
                        icon:'error',
                        title:'Usuario o contrasena incorrectas',
                    });
                }else{
                    Swal.fire({
                        icon:'success',
                        title:'Conexion exitosa',
                    }).then((result) => {
                        if(result.value){
                            window.location.href = "../vistas/dashboard.php";
                        }
                    });
                }
            }
        })
    }
});

