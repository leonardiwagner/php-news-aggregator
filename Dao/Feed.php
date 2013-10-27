<?php

namespace Dao;

include_once "../Dao/Database.php";
include_once "../Model/Feed.php";

class Feed{
	private $database = null;
	private function getDatabase(){
		//prevent multiple instances
		if($this->database == null){
			$this->database = new Database();
		}
		
		return $this->database;
	}
	
	public function save($feed){
		$this->database->query("INSERT INTO feed (name,url) VALUES ('" . $feed->getName() . "','" . $feed->getUrl() ."')");
	}
	
	public function get()
	{
		$feedList = array();
		
		$queryResult = $this->getDatabase()->query("SELECT url FROM feed");
		

		for($i =0; $i < $queryResult->num_rows; $i++){

			$row = mysqli_fetch_array($queryResult);
				
			$feedList[$i] = new \model\Feed();
			$feedList[$i]->setUrl($row["url"]);
		}
		
		return $feedList;
	}
}

?>