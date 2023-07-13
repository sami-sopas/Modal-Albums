<?php

    session_start();
    //Primero llamamos a la conexion
    require '../config/database.php';

    /* Con real_escape_string limpiamos las cadenas que envian los usuarios
      para evitar alguna inyeccion SQL */

    //Recibimos solo el ID del registro a eliminar
    $id = $conn->real_escape_string($_POST['id']);


    $sql = "DELETE FROM music WHERE id = $id";

     if($conn->query($sql)){
        
      //Construccion de la ruta con el nombre
      $dir = "covers"; //Definimos la carpeta donde se guardaran las imagenes

      $info_img = pathinfo($_FILES['cover']['name']); //Informacion sobre la imagen, regresa un arreglo
      $info_img['extension']; 

      $cover = $dir . '/'.$id.'.jpg'; //Para construir el nombre y extension de la imagen recibida 

        if(file_exists($cover)){
          unlink($cover);
        }

        $_SESSION['color'] = "success";
        $_SESSION['msg'] = "Registro eliminado";
     }
     else {

      $_SESSION['color'] = "danger";
      $_SESSION['msg'] = "Error al eliminar registro";

     }

     //Nos volvemos a posicionar en el inicio
     header('Location: index.php');

?>