<?php
  require_once('../util.php');
  if (!isset($_POST['id'])) {
    header('location:../../../?page=editUser');
    exit();
  }

  if (strlen($_POST['newPass']) < 6) {
    $_SESSION["warning"] = generateWarning("A senha deve ter mais de 6 caracteres!");
  }elseif($_POST['newPass'] != $_POST['confirmPass']) {
    $_SESSION["warning"] = generateWarning("As senhas não são iguais!");
  }elseif(mysqli_query($connection, "update tbl_user set senha = '".md5($_POST['newPass'])."' where id = '".$_POST['id']."'")) {
    $_SESSION["warning"] = generateWarning("Senha alterada com sucesso!", false);
  }else{
    $_SESSION["warning"] = generateWarning("Senha não alterada!");
  }
  header('location:../../../?page=editUser&id='.$_POST['id']);
  mysqli_close($connection);
?>