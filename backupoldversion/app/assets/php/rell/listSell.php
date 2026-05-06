<?php
  if (isset($_POST['dataIni'])) {
    $dateIni = $_POST['dataIni'];
  } else {
    $dateIni = date('Y-m-d');
  }
  
  if (isset($_POST['dataFim'])) {
    $dataFim = $_POST['dataFim'];    
  } else {
    $dataFim = date('Y-m-d');
  }

  $sql = "select * from tbl_vendas where dia > '".$dateIni." 00:00:00' and dia < '".$dataFim." 23:59:59'";

  if (isset($_POST['dinheiro'])) {
    $dimCheck = 'checked';
    $sql .= 'and pagamento like "%dinheiro: %"';
  } else {
    $dimCheck = '';
  }

  if (isset($_POST['cartao'])) {
    $cardCheck = 'checked';
    $sql .= 'and pagamento like "%cartao: %"';
  } else {
    $cardCheck = '';
  }

  if (isset($_POST['pix'])) {
    $pixCheck = 'checked';
    $sql .= 'and pagamento like "%pix: %"';
  } else {
    $pixCheck = '';
  }

  if (isset($_POST['desconto'])) {
    $desCheck = 'checked';
    $sql .= 'and pagamento like "%desconto: %"';
  } else {
    $desCheck = '';
  }
  
  if ($_SESSION['user']['nivel'] != 'master') {
    $sql .= "and operador = '".$_SESSION['user']['id']."'";
  } else {
    if (isset($_POST["oper"]) && $_POST["oper"] != '0') {
      $sql .= "and operador = '".$_POST["oper"]."'";
    }
  }

  $result = mysqli_query($connection, $sql);
?>