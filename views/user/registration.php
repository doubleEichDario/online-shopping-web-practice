<div class="registration-body">
  <h1 class="title ml">Nuevo Cliente</h1>
  <div class="form-container">
    <?php if(isset($_SESSION['registration']) && $_SESSION['registration'] == "Success!"): ?>
      <div class="col-12 green-alert">
        <p>
          El registro se completó satisfactoriamente.
        </p>
      </div>
    <?php elseif(isset($_SESSION['registration']) && $_SESSION['registration'] == "Failed!"): ?>
      <div class="col-12 red-alert">
        <p>
          El registro no pudo completarse.
        </p>
      </div>
    <?php endif; ?>

    <?php // Helping function to delete all $_SESSION variables ?>
    <?php Utils::deleteSession('registration') ?>

    <div class="col-12 registration-form">

      <p>
        Proporcionanos tu información básica para que disfrutes
        de nuestro gran catálogo. Revisa <span><a href="#">aquí</a></span> como se procesan tus datos.
      </p>
      <form action="<?= base_url ?>User/save" method="post">

        <!-- Nombre(s) -->
        <div class="search-box">
          <i class="icon-1 far fa-user"></i>
          <input class="form-input" type="text" name="nombre" placeholder="Nombre" required>
        </div>

        <!-- Apellidos -->
        <div class="search-box">
          <i class="icon-1 far fa-user"></i>
          <input class="form-input" type="text" name="apellidos" placeholder="Apellidos" required>
        </div>

        <!-- Email -->
        <div class="search-box">
          <i class="icon-1 far fa-envelope"></i>
          <input class="form-input mb" type="email" name="email" placeholder="E-mail" required>
        </div>

        <!-- Password -->
        <div class="search-box">
          <i class="icon-1 fas fa-key"></i>
          <a class="forgotten-pass" href="#">¿La olvidaste?</a>
          <input class="form-input mb" type="password" name="password" placeholder="Password" required>
        </div>
        <input class="button-medium mt-2" type="submit" value="Registrarme">
        <input type="checkbox" name="recuerda" value="Recordarme">

      </form>
    </div>
    <hr>
    <!-- Connect-By Icons -->
    <div class="connect-by">
      <h4>Te puedes conectar con:</h4>
      <a href="#"><i class="fab fa-facebook"></i></a>
      <a href="#"><i class="fab fa-twitter-square"></i></a>
    </div>
    <div class="back">
      <i class="fas fa-chevron-left"></i>
      <a href="#">Regresar</a>
    </div>

  </div> <!-- form-container -->

</div>
