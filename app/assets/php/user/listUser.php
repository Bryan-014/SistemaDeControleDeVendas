<?php
  if (!isset($connection)) {
    require_once('../util.php');
  }
?>
<div class="navbar">
  <h3>Usuários</h3>
  <div>
    <div class="d-flex"></div>
    <form action="./?page=editUser" method="post">
      <input type="hidden" name="id" value="<?php echo($_SESSION['user']['id'])?>" />
      <input type="submit" class="btn bt-primary" value="Seu Usuário"/>
      <?php
        if ($_SESSION['user']['nivel'] == 'master') {
          ?><a href="?page=cadUser" class="btn bt-primary">Novo Usuário</a><?php
        }
      ?>      
    </form>  
  </div>
</div>
<div class="table-user">
  <table>
    <thead>
      <tr>
        <th>Usuário</th>
        <th>Ativo</th>
        <th>Nível</th>
        <?php
          if ($_SESSION['user']['nivel'] == 'master') {
            ?><th>Ações</th><?php
          }
        ?>           
      </tr>
    </thead>
    <tbody>
      <?php
        $users = mysqli_query($connection, "select * from tbl_user order by usuario");
        foreach ($users as $user) {
          ?>
            <tr>
              <td><?php echo($user['usuario'])?></td>
              <td><?php 
                  if ($user['ativo'] == 0) {
                    echo("Não");
                  } else {
                    echo("Sim");
                  }
                ?></td>
              <td><?php echo($user['nivel'])?></td>
              <?php
                if ($_SESSION['user']['nivel'] == 'master') {
                  ?>
                    <td>
                      <form action="./?page=editUser" method="post">
                        <input type="hidden" name="id" value="<?php echo($user['id'])?>">
                        <input type="submit" class="btn bt-primary w-100" value="Editar">
                      </form>
                    </td>
                  <?php
                }
              ?>
            </tr>
          <?php
        }
      ?>
    </tbody>
  </table>
</div>