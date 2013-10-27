<?php

namespace Model;

class Feed{
	private $title = "";
	private $url = "";
	private $tagList = array();
	private $feedItemList = array();
	
	public function setTitle($value){ $this->title = $value; }
	public function setUrl($value){ $this->url = $value; }
	
	public function addFeedItem($value){
		array_push($this->feedItemList, $value);
	}
	
	public function addTag($value){
		array_push($this->feedItemList, $value);
	}
	 
	
	public function getTitle() { return $this->url; }
	public function getUrl() { return $this->url; }
	public function getFeedItemList() { return $this->feedItemList; }
	public function getTagList() { return $this->feedItemList; }

}

?>