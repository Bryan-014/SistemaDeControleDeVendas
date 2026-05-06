<?php
  require_once('../util.php');
  if (!isset($_POST['cod'])) {
    header('location:../../../?page=editAdds');
    exit();
  }

  if (mysqli_query($connection, "update tbl_adicionais set descricao = '".$_POST['desc']."', preco = ".$_POST['prec']." where cod = ".$_POST['cod'])) {
    $_SESSION["warning"] = generateWarning("Ingrediente atualizado com sucesso!", false);
  } else {
    $_SESSION["warning"] = generateWarning("Ingrediente não atualizado!");
  }
  header('location:../../../?page=editAdds&cod='.$_POST['cod']);
  mysqli_close($connection);
?>