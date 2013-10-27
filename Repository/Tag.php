<?php

namespace Repository;

include_once "../Dao/Tag.php";

class Tag{
	
	private $tagDao = null;
	
	function __construct(){
		//prevent multiple instances
		if($this->tagDao == null){
			$this->tagDao = new \Dao\Tag();
		}
		
		return $this->tagDao;
	}
	
	public function get(){
		return $this->tagDao->get();
	}
	
	public function getTag($tagName){
		return $this->tagDao->getTag($tagName);
	}
}

?>