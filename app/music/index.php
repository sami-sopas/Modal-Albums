<?php
  //Conexion a BD

  require '../config/database.php';
?>

<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CRUD Modal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>

  <div class="container py-3">
    <h2 class="text-center">Musica</h2>

    


    <!-- Boton que llama a newModal (Ventana para agregar) -->
    <!-- lo meti en un row para poder centrar el boton mediante una fila -->
    <div class="row justify-content-end">
      <div class="col-auto">
      <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newModal">
        <i class="bi bi-plus-circle-fill"></i>
           Nuevo registro
        </a>
      </div>
    </div>
    
    <table class="table table-sm table-striped table-hover mt-4">
      <thead> <!-- Encabezado de la tabla -->
        <tr>
          <th>#</th>
          <th>Nombre</th>
          <th>Descripcion</th>
          <th>Genero</th>
          <th>Portada</th>
          <th>Accion</th>
        </tr>
      </thead>

      <tbody> <!-- Cuerpo de la tabla -->

      </tbody>
    </table>

  </div>

  <?php 

    $sqlGenres = "SELECT id, name FROM genre"; //Query para traernos los generos

    /* Usamos el objeto conexion de database.php, y le enviamos la query
       para que nos regrese los generos */
    $genres = $conn->query($sqlGenres);
  ?>

  <!-- incluimos la ventana, es como si copiaramos el codigo del archivo y lo pegaramos aqui debajo -->
  <?php include 'newModal.php' ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>