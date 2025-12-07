<?php
  require_once("../util.php");

  if (!isset($_POST['userName'])) {
    header('location:../../../?page=cadUser');
    exit();
  }

  $senha = $_POST['userName']."123";

  if (mysqli_query($connection, "insert into tbl_user (id ,usuario, senha, nivel, cpf) values (uuid(), '".$_POST['userName']."', '".md5($senha)."', '".$_POST['Nivel']."', '".md5(replace_cpf($_POST["cpf"]))."')")) {
    $_SESSION["warning"] = generateWarning("Usuário cadastrado com sucesso! Senha padrão: ".$senha, false);
  } else {
    $_SESSION["warning"] = generateWarning("Usuário não cadastrado!");
  }
  header('location:../../../?page=cadUser');
  mysqli_close($connection);
?>