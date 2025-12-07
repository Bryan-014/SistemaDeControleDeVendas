<?php
  require_once('../util.php');
  if (!isset($_GET['mode'])) {
    header('location:../../../?page=editUser');
    exit();
  }
  if ($_GET['mode'] == "Desativar") {
    if (mysqli_query($connection, "update tbl_user set ativo = 0 where id = '".$_GET['id']."'")) {
      $_SESSION["warning"] = generateWarning("Usuário desativado com sucesso!", false);
    } else {
      $_SESSION["warning"] = generateWarning("Usuário não desativado!");
    }
  } else {
    if (mysqli_query($connection, "update tbl_user set ativo = 1 where id = '".$_GET['id']."'")) {
      $_SESSION["warning"] = generateWarning("Usuário ativado com sucesso!", false);
    } else {
      $_SESSION["warning"] = generateWarning("Usuário não ativado!");
    }
  }
  header('location:../../../?page=editUser&id='.$_GET['id']);
  mysqli_close($connection);
?>