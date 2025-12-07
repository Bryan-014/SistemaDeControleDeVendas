<?php
  require_once('../util.php');

  $pgto = mysqli_fetch_assoc(mysqli_query($connection, "select pagamento from tbl_vendas where id = ".$_POST['venda']));

  if (mysqli_query($connection, "update tbl_vendas set total = total - ".str_replace('R$ ', '', $_POST['vallTotal'])." where id = ".$_POST['venda'])) {
    if (mysqli_query($connection, "delete from tbl_ordem where ordem = ".$_POST['ord'])) {
      $_SESSION["warning"] = generateWarning("Pedido cancelado!", false);
    } else {
      $_SESSION["warning"] = generateWarning("Pedido não cancelado!");
    }
  } else {
    $_SESSION["warning"] = generateWarning("Pedido não cancelado!");
  }

  header("location:../../../?page=fila");
  mysqli_close($connection);
?>