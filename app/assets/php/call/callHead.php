<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    :root {
      --color: <?php echo($app['color'])?>deg;
    }
  </style>
  <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="./assets/css/style.css" />
  <?php
    if (isset($_GET["page"])) {
      switch ($_GET["page"]) {
        case 'login':
          ?>
            <link rel="stylesheet" href="./assets/css/login.css" />
          <?php
          break;
        case 'sell':
          ?>
            <link rel="stylesheet" href="./assets/css/sell.css">
          <?php
          break;
        case 'fila':
          ?>
            <link rel="stylesheet" href="./assets/css/fila.css">
          <?php
          break;
        case 'editOrd':
          ?>
            <link rel="stylesheet" href="./assets/css/fila.css">
          <?php
          break;
        case 'caixa':
          ?>
            <link rel="stylesheet" href="./assets/css/caixa.css">
          <?php
          break;
        case 'rell':
          ?>
            <link rel="stylesheet" href="./assets/css/rell.css">
          <?php
          break;
        case 'rellDet':
          ?>
            <link rel="stylesheet" href="./assets/css/rell.css">
          <?php
          break;
        case 'prod':
          ?>
            <link rel="stylesheet" href="./assets/css/prod.css">
          <?php
          break;
        case 'cadProd':
          ?>
            <link rel="stylesheet" href="./assets/css/prod.css">
          <?php
          break;
        case 'editProd':
          ?>
            <link rel="stylesheet" href="./assets/css/prod.css">
          <?php
          break;
        case 'adds':
          ?>
            <link rel="stylesheet" href="./assets/css/prod.css">
          <?php
          break;            
        case 'cadAdds':
          ?>
            <link rel="stylesheet" href="./assets/css/prod.css">
          <?php
          break;            
        case 'editAdds':
          ?>
            <link rel="stylesheet" href="./assets/css/prod.css">
          <?php
          break;   
        case 'user':
          ?>
            <link rel="stylesheet" href="./assets/css/user.css">
          <?php
          break; 
        case 'cadUser':
          ?>
            <link rel="stylesheet" href="./assets/css/user.css">
          <?php
          break; 
        case 'editUser':
          ?>
            <link rel="stylesheet" href="./assets/css/user.css">
          <?php
          break; 
        case 'help':
          ?>
            <link rel="stylesheet" href="./assets/css/help.css">
          <?php
          break; 
        default:
          ?>
            <link rel="stylesheet" href="./assets/css/fila.css">
          <?php
          break;
      }
    } else {
      ?>
        <link rel="stylesheet" href="./assets/css/login.css" />
      <?php
    }
  ?>
  <title><?php echo($app['name'])?></title>
</head>
