<?php

namespace Project\MyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/privet/{lola}/{nuh}")
     * @Template()
     */
    public function indexAction($lola, $nuh)
    {
    	$val = $lola ." ". $nuh;
        return  array('name' => $val);
    }
}
