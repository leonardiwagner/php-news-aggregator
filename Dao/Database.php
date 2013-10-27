<?php

namespace Dao;

class Database{
	private $ip = "localhost";
	private $name = "pidfeed";
	private $user = "root";
	private $password = "1234";
	
	private $connection = null;
	
	function __construct()
	{
		//Connect to the database
		$this->connection = new \mysqli($this->ip, $this->user, $this->password, $this->name);
	}
			
	public function query($queryString)
	{
		return $this->connection->query($queryString);
	}
	
}// end class

?>