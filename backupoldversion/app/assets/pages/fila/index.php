<?php
  require_once('./assets/php/call/callHeader.php');
?>
<div class="fila-container mt-3">
  <span  class="h2">
    Fila
  </span>
  <?php require_once('./assets/php/util/validWarning.php'); ?>
  <div id="fila-content">
    <?php 
      require_once('./assets/php/fila/generateTable.php');
    ?>
  </div>
</div>
