const chamaFormaDePagamento = (evento = null) => {
  if (evento != null) {
    switch (evento.keyCode) {
      case 13:
        if (validaFormaDePagamentoGeraQrCode()) adicionarFormaDePagamento();
        break;
    }
  } else {
    if (validaFormaDePagamentoGeraQrCode()) adicionarFormaDePagamento();
  }
};

const validaFormaDePagamentoGeraQrCode = () => {
  if (document.querySelector('#pagmentForm').value == 'pix') {
    if (parseFloat(document.querySelector('#pgto').value) < 999.99) {
      $.ajax({
        url: './assets/php/qrcode/generate.php',
        method: 'POST',
        data: {
          valor: document.querySelector('#pgto').value
        }
      }).done(response => {
        document.querySelector('#divQrCode').innerHTML = response;
      });
      return true;
    } else {
      document.querySelector('#divQrCode').innerHTML =
        'Valor de pix não pode ser maior de R$ 999.99';
      return false;
    }
  }
  return true;
};
