<?php
include "header.php";
try {

//conexion a bd
    $conn = mysqli_connect($db_servidor, $db_usuario, $db_pass, $db_baseDatos);
    if (!$conn) {
        echo '{"codigo":400,"mensaje": "error intentando conectar","respuesta":""}';
    } else {

        if (isset($_GET["nombre_usuario"])){


            $nombre_usuario = $_GET["nombre_usuario"];
            $pass = $_GET["pass"];
            $sql = "SELECT * FROM `usuarios` WHERE nombre_usuario = '".$nombre_usuario."' and pass ='".$pass."';";
            $resultado = $conn->query($sql);
            if ($resultado->num_rows > 0){
                //lo encuentra
                echo '{"codigo":205,"mensaje": "inicio de sesion correcto","respuesta":"0"}';
            }else {
                echo '{"codigo":204,"mensaje": "el usuario o contraseña incorrectos","respuesta":"0"}';
            }
        }else{
            echo '{"codigo":402,"mensaje": "faltan datos para ejecutar la accion solicitada","respuesta":""}';
        }
    }
} catch (Exception $e) {
    echo ($e);
    echo '{"codigo":400,"mensaje": "error intentando conectar","respuesta":""}';

}

include "footer.php";