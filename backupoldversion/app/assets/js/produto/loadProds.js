$(document).ready(() => {
  loadProds();
});

const loadProds = () => {
  $.ajax({
    url: './assets/php/prod/loadProdAddContent.php',
    method: 'POST',
    data: {
      type: 'Produtos'
    }
  }).done(response => {
    document.querySelector('#prod_content').innerHTML = response;
    //closeLoading();
    if (document.querySelector('#opn')) {
      document.querySelector('#opn').addEventListener('click', () => {
        openLoading();
      });
    }
    if (document.querySelector('#oepn')) {
      document.querySelector('#open').addEventListener('click', () => {
        openLoading();
      });
    }
  });
};
