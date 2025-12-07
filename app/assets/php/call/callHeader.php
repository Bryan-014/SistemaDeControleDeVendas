<div class="navbar p-2 bgr-primary ps-3 pe-3">
  <div>
    <Label class="h1 text-light"><?php echo($app['name'])?></Label><span class="text-light" style="font-size: 8px;"><?php echo($app['version'])?></span>
  </div>
  <div class="btn-group">
    <a class="text-light" style="cursor: pointer;"data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Seções</a>
    <ul class="dropdown-menu">
      <li class="text-center"><span><?php echo($_SESSION["user"]["usuario"])?></span></li>
      <li><a href="./?page=sell" class="dropdown-item text-dark" id="drop1">Vender</a></li>
      <li><a href="./?page=fila" class="dropdown-item text-dark" id="drop2">Fila</a></li>
      <li><a href="./?page=caixa" class="dropdown-item text-dark" id="drop2">Caixa</a></li>
      <li><a href="./?page=rell" class="dropdown-item text-dark" id="drop3">Relatórios</a></li>
      <li><a href="./?page=prod" class="dropdown-item text-dark" id="drop4">Produtos</a></li>
      <li><a href="./?page=user" class="dropdown-item text-dark" id="drop5">Usuários</a></li>
      <!--<li><a href="./?page=help" class="dropdown-item text-dark">Ajuda</a></li>-->
      <div class="dropdown-divider"></div>
      <li><a href="./assets/php/login/_loggout.php" class="dropdown-item text-dark" id="drop6">Sair</a></li>
    </ul>
  </div>
</div>