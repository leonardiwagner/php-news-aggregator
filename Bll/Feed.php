<?php

namespace Bll;

include_once "../model/Feed.php";
include_once "../model/FeedItem.php";

class Feed{
	
	public function readFeed2($url){
		$feed = file_get_contents($url);
		$rss = new \SimpleXMLElement($feed);
		
		$rssFeed = new \Model\Feed();
		$rssFeed->setTitle($rss->channel->title);
		//$rssFeed->setDescription($rss->channel->description);
		for($i=0; $i < sizeof($rss->channel->item); $i++)
		{
			$feedItem = new \Model\FeedItem();
			$feedItem->setTitle((string)$rss->channel->item[$i]->title);
			$feedItem->setLink((string)$rss->channel->item[$i]->link);
			
			$description = strip_tags((string)$rss->channel->item[$i]->description);
			if(strlen($description) > 250)
			{
				$description = substr($description, 0, 250) . "...";
			}
			$feedItem->setDescription($description);
			
			$date = strtotime((string)$rss->channel->item[$i]->pubDate);
			$feedItem->setPublicationDate(date('Y-m-d H:i:s', $date));
			
			$rssFeed->addFeedItem($feedItem);
		}
		
		$rssFeed->setUrl($url);
		
		return $rssFeed;
	}
	
	public function readFeed1($url){
		$feed = file_get_contents($url);
		$rss = new \SimpleXMLElement($feed);
		
	
		$rssFeed = new \Model\Feed();
		$rssFeed->setTitle($rss->title);
		
				

		for($i=0; $i < sizeof($rss->entry); $i++)
		{
			$feedItem = new \Model\FeedItem();
			$feedItem->setTitle((string)$rss->entry[$i]->title);
			$feedItem->setLink((string)$rss->entry[$i]->link["href"]);
			
			$description = strip_tags((string)$rss->entry[$i]->content);
			if(strlen($description) > 250)
			{
				$description = substr($description, 0, 250) . "...";
			}
			$feedItem->setDescription($description);
			
			$date = strtotime((string)$rss->entry[$i]->published);
			$feedItem->setPublicationDate(date('Y-m-d H:i:s', $date));
			
			$rssFeed->addFeedItem($feedItem);
		}
		
		$rssFeed->setUrl($url);
		
		return $rssFeed;
	}
}
?>