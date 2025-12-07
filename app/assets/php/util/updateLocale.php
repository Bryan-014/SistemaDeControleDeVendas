<?php
  require_once('../util.php');
  if (isset($_POST['longi']) && $_POST['lati']) {
    mysqli_query($connection, "update tbl_locale set lati = '".$_POST['lati']."', longi = '".$_POST['longi']."'");
  }
?>