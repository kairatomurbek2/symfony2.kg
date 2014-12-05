<?php

namespace Project\MyBundle\Controller;

use Project\MyBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;

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

    /**
     * @Route("/create", name="create")
     * @Template()
     */

    public function createAction(){
        $task = new Task();
        $task->setTitle('A Foo Bar');
        $task->setDescription('kdfjjksdhfjksdjfhjkdsfjdsh');
        $task->setStatus(false);
        $task->setCreatedAt(new \DateTime());
        $task->setFinishAt(null);

        $em = $this->getDoctrine()->getManager();
        $em->persist($task);
        $em->flush();

        return new JsonResponse(array('state'=>'success'));
    }
}
