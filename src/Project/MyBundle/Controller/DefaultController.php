<?php

namespace Project\MyBundle\Controller;

use Project\MyBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/add", name="add")
     * @Template()
     */

    public function addAction(Request $request){
        $task = new Task();
        $form = $this->createFormBuilder($task)
            ->add('title', 'text')
            ->add('description', 'text')
            ->add('createdAt', 'date')
            ->getForm();

        if ($request->getMethod() == 'POST'){
            $form->handleRequest($request);
            if ($form->isValid()){
                return $this->redirect($this->generateUrl('add'));
            }
        }
         return $this->render('ProjectMyBundle:Default:form.html.twig', array(
            'form' => $form->createView(),
        ));
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