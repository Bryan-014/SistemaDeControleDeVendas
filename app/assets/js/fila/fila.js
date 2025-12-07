var arrayDeObjetoDeVenda = [];
var arrayStringDeAdicionais = '';
let inputDeCodigoDeProduto = document.querySelector('#code');
let inputDeQuantidadeDeProdutos = document.querySelector('#qtdI');
let inputDeSelectDeAdicionais = document.querySelector('#adds');
let labelDeAdicionais = document.querySelector('#addLabel');
let inputDeObservacoes = document.querySelector('#obs');
let inputDeDiferencaDePagamento = document.querySelector('#dif');
let pagamentos = [];
var inputDeValorTotalAPagar = document.querySelector('#vallTotal');
let inputDeTroco = document.querySelector('#troco');
let inputDeFormasDePagamento = document.querySelector('#pgtFor');

const changeProduto = () => {
  produtos.forEach(produto => {
    if (inputDeSelectDeProdutos.value == produto.cod) {
      inputDeCodigoDeProduto.value = inputDeSelectDeProdutos.value;
      limparAdicional();
    }
  });
};

//closeLoading();

document.querySelector('#back').addEventListener('click', () => {
  openLoading();
});
document.querySelector('#finSell').addEventListener('click', () => {
  openLoading();
});
document.querySelector('#cancel').addEventListener('click', () => {
  openLoading();
});

const validOperations = e => {
  switch (e.keyCode) {
    case 13:
      checkPrice();
      break;
    case 42:
      inputDeQuantidadeDeProdutos.value = inputDeCodigoDeProduto.value;
      inputDeCodigoDeProduto.value = '';
      break;
    case 114:
      sellProcess();
      break;
    case 108:
      limparAdicional();
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

const novoAdicional = () => {
  if (inputDeSelectDeProdutos.value != 0) {
    adicionais.forEach(adicional => {
      let hasInArr = false;
      ArrayDeAdicionais.forEach(add => {
        if (adicional.desc == add) {
          hasInArr = true;
        }
      });
      if (adicional.code == inputDeSelectDeAdicionais.value && !hasInArr) {
        ArrayDeAdicionais.push(adicional.desc);
        arrayStringDeAdicionais += adicional.desc + ' ';
        adicionaisVenda = adicional.desc + ' ';
        labelDeAdicionais.innerHTML += adicionaisVenda;
        inputDeSelectDeAdicionais.value = 0;
        labelDeAdicionais.style = 'display: block; margin: 8px;';
        checkPrice();
      }
    });
  }
};

function limparAdicional() {
  ArrayDeAdicionais = [];
  inputDeSelectDeAdicionais.value = 0;
  adicionaisVenda = '';
  arrayStringDeAdicionais = '';
  labelDeAdicionais.innerHTML = 'Adicionais: ';
  labelDeAdicionais.style = 'display: none; ';
  checkPrice();
}

const checkPrice = () => {
  if (inputDeQuantidadeDeProdutos.value == '') {
    inputDeQuantidadeDeProdutos.value = 1;
  } else if (inputDeQuantidadeDeProdutos.value == 0) {
    return;
  }
  var prodPrice = 0;
  produtos.forEach(produto => {
    if (inputDeCodigoDeProduto.value == produto.cod) {
      inputDeSelectDeProdutos.value = inputDeCodigoDeProduto.value;
      prodPrice = parseInt(produto.preco);
    }
  });
  var addPrice = 0;
  ArrayDeAdicionais.forEach(add => {
    adicionais.forEach(adicional => {
      if (adicional.desc == add) {
        addPrice += parseInt(adicional.preco);
      }
    });
  });
  inputDeDiferencaDePagamento.value = `R$ ${parseFloat(
    prodPrice * inputDeQuantidadeDeProdutos.value +
      addPrice * inputDeQuantidadeDeProdutos.value -
      precoInicialDoPedido
  ).toFixed(2)}`;
  adicionarInformacoesNoModal(prodPrice + addPrice);
};

const addPgtoEnter = e => {
  switch (e.keyCode) {
    case 13:
      addPgtoFrom();
  }
};

const adicionarFormaDePagamento = () => {
  let form = document.querySelector('#pagmentForm');
  let quant = document.querySelector('#pgto');

  if (quant.value != '') {
    if (form.value != 'desconto') {
      pagamentos.push(parseFloat(quant.value));
    } else {
      inputDeValorTotalAPagar.value =
        'R$ ' +
        parseFloat(
          parseFloat(
            inputDeValorTotalAPagar.value.replace('R$ ', '') -
              parseFloat(quant.value)
          )
        ).toFixed(2);
    }

    inputDeFormasDePagamento.value +=
      form.value + ': R$' + parseFloat(quant.value).toFixed(2) + ' ';

    validTroc();

    form.value = 'dinheiro';
    quant.value = '';
  }
};

const validTroc = () => {
  let pgtoFinal = 0;
  pagamentos.forEach(pgto => {
    pgtoFinal += pgto;
  });
  if (
    parseFloat(pgtoFinal) >=
    parseFloat(inputDeValorTotalAPagar.value.replace('R$ ', ''))
  ) {
    /*inputDeTroco.value = `R$ ${parseFloat(
      parseFloat(pgtoFinal) -
        parseFloat(inputDeValorTotalAPagar.value.replace('R$ ', ''))
    ).toFixed(2)}`;*/
    document.querySelector('#finSell').disabled = false;
  } else {
    document.querySelector('#finSell').disabled = true;
  }
};

function openMod() {
  checkPrice();
  validTroc();
}
