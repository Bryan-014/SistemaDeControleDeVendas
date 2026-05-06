<link rel="stylesheet" href="./assets/css/cardapio.css">
<div class="navbar bgr-primary">
  <div>
    <Label class="h1 text-light" style="margin: 0;"><?php echo($app['name'])?></Label>
  </div>
</div>
<?php
    $locale = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM tbl_locale where active = 1"));
    /*if (isset($locale['lati']) && isset($locale['longi'])) {
      ?><div id="mapa" class="mt-3"><?php
          require_once('./assets/pages/mapa.php');
      ?></div><?php
    } else {
      echo('<h2 class="text-center">Não estamos atendendo no momento😥😔</h2>');
    }*/
    require_once('./assets/php/cardapio/_read.php');
?>

            