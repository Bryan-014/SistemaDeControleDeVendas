<?php
  require_once('../util.php');
  if (!isset($_POST['id'])) {
    header('location:../../../?page=editUser');
    exit();
  }
  
  if (mysqli_query($connection, "update tbl_user set usuario = '".$_POST['userName']."', nivel = '".$_POST['Nivel']."' where id = '".$_POST['id']."'")) {
    $_SESSION["warning"] = generateWarning("Usuário atualizado com sucesso!", false);
  } else {
    $_SESSION["warning"] = generateWarning("Usuário não atualizado!");
  }
  header('location:../../../?page=editUser&id='.$_POST['id']);
  mysqli_close($connection);
?>