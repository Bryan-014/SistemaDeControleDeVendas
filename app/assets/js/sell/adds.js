const novoAdicional = () => {
  if (inputDeSelectDeProdutos.value != 0) {
    adicionais.forEach(adicional => {
      let hasInArr = false;
      ArrayDeAdicionais.forEach(add => {
        if (adicional.code == add) {
          hasInArr = true;
        }
      });
      if (adicional.code == inputDeSelectDeAdicionais.value && !hasInArr) {
        ArrayDeAdicionais.push(adicional.code);
        arrayStringDeAdicionais += adicional.desc + ' ';
        adicionaisDeVendaDeUmSabor = adicional.desc + ' ';
        labelDeAdicionais.innerHTML += adicionaisDeVendaDeUmSabor;
        let precoAtual = parseFloat(
          inputDePrecoUnitario.value.replace('R$ ', '')
        );
        let precoAdicional = parseFloat(adicional.preco);
        let novoPreco = precoAtual + precoAdicional;
        inputDePrecoUnitario.value = 'R$ ' + parseFloat(novoPreco).toFixed(2);
        inputDePrecoAcumulado.value =
          'R$ ' +
          parseFloat(novoPreco * inputDeQuantidadeDeProdutos.value).toFixed(2);
        inputDeSelectDeAdicionais.value = 0;
        labelDeAdicionais.style = 'display: block; margin: 8px;';
      }
    });
  }
};

const limparAdicional = () => {
  ArrayDeAdicionais = [];
  inputDeSelectDeAdicionais.value = 0;
  adicionaisDeVendaDeUmSabor = '';
  arrayStringDeAdicionais = '';
  labelDeAdicionais.innerHTML = 'Adicionais: ';
  labelDeAdicionais.style = 'display: none; ';
};
