<?php

  /**
   * Downloads
   */
  class Downloads extends Conn
  {

    function __construct()
    {
      $this->conn = new Conn();
      $this->pdo  = $this->conn->pdo();
    }


    public function getPedidoById($hash){


        $query = $this->pdo->prepare("SELECT * FROM `pedidos` WHERE hash= :hash AND status= :status ");
        $query->bindValue(':hash', $hash);
        $query->bindValue(':status', 'approved');
        if($query->execute()){

          $query = $this->pdo->query("SELECT * FROM `pedidos` WHERE hash='$hash' AND status= 'approved' ");
          $fetch = $query->fetch(PDO::FETCH_OBJ);
          return $fetch;

        }else{
          return false;
        }


    }


    public function download($download){

      $file = $download['dir'] .'/'. $download['name_file'];

      if(is_file($file)){

        $extensao = pathinfo($file, PATHINFO_EXTENSION);

        switch(strtolower(substr(strrchr(basename($file),"."),1))){

          case "pdf": $tipo="application/pdf"; break;
          case "exe": $tipo="application/octet-stream"; break;
          case "zip": $tipo="application/zip"; break;
          case "doc": $tipo="application/msword"; break;
          case "xls": $tipo="application/vnd.ms-excel"; break;
          case "ppt": $tipo="application/vnd.ms-powerpoint"; break;
          case "gif": $tipo="image/gif"; break;
          case "png": $tipo="image/png"; break;
          case "jpg": $tipo="image/jpg"; break;
          case "mp3": $tipo="audio/mpeg"; break;
          case "php":
          case "htm":
          case "html":

       }

       header("Content-Type: ".$tipo);
       header("Content-Length: ".filesize($file));
       header("Content-Disposition: attachment; filename=".basename($file));

       if(readfile($file)){
         return true;
       }


      }else{
        return false;
      }


    }


    public function download_thanks($produto,$reference,$download){

         $hash = md5(sha1(date('His')));

         $query = $this->pdo->query("UPDATE `pedidos` SET hash='$hash' WHERE reference='$reference' ");

         if($query){

           $extensao = '.'.strtolower(substr(strrchr(basename($download['dir'] .'/'. $download['name_file']),"."),1));

           $newNameFile = $hash . $extensao;

           $rename = rename($download['dir'] .'/'. $download['name_file'], $download['dir'] .'/'. $newNameFile );

           if($rename){

             $idProduto = $produto->id;

             $query = $this->pdo->query("UPDATE `produtos` SET name_file='$newNameFile' WHERE id='$idProduto' ");

             if($query){
               return true;
             }

           }


         }


    }



  }
