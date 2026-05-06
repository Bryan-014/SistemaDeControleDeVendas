<?php
  require_once('../util.php');
  if (!isset($_GET['id'])) {
    header('location:../../../?page=prod');
    exit();
  }

  if (mysqli_query($connection, "update tbl_produtos set ativo = 0 where cod = ".$_GET['id'])) {
    $_SESSION["warning"] = generateWarning("Produto Deletado com sucesso!", false);
  } else {
    $_SESSION["warning"] = generateWarning("Produto não deletado!");
  }
  header('location:../../../?page=prod');
  mysqli_close($connection);
?>