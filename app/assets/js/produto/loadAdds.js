$(document).ready(() => {
  loadAdds();
});

const loadAdds = () => {
  $.ajax({
    url: './assets/php/prod/loadProdAddContent.php',
    method: 'POST',
    data: {
      type: 'Ingredientes'
    }
  }).done(response => {
    document.querySelector('#adds_content').innerHTML = response;
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
