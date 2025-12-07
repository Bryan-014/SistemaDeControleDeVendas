const mandaInformacoesDaTabelaDeVoltaParaOFormulario = indexProd => {
  inputDeCodigoDeProduto.value = arrayDeObjetoDeVenda[indexProd].cod;
  inputDeQuantidadeDeProdutos.value = arrayDeObjetoDeVenda[indexProd].qtd;
  produtos.forEach(produto => {
    if (inputDeCodigoDeProduto.value == produto.cod) {
      limparAdicional();
      inputDeSelectDeProdutos.value = inputDeCodigoDeProduto.value;
      inputDePrecoUnitario.value = 'R$ ' + parseFloat(produto.preco).toFixed(2);
      inputDePrecoAcumulado.value =
        'R$ ' +
        parseFloat(produto.preco * inputDeQuantidadeDeProdutos.value).toFixed(
          2
        );
    }
  });
  inputDeObservacoes.value = arrayDeObjetoDeVenda[indexProd].obs;
  arrayStringDeAdicionais = arrayDeObjetoDeVenda[indexProd].add;
  if (arrayStringDeAdicionais != '') {
    labelDeAdicionais.innerHTML += arrayStringDeAdicionais;
    labelDeAdicionais.style = 'display: block; margin: 8px;';
    let prevAdds = arrayStringDeAdicionais.split(' ');
    prevAdds.forEach(add => {
      adicionais.forEach(adicional => {
        if (add == adicional.desc) {
          ArrayDeAdicionais.push(adicional.code);
          let precoAtual = parseFloat(
            inputDePrecoUnitario.value.replace('R$ ', '')
          );
          let precoAdicional = parseFloat(adicional.preco);
          let novoPreco = precoAtual + precoAdicional;
          inputDePrecoUnitario.value = 'R$ ' + parseFloat(novoPreco).toFixed(2);
          inputDePrecoAcumulado.value =
            'R$ ' +
            parseFloat(novoPreco * inputDeQuantidadeDeProdutos.value).toFixed(
              2
            );
          inputDeSelectDeAdicionais.value = 0;
        }
      });
    });
  }
  document.querySelector('#btnsEdit').innerHTML = `
        <input type="button" value="Salvar" class="btn bt-primary w-45" style="font-size: 14px;" onclick="salvarAlteracoesDaVenda(${indexProd})">
        <input type="button" value="Cancelar" class="btn bt-primary w-45" style="font-size: 14px;" onclick="cancelarVenda(${indexProd})">
    `;

  document.querySelector('#regis').disabled = true;
};

const salvarAlteracoesDaVenda = indexVend => {
  if (inputDeQuantidadeDeProdutos.value == '') {
    inputDeQuantidadeDeProdutos.value = 1;
  } else if (inputDeQuantidadeDeProdutos.value == 0) {
    return;
  } else if (inputDePrecoAcumulado.value == '') {
    return;
  }

  let selectProd;
  produtos.forEach(produto => {
    if (inputDeCodigoDeProduto.value == produto.cod) {
      selectProd = produto;
      arrayDeObjetoDeVenda[indexVend] = {
        cod: produto.cod,
        qtd: parseFloat(
          parseFloat(inputDePrecoAcumulado.value.replace('R$ ', '')) /
            parseFloat(inputDePrecoUnitario.value.replace('R$ ', ''))
        ),
        add: arrayStringDeAdicionais,
        val: inputDePrecoUnitario.value.replace('R$ ', ''),
        obs: inputDeObservacoes.value
      };
    }
  });

  let addds;
  if (labelDeAdicionais.innerHTML.replace('Adicionais: ', '') != '') {
    addds = 'c/ ' + labelDeAdicionais.innerHTML.replace('Adicionais: ', '');
  } else {
    addds = '';
  }

  document.querySelector('#vend' + indexVend).innerHTML = `
    <td>${selectProd.cod}</td>
    <td>${parseFloat(
      parseFloat(inputDePrecoAcumulado.value.replace('R$ ', '')) /
        parseFloat(inputDePrecoUnitario.value.replace('R$ ', ''))
    )}</td>
    <td>${selectProd.desc} ${addds}</td>
    <td>${inputDeObservacoes.value}</td>
    <td>${inputDePrecoUnitario.value}</td>
    <td>${inputDePrecoAcumulado.value}</td>
    `;
  limparInformacoesDoFormulario();
};

const cancelarVenda = indexVend => {
  arrayDeObjetoDeVenda[indexVend] = {};
  document.querySelector('#vend' + indexVend).innerHTML = ``;
  limparInformacoesDoFormulario();
  let sumPriceTot = 0;
  arrayDeObjetoDeVenda.forEach(element => {
    if (!isNaN(element.qtd) && !isNaN(element.val)) {
      sumPriceTot += element.qtd * parseFloat(element.val);
    }
  });
  if (sumPriceTot == 0) {
    document.querySelector('#btnFinal').disabled = true;
  }
};

const limparInformacoesDoFormulario = () => {
  document.querySelector('#btnsEdit').innerHTML = ``;
  document.querySelector('#regis').disabled = false;
  let totalPriceAct = 0;
  arrayDeObjetoDeVenda.forEach(element => {
    if (!isNaN(element.qtd) && !isNaN(element.val)) {
      totalPriceAct += element.qtd * parseFloat(element.val);
    }
  });
  inputDeTotalDeVenda.value = 'R$ ' + parseFloat(totalPriceAct).toFixed(2);
  inputDeCodigoDeProduto.value = '';
  inputDeQuantidadeDeProdutos.value = 1;
  inputDeCodigoDeProduto.focus();
  inputDeSelectDeProdutos.value = 0;
  inputDePrecoUnitario.value = '';
  inputDePrecoAcumulado.value = '';
  inputDeObservacoes.value = '';
  limparAdicional();
  adicionarInformacoesNoModal();
};
