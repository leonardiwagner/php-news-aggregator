<?php

namespace PhpNewsAggregator\ApiBundle\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/", name="_demo")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

}
