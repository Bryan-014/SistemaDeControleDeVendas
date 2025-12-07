<?php
  $connParm = [
    "host" => "localhost",
    "user" => "root",
    "pass" => "",
    "db" => "dbtapiocadacris"
  ];
  $connection = mysqli_connect($connParm['host'], $connParm['user'], $connParm['pass'], $connParm['db']);
?>