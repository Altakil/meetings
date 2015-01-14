<?php

namespace Acme\MeetingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\MeetingBundle\Entity\UserMan;
use Acme\MeetingBundle\Entity\UserWomen;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MainController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AcmeMeetingBundle:Main:main.html.twig');
    }

    public function mainAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('email', 'text')
            ->add('password', 'text')
            ->getForm();

        if ($request->getMethod() == 'POST') {

        } else {
            return $this->render('AcmeMeetingBundle:Main:main.html.twig', array(
                'form' => $form->createView(),
            ));
        }
    }

    public function registrationAction(Request $request)
    {

        $userMan = new UserMan();
        $userWomen = new UserWomen();

        $req = $request->request->all();

        $formMan = $this->createFormBuilder($userMan)
            ->add('gender', 'text')
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
            ->add('file', 'file')
            ->getForm();

        $formWomen = $this->createFormBuilder($userWomen)
            ->add('gender', 'text')
            ->add('email', 'text')
            ->add('password', 'text')
            ->add('FirstName', 'text')
            ->add('LastName', 'text')
            ->add('country', 'text')
            ->add('city', 'text')
            ->add('city', 'text')
            ->add('BirthDate', 'date')
            ->add('MaritalStatus', 'text')
            ->add('breast', 'text')
            ->add('waist', 'text')
            ->add('Hips', 'text')
            ->add('file', 'file')
            ->getForm();

        if ($request->getMethod() == 'POST') {
            if ($req['form']['gender'] == "woman") {
                $formWomen->handleRequest($request);
                if ($formWomen->isValid()) {
                    $userWomen->upload();
                    $em = $this->getDoctrine()->getEntityManager();
                    $em->persist($formWomen->getData());
                    $em->flush();

                    return $this->render('AcmeMeetingBundle:Main:userCreated.hml.twig');
                }
            } else if ($req['form']['gender'] == "man") {
                $formMan->handleRequest($request);
                if ($formMan->isValid()) {
                    $userMan->upload();
                    $em = $this->getDoctrine()->getEntityManager();
                    $em->persist($formMan->getData());
                    $em->flush();

                    return $this->render('AcmeMeetingBundle:Main:userCreated.hml.twig');
                }
            }
        } else {
            return $this->render('AcmeMeetingBundle:Main:registration.html.twig', array(
                'formMan' => $formMan->createView(),
                'formWomen' => $formWomen->createView(),
            ));

        }

    }
}

?>