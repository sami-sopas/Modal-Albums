<?php

  session_start(); //Creamos una sesion para los posibles errores locales

    //Primero llamamos a la conexion
    require '../config/database.php';

    /* Con real_escape_string limpiamos las cadenas que envian los usuarios
      para evitar alguna inyeccion SQL */

    //Recibimos los datos mediante el metodo POST
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $genre = $conn->real_escape_string($_POST['genre']);

    $sql = "INSERT INTO music (name,description,id_genre,date)
     VALUES ('$name','$description','$genre',NOW())";

     if($conn->query($sql)){
        //insert_id, regresa el ultimo ID, de una tabla que contenga AUTOINCREMENTAR
        $id = $conn->insert_id;
        //print("Nuevo registro agregado con id: $id");

        $_SESSION['msg'] = "Registro guardado con ID: $id";

        //Recibimos la imagen y hacemos validaciones
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
              $_SESSION['msg'] .= "<br>Error al guardar imagen"; //Usamos .= para concatenar 
            }
        }
        else {
          $_SESSION['msg'] .= "<br>Formato de imagen no permitido";
        }
     }
     else {
      $_SESSION['msg'] .= "Error al guardar registro";
     }
  }

     //Nos volvemos a posicionar en el inicio
     header('Location: index.php');

?>