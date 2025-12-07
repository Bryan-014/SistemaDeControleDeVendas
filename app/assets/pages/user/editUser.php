<?php
  if(isset($_POST['id'])) {
    $id = $_POST['id']; 
  } else {
    $id = $_GET['id']; 
  }
  
  require_once('./assets/php/call/callHeader.php');
  $user = mysqli_fetch_assoc(mysqli_query($connection, "select * from tbl_user where id = '".$id."'"));
?>
<div class="user-container mt-3">
  <div class="navbar">
    <h3>Usuário</h3>
    <a href="./?page=user" class="btn bt-primary">Voltar</a>
  </div>
  <?php require_once('./assets/php/util/validWarning.php')?>
  <div>
    <form action="./assets/php/user/editBase.php" method="post">
      <input type="hidden" name="id" value="<?php echo($id)?>">
      <div class="d-flex">
        <div class="form-floating w-45 m-1 mt-1">
          <input type="text" name="userName" class="form-control" placeholder="desc" <?php if ($_SESSION['user']['id'] != $id) {echo("readonly");} ?> required autocomplete="off" value="<?php echo($user['usuario'])?>">
          <label for="desc">Nome</label>
        </div>
        <div class="form-floating w-45 m-1 mt-1">
          <select id="Nivel" name="Nivel" class="form-control" placeholder="desc" required <?php if ($_SESSION['user']['nivel'] != "master") {echo("readonly");}?>>
            <option value="normal" <?php if ($user["nivel"] == "normal") {echo("Selected");}?>>Normal</option>
            <option value="master" <?php if ($user["nivel"] == "master") {echo("Selected");}?>>Master</option>
          </select>
          <label for="desc">Nível</label>
        </div>
      </div>
      <input type="submit" class="m-1 btn bt-primary" value="Salvar">
      <?php
        /*
        if ($_SESSION['user']['id'] != $id) {
          if ($_SESSION['user']['nivel'] == "master") {
            if ($user["ativo"] == 1) {
              $mode = "Desativar";
            } else {
              $mode = "Ativar";
            }
            ?><a href="./assets/php/user/descActiv.php?<?php echo("mode=".$mode."&id=".$id)?>" class="btn bt-primary"><?php echo($mode)?></a><?php       
          }
        }
        if ($_SESSION['user']['id'] == $id) {
          if ($_SESSION['user']['nivel'] == "master"){
            $location = mysqli_fetch_assoc(mysqli_query($connection, "select * from tbl_locale"));
            if ($location['active'] == 1) {
              $mode = "Desativar";
            } else {
              $mode = "Ativar";
            }
            ?><a href="./assets/php/util/activeMap.php?<?php echo("mode=".$mode."&id=".$id)?>" class="btn bt-primary"><?php echo($mode)?> mapa</a><?php  
          }
        }
        */
      ?> 
    </form>
    <?php if ($_SESSION['user']['id'] == $id) { ?>
      <form action="./assets/php/user/changePass.php" method="post">
        <input type="hidden" name="id" value="<?php echo($id)?>">
        <h5>Trocar Senha</h5>
        <div class="d-flex">
          <div class="form-floating w-45 m-1 mt-1">
            <input type="password" name="newPass" class="form-control" placeholder="desc" required autocomplete="off">
            <label for="desc">Nova Senha</label>
          </div>
          <div class="form-floating w-45 m-1 mt-1">
            <input type="password" name="confirmPass" class="form-control" placeholder="desc" required autocomplete="off">
            <label for="desc">Confirmar Senha</label>
          </div>
        </div>
        <input type="submit" class="m-1 btn bt-primary" value="Confirmar">
      </form>
    <?php }?>
  </div>
</div>