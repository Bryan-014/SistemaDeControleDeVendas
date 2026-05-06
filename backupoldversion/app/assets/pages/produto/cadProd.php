<?php
  require_once('./assets/php/call/callHeader.php');
?>
<div class="prod-container mt-3">
  <div class="navbar">
    <h3>Cadastrar Sabor</h3>
    <a href="./?page=prod" class="btn bt-primary" id="back">Voltar</a>
  </div>
  <?php require_once('./assets/php/util/validWarning.php')?>
  <form action="./assets/php/prod/cad.php" method="post">
    <div class="form-floating w-100 m-1">
      <select name="cat" id="" required autocomplete="off" class="form-control" placeholder="desc">
        <option value="Salgado">Salgado</option>
        <option value="Doce">Doce</option>
      </select>
      <label for="desc">Categoria</label>
    </div>
    <div class="d-flex">
      <div class="form-floating w-50 m-1">
        <input type="text" name="desc" class="form-control" placeholder="desc" required autocomplete="off">
        <label for="desc">Descrição</label>
      </div>
      <div class="form-floating w-50 m-1">
        <input type="number" name="prec" class="form-control" placeholder="prec" required autocomplete="off">
        <label for="prec">R$</label>
      </div>
    </div>
    <input type="submit" value="Cadastrar" class="btn bt-primary m-1">
  </form>
</div>