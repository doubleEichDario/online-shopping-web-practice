<?php ob_start(); ?>
<!-- Main Content-->
<div class="row">
  <!-- Side Menu -->
  <div class="col-3 user-controls">
    <aside>
      <!-- Login Controls -->
      <div class="registration-form col-12 mt-2">

        <?php if(isset($_SESSION['identity'])): ?>
          Bienvenido, <?= $_SESSION['identity'] -> nombre ?>
          <a href="<?= base_url ?>User/logout">Cerrar Sesión</a>

          <!-- Admin Manager -->
            <?php if(isset($_SESSION['admin']) && $_SESSION['identity'] -> rol == 'admin'): ?>
              <div class="links mt-1">
                <a href="<?= base_url ?>Categories/manage">Gestionar Categorías</a>
                <a href="<?= base_url ?>Product/manage">Gestionar Productos</a>
                <a href="#">Gestionar Pedidos</a>
              </div>
            <?php endif; ?>

            <h4>Mis Pedidos</h4>

            <!-- Alerts to inform user an order has been processed-->
            <?php if(isset($_SESSION['pedido']) && $_SESSION['pedido'] == true): ?>
              <div class="mb-1 alert success-alert">
                Tu pedido se ha procesado satisfactoriamente
              </div>
            <?php elseif(isset($_SESSION['pedido']) && $_SESSION['pedido'] == false): ?>
              <div class="mb-1 alert warning-alert">
                Tu pedido no pudo completarse, intenta de nuevo.
              </div>
            <?php endif; ?>
            <?php Utils::deleteSession('pedido') ?>


            <?php
              $orders = OrderController::getByUser();
              if($orders):
            ?>
              <div class="row">

                <?php foreach ($orders as $index => $order): ?>

                  <div class="col-12 order-container">
                    <h4>ID: <?= $order -> id  ?></h4>
                    <p>Status: <span><?= $order -> status ?></span></p>
                    <p>Importe: $ <span><?= $order -> importe ?></span></p>
                    <p>Productos: <span><?= $order -> unidades ?></span></p>
                    <p><a href="<?= base_url ?>Order/details&id=<?= $order -> id ?>">Ver pedido</a></p>
                  </div>

                <?php endforeach; ?>

              </div>
            <?php endif; ?>

        <!-- No user is logged in, so here it is the form-->
        <?php else: ?>
          <div>
            <h2 class="mt-2">Accede a la tienda</h2>
            <div class="form-block">
              <form action="<?= base_url ?>User/login" method="post">
                <label for="usuario">Usuario</label>
                <input class="form-element" type="email" name="usuario">
                <label for="password">Contraseña</label>
                <input class="form-element" type="password" name="password">
                <input type="submit" value="Entrar" class="full-width-button featured mt-2">
              </form>
            </div>
          </div>
        <?php endif; ?>

      </div>
    </aside>
  </div>
