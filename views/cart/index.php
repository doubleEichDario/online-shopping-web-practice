<div class="generic-container">
  <h2>Carrito de compras</h2>
  <div class="mb-1">

    <h3 class="total-cart in-line">Total en el carrito: <span>$ <?= Utils::getTotalFromCart(); ?><span></h3><span></span>

    <?php if(count($_SESSION['cart']) != 0): ?>
      <a class="medium warning in-line ml-1" href="<?= base_url ?>Cart/empty" role="button">Vaciar el carrito</a>
    <?php endif; ?>

  </div>

  <table class="table">
    <thead>
      <tr>
        <th>Imagen</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Unidades</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
        foreach($cart as $index => $item):
          $product = $item['product'];
      ?>

        <tr>
          <td><img class="thumb" src="../uploads/images/<?= $product -> imagen ?>" alt="Image"></td>
          <td><a href="<?= base_url ?>Product/product&id=<?= $product -> id ?>"><?= $product -> descripcion ?></a></td>
          <td>$ <?= $product -> precio ?></td>
          <td><a href="<?= base_url ?>Cart/units&do=raise&id=<?= $index ?>"><i class="units fas fa-chevron-up"></i></a><?= $item['units'] ?><a href="<?= base_url ?>Cart/units&do=decrease&id=<?= $index ?>"><i class="units fas fa-chevron-down"></i></a></td>
          <td><a href="<?= base_url ?>Cart/remove&id=<?= $index ?>"><i class="fas fa-times"></i></a></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <?php if(count($_SESSION['cart']) != 0): ?>
    <a class="medium primary mt-1" href="<?= base_url ?>Order/checkout" role="button">Hacer el pedido</a>
  <?php endif; ?>
</div>
