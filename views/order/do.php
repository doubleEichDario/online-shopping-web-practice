<div class="generic-container">

<?php if(isset($_SESSION['identity'])): ?>

  <h2>A dónde enviaremos tu pedido</h2>

  <i class="fas fa-chevron-left"></i><a class="back-link" href="<?= base_url ?>Cart/index">Volver al carrito</a>
  <div class="occupy-space"></div>

  <form class="form-block" action="<?= base_url ?>Order/add" method="post">

    <label for="estado"><small>Estado</small></label>
    <input class="half form-element" type="text" name="estado" required>
    <label for="municipio"><small>Municipio</small></label>
    <input class="half form-element" type="text" name="municipio" required>
    <label for="direccion"><small>Dirección</small></label>
    <textarea class="half form-element" name="direccion" rows="4" required></textarea>

    <input class="medium featured mt-1" type="submit" value="Comprar">

  </form>

<?php else: ?>

  <p>Por favor, regístrate o ingresa a la web para procesar tu pedido</p>

<?php endif; ?>

</div>
