<?php

namespace Repository;

include_once "../Dao/FeedTag.php";

class FeedTag{
	
	private $feedTagDao = null;
	
	function __construct(){
		//prevent multiple instances
		if($this->feedTagDao == null){
			$this->feedTagDao = new \Dao\FeedTag();
		}
		
		return $this->feedTagDao;
	}
	
	public function save($feedId, $tagId){
		return $this->feedTagDao->save($feedId, $tagId);
	}
	
}

?>