<?php
require_once("../util.php");

if (!isset($_POST["cpf"]) || !isset($_POST["pass"])) {
  header("Location:../../../?page=login");
  exit();
}

$cpf_input_hash = md5(replace_cpf($_POST["cpf"]));
$query = "SELECT * FROM tbl_user WHERE cpf = ?";
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, "s", $cpf_input_hash);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

$_SESSION['cpfDesc'] = $_POST["cpf"];

if ($user) {
  if (!$user['ativo']) {
    $_SESSION["warning"] = generateWarning("Usuário inativado!");
    unset($_SESSION["user"]);
    header("Location:../../../?page=login");
    mysqli_close($connection);
    exit();
  }

  $stored = $user['senha'];

  $login_ok = false;

  if (password_verify($_POST['pass'], $stored)) {
    $login_ok = true;

    $options = ['cost' => 12];
    if (password_needs_rehash($stored, PASSWORD_DEFAULT, $options)) {
      $newHash = password_hash($_POST['pass'], PASSWORD_DEFAULT, $options);
      $sql = "UPDATE tbl_user SET senha = ? WHERE id = ?";
      $upd = mysqli_prepare($connection, $sql);
      mysqli_stmt_bind_param($upd, "ss", $newHash, $user['id']);
      mysqli_stmt_execute($upd);
      mysqli_stmt_close($upd);
    }

  } else {
    if (preg_match('/^[a-f0-9]{32}$/i', $stored)) {
      if ($stored === md5($_POST['pass'])) {
        $login_ok = true;
        $options = ['cost' => 12];
        $newHash = password_hash($_POST['pass'], PASSWORD_DEFAULT, $options);
        $sql = "UPDATE tbl_user SET senha = ? WHERE id = ?";
        $upd = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($upd, "ss", $newHash, $user['id']);
        mysqli_stmt_execute($upd);
        mysqli_stmt_close($upd);
      }
    }
  }

  if ($login_ok) {
    $_SESSION["user"] = $user;
    $_SESSION["e055fc1b8b6647e27bc36aa81b5fd7c0"] = true;
    header("Location:../../../?page=sell");
    mysqli_close($connection);
    exit();
  } else {
    $_SESSION["warning"] = generateWarning("Usuário ou senha incorretos!");
    unset($_SESSION["user"]);
  }

} else {
  $_SESSION["warning"] = generateWarning("Usuário ou senha incorretos!");
  unset($_SESSION["user"]);
}

header("Location:../../../?page=login");
mysqli_close($connection);
?>
