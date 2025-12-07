<body>
  <?php
    if (isset($_GET["page"])) {
      switch ($_GET["page"]) {
        case 'card':
          require_once("./assets/pages/cardapio.php");
          break;
        default:
          require_once("./assets/pages/notFoundPage.php");
          break;
      }
    } else {
      require_once("./assets/pages/cardapio.php");
    }
    require_once("./assets/php/call/callJs.php");
  ?>  
</body>