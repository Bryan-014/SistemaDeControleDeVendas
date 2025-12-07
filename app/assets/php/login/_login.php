<?php
  require_once("../util.php");

  if (!isset($_SESSION["user"]) || (isset($_SESSION["user"]["cpf"]) && $_SESSION["user"]["cpf"] != md5(replace_cpf($_POST["cpf"])))) {
    $query = "select * from tbl_user where cpf = '".md5(replace_cpf($_POST["cpf"]))."'";
    $user = mysqli_query($connection, $query);
    $_SESSION["user"] = mysqli_fetch_assoc($user);
  }
  $_SESSION['cpfDesc'] = $_POST["cpf"];

  if (isset($_SESSION["user"]["usuario"])) {
    if ($_SESSION["user"]["ativo"]) {
      if ($_SESSION["user"]["senha"] == md5($_POST["pass"])) {
        $_SESSION["e055fc1b8b6647e27bc36aa81b5fd7c0"] = true;
        header("Location:../../../?page=sell");
        exit();
      } else {
        $_SESSION["warning"] = generateWarning("Usuário ou senha incorretos!");
      }
    } else {
      $_SESSION["warning"] = generateWarning("Usuário inativado!");
      unset($_SESSION["user"]);
    }
  } else {
    $_SESSION["warning"] = generateWarning("Usuário ou senha incorretos!");
    unset($_SESSION["user"]);
  }
  header("Location:../../../?page=login");
  mysqli_close($connection);
?>