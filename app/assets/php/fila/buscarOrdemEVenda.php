<?php
  if (isset($_POST['id'])) {
    $id = $_POST['id'];
  } else {
    $id = $_GET['id'];
  }

  if (isset($_POST['codVen'])) {
    $codVen = $_POST['codVen'];
  } else {
    $codVen = $_GET['codVen'];
  }

  $ordem = mysqli_fetch_assoc(mysqli_query($connection, "select * from tbl_ordem where ordem = ".$id));
  $venda = mysqli_fetch_assoc(mysqli_query($connection, "select tbl_vendas.*, tbl_user.usuario as user from tbl_vendas inner join tbl_user on tbl_vendas.operador = tbl_user.id where tbl_vendas.id = ".$codVen));
?>