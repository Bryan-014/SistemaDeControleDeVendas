<?php
  require_once('../util.php');
  if (!isset($_POST['desc'])) {
    header('location:../../../?page=cadProd');
    exit();
  }

  if (mysqli_query($connection, "insert into tbl_produtos (descricao, preco, categoria) values ('".$_POST['desc']."', ".$_POST['prec'].", '".$_POST['cat']."')")) {
    $_SESSION["warning"] = generateWarning("Produto cadastrado com sucesso!", false);
  } else {
    $_SESSION["warning"] = generateWarning("Produto não cadastrado!");
  }
  header('location:../../../?page=cadProd');
  mysqli_close($connection);
?>