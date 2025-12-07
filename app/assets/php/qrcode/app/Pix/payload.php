<?php

namespace App\Pix;

class payLoad{
      /**
   * IDs do Payload do Pix
   * @var string
   */
  const ID_PAYLOAD_FORMAT_INDICATOR = '00';
  const ID_MERCHANT_ACCOUNT_INFORMATION = '26';
  const ID_MERCHANT_ACCOUNT_INFORMATION_GUI = '00';
  const ID_MERCHANT_ACCOUNT_INFORMATION_KEY = '01';
  const ID_MERCHANT_ACCOUNT_INFORMATION_DESCRIPTION = '02';
  const ID_MERCHANT_CATEGORY_CODE = '52';
  const ID_TRANSACTION_CURRENCY = '53';
  const ID_TRANSACTION_AMOUNT = '54';
  const ID_COUNTRY_CODE = '58';
  const ID_MERCHANT_NAME = '59';
  const ID_MERCHANT_CITY = '60';
  const ID_ADDITIONAL_DATA_FIELD_TEMPLATE = '62';
  const ID_ADDITIONAL_DATA_FIELD_TEMPLATE_TXID = '05';
  const ID_CRC16 = '63';


  /**
   * Chave Pix
   * @var string
   */
  private $pixKey;

  /**
   * Descrição
   * @var string
   */
  private $description;

    /**
   * Titular da conta
   * @var string
   */
  private $merchantName;

    /**
   * Cidade do titular
   * @var string
   */
  private $merchantCity;

    /**
   * ID da transação
   * @var string
   */
  private $txid;

  /**
   * Valor
   * @var string
   */
  private $amount;

  
/**
 * Metodo responsável por definir o valor do pixKey
 * @param string
 */
  public function setPixKey($pixKey){
    $this->pixKey = $pixKey;
    return $this;
  }

  /**
 * Metodo responsável por definir o valor da decrição
 * @param string
 */
public function description($description){
    $this->description = $description;
    return $this;
  }

  /**
 * Metodo responsável por definir o valor do titular da conta
 * @param string
 */
public function merchantName($merchantName){
    $this->merchantName = $merchantName;
    return $this;
  }

    /**
 * Metodo responsável por definir o valor da cidade do titular da conta
 * @param string
 */
public function merchantCity($merchantCity){
    $this->merchantCity = $merchantCity;
    return $this;
  }

      /**
 * Metodo responsável por definir o valor do txid
 * @param string
 */
public function txid($txid){
    $this->txid = $txid;
    return $this;
  }
  
        /**
 * Metodo responsável por definir o valor da transação
 * @param float
 */
public function amount($amount){
    $this->amount = (string)number_format($amount,2,'.','');
    return $this;
  }


  /** 
   * Metodo responsável por retornar o valor completo de um payLoad
   * @param string $id
   * @param string $value
   * @return $id.$size.$value
   * 
   */
private function getValue($id,$value){
    $size = str_pad(strlen($value),2,"0",STR_PAD_LEFT);
    return $id.$size.$value;

  }

  private function getAddData(){
    $txid = $this->getValue(self::ID_ADDITIONAL_DATA_FIELD_TEMPLATE_TXID,$this->txid);

    return $this->getValue(self::ID_ADDITIONAL_DATA_FIELD_TEMPLATE,$txid);
  }

    /** 
   * Metodo responsável por retornar o valor completo das informações da conta
   * @param string 
   * 
   */
private function getMerchant(){
  $gui = $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION_GUI,'br.gov.bcb.pix');
  $key = $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION_KEY, $this->pixKey);
  $description = strlen($this->description) ? $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION_DESCRIPTION, $this->description): '';

  return $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION,$gui.$key.$description);
}

  /**
   * Metodo responsável por gerar o código completo do payload Pix
   * @return string
   */
public function getPayLoad(){
  $payLoad = $this->getValue(self::ID_PAYLOAD_FORMAT_INDICATOR,'01').
             $this->getMerchant().
             $this->getValue(self::ID_MERCHANT_CATEGORY_CODE,'0000').
             $this->getValue(self::ID_TRANSACTION_CURRENCY,'986').
             $this->getValue(self::ID_TRANSACTION_AMOUNT,$this->amount).
             $this->getValue(self::ID_COUNTRY_CODE,'BR').
             $this->getValue(self::ID_MERCHANT_NAME,$this->merchantName).
             $this->getValue(self::ID_MERCHANT_CITY,$this->merchantCity).
             $this->getAddData()
             ; 

  return $payLoad.$this->getCRC16($payLoad);
}

private function getCRC16($payload) {
  //ADICIONA DADOS GERAIS NO PAYLOAD
  $payload .= self::ID_CRC16.'04';

  //DADOS DEFINIDOS PELO BACEN
  $polinomio = 0x1021;
  $resultado = 0xFFFF;

  //CHECKSUM
  if (($length = strlen($payload)) > 0) {
      for ($offset = 0; $offset < $length; $offset++) {
          $resultado ^= (ord($payload[$offset]) << 8);
          for ($bitwise = 0; $bitwise < 8; $bitwise++) {
              if (($resultado <<= 1) & 0x10000) $resultado ^= $polinomio;
              $resultado &= 0xFFFF;
          }
      }
  }

  //RETORNA CÓDIGO CRC16 DE 4 CARACTERES
  return self::ID_CRC16.'04'.strtoupper(dechex($resultado));
}

  

}