<?php

namespace Model;

class FeedItem{
	private $feedId = 0;
	private $title = "";
	private $link = "";
	private $description = "";
	private $publicationDate = null;
	
	public function setFeedId($value) { $this->feedId = $value; }
	public function setTitle($value) { $this->title = $value; }
	public function setLink($value) { $this->link = $value; }
	public function setDescription($value) { $this->description = $value; }
	public function setPublicationDate($value) { $this->publicationDate = $value; }
	
	public function getFeedId() { return $this->feedId; }
	public function getTitle() { return $this->title; }
	public function getLink() { return $this->link; }
	public function getDescription() { return $this->description; }
	public function getPublicationDate() { return $this->publicationDate; }
}

?>