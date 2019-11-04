<?php Utils::isAdmin() ?>
<div class="generic-container">

  <h2>Insertar nueva categoria</h2>

    <div class="col-6 no-gutters form-block">

      <?php if(isset($_SESSION['edit_category']) && $_SESSION['edit_category'] == true): ?>

        <form action="<?= base_url ?>Categories/update" method="post">
          <?php $edited_category = $result -> fetch_object();  ?>
          <input type="number" name="id" value="<?= $edited_category -> id ?>" hidden>
          <input class="form-element" type="text" name="category_name" value="<?= $edited_category -> nombre ?>" required>
          <input class="mt-1 medium primary" type="submit" value="Guardar">
        </form>

      <?php else: ?>

        <form action="<?= base_url ?>Categories/insert" method="post">
          <input class="form-element" type="text" name="category_name" placeholder="Introduce el nombre de la nueva categoria" required>
          <input class="mt-1 medium primary" type="submit" value="Guardar">
        </form>

      <?php endif;  ?>
      <?php Utils::deleteSession('edit_category') ?>

    </div>

</div>
