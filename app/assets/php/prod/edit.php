<?php
  require_once('../util.php');
  if (!isset($_POST['cod'])) {
    header('location:../../../?page=editProd');
    exit();
  }

  if (mysqli_query($connection, "update tbl_produtos set descricao = '".$_POST['desc']."', preco = ".$_POST['prec']." where cod = ".$_POST['cod'])) {
    $_SESSION["warning"] = generateWarning("Produto atualizado com sucesso!", false);
  } else {
    $_SESSION["warning"] = generateWarning("Produto não atualizado!");
  }
  header('location:../../../?page=editProd&cod='.$_POST['cod']);
  mysqli_close($connection);
?>