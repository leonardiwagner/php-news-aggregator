<?php


include_once "..\Domain\Feed.php";
include_once "..\Domain\FeedTag.php";
include_once "..\Domain\Tag.php";

namespace PhpNewsAggregator\ApiBundle\Controller;

class TagController extends Controller
{

    public function ReadAllTags(){
      $tag = new \Domain\Tag();
    }

    public function SearchTags(){
      $word = "";
      $tag = new \Domain\Tag();
      $tag.search($word);
    }


}
