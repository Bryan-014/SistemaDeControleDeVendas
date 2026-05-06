$(document).ready(() => {
  carregarProdutos();
  carregarAdicionais();
});

const carregarProdutos = () => {
  $.ajax({
    url: './assets/php/util/constructProdSelect.php'
  }).done(response => {
    inputDeSelectDeProdutos.innerHTML = response;
    if (inputDeCodigoDeProduto.value != '') {
      inputDeSelectDeProdutos.value = inputDeCodigoDeProduto.value;
    }
  });
};

const carregarAdicionais = () => {
  $.ajax({
    url: './assets/php/util/constructAddSelect.php'
  }).done(response => {
    inputDeSelectDeAdicionais.innerHTML = response;
  });
};
