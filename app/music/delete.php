<?php
//Primero llamamos a la conexion

    require '../config/database.php';

    /* Con real_escape_string limpiamos las cadenas que envian los usuarios
      para evitar alguna inyeccion SQL */

    //Recibimos solo el ID del registro a eliminar
    $id = $conn->real_escape_string($_POST['id']);


    $sql = "DELETE FROM music WHERE id = $id";

     if($conn->query($sql)){
        //Validar despues
     }

     //Nos volvemos a posicionar en el inicio
     header('Location: index.php');

?>