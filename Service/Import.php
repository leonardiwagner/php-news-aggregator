<?php

include_once "../Bll/feed.php";
include_once "../Repository/feeditem.php";
include_once "../Dao/feed.php";

$feedBll = new \Bll\Feed();
$feedDao = new \Dao\Feed();
$feedList = $feedDao->get();

$feedItemRepository = new \Repository\FeedItem();

for($i = 0; $i < sizeof($feedList); $i++){
	
	$feedList = $feedBll->readFeed($feedList[$i]->getUrl());
	
	$feedItemList = $feedList->getFeedItemList();
	
	foreach($feedList->getFeedItemList() as $feedItem)
	{
		$feedItemRepository->saveFeedItem($feedItem);
	}

}



?>