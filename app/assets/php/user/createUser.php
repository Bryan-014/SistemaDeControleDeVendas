<?php
  require_once("../util.php");

  if (!isset($_POST['userName'])) {
    header('location:../../../?page=cadUser');
    exit();
  }

  $senha = $_POST['userName'] . "123";

  $options = ['cost' => 12]; 
  $hash = password_hash($senha, PASSWORD_DEFAULT, $options);

  $cpf_hash = md5(replace_cpf($_POST["cpf"]));

  $sql = "INSERT INTO tbl_user (id, usuario, senha, nivel, cpf) VALUES (uuid(), ?, ?, ?, ?)";
  $stmt = mysqli_prepare($connection, $sql);
  mysqli_stmt_bind_param($stmt, "ssis", $_POST['userName'], $hash, $_POST['Nivel'], $cpf_hash);

  if (mysqli_stmt_execute($stmt)) {
    $_SESSION["warning"] = generateWarning("Usuário cadastrado com sucesso! Senha padrão: ".$senha, false);
  } else {
    $_SESSION["warning"] = generateWarning("Usuário não cadastrado!");
  }
  mysqli_stmt_close($stmt);
  header('location:../../../?page=cadUser');
  mysqli_close($connection);
?>
