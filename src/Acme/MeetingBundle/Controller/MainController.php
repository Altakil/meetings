<?php

namespace Acme\MeetingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
        return $this->render('AcmeMeetingBundle:Main:registration.html.twig', array('name' => "registration"));
    }
}
