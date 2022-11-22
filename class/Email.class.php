<?php

  /**
   * Email
   */
  class Email extends Conn
  {

    function __construct()
    {
      $this->conn = new Conn();
      $this->pdo  = $this->conn->pdo();
    }


  public function getSmtp(){

    $query = $this->pdo->prepare('SELECT * FROM `smtp`');
      if($query->execute()){

          $f = $query->fetch(PDO::FETCH_OBJ);
          return $f;

      }else{
        return false;
      }
  }

  public function send($destino,$smtp,$dados_mail){

    $Mailer  = new PHPMailer();
    $Mailer->IsSMTP();
    $Mailer->isHTML(true);
    $Mailer->Charset    = 'UTF-8';
    $Mailer->SMTPAuth   = true;
    $Mailer->SMTPSecure = 'tls';
    $Mailer->Host       = $smtp->host;
    $Mailer->Port       = $smtp->port;
 	  $Mailer->Username   = $smtp->username;
 		$Mailer->Password   = $smtp->password;
    $Mailer->From       = $smtp->email;
    $Mailer->FromName   = "INFO PRODUTOS";

    $Mailer->Subject    = $dados_mail->assunto;
    $Mailer->Body       = $dados_mail->corpo;
    $Mailer->AltBody    = strip_tags($dados_mail->corpo);

    $Mailer->AddAddress($destino);

    if($Mailer->Send()){
      return true;
    }else{
      return false;
    }


  }


  public function getTemplate($nome){

      if(is_file('../templates_email/' . $nome)){
        $string = file_get_contents('../templates_email/' . $nome);
        return $string;
      }else{
        return false;
      }

  }


  }
