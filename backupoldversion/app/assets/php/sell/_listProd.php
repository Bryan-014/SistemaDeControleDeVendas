<?php
  $products = mysqli_query($connection, "select * from tbl_produtos where ativo = 1");
?>