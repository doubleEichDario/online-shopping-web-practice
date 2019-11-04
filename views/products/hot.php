<div class="products">
  <h2 class="title">Productos Populares</h2>

  <div class="row">

    <!-- Products -->
    <?php while($single_product = $hot_products -> fetch_object()): ?>

      <div class="col-2 product">
        <img src="uploads/images/<?= $single_product -> imagen ?>" alt="Product Image">
        <a href="<?= base_url ?>Product/product&id=<?= $single_product -> id ?>"><?= $single_product -> descripcion ?></a>
        <p class="maker"><?= $single_product -> marca ?></p>
        <p class="price"><?= $single_product -> precio ?></p>
        <div class="star-rating">
          <span style="width:85%">
          </span>
        </div>
      </div>

    <?php endwhile; ?>


  </div>
</div>
</div>
