<?php
  require_once('./assets/php/call/callHeader.php');
  require_once("./assets/php/sell/_listProd.php");
  require_once("./assets/php/sell/_listAdds.php");
?>
<div class="d-flex justify-content-center">
  <div class="sell-container m-4">
    <?php require_once("./assets/php/util/validWarning.php") ?>
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
          onkeypress="atalhosPadroesDosCamposDeCodigoEQuantidade(event)"
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
          value="1"
          min="1"
          onkeypress="atalhosPadroesDosCamposDeCodigoEQuantidade(event)"
        />
        <label for="qtd">Quantidade</label>
      </div>
      <input type="button" value="Buscar Produto" onclick="validaSeProdutoExisteEMandaInformacoesParaOFormulario()" class="btn bt-primary callPro">
    </div>
    <div class="d-flex">
      <div class="form-floating mb-2 mt-2 m-1 w-50">
      <select
          id="prod"          
          name="prod"
          class="form-control"
          placeholder="Produtos"          
          autocomplete="off"
          onchange="mudarInformacoesDoProduto()"
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
      <span id="addLabel" style="display: none;">Adicionais: </span>
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
        />
        <label for="obs">Observações</label>
      </div>
    </div>
    <div class="d-flex">
      <div class="form-floating mb-2 mt-2 m-1 w-50">
        <input
          id="unitPrice"
          type="text"
          name="singlePrice"
          class="form-control"
          placeholder="single"
          required
          autocomplete="off"
          readonly        
        />
        <label for="singlePrice">Preço unitário</label>
      </div>
      <div class="form-floating mb-2 mt-2 m-1 w-50">
        <input
          id="multiPrice"
          type="text"
          name="price"
          class="form-control"
          placeholder="priceT"
          required
          autocomplete="off"
          readonly
        />
        <label for="price">Preço acumulado</label>
      </div>
    </div>
    <div class="d-flex">
      <input type="button" value="Registrar Sabor" class="btn bt-primary w-45" style="font-size: 14px;" id="regis" onclick="processoDeRegistrarOSabor()">
      <input type="button" value="Finalizar Pedido" class="btn bt-primary w-45" style="font-size: 14px;" data-bs-toggle="modal" data-bs-target="#final-modal" id="btnFinal" disabled>
    </div>
    <div class="d-flex" id="btnsEdit"></div>
  </div>
  <div class="total-container m-4">
    <div class="table-sell">
      <table>
        <thead>
          <tr>
            <th>Cód</th>
            <th>Qtd</th>
            <th>Sabor</th>
            <th>Obs</th>
            <th>Valor Unitário</th>
            <th>Valor Acumulado</th>
          </tr>
        </thead>
        <tbody id="bodyTable">
        </tbody>
      </table>
    </div>
    <div class="form-floating mb-2 mt-3">
      <input
        id="total"
        type="text"
        name="tot"
        class="form-control"
        placeholder="T"
        required
        autocomplete="off"
        readonly
        value = "R$ 0.00"
        />
      <label for="tot">Total</label>
    </div>
  </div>
</div>
<div id="final-modal" class="modal fade">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <span class="h5 m-2">Finalizar pedido</span>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form action="./assets/php/sell/vender.php" method="post">
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
              <label for="vallTotal">Total a pagar</label>
            </div>
          </div>
          <div class="d-flex">
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
          </div>
          <div class="d-flex">
            <input type="submit" value="Deixar pendente" class="btn bt-primary w-45 m-1" id="pend">
            <input type="submit" value="Finalizar" class="btn bt-primary w-45 m-1" disabled id="finSell">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php 
  require_once('./assets/php/util/prodObject.php');
?>
