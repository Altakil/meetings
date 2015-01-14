<?php

namespace Acme\MeetingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\MeetingBundle\Entity\UserMan;
use Acme\MeetingBundle\Entity\UserWomen;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;


class MainController extends Controller
{

    public function indexAction($name)
    {
        return $this->render('AcmeMeetingBundle:Main:main.html.twig');
    }

    public function mainAction(Request $request)
    {

        $request_value = $request->request->all();

        $form = $this->createFormBuilder()
            ->add('email', 'text')
            ->add('password', 'text')
            ->getForm();

        if ($this->get('session')->get('name')) {
            return $this->redirect($this->generateUrl('showUsers'));
        }

        if ($request->getMethod() == 'POST') {

            $repositoryMan = $this->getDoctrine()
                ->getRepository('AcmeMeetingBundle:UserMan');
            $repositoryWomen = $this->getDoctrine()
                ->getRepository('AcmeMeetingBundle:UserWomen');

            $UserMan = $repositoryMan->findOneBy(array('email' => $request_value['form']['email'], 'password' => $request_value['form']['password']));
            $UserWomen = $repositoryWomen->findOneBy(array('email' => $request_value['form']['email'], 'password' => $request_value['form']['password']));

            if (!$UserMan && !$UserWomen) {
                return new Response("Sorry User on that email/password not exist");
            } else {

                if ($UserMan) {

                    $this->get('session')->set('name', $UserMan->getFirstName());
                    $this->get('session')->set('email', $UserMan->getEmail());
                    $this->get('session')->set('password', $UserMan->getPassword());

                    return $this->redirect($this->generateUrl('main'));
                } else if ($UserWomen) {

                    $this->get('session')->set('name', $UserWomen->getFirstName());
                    $this->get('session')->set('email', $UserWomen->getEmail());
                    $this->get('session')->set('password', $UserWomen->getPassword());

                    return $this->redirect($this->generateUrl('main'));
                }
            }
        } else {
            return $this->render('AcmeMeetingBundle:Main:main.html.twig', array(
                'form' => $form->createView(),
            ));
        }
    }

    public function exitUserAction()
    {
        $this->get('session')->remove('name');
        $this->get('session')->remove('email');
        $this->get('session')->remove('password');
        return $this->redirect($this->generateUrl('main'));
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

    public function showAllUsersAction()
    {
        return $this->render('AcmeMeetingBundle:Main:userLogged.hml.twig', array(
            'name' => $this->get('session')->get('name'),
        ));
    }

    public function showProfileAction()
    {
        $repositoryMan = $this->getDoctrine()
            ->getRepository('AcmeMeetingBundle:UserMan');
        $repositoryWomen = $this->getDoctrine()
            ->getRepository('AcmeMeetingBundle:UserWomen');

        $UserMan = $repositoryMan->findOneBy(array('email' => $this->get('session')->get('email')));
        $UserWomen = $repositoryWomen->findOneBy(array('email' => $this->get('session')->get('email')));

        if ($UserMan) {
            return $this->render('AcmeMeetingBundle:Main:profileLoggedUser.html.twig', array(
                'gender' => $UserMan->getGender(),
                'email' => $UserMan->getEmail(),
                'password' => $UserMan->getPassword(),
                'FirstName' => $UserMan->getFirstName(),
                'LastName' => $UserMan->getLastName(),
                'country' => $UserMan->getCountry(),
                'city' => $UserMan->getCity(),
                'BirthDate' => $UserMan->getBirthDate(),
                'MaritalStatus' => $UserMan->getMaritalStatus(),
            ));
        } else if ($UserWomen) {

        }

        return $this->render('AcmeMeetingBundle:Main:profileLoggedUser.html.twig', array(
            'name' => $this->get('session')->get('name'),
        ));
    }

}

?>