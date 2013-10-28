<?php

namespace Bll;

include_once "../Model/Tag.php";
include_once "../Repository/Tag.php";

class Tag{
	
	public function TagCloud(){
		
		$tagRepository = new \Repository\Tag();
		$tagList = $tagRepository->getTop(0,20);
		
		$maxValue = 0;
		$minValue = 0;
		
		$jsonReturn = "[";
		
		for($i = 0; $i < sizeof($tagList); $i++){
			$jsonReturn .= "\"". $tagList[$i]->getName() ."\"";
			
			if($i < (sizeof($tagList) - 1))
			{
				$jsonReturn .= ",";
			}
		}
		
		$rssFeed->setUrl($url);
		
		return $rssFeed;
	}
	
	
}

/*
 * 
 *  public static string ShowPreviewContent(string pContent, int pPreviewChar)
        {
            pContent = Regex.Replace(pContent, "<.*?>", string.Empty);
            if (pContent.Length > pPreviewChar)
            {
                int endPosition = pContent.IndexOf(' ', pPreviewChar);
                if (endPosition > 2)
                    pContent = pContent.Substring(0, endPosition) + "...";
                else
                {
                    pContent = pContent.Substring(0, pPreviewChar) + "...";
                }
            }

            return pContent;
        }
 */
?>