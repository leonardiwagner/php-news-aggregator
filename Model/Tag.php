<?php

namespace Model;

class Tag{
	private $id = 0;
	private $name = "";
	
	public function setId($value) { $this->id = $value; }
	public function setName($value) { $this->name = $value; }
	
	public function getId() { return $this->id; }
	public function getName() { return $this->name; } 
}


?>