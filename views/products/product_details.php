<div class="generic-container">

  <?php while($single_product = $result -> fetch_object()): ?>


    <div class="row">
      <div class="col-6">
        <img class="detailed-image-view" src="../uploads/images/<?= $single_product -> imagen ?>" alt="Product Image">
      </div>

      <div class="col-6">
        <h3><?= $single_product -> descripcion ?></h3>
        <p class="maker"><?= $single_product -> marca ?></p>
        <p class="price"><?= $single_product -> precio ?></p>
        <div class="star-rating">
          <span style="width:85%">
          </span>
        </div>
        <div class="occupy-space"></div>

          <a class="half full-width-button primary mt-2" href="<?= base_url ?>Cart/add&id=<?= $single_product -> id ?>" role="button"><span><i class="fas fa-shopping-cart"></i></span><span class="some-space">Agregar al carrito</span></i></a>


      </div>
    </div>

  <?php endwhile; ?>


</div>
