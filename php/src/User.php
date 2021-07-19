<?php

class User 
{
	private $conn;
	private $table_name = "users";

	// object properties
	public $id;
	public $name;
	public $email;
	public $created_at;
	public $updated_at;

	public function __construct($db){
  		$this->conn = $db;
	}

	function list()
	{
		$query = "SELECT id, name, email, created_at, updated_at
			FROM
		" . $this->table_name . " user
		ORDER BY
		user.id ASC";

		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
}