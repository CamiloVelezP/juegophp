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
            isset($_GET["pass2"]) &&
            isset($_GET["jugador"]) &&
            isset($_GET["nivel"])){


            $nombre_usuario = $_GET["nombre_usuario"];
            $pass = $_GET["pass"];
            $pass2 = $_GET["pass2"];
            $jugador = $_GET["jugador"];
            $nivel = $_GET["nivel"];

            $sql = "SELECT * FROM `usuarios` WHERE nombre_usuario = '".$nombre_usuario."' and pass ='".$pass."';";
            $resultado = $conn->query($sql);
            if ($resultado->num_rows > 0){
                $sql = "UPDATE `usuarios` SET  `pass` = '".$pass2."', `jugador` = '".$jugador."', `nivel` = '".$nivel."' WHERE nombre_usuario = '".$nombre_usuario."';";
                $conn->query($sql);
                $sql = "SELECT * FROM `usuarios` WHERE nombre_usuario = '".$nombre_usuario."';";
                $resultado = $conn->query($sql);
                $texto = '';
            while($row = $resultado->fetch_assoc()){
                $texto =
                    "{#id#:".$row["id_usuario"].
                    ",#usuario#:#".$row["nombre_usuario"].
                    "#,#pass#:#".$row["pass"].
                    "#,#jugador#:".$row["jugador"].
                    ",#nivel#:".$row["nivel"].
                    "}";
            }
                //lo encuentra
                echo '{"codigo":206,"mensaje": "Usuario editado con exito","respuesta":"'.$texto.'"}';
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