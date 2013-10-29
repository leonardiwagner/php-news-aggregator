<?php

namespace Dao;

include_once "../Dao/Database.php";
include_once "../Model/FeedBox.php";

class Feed{
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
		$feedBoxList = array();
		
		$queryResult = $this->getDatabase()->query("SELECT id, title, description FROM feedbox");
		
		for($i =0; $i < $queryResult->num_rows; $i++){

			$row = mysqli_fetch_array($queryResult);
				
			$feedBox = new \Model\FeedBox();
			$feedBox->setId($row["id"]);
			$feedBox->setTitle($row["title"]);
			$feedBox->setDescription($row["description"]);
			array_push($feedBoxList,$feedBox);
			
		}

		return $feedBoxList;
	}
	
}// end class

?>