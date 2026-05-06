const atalhosPadroesDosCamposDeCodigoEQuantidade = evento => {
  switch (evento.keyCode) {
    case 13:
      validaSeProdutoExisteEMandaInformacoesParaOFormulario();
      break;
    case 42:
      inputDeQuantidadeDeProdutos.value = inputDeCodigoDeProduto.value;
      inputDeCodigoDeProduto.value = '';
      break;
    case 114:
      processoDeRegistrarOSabor();
      break;
    case 108:
      limparAdicional();
      validaSeProdutoExisteEMandaInformacoesParaOFormulario();
      break;
    default:
      inputDeCodigoDeProduto.value = inputDeCodigoDeProduto.value.replace(
        '*',
        ''
      );
      inputDeQuantidadeDeProdutos.value =
        inputDeQuantidadeDeProdutos.value.replace('e', '');
      break;
  }
};

const validaSeProdutoExisteEMandaInformacoesParaOFormulario = () => {
  if (inputDeQuantidadeDeProdutos.value == 0) {
    return;
  }
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
};

const mudarInformacoesDoProduto = () => {
  produtos.forEach(produto => {
    if (inputDeSelectDeProdutos.value == produto.cod) {
      limparAdicional();
      inputDeCodigoDeProduto.value = inputDeSelectDeProdutos.value;
      inputDePrecoUnitario.value = 'R$ ' + parseFloat(produto.preco).toFixed(2);
      inputDePrecoAcumulado.value =
        'R$ ' +
        parseFloat(produto.preco * inputDeQuantidadeDeProdutos.value).toFixed(
          2
        );
    }
  });
};

var totalVenda = 0;

const processoDeRegistrarOSabor = () => {
  if (inputDeQuantidadeDeProdutos.value == '') {
    inputDeQuantidadeDeProdutos.value = 1;
  } else if (inputDeQuantidadeDeProdutos.value == 0) {
    return;
  } else if (inputDePrecoAcumulado.value == '') {
    return;
  }
  produtos.forEach(produto => {
    if (inputDeCodigoDeProduto.value == produto.cod) {
      arrayDeObjetoDeVenda.push({
        cod: produto.cod,
        qtd: parseFloat(
          parseFloat(inputDePrecoAcumulado.value.replace('R$ ', '')) /
            parseFloat(inputDePrecoUnitario.value.replace('R$ ', ''))
        ),
        add: arrayStringDeAdicionais,
        val: inputDePrecoUnitario.value.replace('R$ ', ''),
        obs: inputDeObservacoes.value
      });
      inputDeTotalDeVenda.value =
        'R$ ' +
        parseFloat(
          parseFloat(inputDeTotalDeVenda.value.replace('R$ ', '')) +
            parseFloat(inputDePrecoAcumulado.value.replace('R$ ', ''))
        ).toFixed(2);
      enviarInformacoesDaVendaParaATabela(
        produto,
        arrayDeObjetoDeVenda.length - 1
      );
      inputDeCodigoDeProduto.value = '';
      inputDeQuantidadeDeProdutos.value = 1;
      //inputDeCodigoDeProduto.focus();
      inputDeSelectDeProdutos.value = 0;
      inputDePrecoUnitario.value = '';
      inputDePrecoAcumulado.value = '';
      inputDeObservacoes.value = '';
      limparAdicional();
      adicionarInformacoesNoModal();
      document.querySelector('#btnFinal').disabled = false;
    }
  });
};

const enviarInformacoesDaVendaParaATabela = (produto, indexProd) => {
  let adds;
  if (labelDeAdicionais.innerHTML.replace('Adicionais: ', '') != '') {
    adds = 'c/ ' + labelDeAdicionais.innerHTML.replace('Adicionais: ', '');
  } else {
    adds = '';
  }

  corpoDaTabelaDeVenda.innerHTML += `
    <tr id="vend${indexProd}" onclick="mandaInformacoesDaTabelaDeVoltaParaOFormulario(${indexProd})" style="cursor: pointer;">
      <td>${produto.cod}</td>
      <td>${parseFloat(
        parseFloat(inputDePrecoAcumulado.value.replace('R$ ', '')) /
          parseFloat(inputDePrecoUnitario.value.replace('R$ ', ''))
      )}</td>
      <td>${produto.desc} ${adds}</td>
      <td>${inputDeObservacoes.value}</td>
      <td>${inputDePrecoUnitario.value}</td>
      <td>${inputDePrecoAcumulado.value}</td>
    </tr>
  `;
};
