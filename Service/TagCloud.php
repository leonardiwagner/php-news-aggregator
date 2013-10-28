<?php

include_once "../Repository/Tag.php";

$tagRepository = new \Repository\Tag();
$tagList = $tagRepository->getTop(0,10);

$tagMin = 0;
$tagMax = 0;

for($i = 0; $i < sizeof($tagList); $i++){
	
	if($tagMin == 0 && $tagMax == 0){
		$tagMin = $tagList[$i]->getValue();
		$tagMax = $tagList[$i]->getValue();
	}else{
		if($tagList[$i]->getValue() > $tagMax)
		{
			$tagMax = $tagList[$i]->getValue();
		}else if($tagList[$i]->getValue() < $tagMin){
			$tagMin = $tagList[$i]->getValue();
		}
	}
	
}



$fontMin = 12;
$fontMax = 16;

$jsonReturn = "[";


for($i = 0; $i < sizeof($tagList); $i++){
	
	$tagValue = ($tagList[$i]->getValue() * $fontMax) / $tagMax; 
	$tagValue = (int)$tagValue + $fontMin - 1;
	
	$jsonReturn .= "{";
	$jsonReturn .= "	\"id\": \"". $tagList[$i]->getId() ."\",";
	$jsonReturn .= "	\"name\": \"". $tagList[$i]->getName() ."\",";
	$jsonReturn .= "	\"value\": \"". $tagValue ."\"";
	$jsonReturn .= "}";
	
	if($i < (sizeof($tagList) - 1))
	{
		$jsonReturn .= ",";
	}
}
	

$jsonReturn .= "]";

echo $jsonReturn;

?>