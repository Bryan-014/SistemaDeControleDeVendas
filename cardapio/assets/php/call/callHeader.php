<?php
  if (!isset($_SESSION["logged"])) {
    header("location:?page=login");
  }
?>
<div class="navbar p-2 bgr-primary">
  <div>
    <Label class="h1 text-light"><?php echo($app['name'])?></Label><span class="text-light" style="font-size: 8px;"><?php echo($app['version'])?></span>
  </div>
  <div class="btn-group">
    <a class="text-light" data-bs-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">Seções</a>
    <ul class="dropdown-menu">
      <li class="text-center"><span><?php echo($_SESSION["user"]["usuario"])?></span></li>
      <li><a href="./?page=sell" class="dropdown-item text-dark">Vender</a></li>
      <li><a href="./?page=fila" class="dropdown-item text-dark">Fila</a></li>
      <li><a href="./?page=rell" class="dropdown-item text-dark">Relatórios</a></li>
      <li><a href="./?page=prod" class="dropdown-item text-dark">Produtos</a></li>
      <li><a href="./?page=user" class="dropdown-item text-dark">Usuários</a></li>
      <li><a href="./?page=help" class="dropdown-item text-dark">Ajuda</a></li>
      <div class="dropdown-divider"></div>
      <li><a href="./assets/php/login/_loggout.php" class="dropdown-item text-dark">Sair</a></li>
    </ul>
  </div>
</div>