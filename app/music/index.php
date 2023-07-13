<?php

  session_start();
  //Conexion a BD

  require '../config/database.php';

  /* query para llenas las tablas con la informacion, usando un inner join
     para ligar con la llave foranea (genero) */ 
  $sqlMusic = "SELECT m.id, m.name, m.description,
               g.name as genre FROM music AS m INNER JOIN genre AS g ON m.id_genre = g.id";

  $music = $conn->query($sqlMusic);

  //Para poder ver la imagen, primero definimos el directorio
  $dir = "covers/";
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

    <hr>

    <?php
      //Si existe la variable de sesion "msg", mostramos el mensaje que contenga
      if(isset($_SESSION['msg']) && isset($_SESSION['color'])) { ?>
        <div class="alert alert-<?= $_SESSION['color']; ?> alert-dismissible fade show" role="alert"> <!-- asi alert- puede variar ya sea success o danger -->
          <?= $_SESSION['msg']; ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    <?php
    unset($_SESSION['color']); //Eliminamos variables de sesion
    unset($_SESSION['msg']); //Eliminamos variables de sesion
  } ?>


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
    <table class="table table-sm table-striped table-hover mt-4 text-center">
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

      <?php /* Usar <?= ?> es el quivalente a usar <?php echo; ?> */ ?>

      <?php while($row_music = $music->fetch_assoc()) {  ?>
        <tr>
          <th scope="row"> <?= $row_music['id']; ?> </th>
          <td> <?= $row_music['name']; ?> </td>
          <td> <?= $row_music['description']; ?> </td>
          <td> <?= $row_music['genre']; ?> </td>         <!-- Con eso se envia otro dato para actualizar la cache del navegador -->
          <td><img src="<?= $dir . $row_music['id'] . '.jpg?n=' . time(); ?> " width=100  height=100 ></td> <!-- Contactenamos lo del directorio con el id para traernos la imagen -->
          <td class="">
            <a href="#" class="btn btn-primary" data-bs-id="<?= $row_music['id']; ?>" data-bs-toggle="modal" data-bs-target="#editModal"><i class="bi bi-pencil-square me-1"></i>Editar</a>

            <a href="#" class="btn btn-danger" data-bs-id="<?= $row_music['id']; ?>" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="bi bi-trash3-fill me-1"></i></i>Eliminar</a>
          </td>
        </tr>
        <?php } ?>
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
  <?php include 'newModal.php'; ?>

  <?php $genres->data_seek(0); ?> <!-- Para reiniciar el ciclo while del newModal y asi poder mostrar los generos en editModal -->

  <?php include 'editModal.php'; ?>

  <?php include 'deleteModal.php'; ?>

  <script>
    //Codigo JS para detectar el evento cuando se muestra un modal para EDITAR
    let editModal = document.getElementById('editModal');
    let deleteModal = document.getElementById('deleteModal');

    //Le indicamos el evento
    // "show.bs.modal" es cuando damos click al boton para abrir el modal
    // "shown.bs.modal" es cuando terminan de cargar todos los elementos del modal
    editModal.addEventListener('shown.bs.modal', event => {
      let button = event.relatedTarget; //Para detectar a que boton se le dio click
      let id = button.getAttribute('data-bs-id'); //Para pasar el id del registro que quiero modificar

      //De la ventana modal, buscamos el elemento con la clase .modal-body con el elemento id
      //De esta manera detectamos los demas datos
      let inputId = editModal.querySelector('.modal-body #id');
      let inputName = editModal.querySelector('.modal-body #name');
      let inputDescription = editModal.querySelector('.modal-body #description');
      let inputGenre = editModal.querySelector('.modal-body #genre');
      let cover = editModal.querySelector('.modal-body #img_cover');

      //Peticion Ajax para pasar la informacion al modal
      let url = "getSong.php";
      let formData = new FormData();
      formData.append('id',id); //Elementos que necesitamos enviar

      //Esto es una peticion de forma nativa
      fetch(url, {
        method: "POST",
        body: formData
      }).then(response => response.json())
      .then(data => { //La variable data ya contendra los datos del registro despues de la petision a getSong.php

        inputId.value = data.id
        inputName.value = data.name
        inputDescription.value = data.description
        inputGenre.value = data.id_genre
        cover.src = '<?= $dir ?>' + data.id + '.jpg'

      }).catch(err => console.log(err));

    })

    //Codigo para eliminar modal
    deleteModal.addEventListener('shown.bs.modal', event => {
      let button = event.relatedTarget; //Para detectar a que boton se le dio click
      let id = button.getAttribute('data-bs-id'); //Para pasar el id del registro que quiero modificar
      deleteModal.querySelector('.modal-footer #id').value = id; //Le pasamos el ID a la ventana de deleteModal para que el usuario sepa que registro va a elimianr

    })
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>