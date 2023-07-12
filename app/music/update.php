<?php
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
        //Validar despues
     }

     //Nos volvemos a posicionar en el inicio
     header('Location: index.php');

?>