<?php

include_once "..\Repository\FeedBox.php";
include_once "..\Repository\FeedItem.php";

$feedBoxRepository = new \Repository\FeedBox();
$feedItemRepository = new \Repository\FeedItem();

$feedBoxList = $feedBoxRepository->get();

$jsonReturn = "[";

for($i = 0; $i < sizeof($feedBoxList); $i++){
	$jsonReturn .= "{";
	$jsonReturn .= "	\"id\": \"". $feedBoxList[$i]->getId() ."\",";
	$jsonReturn .= "	\"title\": \"". $feedBoxList[$i]->getTitle() ."\",";
	$jsonReturn .= "	\"description\": \"". $feedBoxList[$i]->getDescription() ."\",";
	
	
	$jsonReturn .= "	\"feedItemList\": [ ";
	
	$feedItemList = $feedItemRepository->get($feedBoxList[$i]->getId());
	
	for($j = 0; $j < sizeof($feedItemList); $j++){
		$jsonReturn .= "	{";
		$jsonReturn .= "		\"title\": ". json_encode($feedItemList[$j]->getTitle()) .",";
		$jsonReturn .= "		\"description\": ". json_encode($feedItemList[$j]->getDescription()) .",";
		$jsonReturn .= "		\"link\": ". json_encode($feedItemList[$j]->getLink()) .",";
		$jsonReturn .= "		\"publicationDate\": \"". relativeTime($feedItemList[$j]->getPublicationDate()) ."\"";
		$jsonReturn .= "	}";
		
		if($j < (sizeof($feedItemList) - 1))
		{
			$jsonReturn .= ",";
		}
	}
	
	
	$jsonReturn .= "	] ";
	
	$jsonReturn .= "}";
	
	if($i < (sizeof($feedBoxList) - 1))
	{
		$jsonReturn .= ",";
	}
}

$jsonReturn .= "]";

echo $jsonReturn;


function relativeTime($date, $postfix = ' ago', $fallback = 'F Y') 
{
    $diff = time() - strtotime($date);
    if($diff < 60) 
        return $diff . ' second'. ($diff != 1 ? 's' : '') . $postfix;
    $diff = round($diff/60);
    if($diff < 60) 
        return $diff . ' minute'. ($diff != 1 ? 's' : '') . $postfix;
    $diff = round($diff/60);
    if($diff < 24) 
        return $diff . ' hour'. ($diff != 1 ? 's' : '') . $postfix;
    $diff = round($diff/24);
    if($diff < 7) 
        return $diff . ' day'. ($diff != 1 ? 's' : '') . $postfix;
    $diff = round($diff/7);
    if($diff < 4) 
        return $diff . ' week'. ($diff != 1 ? 's' : '') . $postfix;
    $diff = round($diff/4);
    if($diff < 12) 
        return $diff . ' month'. ($diff != 1 ? 's' : '') . $postfix;

    return date($fallback, strtotime($date));
}



?>