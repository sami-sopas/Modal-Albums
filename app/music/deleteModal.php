    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm"> <!-- modal-lg para que sea mas grande la ventana -->
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="deleteModalLabel">Aviso</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            ¿Desea eliminar el Album?
          </div>

          <div class="modal-footer">
            <form action="delete.php" method="post">
              <input type="hidden" name="id" id="id">
                  <button type="submit" class="btn btn-primary">
                  Eliminar
                  </button>
                </div>
              </form>
          </div>
        </div>
      </div>
    </div>