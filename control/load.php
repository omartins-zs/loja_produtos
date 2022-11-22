<?php

 session_start();

 if(isset($_POST['load'])){

   if(isset($_SESSION['USER'])){

      $_SESSION['checkout']['idUser'] = $_SESSION['USER']['id'];
      echo 1;
  }else{
      echo 0;
  }

 }


?>
