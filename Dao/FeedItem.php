<?php

namespace Dao;

include_once "Database.php";
include_once "../Model/FeedItem.php";

class FeedItem{
	
	private $database = null;
	private function getDatabase(){
		//prevent multiple instances
		if($this->database == null){
			$this->database = new Database();
		}
		
		return $this->database;
	}
	
	public function get($feedBoxId, $skip = 0, $count = 5){
		$feedItemList = array();
		
		$queryString = "SELECT feeditem.title, feeditem.description, feeditem.link, feeditem.publicationDate FROM feeditem ";
		$queryString .= " INNER JOIN feedtag ON feedtag.feedid = feeditem.feedid ";
		$queryString .= " INNER JOIN feedboxtag ON feedboxtag.tagid = feedtag.tagid ";
		$queryString .= " WHERE feedboxtag.feedboxid = $feedBoxId ";
		$queryString .= " ORDER by publicationDate DESC	 ";
		$queryString .= " LIMIT $skip,$count	 ";
		
		$queryResult = $this->getDatabase()->query($queryString);
		
		for($i =0; $i < $queryResult->num_rows; $i++){

			$row = mysqli_fetch_array($queryResult);
				
			$feedItem = new \Model\FeedItem();
			$feedItem->setTitle($row["title"]);
			$feedItem->setDescription($row["description"]);
			$feedItem->setLink($row["link"]);
			$feedItem->setPublicationDate($row["publicationDate"]);
			array_push($feedItemList, $feedItem);
			
		}
		
		return $feedItemList;
	}
	
	public function save($feedItem){
		$queryString = "INSERT INTO feeditem(feedId,title,link,description,publicationDate) VALUES (" . $feedItem->getFeedId() . ",'".$feedItem->getTitle() . "','" . $feedItem->getLink()  . "','" . $feedItem->getDescription() . "','" . $feedItem->getPublicationDate() ."') ";
		$queryString .= " ON DUPLICATE KEY UPDATE title = '".$feedItem->getTitle() . "', description = '" . $feedItem->getDescription() . "', publicationDate = '" . $feedItem->getPublicationDate() ."' ";
		
		$this->getDatabase()->query($queryString);
	}
	
}// end class

?>