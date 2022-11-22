<?php

  session_start();

  require_once '../class/Conn.class.php';
  require_once '../class/Produtos.class.php';
  require_once '../class/Pedidos.class.php';
  require_once '../class/MercadoPago.class.php';



  $produtos    = new Produtos();
  $pedidos     = new Pedidos();
  $mercadopago =  new MercadoPago();


  if(isset($_SESSION['checkout']) && isset($_SESSION['USER'])){

   $produto = $produtos->getProdutoById($_SESSION['checkout']['produtoId']);

   if($produto){

    $pedido = new stdClass();
    $pedido->iduser    = $_SESSION['USER']['id'];
    $pedido->produto   = $_SESSION['checkout']['produtoId'];
    $pedido->valor     = $produto->valor;
    $pedido->reference = $_SESSION['checkout']['reference'];
    $pedido->status    = "pending";
    $pedido->data      = $_SESSION['checkout']['data'];
    $pedido->hash      = sha1(date('His'));

    $searchPedido  = $pedidos->getPedidoById($pedido->reference);

    if($searchPedido){

      $pedido = $searchPedido;
      $insertPedido = true;

    }else{

      $insertPedido = $pedidos->insert((array)$pedido);

    }


      if($insertPedido){
        // iniciar gateway de pagamento

        $credenciais = $mercadopago->credenciais();

        if($credenciais){

          include_once '../lib/MercadoPago/lib/mercadopago.php';

          $url = "http://scriptmundo.com/infoprodutos";

          $link_payment = $mercadopago->init($credenciais,$pedido,$produto,$url);

          if($link_payment){

            echo '{"erro":false,"msg":"Sucesso","link":"'.$link_payment.'"}';
            exit();

          }else{
            echo '{"erro":true,"msg":"Erro, entre em contato com o suporte"}';
            exit();
          }

        }else{
          echo '{"erro":true,"msg":"Erro, entre em contato com o suporte"}';
          exit();
        }

      }else{
        echo '{"erro":true,"msg":"Erro, entre em contato com o suporte"}';
        exit();
      }

  }else{
    echo '{"erro":true,"msg":"Parece que o produto não está mais disponivel, tente outro ou entre em contato com o suporte"}';
    exit();
  }


  }else{
    echo '{"erro":true,"msg":"403"}';
    exit();
  }
