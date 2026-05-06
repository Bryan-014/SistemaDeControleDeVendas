<script src="./assets/bootstrap/js/bootstrap.min.js"></script>
<script src="./assets/js/jquery/jquery.min.js"></script>
<script src="./assets/js/jquery/jqueryMask.min.js"></script>
<!--<script src="./assets/js/shered/loading.js"></script>-->
<?php
  if (isset($_SESSION["user"]["id"]) && $_SESSION["user"]["id"] == '48630922-4e77-11ed-b757-feed01220056'){
    ?>
      <script src="./assets/js/locale/updateLocale.js"></script>
    <?php 
  }

  if (isset($_GET["page"])) {
    switch ($_GET["page"]) {
      case 'login':
        ?>
          <script src="./assets/js/login/load.js"></script>          
        <?php
        break;
      case 'sell':
        ?>
          <script src="./assets/js/sell/sell.js"></script>
          <script src="./assets/js/sell/process.js"></script>
          <script src="./assets/js/sell/adds.js"></script>
          <script src="./assets/js/sell/edit.js"></script>
          <script src="./assets/js/shered/qrcode.js"></script>
          <script src="./assets/js/shered/loadProdAdd.js"></script>
          <?php
        break;
      case 'fila':
          ?>
          <script src="./assets/js/fila/reloadFila.js"></script>          
          <?php
        break;
      case 'editOrd':
          ?>
          <script src="./assets/js/fila/fila.js"></script>
          <script src="./assets/js/shered/loadProdAdd.js"></script>
          <script src="./assets/js/shered/qrcode.js"></script>
        <?php
        break;
      case 'rell':
        ?>
          <script src="./assets/js/rell/load.js"></script>          
        <?php
        break;
      case 'rellDet':
        ?>
          <script src="./assets/js/rell/det.js"></script>          
        <?php
        break;
      case 'prod':
          ?>
          <script src="./assets/js/produto/loadProds.js"></script>
        <?php
        break;
      case 'adds':
        ?>
          <script src="./assets/js/produto/loadAdds.js"></script>
        <?php
        break;
      case 'editProd':
          ?>
          <script src="./assets/js/produto/loading.js"></script>
        <?php
        break;
      case 'editAdds':
        ?>
          <script src="./assets/js/produto/loading.js"></script>
        <?php
        break;
      case 'cadProd':
          ?>
          <script src="./assets/js/produto/loading.js"></script>
        <?php
        break;
      case 'cadAdds':
        ?>
          <script src="./assets/js/produto/loading.js"></script>
        <?php
        break;
      case 'user':
        ?>
          <script src="./assets/js/user/listUser.js"></script>
        <?php
        break;
      case 'cadUser':
        ?>
          <script src="./assets/js/user/closeLoad.js"></script>
        <?php
        break;
      case 'editUser':
        ?>
          <script src="./assets/js/user/closeLoad.js"></script>
        <?php
        break;
      default:
        break;
    }
  } else {
    ?>
      <script src="./assets/js/login/load.js"></script>
    <?php
  }
?>