<?php
namespace chillerlan\QRCodeExamples;

require __DIR__.'/app/Pix/payload.php';


use \App\Pix\payload;

$valor = $_POST['valor'];

//Instancia principal do payload pix
$obPayLoad = (new payLoad)->setPixKey('13730921908')
                          ->description('a')
                          ->merchantName('a')
                          ->merchantCity('a')
                          ->amount($valor)
                          ->txid('a');

$payLoadQrCode = $obPayLoad->getPayLoad();

echo $payLoadQrCode;
echo('<br>');

//Namespace usando para nomear as classe e evitar conflito de classe iguais

//Estamos usando a classe QRCode do namespace QRCodeExamples
use chillerlan\QRCode\{QRCode, QROptions};

//Incluir Composer
include './vendor/autoload.php';



//URL que será utilizada para gerar o QR
$url = $payLoadQrCode;

//Configurações do QRCode
$options = new QROptions([
	'version'    => 5,
	'outputType' => QRCode::OUTPUT_MARKUP_SVG,
	'eccLevel'   => QRCode::ECC_L,
]);

//invoca uma nova instância QRCode
$qrcode = new QRCode($options);

//Gerar a imagem do QR
//$qrcode->render($url);

//Gerar a imagem e salvar a imagem do QR no servidor
$qrcode->render($url, 'imgqrcode/curso-de-php.svg');

echo "<img src='./assets/php/gerarQrcode/imgqrcode/curso-de-php.svg' width='200'>";

//echo '<img src="'.(new QRCode)->render($url).'" alt="Celke" />';