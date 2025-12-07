<?php
  require_once('../util.php');

  $pgto = mysqli_fetch_assoc(mysqli_query($connection, "select pagamento from tbl_vendas where id = ".$_POST['vnd']));

  if (mysqli_query($connection, "update tbl_vendas set total = total + ".str_replace('R$ ', '', $_POST['vallTotal'])." where id = ".$_POST['vnd'])) {
    if (mysqli_query($connection, "update tbl_ordem set codigo_produto = ".$_POST['codProd'].", adicionais = '".$_POST['adds']."', qtd = ".$_POST['qtd'].", valor_uni = ".$_POST['valUni'].", obs = '".$_POST['obs']."' where ordem = ".$_POST['ord'])) {
      $_SESSION["warning"] = generateWarning("Pedido atualizado!", false);
    } else {
      $_SESSION["warning"] = generateWarning("Pedido não atualizado!");
    }
  } else {
    $_SESSION["warning"] = generateWarning("Pedido não atualizado!");
  }

  header("location:../../../?page=editOrd&id=".$_POST['ord']."&codVen=".$_POST['vnd']);
  mysqli_close($connection);
?>