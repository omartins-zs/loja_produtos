<?php

/**
 * MercadoPago
 *
 */
class MercadoPago extends Conn
{

  function __construct()
  {
    $this->conn = new Conn();
    $this->pdo  = $this->conn->pdo();
  }


 public function credenciais(){


    $q = $this->pdo->prepare('SELECT * FROM `credencias_mp`');
      if($q->execute()){
        $f = $q->fetch(PDO::FETCH_OBJ);

          return $f;

      }else{
        return false;
      }

  }


  public function convertMoney($type,$valor){
    if($type == 1){
       $a = str_replace(',','.',str_replace('.','',$valor));
       return $a;
     }else if($type == 2){
       return number_format($valor,2,",",".");
      }
  }


  public function init($credenciais,$pedido,$produto,$url){

    $mp = new MP($credenciais->client_id,$credenciais->client_secret);

    $preference_data = array(

       "items" => array(
         array(
           "id" => $produto->id,
           "title" => $produto->nome,
           "currency_id" => "BRL",
           "picture_url" => $url."/img/produtos/{$produto->img}",
           "description" => $produto->nome,
           "quantity" => 1,
           "unit_price" => (double)self::convertMoney(1,$pedido->valor)
         )
       ),

       "back_urls" => array(
         "success" => $url."/cliente",
         "failure" => $url."/cliente",
         "pending" => $url."/cliente"
       ),

       "notification_url" => $url."/control/notification.php",
       "external_reference" => $pedido->reference
    );

    $preference = $mp->create_preference($preference_data);

    $mp->sandbox_mode(FALSE);

    $link = $preference["response"]["init_point"];

    if($link != false){
      return $link;
    }else{
      return false;
    }

  }


  public function notification($credenciais,$cod){

    $mp = new MP($credenciais->client_id,$credenciais->client_secret);

    $token_access = ["access_token" => $mp->get_access_token()];

    $payment_info = $mp->get("/collections/notifications/" . $cod , $token_access, false);

    $status     = $payment_info["response"]["collection"]["status"];
    $forma      = $payment_info["response"]["collection"]["payment_type"];
    $reference  = $payment_info["response"]["collection"]["external_reference"];

    $return['ref'] = $reference;
    $return['status'] = $status;
    $return['forma'] = $forma;

    $json = json_encode($return);
    return $json;

  }


}
