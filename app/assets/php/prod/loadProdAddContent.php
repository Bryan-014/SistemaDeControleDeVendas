<?php
  if (!isset($connection)) {
    require_once('../util.php');
  }
?>
<div class="navbar">
  <h3><?php echo($_POST['type']) ?></h3>
  <div>
    <?php
      if ($_POST['type'] == 'Produtos') {
        ?>        
          <a href="?page=adds" class="btn bt-primary" id="opn">Ingredientes</a>
        <?php
      } else {
        ?>
          <a href="?page=prod" class="btn bt-primary" id="opn">Voltar</a>
        <?php
      }
    ?>
    <?php
      if ($_SESSION['user']['nivel'] == 'master') {
        ?><a href="?page=cad<?php
          if ($_POST['type'] == 'Produtos') {
            echo('Prod');
          } else {
            echo('Adds');
          }
        ?>" class="btn bt-primary" id="open">Novo <?php
        if ($_POST['type'] == 'Produtos') {
          echo('Sabor');
        } else {
          echo('Ingrediente');
        }
      ?></a><?php
      }
    ?>      
  </div>
</div>
<?php require_once('../util/validWarning.php')?>
<div class="prod-table">
  <table>
    <thead>
      <tr>
        <th>Cód</th>
        <th>Descrição</th>
        <th>Categoria</th>
        <th>Preço</th>
        <?php
          if ($_SESSION['user']['nivel'] == 'master') {
            ?><th>Ações</th><?php
          }
        ?>
      </tr>
    </thead>
    <tbody>
      <?php
        if ($_POST['type'] == 'Produtos') {
          $table = 'tbl_produtos';
        } else {        
          $table = 'tbl_adicionais';
        }
        $prods = mysqli_query($connection, "select * from $table where ativo = 1");
        foreach ($prods as $prod) {
          ?>
            <tr>
              <td><?php echo($prod['cod'])?></td>
              <td><?php echo($prod['descricao'])?></td>
              <td><?php echo($prod['categoria'])?></td>
              <td>R$ <?php echo(number_format($prod['preco'], 2, '.', ','))?></td>
              <?php
                if ($_SESSION['user']['nivel'] == 'master') {
                  ?><td><form action="./?page=edit<?php
                  if ($_POST['type'] == 'Produtos') {
                    echo('Prod');
                  } else {
                    echo('Adds');
                  }
                ?>" method="post"><input type="hidden" name="id" value="<?php echo($prod['cod'])?>"><input type="submit" value="Editar" class="btn bt-primary w-100" onclick="openLoading()"></form></td><?php
                }
              ?>                
            </tr>
          <?php
        }
      ?>
    </tbody>
  </table>
</div>