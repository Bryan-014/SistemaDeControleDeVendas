<?php
  $app = [
    'name' => 'Sistema de Controle de Vendas',
    'version' => 'v1.4',
    'color' => '250'
  ];
  
  require_once("./assets/php/util.php");
  
  if (isset($_GET['page']) && $_GET['page'] != 'login') {
      if (!isset($_SESSION['e055fc1b8b6647e27bc36aa81b5fd7c0'])) {
          header('location:?page=login');
          exit();
      }
  } else {
      if (isset($_SESSION['e055fc1b8b6647e27bc36aa81b5fd7c0'])) {
          header('location:?page=sell');
          exit();
      }
  }
  
  require_once("./assets/php/vers.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
  <?php
    require_once("./assets/php/call/callHead.php");
    require_once("./assets/php/call/callBody.php");
  ?>
</html>
<?php 
    mysqli_close($connection);
    unset($_SESSION['redirect']);
?>