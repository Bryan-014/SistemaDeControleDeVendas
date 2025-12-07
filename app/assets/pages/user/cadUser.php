<?php
  require_once('./assets/php/call/callHeader.php');
?>
<div class="user-container mt-3">
  <div class="navbar">
    <h3>Novo Usuário</h3>
    <a href="./?page=user" class="btn bt-primary">Voltar</a>
  </div>
  <?php require_once('./assets/php/util/validWarning.php')?>
  <div>
    <form action="./assets/php/user/createUser.php" method="post">
      <div class="d-flex">
        <div class="form-floating w-100 m-1 mt-1">
          <input type="text" name="cpf" class="form-control" placeholder="cpf" required autocomplete="off" onkeypress="$(this).mask('000.000.000-00');">
          <label for="cpf">CPF</label>
        </div>
      </div>
      <div class="d-flex">
        <div class="form-floating w-45 m-1 mt-1">
          <input type="text" name="userName" class="form-control" placeholder="desc" required autocomplete="off">
          <label for="desc">Nome</label>
        </div>
        <div class="form-floating w-45 m-1 mt-1">
          <select id="Nivel" name="Nivel" class="form-control" placeholder="desc" required>
            <option value="normal">Normal</option>
            <option value="master">Master</option>
          </select>
          <label for="desc">Nível</label>
        </div>
      </div>
      <input type="submit" class="m-1 btn bt-primary" value="Cadastrar">
    </form>
  </div>
</div>