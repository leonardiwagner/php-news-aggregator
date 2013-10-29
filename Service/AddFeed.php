<?php

error_reporting(E_ERROR | E_PARSE);

include_once "..\Bll\Feed.php";
include_once "..\Repository\Feed.php";
include_once "..\Repository\FeedTag.php";
include_once "..\Repository\Tag.php";

$feed = null;
$feedBll = new \Bll\Feed();

$feedRepository = new \Repository\Feed();
$feedTagRepository = new \Repository\FeedTag();
$tagRepository = new \Repository\Tag();

$data = null;
$feed = null;

//Check if rss have valid content
try{
	$data = file_get_contents("php://input");
	$data = json_decode($data);	
	
	$feed = $feedBll->readFeed2($data->feed);
}catch(Exception $e){
	$jsonResponse = "{ \"response\": false, \"text\": \"Hey, the typed Feed Url is not valid!\"}";	
	echo $jsonResponse;
	exit;
}

//Check if user typed the feed url
if(strlen($data->feed) <= 3)
{
	$jsonResponse = "{ \"response\": false, \"text\": \"You need to type Feed Url\"}";	
	echo $jsonResponse;
	exit;
}

//Check if feed have content
if(sizeof($feed->getFeedItemList()) <= 0){
	//check for rss1
	$feed = $feedBll->readFeed1($data->feed);
	
	if(sizeof($feed->getFeedItemList()) <= 0){
		$jsonResponse = "{ \"response\": false, \"text\": \"The given Feed Url doesn't have any news :()\"}";	
		echo $jsonResponse;
		exit;
	}
}

//Check if feed have at least one tag
if($data->tagId == null || $data->tagId == 0){
	$jsonResponse = "{ \"response\": false, \"text\": \"You have to type at least one category to add feed\"}";	
	echo $jsonResponse;
	exit;
}

//Save feed
$feedId = $feedRepository->save($feed);
if(!($feedId > 0))
{
	$jsonResponse = "{ \"response\": false, \"text\": \"Oh, our database is so stupid! Please report this bug.\"}";	
	echo $jsonResponse;
	exit;
}

//Save tag
$feedTagRepository->save($feedId, $data->tagId);

$jsonResponse = "{ \"response\": true, \"text\": \"Awesome! We have a new feed, thank you very much!\"}";	
echo $jsonResponse;
exit;










?>