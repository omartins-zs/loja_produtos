<?php

  require_once '../class/Conn.class.php';
  require_once '../lib/MercadoPago/lib/mercadopago.php';
  require_once '../lib/phpmailer/PHPMailerAutoload.php';
  require_once '../class/MercadoPago.class.php';
  require_once '../class/Pedidos.class.php';
  require_once '../class/Produtos.class.php';
  require_once '../class/Clientes.class.php';
  require_once '../class/Email.class.php';
  require_once '../class/Whatsapp.class.php';

  $mercadopago = new MercadoPago();
  $pedidos     = new Pedidos();
  $produtos    = new Produtos();
  $clientes    = new Clientes();
  $email       = new Email();
  $whatsapp    = new Whatsapp();

  if( isset($_GET['collection_id']) || isset($_GET['id']) ){

    $cod  = isset($_GET['collection_id']) ? $_GET['collection_id'] : $_GET['id'];

    $credenciais = $mercadopago->credenciais();

    if($credenciais){

      $notification = $mercadopago->notification($credenciais,$cod);

      if($notification){

        $info_notification = json_decode($notification);

        if($info_notification->status == "pending"){

          $pedido = $pedidos->getPedidoById($info_notification->ref,true);

          if($pedido){

            $produto = $produtos->getProdutoById($pedido->produto);

            if($produto){

              $cliente = $clientes->getClienteById($pedido->iduser);

              if($cliente){

                $update = $pedidos->updatePedido($info_notification->status,$info_notification->ref);

                if($update){

                  $template = $email->getTemplate('envia_link.html');

                  if($template){

                      $str_1 = array("http://localhost/infoprodutos/download/?key={$pedido->hash}",$pedido->valor,$info_notification->forma,explode(' ',$cliente->nome)[0]);
                      $str_2 = array('{link}','{valor}','{forma}','{nome_cliente}');

                      $corpo = str_replace($str_2,$str_1,$template);
                      $smtp  = $email->getSmtp();

                      $dados_mail = new stdClass();
                      $dados_mail->assunto = "Seu pagamento foi confirmado";
                      $dados_mail->corpo   = $corpo;

                      $send = $email->send($cliente->email,$smtp,$dados_mail);


                      $template_wpp = $whatsapp->getTemplate("envia_link.txt");

                      if($template_wpp){

                        $corpo_wpp = str_replace($str_2,$str_1,$template_wpp);
                        $send_wpp  = $whatsapp->send($cliente->whatsapp,$corpo_wpp);

                      }



                  }

                }

              }

            }

          }

        }

      }


    }

  }


?>
