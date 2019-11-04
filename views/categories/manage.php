
<div class="generic-container">
  <h2>Gestionar Categorias</h2>

  <?php if(isset($_SESSION['inserting_category']) && $_SESSION['inserting_category'] == true): ?>
    <div class="mb-1 alert success-alert">
      La categoría se <strong>guardó</strong> satisfactoriamente.
    </div>

  <?php elseif(isset($_SESSION['inserting_category']) && $_SESSION['inserting_category'] == false): ?>
    <div class="mb-1 alert warning-alert">
      Hubo un error al <strong>guardar la categoría.</strong>
    </div>

  <?php elseif(isset($_SESSION['deleting_category']) && $_SESSION['deleting_category'] == false): ?>
    <div class="mb-1 alert warning-alert">
      Hubo un error al <strong>borrar</strong> la categoría.
    </div>

  <?php elseif(isset($_SESSION['deleting_category']) && $_SESSION['deleting_category'] == true): ?>
      <div class="mb-1 alert success-alert">
        La categoría se <strong>borró</strong> satisfactoriamente.
      </div>

  <?php elseif(isset($_SESSION['updated_category']) && $_SESSION['updated_category'] == false): ?>
    <div class="mb-1 alert warning-alert">
      Hubo un error al <strong>editar</strong> la categoría.
    </div>

  <?php elseif(isset($_SESSION['updated_category']) && $_SESSION['updated_category'] == true): ?>
      <div class="mb-1 alert success-alert">
        La categoría se <strong>editó</strong> satisfactoriamente.
      </div>
  <?php endif; ?>

  <?php Utils::deleteSession('inserting_category') ?>
  <?php Utils::deleteSession('deleting_category') ?>
  <?php Utils::deleteSession('updated_category') ?>

  <a class="mb-1 medium primary" href="<?= base_url ?>Categories/create" role="button">Crear nueva</a>

  <table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php while($categoria = $all -> fetch_object()): ?>
        <tr>
          <td><?= $categoria -> id ?></td>
          <td><?= $categoria -> nombre ?></td>
          <td class="item-actions">
            <a class="action-icon" href="<?= base_url ?>Categories/delete&id=<?= $categoria -> id ?>"><i class="far fa-trash-alt"></i></a>
            <a class="action-icon" href="<?= base_url ?>Categories/edit&id=<?= $categoria -> id ?>"><i class="far fa-edit"></i></a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
