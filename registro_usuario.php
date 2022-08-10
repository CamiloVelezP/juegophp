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

            $sql = "SELECT * FROM `usuarios` WHERE nombre_usuario = '".$nombre_usuario."';";
            $resultado = $conn->query($sql);
            echo"holi";

            if ($resultado->num_rows > 0){
                echo '{"codigo":403,"mensaje": "ya existe un usuario con ese nombre":"'.$resultado->num_rows.'"}';
            }else {
                $sql = "INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `pass`, `jugador`, `nivel`) 
                VALUES (NULL, '".$nombre_usuario."', '".$pass."', '".$jugador."', '".$nivel."');";

                if ($conn->query($sql) === TRUE){
                    echo '{"codigo":201,"mensaje": "usuario creado correctamente","respuesta":""}';
                }else {
                    echo '{"codigo":401,"mensaje": "error intentando crear el usuario","respuesta":""}';
                }
            }
        }else{
            echo '{"codigo":402,"mensaje": "faltan datos para ejecutr la accion solicitada","respuesta":""}';
        }
    }
} catch (Exception $e) {
    echo '{"codigo":400,"mensaje": "error intentando conectar","respuesta":""}';

}

include "footer.php";