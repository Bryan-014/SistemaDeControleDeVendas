function fodase(evento = null) {
    if (evento != null) {
        switch (evento.keyCode) {
            case 13:
                fodase2(document.querySelector('#pagmentForm'));
                adicionarFormaDePagamento();
          }
    } else {
        fodase2(document.querySelector('#pagmentForm'));
        adicionarFormaDePagamento();
    }
    
}

function fodase2(parametro) {
    if (parametro.value == 'pix') {
        $.ajax({
            url: './assets/php/gerarQrcode/generate.php',
            method: 'POST',
            data: {
                valor: document.querySelector('#pgto').value
            }
        }).done(response => {
            document.querySelector('#qrCode').innerHTML = response;
        });
    }
}