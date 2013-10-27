<?php

namespace Repository;

include_once "../Dao/FeedBox.php";

class FeedBox{
	
	private $feedBoxDao = null;
	
	function __construct(){
		//prevent multiple instances
		if($this->feedBoxDao == null){
			$this->feedBoxDao = new \Dao\Feed();
		}
		
		return $this->feedBoxDao;
	}
	
	public function get(){
		return $this->feedBoxDao->get();
	}
	
}

?>