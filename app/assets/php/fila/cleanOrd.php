<?php
  require_once("../util.php");
  mysqli_query($connection, "update tbl_ordem set finalizado = 1 where ordem = ".$_GET["ord"]);
  header("location:../../../?page=fila");
  mysqli_close($connection);
?>