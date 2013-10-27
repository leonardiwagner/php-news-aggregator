<?php

namespace Dao;

include_once "../Dao/Database.php";
include_once "../Model/Tag.php";

class Tag{
	private $database = null;
	private function getDatabase(){
		//prevent multiple instances
		if($this->database == null){
			$this->database = new Database();
		}
		
		return $this->database;
	}
	
	public function get()
	{
		$tagList = array();
		
		$queryResult = $this->getDatabase()->query("SELECT id,name FROM tag");
		

		for($i =0; $i < $queryResult->num_rows; $i++){

			$row = mysqli_fetch_array($queryResult);
				
			$tagList[$i] = new \Model\Tag();
			$tagList[$i]->setId($row["id"]);
			$tagList[$i]->setName($row["name"]);
		}
		
		return $tagList;
	}
	
	public function getTagId($tagName){
	
		$queryResult = $this->getDatabase()->query("SELECT id FROM tag WHERE name = '" . $tagName  . "'");
		
		if(mysqli_num_rows($queryResult) == 0){
			$queryString = "INSERT INTO tag(name) VALUES ('". $tagName . "')";
			$this->getDatabase()->query($queryString);
		
			$tagId = $this->getDatabase()->getInsertId();
		}else{
			$row = mysqli_fetch_array($queryResult);
			
			$tagId = $row["id"];
		}

		return $tagId;
	}
}

?>