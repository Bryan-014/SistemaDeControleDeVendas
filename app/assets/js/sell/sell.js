var arrayDeObjetoDeVenda = [];
var adicionaisDeVendaDeUmSabor = '';
var arrayStringDeAdicionais = '';
var ArrayDeAdicionais = [];

let inputDeTotalDeVenda = document.querySelector('#total');
let inputDeCodigoDeProduto = document.querySelector('#code');
let inputDeQuantidadeDeProdutos = document.querySelector('#qtdI');
let inputDePrecoUnitario = document.querySelector('#unitPrice');
let inputDePrecoAcumulado = document.querySelector('#multiPrice');
let corpoDaTabelaDeVenda = document.querySelector('#bodyTable');
let inputDeSelectDeProdutos = document.querySelector('#prod');
let inputDeSelectDeAdicionais = document.querySelector('#adds');
let labelDeAdicionais = document.querySelector('#addLabel');
let inputDeObservacoes = document.querySelector('#obs');
let inputDeTroco = document.querySelector('#troco');
let inputDeFormasDePagamento = document.querySelector('#pgtFor');
let pagamentos = [];

//.focus(); //Coloca o foco no input de código de produto assim que carrega a página

inputDeQuantidadeDeProdutos.addEventListener('click', () => {
  inputDeQuantidadeDeProdutos.select(); //Seleciona o valor no input de quantidade quando selecionado para facilitação
});

//closeLoading();

const adicionarInformacoesNoModal = () => {
  let modal = document.querySelector('#modal-informations');
  document.querySelector('#vallTotal').value = inputDeTotalDeVenda.value;
  inputDeTroco.value = '';
  pagamentos = [];
  inputDeFormasDePagamento.value = '';
  modal.innerHTML = `<input type="hidden" name="qtdProdutos" value="${arrayDeObjetoDeVenda.length}">`;

  for (let index = 0; index < arrayDeObjetoDeVenda.length; index++) {
    const element = arrayDeObjetoDeVenda[index];
    modal.innerHTML += colocarInputsNoModalDeVenda(element, index);
  }
};

const colocarInputsNoModalDeVenda = (produtoDaVenda, indiceFor) => {
  return `
        <input type="hidden" name="codPro-${indiceFor + 1}" value="${
    produtoDaVenda.cod
  }">
        <input type="hidden" name="qtdPro-${indiceFor + 1}" value="${
    produtoDaVenda.qtd
  }">
        <input type="hidden" name="addsPro-${indiceFor + 1}" value="${
    produtoDaVenda.add
  }">
        <input type="hidden" name="valPro-${indiceFor + 1}" value="${
    produtoDaVenda.val
  }">
        <input type="hidden" name="obsPro-${indiceFor + 1}" value="${
    produtoDaVenda.obs
  }">
      `;
};

const adicionarFormaDePagamento = () => {
  let form = document.querySelector('#pagmentForm');
  let quant = document.querySelector('#pgto');
  let totToPag = document.querySelector('#vallTotal');

  if (quant.value != '') {
    if (form.value != 'desconto') {
      pagamentos.push(parseFloat(quant.value));
    } else {
      totToPag.value =
        'R$ ' +
        parseFloat(
          parseFloat(
            totToPag.value.replace('R$ ', '') - parseFloat(quant.value)
          )
        ).toFixed(2);
    }

    inputDeFormasDePagamento.value +=
      form.value + ': R$' + parseFloat(quant.value).toFixed(2) + ' ';

    let pgtoFinal = 0;
    pagamentos.forEach(pgto => {
      pgtoFinal += pgto;
    });

    if (
      parseFloat(pgtoFinal) >= parseFloat(totToPag.value.replace('R$ ', ''))
    ) {
      inputDeTroco.value = `R$ ${parseFloat(
        parseFloat(pgtoFinal) - parseFloat(totToPag.value.replace('R$ ', ''))
      ).toFixed(2)}`;
      document.querySelector('#finSell').disabled = false;
    }

    form.value = 'dinheiro';
    quant.value = '';
  }
};

document.querySelector('#finSell').addEventListener('click', () => {
  if (!document.querySelector('#finSell').disabled) {
    openLoading();
  }
});
