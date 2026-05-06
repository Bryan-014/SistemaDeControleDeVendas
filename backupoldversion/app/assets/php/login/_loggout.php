<?php
  session_start();

  header('Location:../../../');

  session_unset();
  session_destroy();
?>