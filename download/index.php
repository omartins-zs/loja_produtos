<?php


  session_start();

  require_once '../class/Conn.class.php';
  require_once '../class/Downloads.class.php';
  require_once '../class/Produtos.class.php';

  $downloads = new Downloads();
  $produtos  = new Produtos();

  if(isset($_GET['key'])){

    $key = $_GET['key'];

    $pedido = $downloads->getPedidoById($key);

    if($pedido){

      $produto = $produtos->getProdutoById($pedido->produto);

      if($produto){

        $download = array(
          'name_file' => $produto->name_file,
          'dir' => 'files'
        );

        $down = $downloads->download($download);

        if($down){

           $thanks = $downloads->download_thanks($produto,$pedido->reference,$download);

           if($thanks){
             // informar adm, mais um downlod

           }else{
             // informar adm, falha na segurança do arquivo de download

           }

        }

      }

    }

  }






?>
