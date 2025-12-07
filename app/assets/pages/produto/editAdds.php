<?php
  require_once('./assets/php/call/callHeader.php');

  if (isset($_GET['cod'])) {
    $code = $_GET['cod'];
  } else {
    $code = $_POST['id'];
  }

  $product = mysqli_fetch_assoc(mysqli_query($connection, "select * from tbl_adicionais where cod = ".$code));
?>
<div class="prod-container mt-3">
  <div class="navbar">
    <h3>Editar Ingrediente</h3>
    <a href="./?page=adds" class="btn bt-primary" id="back">Voltar</a>
  </div>
  <?php require_once('./assets/php/util/validWarning.php')?>
  <form action="./assets/php/prod/editAdds.php" method="post">
    <div class="d-flex">
      <div class="form-floating w-45 m-0 mb-1" style="margin-inline: 4px !important;">
        <input type="text" name="cod" class="form-control" readonly placeholder="codigo" value="<?php echo($code)?>" required autocomplete="off">
        <label for="cod">Código</label>
      </div>
      <div class="form-floating w-50">
        <input type="number" name="prec" class="form-control" placeholder="prec" value="<?php echo($product['preco'])?>" required autocomplete="off">
        <label for="prec">R$</label>
      </div>
    </div>
    <div class="d-flex">
      <div class="form-floating w-45 m-1">
        <select name="cat" id="cate" required autocomplete="off" class="form-control" placeholder="desc">
          <option value="Salgado">Salgado</option>
          <option value="Doce">Doce</option>
        </select>
        <label for="desc">Categoria</label>
      </div>
      <div class="form-floating w-50 m-0 mt-1">
        <input type="text" name="desc" class="form-control" placeholder="desc" value="<?php echo($product['descricao'])?>" required autocomplete="off">
        <label for="desc">Descrição</label>
      </div>
    </div>
    <input type="submit" value="Salvar" class="btn bt-primary m-1">
    <a data-bs-toggle="modal" data-bs-target="#warning-modal" class="btn bt-primary m-1">Excluir</a>
  </form>
</div>
<div id="warning-modal" class="modal fade">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <span class="h5 m-2">Atenção</span>        
      </div>
      <div class="modal-body">
        <div>
          <p>Você tem certeza que deseja excluir o produto: <b><?php echo($product['descricao'])?></b>, essa ação não poderá ser desfeita!</p>
        </div>
        <button type="button" class="btn bt-primary" data-bs-dismiss="modal">Cancelar</button>
        <a href="./assets/php/prod/delAdds.php?id=<?php echo($code)?>" class="btn bt-primary m-1">Excluir</a>
      </div>
    </div>
  </div>
</div>
<script>
  document.querySelector('#cate').value = '<?php echo($product['categoria'])?>'
</script>