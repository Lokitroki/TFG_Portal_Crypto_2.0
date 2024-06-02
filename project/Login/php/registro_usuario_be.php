<?php

    include 'conexion_be.php';

    $nombre_completo = $_POST['nombre_completo'];
    $correo= $_POST['correo'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    
    //Encriptando la contraseña
    $contrasena = hash('sha512', $contrasena);

    $query = "INSERT INTO usuarios(nombre_completo, correo, usuario, contrasena) 
            VALUES('$nombre_completo', '$correo', '$usuario', '$contrasena')";


    // Verificar que el correo no se repita en la Base de Datos
    $verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo'");

    if(mysqli_num_rows($verificar_correo) > 0){
        echo '
            <script>
                alert("El correo ya esta registrado, utilice otro correo o recupere su contraseña");
                window.location = "../index.php";
            </script>
        ';
        exit();
    }

        // Verificar que el nombre de usuario no se repita en la Base de Datos
        $verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario='$usuario'");

        if(mysqli_num_rows($verificar_usuario) > 0){
            echo '
                <script>
                    alert("El nombre de usuario ya esta registrado, utilice otro nombre de usuario");
                    window.location = "../index.php";
                </script>
            ';
            exit();
        }

    $ejecutar = mysqli_query($conexion, $query);

    if($ejecutar){
        echo '
            <script>
                alert("Usuario registrado correctamente");
                window.location = "../index.php";
            </script>
        ';
    }else{
        echo '
        <script>
            alert("Intentalo de nuevo, fallo al registrarse");
            window.location = "../index.php";
        </script>
        ';
    }

    mysqli_close($conexion);

?>