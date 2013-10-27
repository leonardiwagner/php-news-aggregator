<?php

namespace repository;

include_once "../Dao/FeedItem.php";

class FeedItem{
	private $feedItemDao = null;
	
	function __construct(){
		//prevent multiple instances
		if($this->feedItemDao == null){
			$this->feedItemDao = new \Dao\FeedItem();
		}
		
		return $this->feedItemDao;
	}
	
	public function saveFeedItem($feedItem)
	{
		$this->feedItemDao->save($feedItem);
	}	
	
	public function get($feedBoxId, $skip = 0, $count = 4){
		return $this->feedItemDao->get($feedBoxId, $skip, $count);
	}
	
}


?>