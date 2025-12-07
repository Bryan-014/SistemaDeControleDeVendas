<div class="login-container p-3">
  <div class="form-singin text-center">
    <form action="./assets/php/login/_login.php" method="post">
      <span class="h1 label-primary">
        <?php echo($app['name'])?>
      </span>
      <?php require_once("./assets/php/util/validWarning.php") ?>
      <div class="form-floating mb-2 mt-3">
        <input
          type="text"
          name="cpf"
          class="form-control"
          placeholder="cpf"
          required
          autocomplete="off"
          onkeypress="$(this).mask('000.000.000-00');"
          value="<?php
            if (isset($_SESSION['cpfDesc'])) {
              echo($_SESSION['cpfDesc']);
            }
          ?>"
        />
        <label for="cpf">CPF</label>
      </div>
      <div class="form-floating mb-2">
        <input
          type="password"
          name="pass"
          class="form-control"
          placeholder="pass"
          required
          autocomplete="off"
        />
        <label for="pass">Senha</label>
      </div>
      <input type="submit" value="Entrar" class="btn bt-primary w-100" onclick="openLoading()"/>
    </form>
  </div>
</div>