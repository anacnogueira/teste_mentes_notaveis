<?php

class State 
{
	private $conn;
	private $table_name = "states";

	// object properties
	public $id;
	public $name;
	public $uf;

	public function __construct($db){
  		$this->conn = $db;
	}

	public function list()
	{
		$query = "SELECT id, name, uf
			FROM
		" . $this->table_name . " state
		ORDER BY
		state.name ASC";

		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	function create()
	{
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name, 
                    uf=:uf";
        $stmt = $this->conn->prepare($query);
   
        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":uf", $this->uf);
    
        if ($stmt->execute()) {
            return true;
        }
    
        return false;
    }

    public function read()
    {
    	$query = "SELECT
            id, name, euf
                FROM
                    " . $this->table_name . " state                    
                WHERE
                    user.id = ?
                LIMIT
                    0,1";
    
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
   	}

   	public function update()
   	{
   		$query = "UPDATE 
                    " . $this->table_name . "
                SET
                    name=:name, 
                    uf=:uf
                WHERE id =:id";
        $stmt = $this->conn->prepare($query);
   
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":uf", $this->uf);
    
        if ($stmt->execute()) {
            return true;
        }
    
        return false;
   	}

   	public function destroy ()
   	{
   		$query = "DELETE FROM 
                    " . $this->table_name . "
                WHERE id =:id";
        $stmt = $this->conn->prepare($query);
   
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
    
        return false;		
	}	
        
	public function validate($data)
	{
		$errors = [];

		if ( !isset($data['name']) || empty($data['name']) ) {
			$errors['name'] = 'O campo é obrigatorio';
		}

		if ( !isset($data['uf']) || empty($data['uf']) ) {
			$errors['uf'] = 'O campo é obrigatorio';
		}

		return $errors;
	}
}