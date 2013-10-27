<?php

error_reporting(E_ERROR | E_PARSE);

include "..\Bll\Feed.php";
include "..\Repository\Tag.php";

$feed = null;
$feedBll = new \Bll\Feed();

$tagRepository = new \Repository\Tag();

$data = null;




//Check if rss have valid content
try{
	$data = file_get_contents("php://input");
	$data = json_decode($data);	
	
	$feed = $feedBll->readFeed($data->feed);
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

if(sizeof($feed->getFeedItemList()) <= 0){
	$jsonResponse = "{ \"response\": false, \"text\": \"O feed que você adicionou não tem noticias :()\"}";	
	echo $jsonResponse;
	exit;
	
}

//Check if feed have at least one tag
if($data->tag == null || sizeof($data->tag) <= 0){
	$jsonResponse = "{ \"response\": false, \"text\": \"Você deve inserir pelo menos uma tag para adicionar o feed\"}";	
	echo $jsonResponse;
	exit;
}

//Check if feed have content
if(sizeof($feed->getFeedItemList()) <= 0){
	$jsonResponse = "{ \"response\": false, \"text\": \"O feed que você adicionou não tem noticias :()\"}";	
	echo $jsonResponse;
	exit;
}

//Save feed

//Save tags



$jsonResponse = "{ \"response\": true, \"text\": \"ok\"}";	
echo $jsonResponse;
exit;

//echo $feed->getTitle();










?>