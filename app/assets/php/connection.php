<?php
  $connParm = [
    "host" => "localhost",
    "user" => "root",
    "pass" => "123456",
    "db" => "db_sca"
  ];
  $connection = mysqli_connect($connParm['host'], $connParm['user'], $connParm['pass'], $connParm['db']);
?>