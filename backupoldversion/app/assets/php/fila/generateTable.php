<?php
  if (!isset($connection)) {
    require_once('../util.php');
  }
  $fila = mysqli_query($connection, "select o.ordem as id, p.descricao as prod, o.adicionais as adds, o.qtd as qtd, v.cliente as nome, o.obs as obs, o.codigo_venda as codVend, v.ofDay as ofDay, v.pagamento as forma from tbl_ordem as o inner join tbl_vendas as v on v.id = o.codigo_venda inner join tbl_produtos as p on p.cod = o.codigo_produto where o.finalizado = 0 order by id");
  if ($fila->num_rows == 0) {
    echo("<h4>Tudo calmo por aqui! 😅🥱</h4>");
  } else {
    ?>
      <div class="table-fila">
        <table>
          <thead>
            <tr>
              <th>Qtd</th>
              <th>Sabor&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;</th>
              <?php
                $hasObs = false;
                foreach ($fila as $produto) {
                  if (isset($produto['obs']) && $produto['obs'] != '') {                    
                    $hasObs = true;
                  }
                }
                if ($hasObs) {
                  ?>                
                    <th>Observações</th>
                  <?php
                }
              ?>
              <th>Cliente</th>
              <th>Pago</th>
              <th>Ação</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($fila as $produto) { 
                if ($produto['adds'] != '') {
                  $adds = ' c/ '.$produto['adds'];
                } else {
                  $adds = '';
                }
                if (isset($produto['nome']) && $produto['nome'] != '') {
                  $nome = 'Nº Pedido: '.$produto['ofDay'].' | '.$produto['nome'];
                }  else {
                  $nome = 'Nº Pedido: '.$produto['ofDay'];
                }
                if (isset($produto['forma']) && $produto['forma'] != '') {
                  $forma = 'SIM';
                } else {
                  $forma = 'NÃO';
                }
                ?>
                  <tr>
                    <td><?php echo($produto['qtd'])?></td>
                    <td><?php echo($produto['prod'] . $adds)?></td>
                    <?php
                       if ($hasObs) {
                        ?>                                          
                          <td><?php echo($produto['obs'])?></td>
                        <?php
                      }
                    ?>
                    <td><?php echo($nome)?></td>
                    <td><?php echo($forma)?></td>
                    <td>
                      <div>
                        <form style="display: flex;" action="./?page=editOrd" method="post">
                          <input type="hidden" name="codVen" value="<?php echo($produto['codVend'])?>">
                          <input type="hidden" name="id" value="<?php echo($produto['id'])?>">
                          <a href='./assets/php/fila/cleanOrd.php?ord="<?php echo($produto['id'])?>"' class='btn bt-primary w-100 m-2' id="fin">Finalizar</a>
                          <input type="submit" class='btn bt-primary w-100 m-2' value="Editar" id="edit">
                        </form>
                      </div>
                    </td>
                  </tr>
                <?php
              }
            ?>
          </tbody>
        </table>
      </div>
    <?php  
  }
?>