<?php
  require_once('./assets/php/call/callHeader.php');
  require_once("./assets/php/sell/_listProd.php");
  require_once("./assets/php/sell/_listAdds.php");
  require_once("./assets/php/fila/buscarOrdemEVenda.php");
?>
<div class="ord-container mt-3">
  <div class="navbar">
    <span  class="h2">
      Editar Pedido
    </span>
    <a href="./?page=fila" class="btn bt-primary" id="back">Voltar</a>
  </div>
  <div>
    <span><b>Vendedor: </b><?php echo($venda['user'])?></span>
  </div>
  <div>
    <?php
      if ($venda['cliente'] != '') {
        ?>      
          <span><b>Cliente: </b><?php echo($venda['cliente'])?></span>
        <?php
      }
    ?>
  </div>
  <?php require_once('./assets/php/util/validWarning.php') ?>
  <div class="d-flex">
    <div class="form-floating mb-2 mt-2 m-1 w-50">
      <input
        id="code"
        type="number"
        name="code"
        class="form-control"
        placeholder="codigo"
        required
        autocomplete="off"
        value="<?php echo($ordem['codigo_produto'])?>"
        onkeypress="validOperations(event)"
      />
      <label for="codigo">Código do sabor</label>
    </div>     
    <div class="form-floating mb-2 mt-2 m-1 w-50">
      <input
        id="qtdI"
        type="number"
        name="qtd"
        class="form-control"
        placeholder="qtde"
        required
        autocomplete="off"
        value="<?php echo($ordem['qtd'])?>"
        min="1"
        onkeypress="validOperations(event)"
      />
      <label for="qtd">Quantidade</label>
    </div>
    <input type="button" value="Buscar Produto" onclick="validProd()" class="btn bt-primary callPro">
  </div>
  <div class="d-flex">
    <div class="form-floating mb-2 mt-2 m-1 w-50">
    <select
        id="prod"          
        name="prod"
        class="form-control"
        placeholder="Produtos"          
        autocomplete="off"
        onchange="changeProduto()"
      >
        <option value=""></option>
        <option value="">Carregando...</option>
      </select>
      <label for="prod">Sabor</label>
    </div>
    <div class="form-floating mb-2 mt-2 m-1 w-40">
      <select
        id="adds"          
        name="adds"
        class="form-control"
        placeholder="adicionais"          
        autocomplete="off"        
      >
        <option value=""></option>
        <option value="">Carregando...</option>
      </select>
      <label for="qtd">Adicionais</label>
    </div>
    <input type="button" class="btn bt-primary mt-2 bt-add" value="+" style="height: 47px;" onclick="novoAdicional()">
    </div>
    <div class="">
      <span id="addLabel" style="<?php if($ordem['adicionais'] != '') {echo('display: block;  margin: 8px;');} else {echo('display: none;');}?> ">Adicionais: <?php echo($ordem['adicionais'])?></span>
    </div>
    <div class="d-flex">
      <div class="form-floating mb-2 mt-2 m-1 w-100">
        <input
          id="obs"
          type="text"
          name="obs"
          class="form-control"
          placeholder="Obs"
          autocomplete="off"      
          value="<?php echo($ordem['obs'])?>"
        />
        <label for="obs">Observações</label>
      </div>
    </div>
    <div class="form-floating mb-2 mt-2 m-1 w-100">
      <input
        id="dif"
        type="text"
        name="dif"
        class="form-control"
        placeholder="single"
        required
        autocomplete="off"
        readonly
        value="R$ 0.00"
      />
      <label for="dif">Diferença</label>
    </div>
    <div class="d-flex">
      <input type="button" value="Editar Pedido" class="btn bt-primary w-45" style="font-size: 14px;" data-bs-toggle="modal" data-bs-target="#final-modal" id="btnFinal" onclick="openMod()">
      <input type="button" value="Cancelar" class="btn bt-primary w-45" style="font-size: 14px;" data-bs-toggle="modal" data-bs-target="#cancel-modal" id="btnCancel">
    </div>
  </div>
</div>
<div id="final-modal" class="modal fade">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <span class="h5 m-2">Editar pedido</span>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form action="./assets/php/fila/editOrd.php" method="post">
          <div id="modal-informations">
          </div>
          <div class="d-flex">
            <div class="form-floating mb-2 mt-2 m-1 w-50">
              <input
                id="clientName"
                type="text"
                name="clientName"
                class="form-control"
                placeholder="Nome do cliente"
                autocomplete="off"
                readonly
                value="<?php echo($venda['cliente'])?>"
              />
              <label for="clientName">Nome do cliente</label>
            </div>
            <div class="form-floating mb-2 mt-2 m-1 w-50">
              <input
                id="vallTotal"
                type="text"
                name="vallTotal"
                class="form-control"
                required
                placeholder="Total a pagar"
                autocomplete="off"
                readonly
              />
              <label for="vallTotal">Diferença</label>
            </div>
          </div>
          <!-- <div class="d-flex">
            <div class="form-floating mb-2 mt-2 m-1 w-50">
              <select
                id="pagmentForm"
                class="form-control"
                placeholder="Nome do cliente"
                autocomplete="off"
              >
                <option value="dinheiro">Dinheiro</option>
                <option value="cartão">Cartão</option>
                <option value="pix">Pix</option>
                <option value="desconto">Desconto</option>
              </select>
              <label for="pagmentForm">Forma de pagamento</label>
            </div>
            <div class="form-floating mb-2 mt-2 m-1 w-40">
              <input
                id="pgto"
                type="number"
                class="form-control"
                placeholder="Total a pagar"
                autocomplete="off"
                onkeyup="chamaFormaDePagamento(event)"
              />
              <label for="pgto">R$ </label>
            </div>
            <input type="button" class="btn bt-primary mt-3 bt-add" value="+" style="height: 40px;" onclick="chamaFormaDePagamento()">
          </div>
          <div id="divQrCode" class="text-center"></div>
          <div class="d-flex">
            <div class="form-floating mb-2 mt-2 m-1 w-50">
              <input
                id="pgtFor"
                type="text"
                name="pgtFor"
                required
                class="form-control"
                placeholder="Nome do cliente"
                autocomplete="off"
                readonly
              />
              <label for="pgtFor">Pagamento</label>
            </div>
            <div class="form-floating mb-2 mt-2 m-1 w-50">
              <input
                id="troco"
                type="text"
                class="form-control"
                placeholder="Total a pagar"
                autocomplete="off"
                required
                readonly
              />
              <label for="troco">Troco</label>
            </div>
          </div> -->
          <input type="submit" value="Finalizar" class="btn bt-primary w-100 m-1" disabled id="finSell">
        </form>
      </div>
    </div>
  </div>
</div>
<div id="cancel-modal" class="modal fade">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <span class="h5 m-2">Cancelar pedido</span>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form action="./assets/php/fila/cancelOrd.php" method="post">
          <div class="d-flex">
            <input type="hidden" name="venda" value="<?php echo($codVen)?>">
            <input type="hidden" name="ord" value="<?php echo($id)?>">
            <div class="form-floating mb-2 mt-2 m-1 w-50">
              <input
                id="clientName"
                type="text"
                name="clientName"
                class="form-control"
                placeholder="Nome do cliente"
                autocomplete="off"
                readonly
                value="<?php echo($venda['cliente'])?>"
              />
              <label for="clientName">Nome do cliente</label>
            </div>
            <div class="form-floating mb-2 mt-2 m-1 w-50">
              <input
                id="vallTotal"
                type="text"
                name="vallTotal"
                class="form-control"
                required
                placeholder="Total a pagar"
                autocomplete="off"
                readonly
                value="R$ <?php echo(number_format(floatval($ordem['qtd'] * $ordem['valor_uni']), 2, ".", ","))?>"
              />
              <label for="vallTotal">Devolver</label>
            </div>
          </div>
          <input type="submit" value="Cancelar" class="btn bt-primary w-100 m-1" id="cancel">
        </form>
      </div>
    </div>
  </div>
</div>
<?php 
  require_once('./assets/php/util/prodObject.php');
  require_once('./assets/php/fila/loadScriptInformations.php')
?>

