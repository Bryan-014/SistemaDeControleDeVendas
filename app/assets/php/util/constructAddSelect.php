<option value="0"></option>
<?php
  if (!isset($connection)) {
    require_once('../util.php');
  }
  if (!isset($adds)) {
    require_once('../sell/_listAdds.php');
  }

  foreach ($adds as $add) {
    $abrev = abrevStr($add['descricao']);
    ?><option value="<?php echo($add["cod"])?>"><?php echo($abrev)?></option><?php
  }
?>