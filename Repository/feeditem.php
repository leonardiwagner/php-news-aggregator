<?php

namespace repository;

include_once "../dao/feedItem.php";

class FeedItem{
	private $feedItemDao = null;
	
	function __construct(){
		//prevent multiple instances
		if($this->feedItemDao == null){
			$this->feedItemDao = new \dao\FeedItem();
		}
		
		return $this->feedItemDao;
	}
	
	public function saveFeedItem($feedItem)
	{
		$this->feedItemDao->save($feedItem);
	}	
	
}


?>