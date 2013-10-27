<?php

namespace Repository;

include_once "../Dao/Feed.php";

class Feed{
	
	private $feedDao = null;
	
	function __construct(){
		//prevent multiple instances
		if($this->feedDao == null){
			$this->feedDao = new \Dao\Feed();
		}
		
		return $this->feedDao;
	}
	
	public function save($feed){
		return $this->feedDao->save($feed);
	}
	
}

?>