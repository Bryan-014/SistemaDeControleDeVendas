<?php
  namespace chillerlan\QRCodeExamples;

  require __DIR__.'/app/Pix/payload.php';

  use \App\Pix\payload;

  $valor = $_POST['valor'];

  $obPayLoad = (new payLoad)
    ->setPixKey('13730921908')
    ->description('T')
    ->merchantName('T')
    ->merchantCity('M')
    ->amount($valor)
    ->txid('a');

  $payLoadQrCode = $obPayLoad->getPayLoad();

  use chillerlan\QRCode\{QRCode, QROptions};

  include './vendor/autoload.php';

  $url = $payLoadQrCode;

  $options = new QROptions([
    'version'    => 5,
    'outputType' => QRCode::OUTPUT_MARKUP_SVG,
    'eccLevel'   => QRCode::ECC_L,
  ]);

  $qrcode = new QRCode($options);

  $qrcode->render($url, 'imgqrcode/curso-de-php.svg');

  echo  $payLoadQrCode."<br><img src='./assets/php/qrcode/imgqrcode/curso-de-php.svg' width='200'>";
?>