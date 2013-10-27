<?php

namespace Dao;

include_once "Database.php";

class FeedItem{
	
	private $database = null;
	private function getDatabase(){
		//prevent multiple instances
		if($this->database == null){
			$this->database = new Database();
		}
		
		return $this->database;
	}
	
	public function save($feedItem){
		$queryString = "INSERT INTO feedcontent(title,link,description,publicationDate) VALUES ('".$feedItem->getTitle() . "','" . $feedItem->getLink()  . "','" . $feedItem->getDescription() . "','" . $feedItem->getPublicationDate() ."') ";
		$queryString .= " ON DUPLICATE KEY UPDATE title = '".$feedItem->getTitle() . "', description = '" . $feedItem->getDescription() . "', publicationDate = '" . $feedItem->getPublicationDate() ."' ";
		
		echo $queryString;
		
		$this->getDatabase()->query($queryString);
	}
}

?>