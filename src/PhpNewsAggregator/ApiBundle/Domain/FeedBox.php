<?php

namespace PhpNewsAggregator\ApiBundle\Domain;

class FeedBox{
  private $id = 0;
  private $title = "";
  private $description = "";

  public function setId($value){ $this->id = $value; }
  public function setTitle($value){ $this->title = $value; }
  public function setDescription($value){ $this->description = $value; }

  public function getId() { return $this->id; }
  public function getTitle() { return $this->title; }
  public function getDescription() { return $this->description; }

}// end class

?>