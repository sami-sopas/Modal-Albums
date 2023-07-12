<?php
    require '../config/database.php';

    //Recibimos el id de la peticion Ajax POST
    $id = $conn->real_escape_string($_POST['id']);

    $sql = "SELECT id, name, description, id_genre FROM music WHERE id = $id LIMIT 1";

    $result = $conn->query($sql);

    $rows = $result->num_rows; //Para ver si regreso filas

    /*Variable a retornar con la informacion, indicamos que iba a ser un JSON
      por lo que tenemos que regresar un arreglo */
    $song = [];

    if($rows > 0) //Si es mayor a 0 es porque si trajo informacion
    {
        $song = $result->fetch_array();
    }

    //Retornamos la cancion, con el formato en caso de acentos
    echo json_encode($song,JSON_UNESCAPED_UNICODE);

    /* Asi se veria la informacion que retorna

        ARRAY
        (
            [id] => 1
            [name] => abcdf
            [description] => ghijk
            [id_genre] => 10
        )

    */
?>