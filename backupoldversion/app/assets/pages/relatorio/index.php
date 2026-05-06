<?php
  require_once('./assets/php/call/callHeader.php');
  require_once('./assets/php/rell/listSell.php');
?>
<div class="rell-container mt-3">
  <h3>
    Relatórios
  </h3>
  <form action="./?page=rell" method="post">
    <div class="d-flex">
      <div class="form-floating mb-2 mt-2 m-1 w-50">
        <input
          id="dataIni"
          type="date"
          name="dataIni"
          class="form-control"
          placeholder="dd/mm/YYYY"
          autocomplete="off"
          value="<?php echo($dateIni)?>"
        />
        <label for="dataIni">Data Inicial</label>
      </div>
      <div class="form-floating mb-2 mt-2 m-1 w-50">
        <input
          id="dataFim"
          type="date"
          name="dataFim"
          class="form-control"
          placeholder="Total a pagar"
          value="<?php echo($dataFim)?>"
        />
        <label for="dataFim">Data Final</label>
      </div>
    </div>
    <div class="d-flex">
      <?php
        if ($_SESSION['user']['nivel'] == 'master') {
          ?>
            <div class="form-floating mb-2 mt-2 m-1 w-50">
              <select
                id="oper"
                name="oper"
                class="form-control"
                autocomplete="off"
              >
                <option value="0"></option>
                <?php
                  $users = mysqli_query($connection, "select * from tbl_user order by usuario");
                  foreach ($users as $user) {
                    
                    ?><option value="<?php echo($user['id'])?>"<?php
                      if (isset($_POST["oper"]) && $_POST["oper"] == $user['id']) {
                        echo("Selected");
                      }
                    ?>><?php echo($user['usuario'])?></option><?php
                  }
                ?>
              </select>
              <label for="dataIni">Vendedor</label>
            </div>
          <?php
        }
      ?>
      <div class="container-filt d-flex">
        <div class="justfy-center">
          <input type="checkbox" name="dinheiro" class="m-2" <?php echo($dimCheck)?>>
          <label style="margin-top: 2px;">Dinheiro</label>
        </div>
        <div class="justfy-center">
          <input type="checkbox" name="cartao" class="m-2" <?php echo($cardCheck)?>>
          <label style="margin-top: 2px;">Cartão</label>
        </div>
        <div class="justfy-center">
          <input type="checkbox" name="pix" class="m-2" <?php echo($pixCheck)?>>
          <label style="margin-top: 2px;">Pix</label>
        </div>
        <div class="justfy-center">
          <input type="checkbox" name="desconto" class="m-2" <?php echo($desCheck)?>>
          <label style="margin-top: 2px;">Desconto</label>
        </div>
      </div>
    </div>
    <input type="submit" value="Buscar Periodo" class="btn bt-primary w-100" id="busca">
  </form>
  <?php
    if ($result->num_rows == 0) {
      echo("<h4 class='mt-2'>Não tiveram vendas nesse período com esses filtros😥😔</h4>");
    } else {
      $tot = 0;
      $qtd = 0;
      foreach ($result as $venda) {
        $ordens = mysqli_query($connection, "select * from tbl_ordem where codigo_venda = ".$venda['id']);
        $tot += $venda['total'];
        foreach ($ordens as $ordem) {
          $qtd += $ordem['qtd'];
        }
      }
      ?>
        <div class="d-flex mt-2">
          <div class="w-50"><b>Quantidade: </b> <?php echo $qtd; ?></div>
          <div class="w-50"><b>Total: </b>R$ <?php echo number_format($tot, 2, '.',','); ?></div>
        </div>
        <div class="rell-table mt-2">
          <table>
            <thead>
              <tr>
                <th>Data</th>
                <th>Qtd</th>
                <th>Total</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($result as $venda) {
                  $ordens = mysqli_query($connection, "select * from tbl_ordem where codigo_venda = ".$venda['id']);
                  $qtd = 0;
                  foreach ($ordens as $ordem) {
                    $qtd += $ordem['qtd'];
                  }
                  if ($qtd != 0) {
                    ?>
                      <tr>
                        <td><?php echo(date('d/m/Y', strtotime($venda['dia'])))?></td>
                        <td><?php echo($qtd)?></td>
                        <td>R$ <?php echo(number_format($venda['total'], 2, ".", ","))?></td>
                        <td>
                          <form action="./?page=rellDet" method="post">
                            <input type="hidden" name="id" value="<?php echo($venda['id'])?>">
                            <input type="hidden" name="dataIni" value="<?php echo($dateIni)?>">
                            <input type="hidden" name="oper" value="<?php
                              if (isset($_POST["oper"])) {
                                if ($_SESSION['user']['nivel'] == 'master') {
                                  echo($_POST["oper"]);
                                } else {
                                  echo('0');
                                }
                              } else {
                                echo('0');
                              }
                            ?>">
                            <input type="hidden" name="dataFim" value="<?php echo($dataFim)?>">
                            <input type="hidden" name="dinheiro" value="<?php echo($dimCheck)?>">
                            <input type="hidden" name="cartao" value="<?php echo($cardCheck)?>">
                            <input type="hidden" name="pix" value="<?php echo($pixCheck)?>">
                            <input type="hidden" name="desconto" value="<?php echo($desCheck)?>">
                            <input type="submit" class="btn bt-primary w-100" value="Detalhes" onclick="openLoading()"/>
                          </form>  
                        </td>
                      </tr>
                    <?php            
                  } else {
                    mysqli_query($connection, "delete from tbl_vendas where id = ".$venda['id']);
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
      <?php
    }
  ?>
</div>