<?php

 session_start();

 require_once '../class/Conn.class.php';
 require_once '../class/Produtos.class.php';

 $produtos = new Produtos();

 if(isset($_GET['id'])){


   $idProduto = $_GET['id'];

   if(is_numeric($idProduto) && $idProduto != ""){
     $produto = $produtos->getProdutoById($idProduto);
     if($produto == false){
       echo '<script>location.href="../produto/'.$idProduto.'";</script>';
     }
   }else{
      echo '<script>location.href="../produto/'.$idProduto.'";</script>';
   }


   $_SESSION['checkout'] = array(
      'produtoId' => $idProduto,
      'data' => date('d/m/Y'),
      'reference' => substr(sha1(rand(10000,99000)),0,100)
   );


   if(isset($_SESSION['USER'])){
     // está logado , redireciona para pagina de pagamento
     $_SESSION['checkout']['idUser'] = $_SESSION['USER']['id'];
   }

   echo '<script>location.href="../checkout";</script>';

 }
