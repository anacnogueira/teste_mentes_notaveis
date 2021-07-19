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
}