<?php

//error_reporting(E_ERROR | E_PARSE);

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
	$jsonResponse = "{ \"response\": false, \"text\": \"O endereço que você adicionou não é um feed válido\"}";	
	echo $jsonResponse;
	exit;
}

//Check if user typed the feed url
if(strlen($data->feed) <= 3)
{
	$jsonResponse = "{ \"response\": false, \"text\": \"Você deve inserir o endereço do feed\"}";	
	echo $jsonResponse;
	exit;
}


//Check if feed have content
if(sizeof($feed->getFeedItemList()) <= 0){
	//check for rss1
	$feed = $feedBll->readFeed1($data->feed);
	
	if(sizeof($feed->getFeedItemList()) <= 0){
		$jsonResponse = "{ \"response\": false, \"text\": \"O feed que você adicionou não tem noticias :()\"}";	
		echo $jsonResponse;
		exit;
	}
	

}


//Check if feed have at least one tag
if($data->tag == null || sizeof($data->tag) <= 0){
	$jsonResponse = "{ \"response\": false, \"text\": \"Você deve inserir pelo menos uma tag para adicionar o feed\"}";	
	echo $jsonResponse;
	exit;
}



//Save feed
$feedId = $feedRepository->save($feed);
if(!($feedId > 0))
{
	$jsonResponse = "{ \"response\": false, \"text\": \"Não deu para salvar o feed no banco de dados\"}";	
	echo $jsonResponse;
	exit;
}

//Save tags
for($i = 0; $i < sizeof($data->tag); $i++){
	
	$tagId = $tagRepository->getTagId($data->tag[$i]);
	$feedTagRepository->save($feedId, $tagId);
	
}


$jsonResponse = "{ \"response\": true, \"text\": \"ok\"}";	
echo $jsonResponse;
exit;

//echo $feed->getTitle();










?>