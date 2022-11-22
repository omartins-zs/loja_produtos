<?php

  if(!isset($_SESSION['USER'])){

    echo '<script>location.href="login";</script>';
    exit();

  }


  $pedidos = $i->Pedidos->getAllpedidosUser($_SESSION['USER']['id']);

?>

<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Área do cliente</title>
  </head>
  <body>

    <div class="container" >

      <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal">Company name</h5>
        <nav class="my-2 my-md-0 mr-md-3">
          <a class="p-2 text-dark" href="#">Features</a>
          <a class="p-2 text-dark" href="#">Enterprise</a>
          <a class="p-2 text-dark" href="#">Support</a>
          <a class="p-2 text-dark" href="#">Pricing</a>
        </nav>
        <a class="btn btn-outline-primary" href="sair">Sair</a>
      </div>

      <div class="row" >

        <table class="table">
        <thead>
          <tr>
            <th scope="col">Data</th>
            <th scope="col">Valor</th>
            <th scope="col">Status</th>
            <th scope="col">Produto</th>
            <th scope="col">Download</th>
          </tr>
        </thead>
        <tbody>

          <?php

            if($pedidos){

              $status = array(
                'approved' => "<span class='badge badge-success' >Aprovado</span>",
                'pending'  => "<span class='badge badge-warning' >Pendente</span>",
                'in_process' => "<span class='badge badge-warning' >Análise</span>",
                'rejected' => "<span class='badge badge-danger' >Rejeitado</span>",
                'refunded' => "<span class='badge badge-info' >Devolvido</span>",
                'cancelled' => "<span class='badge badge-secondary' >Cancelado</span>",
                'in_mediation' => "<span class='badge badge-danger' >Medianção</span>"
              );

              while($pedido = $pedidos->fetch(PDO::FETCH_OBJ)){


                $link = "";

                if($pedido->status == "approved"){
                  $link = "http://localhost/infoprodutos/download/?key={$pedido->hash}";
                }

                $produto = $i->Produtos->getProdutoByid($pedido->produto);

            ?>

          <tr>
            <th scope="row"><?= $pedido->data; ?></th>
            <td>R$ <?= $pedido->valor; ?></td>
            <td><?= $status[$pedido->status]; ?></td>
            <td><?= $produto->nome; ?></td>
            <td>
              <?php if($link == ""){ ?>
              <button href="#" disabled class="disabled btn btn-sm btn-info" >Download</button>
            <?php }else{ ?>
              <a onclick="location.href=''" target="_blank" href="<?= $link; ?>"  class="btn btn-sm btn-info" >Download</a>
            <?php } ?>
            </td>
          </tr>

          <?php
            }
          }else{
          ?>
          <tr>
            <td colspan="5" class="text-center" >Nenhum pedido encontrado</td>
          </tr>
        <?php } ?>
        </tbody>
      </table>

      </div>

     </div>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
