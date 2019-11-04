

<div class="generic-container">
  <h2>Gestionar Productos</h2>

  <?php if(isset($_SESSION['deleting_query']) && $_SESSION['deleting_query'] == true): ?>
    <div class="mb-1 alert success-alert">
      El producto se <strong>eliminó</strong> correctamente.
    </div>

  <?php elseif(isset($_SESSION['deleting_query']) && $_SESSION['deleting_query'] == false): ?>
    <div class="mb-1 alert warning-alert">
      Hubo un problema al <strong>eliminar</strong> el producto.
    </div>

  <?php elseif(isset($_SESSION['updated_product']) && $_SESSION['updated_product'] == true): ?>
    <div class="mb-1 alert success-alert">
      El producto se <strong>editó</strong> correctamente.
    </div>

  <?php elseif(isset($_SESSION['updated_product']) && $_SESSION['updated_product'] == false): ?>
    <div class="mb-1 alert warning-alert">
      Hubo un problema al <strong>editar</strong> el producto.
    </div>

  <?php elseif(isset($_SESSION['inserting_query']) && $_SESSION['inserting_query'] == true): ?>
    <div class="mb-1 alert success-alert">
      El producto se <strong>agregó</strong> correctamente.
    </div>

  <?php elseif(isset($_SESSION['inserting_query']) && $_SESSION['inserting_query'] == false): ?>
    <div class="mb-1 alert warning-alert">
      Hubo un problema al <strong>insertar</strong> el producto.
    </div>

  <?php endif; ?>

  <?php Utils::deleteSession('deleting_query') ?>
  <?php Utils::deleteSession('inserting_query') ?>
  <?php Utils::deleteSession('updated_product') ?>

  <a class="medium primary mb-1" href="<?= base_url ?>Product/create" role="button">Crear nuevo</a>

  <table class="table">
    <thead>
      <tr>
        <th>Categoría</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Imagen</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php while($producto = $products -> fetch_object()): ?>
        <tr>
          <td><?= $producto -> categoria_id ?></td>
          <td><?= $producto -> descripcion ?></td>
          <td><?= $producto -> precio ?></td>
          <td><?= $producto -> stock ?></td>
          <td><img class="thumb" src="../uploads/images/<?= $producto -> imagen ?>" alt="Imagen de producto"></td>
          <td class="item-actions">
            <a class="action-icon" href="<?= base_url ?>Product/delete&id=<?= $producto -> id ?>"><i class="far fa-trash-alt"></i></a>
            <a class="action-icon" href="<?= base_url ?>Product/edit&id=<?= $producto -> id ?>"><i class="far fa-edit"></i></a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

</div>
