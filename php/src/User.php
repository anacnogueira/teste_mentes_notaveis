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

	public function list()
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

	public function validate($data)
	{
		$errors = [];

		if ( !isset($data['name']) || empty($data['name']) ) {
			$errors['name'] = 'O campo é obrigatorio';
		}

		if ( !isset($data['email']) || empty($data['email']) ) {
			$errors['email'] = 'O campo é obrigatorio';
		} else if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL) ) { // Validate email
			$errors['email'] = 'O e-mail deve ser um endereço de e-mail válido.';
		}
		//Unique
		$query = "SELECT email
			FROM
		" . $this->table_name . " user
		WHERE user.email = ?";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $data['email']);
		$stmt->execute();
		$num = $stmt->rowCount();
		
		if ( $num > 0) {
			$errors['email'] = 'O campo requer um valor único.';
		}

		return $errors;
	}
}