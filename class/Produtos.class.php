<?php

/**
 * Produtos
 */
class Produtos extends Conn
{

	function __construct()
	{
		$this->conn = new Conn();
		$this->pdo  = $this->conn->pdo();
	}


	public function listar()
	{

		$query = $this->pdo->query("SELECT * FROM `produtos` ");
		$fetch = $query->fetchAll(PDO::FETCH_OBJ);

		if (count($fetch) > 0) {

			$query = $this->pdo->query("SELECT * FROM `produtos` ");
			return $query;
		} else {
			return false;
		}
	}
}
