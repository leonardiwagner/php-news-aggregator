<?php

namespace PhpNewsAggregator\ApiBundle\Domain;

class Tag{
  private $id = 0;
  private $name = "";
  private $value = "";

  public function setId($value) { $this->id = $value; }
  public function setName($value) { $this->name = $value; }
  public function setValue($value) { $this->value = $value; }

  public function getId() { return $this->id; }
  public function getName() { return $this->name; } 
  public function getValue() { return $this->value; } 

  public function TagCloud(){

    $tagRepository = new \Repository\Tag();
    $tagList = $tagRepository->getTop(0,20);

    $maxValue = 0;
    $minValue = 0;

    $jsonReturn = "[";

    for($i = 0; $i < sizeof($tagList); $i++){
      $jsonReturn .= "\"". $tagList[$i]->getName() ."\"";

      if($i < (sizeof($tagList) - 1))
      {
        $jsonReturn .= ",";
      }
    }

    $rssFeed->setUrl($url);

    return $rssFeed;
  }

}// end class


?>