<?php

   session_start(); //Creamos una sesion para los posibles errores locales
   //Primero llamamos a la conexion
    require '../config/database.php';

    /* Con real_escape_string limpiamos las cadenas que envian los usuarios
      para evitar alguna inyeccion SQL */

    //Recibimos los datos mediante el metodo POST
    $id = $conn->real_escape_string($_POST['id']);
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $genre = $conn->real_escape_string($_POST['genre']);

    $sql = "UPDATE music SET name = '$name', description = '$description',
        id_genre = $genre WHERE id = $id";

     if($conn->query($sql)){

      $_SESSION['color'] = "success";
      $_SESSION['msg'] = "Registro actualizado";

        //Recibimos la imagen y si no se recibe la imagen no pasa nada
        if($_FILES['cover']['error'] == UPLOAD_ERR_OK) //Si sale 0, es porque es correcto
        {
          //Arreglo con los formatos para las imagenes
          $format = array("image/jpg","image/jpeg","image/png");

          //Una vez recibimos el archivo, aqui verificamos que tenga el formato correcto
          if(in_array($_FILES['cover']['type'],$format)){

            $dir = "covers"; //Definimos la carpeta donde se guardaran las imagenes

            $info_img = pathinfo($_FILES['cover']['name']); //Informacion sobre la imagen, regresa un arreglo
            $info_img['extension']; 

            $cover = $dir . '/'.$id.'.jpg'; //Para construir el nombre y extension de la imagen recibida 

            if(!file_exists($dir)){ //Si no existe la carpeta, la creamos
              mkdir($dir,0777); //Nombre y permisos
            }

            //Regresa un booleano, le pasamos de parametro el nombre temporal
            if(!move_uploaded_file($_FILES['cover']['tmp_name'], $cover))
            {
               $_SESSION['color'] = "danger";
              $_SESSION['msg'] .= "<br>Error al guardar imagen"; //Usamos .= para concatenar 
            }
        }
        else {
         $_SESSION['color'] = "danger";
          $_SESSION['msg'] .= "<br>Formato de imagen no permitido";
        }
     }else {
      $_SESSION['color'] = "danger";
      $_SESSION['msg'] = "Error al actualizar registro";
     }
   }

     //Nos volvemos a posicionar en el inicio
     header('Location: index.php');

?>