<?php 
  if (!isset($_POST['id'])) {
    header('location:./?page=rell');
    exit();
  }
  require_once('./assets/php/call/callHeader.php');
  $venda = mysqli_fetch_assoc(mysqli_query($connection, "select Vend.dia as Day, Vend.cliente as Client, Vend.pagamento as PaymantForm, UserT.usuario as Oper, Vend.total as tot from tbl_vendas as Vend inner join tbl_user as UserT on UserT.id = Vend.operador where Vend.id = ".$_POST['id']));
  $ordem = mysqli_query($connection, "select Ord.codigo_produto as ProdCod, Ord.qtd as qtd, Prod.descricao as descricao, Ord.adicionais as adds, Ord.obs as obs, Ord.valor_uni as ValUni from tbl_ordem as Ord inner join tbl_produtos as Prod on Ord.codigo_produto = Prod.cod where Ord.codigo_venda = ".$_POST['id']);
?>
<div class="rell-container mt-3">
  <div class="navbar">
    <h3>Detalhes</h3>
    <form action="./?page=rell" method="post">
      <input type="hidden" name="dataIni" value="<?php echo($_POST['dataIni'])?>">
      <input type="hidden" name="dataFim" value="<?php echo($_POST['dataFim'])?>">
      <?php
        if ($_SESSION['user']['nivel'] == 'master') {
          ?><input type="hidden" name="oper" value="<?php echo($_POST["oper"])?>"><?php
        }
        if ($_POST['dinheiro'] == 'checked') {
          ?><input type="hidden" name="dinheiro" value="on"><?php
        }
        if ($_POST['cartao'] == 'checked') {
          ?><input type="hidden" name="cartao" value="on"><?php
        }
        if ($_POST['pix'] == 'checked') {
          ?><input type="hidden" name="pix" value="on"><?php
        }
        if ($_POST['desconto'] == 'checked') {
          ?><input type="hidden" name="desconto" value="on"><?php
        }
      ?>      
      <input type="submit" value="Voltar" class="btn bt-primary" onclick="openLoading()">
    </form>
  </div>
  <div class="w-100"><b>Data e horário:</b> <?php echo(date('d/m/Y H:i:s', strtotime($venda['Day'])))?>&#160;&#160;&#160;</div>
  <?php
    if ($venda['Client'] != '') {
      ?><div class="w-100"><b>Cliente:</b> <?php echo($venda['Client'])?></div><?php
    }
  ?>
  <div class="w-100"><b>Forma de pagamento:</b> <?php echo($venda['PaymantForm'])?></div>
  <div class="w-100"><b>Vendedor:</b> <?php echo($venda['Oper'])?> </div>
  <div class="w-100"><b>Total Pago:</b> R$ <?php echo(number_format($venda['tot'], 2,'.',','))?></div>
  <div class="rell-table mt-2">
    <table>
      <thead>
        <tr>
          <th>Cód</th>
          <th>Qtd</th>
          <th>Sabor&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;</th>
          <?php
            $hasObs = false;
            $hasAdds = false;
            foreach ($ordem as $produto) {
              if (isset($produto['adds']) && $produto['adds'] != '') {                    
                $hasAdds = true;
              }
              if (isset($produto['obs']) && $produto['obs'] != '') {                    
                $hasObs = true;
              }
            }
            if ($hasAdds) {
              ?>                
                <th>Adicionais</th>
              <?php
            }
            if ($hasObs) {
              ?>                
                <th>Obs</th>
              <?php
            }
          ?>
          <th>Valor Unitário</th>
          <th>Valor Acumulado</th>
        </tr>
      </thead>
      <tbody>
        <?php         
          foreach ($ordem as $product) {
            ?>
              <tr>
                <td><?php echo($product['ProdCod'])?></td>
                <td><?php echo($product['qtd'])?></td>
                <td><?php echo($product['descricao'])?></td>
                <?php
                  if ($hasAdds) {
                    ?>                                          
                      <td><?php echo($product['adds'])?></td>
                    <?php
                  } 
                  if ($hasObs) {
                    ?>                                          
                      <td><?php echo($product['obs'])?></td>
                    <?php
                  } 
                ?>                              
                <td>R$ <?php echo(number_format($product['ValUni'], 2, '.', ','))?></td>
                <td>R$ <?php echo(number_format($product['ValUni'] * $product['qtd'], 2, '.', ','))?></td>
              </tr>
            <?php
          }
        ?>
      </tbody>
    </table>
  </div>
</div>