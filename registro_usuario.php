<?php
include "header.php";
try {

//conexion a bd
    $conn = mysqli_connect($db_servidor, $db_usuario, $db_pass, $db_baseDatos);
    if (!$conn) {
        echo '{"codigo":400,"mensaje": "error intentando conectar","respuesta":""}';
    } else {

        if (isset($_GET["nombre_usuario"]) &&
            isset($_GET["pass"]) &&
            isset($_GET["jugador"]) &&
            isset($_GET["nivel"])){


        $nombre_usuario = $_GET["nombre_usuario"];
        $pass = $_GET["pass"];
        $jugador = $_GET["jugador"];
        $nivel = $_GET["nivel"];
        $sql = "INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `pass`, `jugador`, `nivel`) 
                VALUES (NULL, '".$nombre_usuario."', '".$pass."', '".$jugador."', '".$nivel."');";

        if ($conn->query($sql) === TRUE){
            echo '{"codigo":201,"mensaje": "usuario creado correctamenjte","respuesta":""}';
        }else {
            echo '{"codigo":401,"mensaje": "error intentando crear el usuario","respuesta":""}';
        }
        }else{
            echo '{"codigo":402,"mensaje": "faltan datos de usuario","respuesta":""}';
        }
    }
} catch (Exception $e) {
    echo '{"codigo":400,"mensaje": "error intentando conectar","respuesta":""}';

}

include "footer.php";