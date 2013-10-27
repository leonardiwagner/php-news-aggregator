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

		$titulo = trim(preg_replace('/\s+/', ' ', $feed->getTitle()));
		

		$this->getDatabase()->query("INSERT INTO feed (title,url,registered) VALUES ('" . $titulo . "','" . $feed->getUrl() ."', now())");

		return $this->getDatabase()->getInsertId();
	}
	
	public function get()
	{
		$feedList = array();
		
		$queryResult = $this->getDatabase()->query("SELECT id,url FROM feed GROUP BY url");
		

		for($i =0; $i < $queryResult->num_rows; $i++){

			$row = mysqli_fetch_array($queryResult);
				
			$feed = new \Model\Feed();
			$feed->setId($row["id"]);
			$feed->setUrl($row["url"]);
			array_push($feedList,$feed);
			
		}

		return $feedList;
	}
}

?>