<?php

  /**
   * Whatsapp
   */
  class Whatsapp extends Conn
  {

    function __construct()
    {
      $this->conn = new Conn();
      $this->pdo  = $this->conn->pdo();
    }


  public function credencias(){

    $query = $this->pdo->prepare('SELECT * FROM `credencias_whatsapp`');
      if($query->execute()){

          $f = $query->fetch(PDO::FETCH_OBJ);
          return $f;

      }else{
        return false;
      }
  }

  public function send($destino,$text){

     $wpp = self::credencias();

     $client_id = $wpp->client_id;
     $secret = $wpp->secret;
     $type = "text";
     $message = urlencode($text);
     $device_id = $wpp->device;
     $recipient = $destino;
     $url = 'http://scapi.com.br/api/message/sendText?client_id='.$client_id.'&secret='.$secret.'&type='.$type.'&message='.$message.'&device_id='.$device_id.'&recipient='.$recipient;

     $options = array(
         'http' => array(
             'method'  => 'GET'
         )
     );
     $context  = stream_context_create($options);
     $result = file_get_contents($url, false, $context);
     if ($result === FALSE) {
         return false;
     }

     $retorno = json_decode($result);
     if($retorno !== false){
         return true;
     }else{
         return false;
     }


  }


  public function getTemplate($nome){

      if(is_file('../templates_whatsapp/' . $nome)){
        $string = file_get_contents('../templates_whatsapp/' . $nome);
        return $string;
      }else{
        return false;
      }

  }


  }
