<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>CheckOut</title>
  </head>
  <body>

    <div class="container">

      <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal">InfoProdutos</h5>
        <nav class="my-2 my-md-0 mr-md-3">
          <a class="p-2 text-dark" href="cliente">Home</a>
          <a class="p-2 text-dark" href="mailto:contato@seusite.com">Contato</a>
          <a class="p-2 text-dark" href="create">Cadastrar-se</a>
        </nav>

          <?php

            if(isset($_SESSION['USER'])){

           ?>
            <a class="btn btn-outline-primary" href="sair">Sair</a>
          <?php }else{ ?>
              <a class="btn btn-outline-primary" href="login">Login</a>
        <?php } ?>

      </div>

      <div class="row">

        <?php if(isset($_SESSION['checkout']['idUser'])){ ?>

          <!-- Pagamento -->
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <div class="card" style="padding:20px;">
                <div class="card-head">
                  <h3>Como deseja pagar?</h3>
                </div>
                <div class="card-body">
                    <a href="#" style="width:100%;" id="btn_mp" onclick="create_pedido();" class="btn btn-primary btn-lg" >Mercado Pago</a>
                </div>
            </div>
          </div>
          <div class="col-md-4"></div>


        <?php }else{ ?>

          <div class="col-md-12 text-center">
            <h2>Faça login ou crie sua conta</h2>
          </div>

          <div class="col-md-6">
            <div class="card" style="min-height:350px;padding:20px;" >

              <div class="card-head">
                  <h3>Faça login</h3>
              </div>

             <div class="form-group">
               <input class="form-control" type="email" id="email" autocomplete="off" name="email" placeholder="Digite seu email" value="" >
             </div>

             <div class="form-group">
               <input class="form-control" type="password" id="senha" name="senha" placeholder="Digite sua senha" value="" >
             </div>

             <div class="form-group">
               <button onclick="login();" type="button" style="width:100%;" class="btn btn-lg btn-outline-info" id="login" name="login">Entrar</button>
             </div>

            </div>
          </div>

          <div class="col-md-6">
            <div class="card" style="min-height:350px;padding:20px;" >

              <div class="card-head">
                  <h3>Criar conta</h3>
              </div>

             <div class="form-group">
               <input class="form-control" type="email" id="email_criar" name="email_criar" placeholder="Digite um email" value="" >
             </div>

             <div class="form-group">
               <input class="form-control" type="text" id="whatsapp_criar" name="whatsapp_criar" placeholder="Digite seu whatsapp" value="" >
               <small>Ex: 551112345698</small>
             </div>

             <div class="form-group">
               <input class="form-control" type="password" id="senha_criar" name="senha_criar" placeholder="Digite uma senha" value="" >
             </div>

             <div class="form-group">
               <button onclick="create();" type="button" style="width:100%;" class="btn btn-lg btn-outline-info" id="login" name="login">Criar</button>
             </div>

            </div>
          </div>

        <?php } ?>
      </div>

    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/function.js" ></script>


  </body>
</html>
