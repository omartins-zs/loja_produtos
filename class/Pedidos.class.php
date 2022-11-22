<?php

  /**
   * Pedidos
   */
  class Pedidos extends Conn
  {

    function __construct()
    {
      $this->conn = new Conn();
      $this->pdo  = $this->conn->pdo();
    }


    public function insert($pedido){

      $query = $this->pdo->prepare("INSERT INTO `pedidos` (iduser,produto,valor,reference,status,data,hash) VALUES (:iduser,:produto,:valor,:reference,:status,:data,:hash) ");

      if($query->execute($pedido)){
        return true;
      }else{
        return false;
      }

    }


    public function getAllpedidosUser($iduser){
      
      $query = $this->pdo->prepare("SELECT * FROM `pedidos` WHERE iduser= :iduser ");
      $query->bindValue(':iduser', $iduser);
      if($query->execute()){
        $fetch = $query->fetchAll(PDO::FETCH_OBJ);
        if(count($fetch)>0){

          $query = $this->pdo->prepare("SELECT * FROM `pedidos` WHERE iduser= :iduser ");
          $query->bindValue(':iduser', $iduser);
          $query->execute();

          return $query;

        }else{

          return false;

        }
      }

    }


    public function getPedidoById($reference,$notification=false){

      if($notification){

        $query = $this->pdo->prepare("SELECT * FROM `pedidos` WHERE reference= :reference AND status != :status ");
        $query->bindValue(':reference', $reference);
        $query->bindValue(':status', 'approved');
        if($query->execute()){

          $query = $this->pdo->query("SELECT * FROM `pedidos` WHERE reference='$reference' AND status != 'approved' ");
          $fetch = $query->fetch(PDO::FETCH_OBJ);
          return $fetch;

        }else{
          return false;
        }

      }else{


        $query = $this->pdo->prepare("SELECT * FROM `pedidos` WHERE reference= :reference  ");
        $query->bindValue(':reference', $reference);
        if($query->execute()){

          $query = $this->pdo->query("SELECT * FROM `pedidos` WHERE reference='$reference' ");
          $fetch = $query->fetch(PDO::FETCH_OBJ);
          return $fetch;

        }else{
          return false;
        }

      }
    }


    public function updatePedido($status,$ref){

      $query = $this->pdo->query("UPDATE `pedidos` SET status='$status' WHERE reference='$ref' ");
      if($query){
        return true;
      }else{
        return false;
      }
    }

  }
