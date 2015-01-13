<?php

namespace Acme\MeetingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\MeetingBundle\Entity\UserMan;

class MainController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AcmeMeetingBundle:Main:main.html.twig');
    }

    public function defaultAction()
    {
        return $this->render('AcmeMeetingBundle:Main:main.html.twig', array('name' => "main"));
    }

    public function registrationAction()
    {
        $userMan = new UserMan();

        $form = $this->createFormBuilder($userMan)->add('gender', 'text')
            ->add('email', 'text')
            ->add('password', 'text')
            ->add('FirstName', 'text')
            ->add('LastName', 'text')
            ->add('country', 'text')
            ->add('city', 'text')
            ->add('city', 'text')
            ->add('BirthDate', 'date')
            ->add('MaritalStatus', 'text')
            ->add('BodyType', 'text')
            ->add('image', 'file')
            ->getForm();

        return $this->render('AcmeMeetingBundle:Main:registration.html.twig', array(
            'form' => $form->createView(),
            'name' => "registration",
        ));

        //return $this->render('AcmeMeetingBundle:Main:registration.html.twig', array('name' => "registration"));
    }
}
