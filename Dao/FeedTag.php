<?php

namespace Dao;

include_once "../Dao/Database.php";

class FeedTag{
	private $database = null;
	private function getDatabase(){
		//prevent multiple instances
		if($this->database == null){
			$this->database = new Database();
		}
		
		return $this->database;
	}
	
	
	
	public function save($feedId, $tagId){
 		$this->getDatabase()->query("INSERT INTO feedtag (feedid,tagid) VALUES (" . $feedId . "," . $tagId .")");
	}
	
}

?>