<?php

namespace Project\MyBundle\Controller;

use Project\MyBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
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
         * @Route("/create")
     */

    public function createAction(){
        $task = new Task();
        $task->setTitle('A Foo Bar');
        $task->setDescription('Kayrat');
        $task->setStatus(false);
        $task->setCreatedAt(new \DateTime());
        $task->setFinishAt(null);

        $em = $this->getDoctrine()->getManager();
        $em->persist($task);
        $em->flush();

        return new Response('Created product id ' . $task->getId());
    }


    /**
     * @Route("/show/{id}", name="showTask")
     * @Template()
     */
    public function showAction($id)
    {
        $task = $this->getDoctrine()
            ->getRepository('ProjectMyBundle:Task')
            ->find($id);
        if (!$task) {
            throw $this->createNotFoundException('Страница не найдена!');
        }
        return array('task' => $task);
    }
    /**
     * @Route("/list", name="list")
     * @Template()
     */
    public function listAction(){
        $task = $this->getDoctrine()
            ->getRepository('ProjectMyBundle:Task')
            ->findAll();
        if (!$task) {
            throw $this->createNotFoundException('Страница не найдена!');
        }
        return array('tasks' => $task);
    }
}
