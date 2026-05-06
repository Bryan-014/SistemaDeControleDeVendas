<?php
  $connParm = [
    "host" => "localhost",
    "user" => "root",
    "pass" => "",
    "db" => "db_sca"
  ];
  $connection = mysqli_connect($connParm['host'], $connParm['user'], $connParm['pass'], $connParm['db']);
?>