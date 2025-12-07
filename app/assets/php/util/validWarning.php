<?php        
  if (isset($_SESSION["warning"])) {
    ?>
      <div class="text-center p-2 alert alert-<?php
        if ($_SESSION["warning"]["danger"]) {
          echo("danger");
        } else {
          echo("success");
        }
      ?> m-3 p-0">
        <b>
          <?php echo($_SESSION["warning"]["msg"])?>
        </b>
      </div>
    <?php
    unset($_SESSION["warning"]);
  }
?>