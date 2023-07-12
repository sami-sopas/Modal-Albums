<?php
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
     }

     //Nos volvemos a posicionar en el inicio
     header('Location: index.php');

?>