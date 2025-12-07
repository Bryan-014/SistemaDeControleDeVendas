<?php
  require_once('../util.php');
  if (!isset($_POST['desc'])) {
    header('location:../../../?page=cadAdds');
    exit();
  }

  if (mysqli_query($connection, "insert into tbl_adicionais (descricao, preco, categoria) values ('".$_POST['desc']."', ".$_POST['prec'].", '".$_POST['cat']."')")) {
    $_SESSION["warning"] = generateWarning("Ingrediente cadastrado com sucesso!", false);
  } else {
    $_SESSION["warning"] = generateWarning("Ingrediente não cadastrado!");
  }
  header('location:../../../?page=cadAdds');
  mysqli_close($connection);
?>