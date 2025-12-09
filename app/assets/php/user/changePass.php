<?php
  require_once('../util.php');
  if (!isset($_POST['id'])) {
    header('location:../../../?page=editUser');
    exit();
  }

  if (strlen($_POST['newPass']) < 6) {
    $_SESSION["warning"] = generateWarning("A senha deve ter mais de 6 caracteres!");
  } elseif ($_POST['newPass'] != $_POST['confirmPass']) {
    $_SESSION["warning"] = generateWarning("As senhas não são iguais!");
  } else {
    $options = ['cost' => 12];
    $newHash = password_hash($_POST['newPass'], PASSWORD_DEFAULT, $options);

    $sql = "UPDATE tbl_user SET senha = ? WHERE id = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $newHash, $_POST['id']);
    if (mysqli_stmt_execute($stmt)) {
      $_SESSION["warning"] = generateWarning("Senha alterada com sucesso!", false);
    } else {
      $_SESSION["warning"] = generateWarning("Senha não alterada!");
    }
    mysqli_stmt_close($stmt);
  }
  header('location:../../../?page=editUser&id='.$_POST['id']);
  mysqli_close($connection);
?>
