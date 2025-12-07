<body>
  <?php
    //require_once('./assets/pages/loading.php');
    if (isset($_GET["page"])) {
      switch ($_GET["page"]) {
        case 'login':
          require_once("./assets/pages/login.php");
          break;
        case 'sell':
          require_once("./assets/pages/vender.php");
          break;
        case 'fila':
          require_once("./assets/pages/fila/index.php");
          break;
        case 'editOrd':
          require_once("./assets/pages/fila/editOrdem.php");
          break;
        case 'caixa':
          require_once("./assets/pages/caixa/index.php");
          break;
        case 'rell':
          require_once("./assets/pages/relatorio/index.php");
          break;
        case 'rellDet':
          require_once("./assets/pages/relatorio/det.php");
          break;
        case 'prod':
          require_once("./assets/pages/produto/index.php");
          break;
        case 'cadProd':
          require_once("./assets/pages/produto/cadProd.php");
          break;
        case 'editProd':
          require_once("./assets/pages/produto/editProd.php");
          break;
        case 'adds':
          require_once("./assets/pages/produto/adds.php");
          break;            
        case 'cadAdds':
          require_once("./assets/pages/produto/cadAdds.php");
          break;            
        case 'editAdds':
          require_once("./assets/pages/produto/editAdds.php");
          break;   
        case 'user':
          require_once("./assets/pages/user/index.php");
          break; 
        case 'cadUser':
          require_once("./assets/pages/user/cadUser.php");
          break; 
        case 'editUser':
          require_once("./assets/pages/user/editUser.php");
          break; 
        case 'help':
          require_once("./assets/pages/help.php");
          break; 
        default:
          require_once("./assets/pages/notFoundPage.php");
          break;
      }
    } else {
      require_once("./assets/pages/login.php");
    }
    require_once("./assets/php/call/callJs.php");
  ?>  
</body>