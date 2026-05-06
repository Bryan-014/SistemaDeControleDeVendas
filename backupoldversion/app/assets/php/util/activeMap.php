<?php
  require_once('../util.php');

  if (isset($_GET['mode'])) {
    if ($_GET['mode'] == 'Desativar') {
      if (mysqli_query($connection, "update tbl_locale set active = 0")) {
        $_SESSION["warning"] = generateWarning("Mapa desativado com sucesso!", false);
      } else {
        $_SESSION["warning"] = generateWarning("Mapa não desativado!");
      }
    } else {
      if (mysqli_query($connection, "update tbl_locale set active = 1")) {
        $_SESSION["warning"] = generateWarning("Mapa ativado com sucesso!", false);
      } else {
        $_SESSION["warning"] = generateWarning("Mapa não ativado!");
      }
    }
  }

  header('Location:../../../?page=editUser&id='.$_GET['id']);
?>