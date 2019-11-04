<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="<?= base_url ?>assets/css/styles.css">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Tienda de camisetas</title>
  </head>
  <body>

    <!-- Header -->
    <header>
      <div class="row web-header">
        <div class="title col-2 mt-1">
          <a href="<?= base_url ?>"><h1>PlayerasChidas
        </h1></a>
        </div>
        <div class="col-5 form-block">
          <form action="index.php" method="post">
            <input class="search form-element mt-3" type="text" name="search" placeholder="Que tipo de camisa necesitas...">
            <input class="search-button mt-3 right" type="submit" name="search" value="Buscar">
          </form>
        </div>
        <div class="col-2">
          <?php if(isset($_SESSION['cart'])): ?>
            <a href="<?= base_url ?>Cart/index"><i class="mt-1 fas fa-shopping-cart"></i><span class="items-counter"><?= Utils::countItemsInCart(); ?></span></a>
          <?php  else:?>
            <a href="#"><i class="customer-icon material-icons">shopping_cart</i><span class="items-counter">0</span></a>
          <?php endif; ?>
          <a href="#"><i class="customer-icon material-icons">favorite</i><span class="wishes-counter">0</span></a>
        </div>
        <div class="col-3 buying-view-options">
          <a class="mt-1" href="#">Peso Mexicano (MXN)</a>
          <a href="#"><i class="material-icons">expand_more</i></a>
          <a class="mt-1" href="#">Español</a>
          <a href="#"><i class="material-icons">expand_more</i></a>
        </div>
    </header>

    <!-- Navigation -->
    <nav>
      <div class="row menu">
        <div class="col-12">
          <ul class="category-navigation">
            <li><a href="<?= base_url ?>">Inicio</a></li>

            <?php
              $categorias = new Categories();
              $all = $categorias -> showAll();
            ?>
            <?php while($categoria = $all -> fetch_object()): ?>
              <li class="navigation-link" id="<?= $categoria -> id ?>"><a href="<?= base_url ?>Product/categorized&id=<?= $categoria -> id ?>"><?= $categoria -> nombre;  ?></a></li>
            <?php endwhile; ?>

          </ul>
        </div>
      </div>
    </nav>
