<option value="0"></option>
<?php
  if (!isset($connection)) {
    require_once('../util.php');
  }
  if (!isset($products)) {
    require_once('../sell/_listProd.php');
  }


  foreach ($products as $product) {
    $abrev = abrevStr($product['descricao']);
    ?><option value="<?php echo($product["cod"])?>"><?php echo($abrev)?></option><?php
  }
?>