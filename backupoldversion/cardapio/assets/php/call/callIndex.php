<?php
  $app = [
    'name' => 'Tapioca da Cris',
    'version' => 'v1.0',
    'color' => '666'
  ];
  require_once("./assets/php/util.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
  <?php
    require_once("./assets/php/call/callHead.php");
    require_once("./assets/php/call/callBody.php");
  ?>
</html>
<?php mysqli_close($connection)?>