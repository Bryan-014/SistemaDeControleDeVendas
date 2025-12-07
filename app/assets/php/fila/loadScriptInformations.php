<script>
  var precoInicialDoPedido = <?php echo($ordem['qtd'] * $ordem['valor_uni'])?>;
  var adicionaisVenda ='<?php echo($ordem['adicionais'])?>';
  var ArrayDeAdicionais = [<?php
    foreach (explode(",", str_replace(" ", ",", $ordem['adicionais'])) as $add) {
      echo("'".$add."',");
    }
  ?>];
  let inputDeSelectDeProdutos = document.querySelector('#prod');

  const adicionarInformacoesNoModal = valUni => {
    let modal = document.querySelector('#modal-informations');
    document.querySelector('#vallTotal').value = inputDeDiferencaDePagamento.value;
    pagamentos = [];
    //inputDeTroco.value = '';
    //inputDeFormasDePagamento.value = '';
    modal.innerHTML = `
      <input type="hidden" name="vnd" value="${<?php echo($codVen)?>}">
      <input type="hidden" name="ord" value="${<?php echo($id)?>}">
      <input type="hidden" name="codProd" value="${inputDeCodigoDeProduto.value}">
      <input type="hidden" name="adds" value="${labelDeAdicionais.innerHTML.replace('Adicionais: ', '')}">
      <input type="hidden" name="qtd" value="${inputDeQuantidadeDeProdutos.value}">
      <input type="hidden" name="valUni" value="${valUni}">
      <input type="hidden" name="obs" value="${inputDeObservacoes.value}">      
    `;
  }
</script>
