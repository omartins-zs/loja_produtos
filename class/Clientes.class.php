<?php

  /**
   * Clientes
   */
  class Clientes extends Conn
  {

    function __construct()
    {
      $this->conn = new Conn();
      $this->pdo  = $this->conn->pdo();
    }

   public function login($email,$senha){

      $query = $this->pdo->prepare("SELECT * FROM `usuarios` WHERE email= :email AND senha= :senha ");
      $query->bindValue(':email', $email);
      $query->bindValue(':senha', $senha);
      $execute = $query->execute();
      if($execute){

        $fetch = $query->fetchAll(PDO::FETCH_OBJ);
        if(count($fetch)>0){

           $q = $this->pdo->prepare("SELECT * FROM `usuarios` WHERE email= :email AND senha= :senha");
           $q->bindValue(':email', $email);
           $q->bindValue(':senha', $senha);
           $q->execute();
           $fetch = $q->fetch(PDO::FETCH_OBJ);


           $_SESSION['USER'] = (array)$fetch;

           return true;

        }else{
          return false;
        }

      }else{
        return false;
      }
   }


   public function create($email,$senha,$whatsapp,$nome){

     $query = $this->pdo->prepare("INSERT INTO `usuarios` (nome,email,whatsapp,senha) VALUES (:nome,:email,:whatsapp,:senha) ");
     $query->bindValue(':nome', $nome);
     $query->bindValue(':email', $email);
     $query->bindValue(':whatsapp', $whatsapp);
     $query->bindValue(':senha', $senha);

     if($query->execute()){
       return true;
     }else{
       return false;
     }

   }

   public function getClienteById($id){

     $query = $this->pdo->prepare("SELECT * FROM `usuarios` WHERE id= :id  ");
     $query->bindValue(':id', $id);
     if($query->execute()){

       $query = $this->pdo->query("SELECT * FROM `usuarios` WHERE id='$id' ");
       $fetch = $query->fetch(PDO::FETCH_OBJ);
       return $fetch;

     }else{
       return false;
     }

   }


  }
