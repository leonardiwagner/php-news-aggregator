<?php


include_once "..\Domain\Feed.php";
include_once "..\Domain\FeedTag.php";
include_once "..\Domain\Tag.php";

namespace PhpNewsAggregator\ApiBundle\Controller;

class FeedController extends Controller
{
    /**
     * @Route("/", name="_demo")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    public function AddFeed(){
      $feedName = "";
      $feedUrl = "";

      $feed = new Feed($feedName, $feedUrl);
      $feedObject = $feed.save();
    }

}
