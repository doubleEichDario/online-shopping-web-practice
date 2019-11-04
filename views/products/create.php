<?php Utils::isAdmin() ?>
<div class="generic-container">

  <h2>Insertar nuevo producto</h2>

  <div class="col-6 form-block">

    <!-- If editing-->
    <?php if(isset($_SESSION['edit_item']) && $_SESSION['edit_item'] == true): ?>

      <form action="<?= base_url ?>Product/update" method="post" enctype="multipart/form-data">
        <?php
        $categories = new Categories();
        $all = $categories -> showAll();
        ?>
        <label for="categoria"><small>Categoría</small></label>
        <select class="half form-element" name="categoria">

          <?php while($category = $all -> fetch_object()): ?>
            <option value="<?= $category -> id ?>"><?= $category -> nombre ?></option>
          <?php endwhile; ?>

        </select>

        <?php while($edit_product = $result -> fetch_object()): ?>

          <input type="number" name="id" value="<?= $edit_product -> id ?>" hidden>
          <label for="descripcion"><small>Descripción</small></label>
          <textarea class="half form-element" name="descripcion" rows="4" cols="50" required><?= $edit_product -> descripcion ?></textarea>
          <label for="marca"><small>Marca</small></label>
          <input class="quarter form-element" type="text" name="marca" placeholder="Marca" required>
          <label for="precio"><small>Precio</small></label>
          <input class="quarter form-element" type="number" name="precio" step=0.01 min=0 max=9999.99 value="<?= $edit_product -> precio ?>" required>
          <label for="stock"><small>En stock</small></label>
          <input class="quarter form-element" type="number" name="stock" value="<?= $edit_product -> stock ?>" required>
          <div class="alert success-alert mt-1">
            <small>Por favor, carga el archivo otra vez</small>
            <input type="file" name="imagen">
          </div>
          <input class="mt-1 medium primary" type="submit" value="Guardar">

        <?php endwhile; ?>
      </form>

    <?php else: ?>

      <!-- If a regular product insert is going on -->
      <form action="<?= base_url ?>Product/insert" method="post" enctype="multipart/form-data">
        <?php
        $categories = new Categories();
        $all = $categories -> showAll();
        ?>
        <label for="categoria"><small>Categoría</small></label>
        <select class="half form-element" name="categoria">

          <?php while($category = $all -> fetch_object()): ?>
            <option value="<?= $category -> id ?>"><?= $category -> nombre ?></option>
          <?php endwhile; ?>

        </select>

        <label for="descripcion"><small>Descripción</small></label>
        <textarea class="half form-element" name="descripcion" rows="4" cols="50" required></textarea>
        <label for="marca"><small>Marca</small></label>
        <input class="quarter form-element" type="text" name="marca" placeholder="Marca" required>
        <label for="precio"><small>Precio</small></label>
        <input class="quarter form-element" type="number" name="precio" step=0.01 min=0 max=9999.99 placeholder="$" required>
        <label for="stock"><small>En stock</small></label>
        <input class="quarter form-element" type="number" name="stock" placeholder="Cuántos hay.." required>
        <input class="mt-1" type="file" name="imagen">
        <input class="mt-1 medium primary" type="submit">

      </form>

    <?php endif; ?>
    <?php Utils::deleteSession('edit_item') ?>

  </form>
</div>
</div>
