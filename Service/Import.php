<?php

include_once "../Bll/feed.php";
include_once "../Repository/feeditem.php";
include_once "../Dao/feed.php";

$feedBll = new \Bll\Feed();
$feedDao = new \Dao\Feed();
$feedList = $feedDao->get();

$feedItemRepository = new \Repository\FeedItem();

for($i = 0; $i < sizeof($feedList); $i++){
	
	try{
		$feed= $feedBll->readFeed2($feedList[$i]->getUrl());
		
		if(sizeof($feed->getFeedItemList()) <= 0){
			//check for rss1
			$feed = $feedBll->readFeed1($data->feed);
		}
		
		$feedItemList = $feed->getFeedItemList();
		
		foreach($feed->getFeedItemList() as $feedItem)
		{
			$feedItem->setFeedId($feedList[$i]->getId());
			$feedItemRepository->saveFeedItem($feedItem);
		}
	}catch(Exception $e){
		
	}

}

?>