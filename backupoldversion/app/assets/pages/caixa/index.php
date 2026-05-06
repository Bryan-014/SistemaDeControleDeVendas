<?php
  require_once('./assets/php/call/callHeader.php');
  $pendentes = mysqli_query($connection, 'select * from tbl_vendas where pagamento = ""');
?>
<div class="caixa-container mt-4">
  <span  class="h2">
    Pagamentos Pendentes
  </span>
  <?php
    if ($pendentes->num_rows == 0) {
      ?><h4>Tudo calmo por aqui! 😅🥱</h4><?php
    } else {
      ?>
        <div class="table-caixa mt-3">
          <table>
            <tr>
              <th>Cliente</th>
              <th>Total</th>
              <th>Sabores</th>
              <th>Ações</th>
            </tr>
            <?php
              foreach ($pendentes as $row) {
                if (isset($row['nome']) && $row['nome'] != '') {
                  $nome = 'Nº Pedido: '.$row['ofDay'].' | '.$row['nome'];
                }  else {
                  $nome = 'Nº Pedido: '.$row['ofDay'];
                }

                $sabores = mysqli_query($connection, 'select tbl_ordem.*, tbl_produtos.* from tbl_ordem inner join tbl_produtos on tbl_ordem.codigo_produto = tbl_produtos.cod where tbl_ordem.codigo_venda = "'.$row['id'].'"');
                $saborConc = '*';
                foreach ($sabores as $sabor) {
                  if (isset($row['adicionais']) && $row['adicionais'] != '') {
                    $add = ' c/ '.$row['adicionais'];
                  } else {
                    $add = '';
                  }
                  $saborConc .= ', '.$sabor['descricao'].$add;
                }

                ?>
                <tr>
                  <td><?php echo($nome)?></td>
                  <td><?php echo($row['total'])?></td>
                  <td><?php echo(str_replace('*, ', '', $saborConc))?></td>
                  <td>
                    <div>
                      <form style="display: flex;" action="./?page=cobrar" method="post">
                        <input type="hidden" name="codVen" value="<?php echo($row['id'])?>">
                        <input type="submit" class='btn bt-primary w-100 m-2' value="Cobrar" id="edit">
                      </form>
                    </div>
                  </td>
                </tr>
                <?php
              }
            ?>
          </table>
        </div>      
      <?php
    }
  ?>
</div>