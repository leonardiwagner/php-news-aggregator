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
	
	public function save($tagName){
		$queryString = "INSERT INTO tag(name) VALUES ('".$tag->getName() . "'";
		
		$this->getDatabase()->query($queryString);
		
		return $this->getDatabase()->insert_id;
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
	
	public function getTag($tagName){
		$tag = new \Model\Tag();
					
		$queryResult = $this->getDatabase()->query("SELECT id, name FROM tag");
		
		if(mysqli_num_rows($queryResult) == 0){
			$tagId = $this->save($tagName);
		}else{
			$row = mysqli_fetch_array($queryResult);
			
			$tagId = $row["id"];
		}
		
		$tag->setId($tagId);
		$tag->setName($tagName);
		
		return $tag;
	}
}

?>