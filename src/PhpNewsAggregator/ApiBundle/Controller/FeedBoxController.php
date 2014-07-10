<?php


include_once "..\Domain\Feed.php";
include_once "..\Domain\FeedTag.php";
include_once "..\Domain\Tag.php";

namespace PhpNewsAggregator\ApiBundle\Controller;

class FeedBoxController extends Controller
{
    public function GetFeedBox(){

      $feedBoxes = new FeedBox();
      
    }

}
