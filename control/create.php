<?php

  session_start();

  require_once '../class/Conn.class.php';
  require_once '../class/Clientes.class.php';

  $clientes = new Clientes();

  if(isset($_POST['email']) && isset($_POST['whatsapp']) && isset($_POST['senha'])){

    if($_POST['email'] != "" && $_POST['whatsapp'] != "" && $_POST['senha'] != "" && $_POST['nome'] != ""){


      $email    = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
      $senha    = $_POST['senha'];
      $whatsapp = $_POST['whatsapp'];
      $nome     = $_POST['nome'];

      $create = $clientes->create($email,$senha,$whatsapp,$nome);

      if($create){
        $login = $clientes->login($email,$senha);
        if($login){
          echo '{"erro":false,"create":1,"login":1,"msg":"logado"}';
        }else{
          echo '{"erro":true,"create":1,"login":0,"msg":"Sua conta foi criada, faça login"}';
        }
      }else{
        echo '{"erro":true,"create":0,"login":0,"msg":"Erro temporario, tente mais tarde, ou entre em contato com o suporte"}';
      }


    }




  }
