<?php
  function generateWarning($msg, $isDanger = true) {
    return [
      "danger" => $isDanger,
      "msg" => $msg
    ];
  }

  function replace_cpf($cpf){
    return str_replace(".", "", str_replace("-", "", $cpf));
  }

  function abrevStr($str, $lenToAbrev = 36, $prefix = '...') {
    if (strlen($str) > $lenToAbrev) {
      return substr($str, 0, $lenToAbrev).$prefix;
    } 
    return $str;    
  }  
?>