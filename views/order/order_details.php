<div class="generic-container">
  <h2>Detalles del pedido</h2>
    <!-- Products -->
    <?php foreach($products_to_show as $single_product): ?>

      <div class="row product-description">
        <div class="col-2">
          <img class="detailed-image-view-for-orders" src="../uploads/images/<?= $single_product -> imagen ?>" alt="Product Image">
        </div>

        <div class="col-5 detail-on-orders">
          <p><?= $single_product -> descripcion ?></p>
          <p class="maker"><?= $single_product -> marca ?></p>
          <p class="price"><?= $single_product -> precio ?></p>
          <div class="star-rating">
            <span style="width:85%">
            </span>
          </div>
        </div>
        <div class="col-3 content-on-order-details">
          <p>Unidades</p>
          <p><?= $single_product -> unidades ?></p>
        </div>
        <div class="col-2 content-on-order-details">
          <p>Acciones</p>
          <p><a href="<?= base_url ?>Order/update&do=remove&product=<?= $single_product -> producto_id ?>"><i class="fas fa-times"></i></a></p>
        </div>
      </div>

    <?php endforeach; ?>



</div>
