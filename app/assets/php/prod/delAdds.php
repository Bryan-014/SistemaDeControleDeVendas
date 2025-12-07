<?php
  require_once('../util.php');
  if (!isset($_GET['id'])) {
    header('location:../../../?page=adds');
    exit();
  }

  if (mysqli_query($connection, "update tbl_adicionais set ativo = 0 where cod = ".$_GET['id'])) {
    $_SESSION["warning"] = generateWarning("Ingrediente Deletado com sucesso!", false);
  } else {
    $_SESSION["warning"] = generateWarning("Ingrediente não deletado!");
  }
  header('location:../../../?page=adds');
  mysqli_close($connection);
?>