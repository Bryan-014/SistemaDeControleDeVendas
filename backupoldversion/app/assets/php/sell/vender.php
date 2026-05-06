<?php
  require_once("../util.php");
  $qtdPr = $_POST['qtdProdutos'];

  $venda = [
    'cliente' => $_POST['clientName'],
    'total' => str_replace('R$ ', '', $_POST['vallTotal']),
    'pgto' => $_POST['pgtFor']
  ];

  $last = mysqli_fetch_assoc(mysqli_query($connection, "select MAX(id) as id from tbl_vendas"))['id'];
  if (isset($last)) {
    $lastVend = mysqli_fetch_assoc(mysqli_query($connection, "select * from tbl_vendas where id = $last and dia > '".date('Y-m-d')." 00:00:00' and dia < '".date('Y-m-d')." 23:59:59'"));
  
    if (isset($lastVend['ofDay'])) {
      $ofDay = $lastVend['ofDay'] + 1;
    } else {
      $ofDay = 1;
    }
  } else {
    $ofDay = 1;  
  }

  mysqli_query($connection, "insert into tbl_vendas (cliente, pagamento, total, operador, ofDay, dia) values ('".$venda['cliente']."','".$venda['pgto']."','".$venda['total']."', '".$_SESSION["user"]["id"]."', ".$ofDay.", '".date('Y-m-d H:i:s')."')");

  $lastIndex = mysqli_fetch_assoc(mysqli_query($connection, "select MAX(id) as id from tbl_vendas"))['id'];
  for ($i=1; $i <= $qtdPr; $i++) {
    if (($_POST['codPro-'.$i] != "" || $_POST['qtdPro-'.$i] != "" || $_POST['valPro-'.$i] != "") && ($_POST['codPro-'.$i] != "undefined" || $_POST['qtdPro-'.$i] != "undefined" || $_POST['valPro-'.$i] != "undefined")) {
      mysqli_query($connection, "insert into tbl_ordem (codigo_produto, adicionais, qtd, codigo_venda, valor_uni, obs) values ('".$_POST['codPro-'.$i]."','".$_POST['addsPro-'.$i]."',".$_POST['qtdPro-'.$i].",".$lastIndex.", '".$_POST['valPro-'.$i]."', '".$_POST['obsPro-'.$i]."')");      
    }
  }

  $_SESSION["warning"] = generateWarning("Pedido cadastrado, o número do pedido é: ".$ofDay, false);

  header("location:../../../?page=sell");
  mysqli_close($connection);
?>