$(document).ready(() => {
  reloadFila();
  //closeLoading();
});

const reloadFila = () => {
  setTimeout(() => {
    $.ajax({
      url: './assets/php/fila/generateTable.php'
    }).done(response => {
      if (document.querySelector('#fila-content').innerHTML != response) {
        document.querySelector('#fila-content').innerHTML = response;
        if (document.querySelector('#edit')) {
          document.querySelector('#edit').addEventListener('click', () => {
            openLoading();
          });
          document.querySelector('#fin').addEventListener('click', () => {
            openLoading();
          });
        }
      }
      reloadFila();
    });
  }, 10000);
};

if (document.querySelector('#edit')) {
  document.querySelector('#edit').addEventListener('click', () => {
    openLoading();
  });
  document.querySelector('#fin').addEventListener('click', () => {
    openLoading();
  });
}
