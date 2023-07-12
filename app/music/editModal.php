    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg"> <!-- modal-lg para que sea mas grande la ventana -->
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="editModalLabel">Editar album</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="save.php" method="post" enctype="multipart/form-data">

            <input type="hidden" id="id" name="id"> <!-- Aqui enviamos el ID para mandarlo a actualizar -->



              <!-- FORMULARIO -->
              <div class="mb-3"> <!-- Nombre -->
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" name="name" id="name" class="form-control" required>
              </div>

              <div class="mb-3"> <!-- Descripcion -->
                <label for="description" class="form-label">Descripcion:</label>
                <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
              </div>

              <div class="mb-3"> <!-- Genero -->
                <label for="genre" class="form-label">Genero:</label>
                <select name="genre" id="genre" class="form-select" required>
                  <option value="">Seleccionar...</option>
                  <?php //genres es la variable que tiene los registros en el index
                        //fetch_assocc regresa un array de strings  $fila["id"], $fila["name"]?>
                  <?php  while($row_genres = $genres->fetch_assoc()) { ?>
                    <option value="<?php echo $row_genres["id"]; ?>"><?= $row_genres["name"] ?> </option>
                 <?php } ?>
                </select>
              </div>

              <div class="mb-3"> <!-- Portada -->
                <label for="cover" class="form-label">Portada:</label>
                <input type="file" name="cover" id="cover" class="form-control" accept="image/jpeg">
              </div>

              <div class="">
                <button type="submit" class="btn btn-primary">
                <i class="bi bi-save2-fill"></i>
                Guardar
                </button>
              </div>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
