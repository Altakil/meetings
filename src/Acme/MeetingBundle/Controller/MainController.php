<?php

namespace Acme\MeetingBundle\Controller;

use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\MeetingBundle\Entity\UserMan;
use Acme\MeetingBundle\Entity\UserWomen;
use Acme\MeetingBundle\Entity\adminProfile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Acme\MeetingBundle\Form\manRegFormType;
use Acme\MeetingBundle\Form\womenRegFormType;
use Acme\MeetingBundle\Form\UserManType;
use Acme\MeetingBundle\Form\UserWomenType;

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

    public function ajaxAction(Request $request)
    {
        $query = $this->getRequest()->get('request');

        $countryChoice = $this->getDoctrine()->getManager()->getRepository('AcmeMeetingBundle:country')->findOneByName($query);
        $listCities = $countryChoice->getTowns();

        $arrayCities = array();
        foreach ($listCities as $value) {
            $arrayCities[$value->getName()] = $value->getName();
        }

        return new Response(json_encode($arrayCities));
    }

    public function registrationAction(Request $request)
    {
        $EntityCountries = $this->getDoctrine()->getManager()->getRepository('AcmeMeetingBundle:country')->findAll();

        $arrayCountries = array();
        foreach ($EntityCountries as $value) {
            $arrayCountries[$value->getName()] = $value->getName();
        }

        $userMan = new UserMan();
        $userWomen = new UserWomen();

        $req = $request->request->all();
        $formMan = $this->createFormBuilder($userMan)
            ->add('gender', 'hidden')
            ->add('email', 'text')
            ->add('password', 'text')
            ->add('FirstName', 'text')
            ->add('LastName', 'text')
            ->add('Country', 'choice', array(
                'choices' => $arrayCountries,
                'required' => true,
            ))
            ->add('city', 'hidden')
            ->add('BirthDate', 'date')
            ->add('MaritalStatus', 'choice', array(
                'choices' => array('married' => 'married', 'not married' => 'not married'),
                'required' => true,
            ))
            ->add('BodyType', 'text')
            ->add('file', 'file')
            ->getForm();

        $formWomen = $this->createFormBuilder($userWomen)
            ->add('gender', 'hidden')
            ->add('email', 'text')
            ->add('password', 'text')
            ->add('FirstName', 'text')
            ->add('LastName', 'text')
            ->add('Country', 'choice', array(
                'choices' => $arrayCountries,
                'required' => true,
            ))
            ->add('city', 'hidden')
            ->add('BirthDate', 'date')
            ->add('MaritalStatus', 'choice', array(
                'choices' => array('married' => 'married', 'not married' => 'not married'),
                'required' => true,
            ))
            ->add('breast', 'text')
            ->add('waist', 'text')
            ->add('Hips', 'text')
            ->add('file', 'file')
            ->getForm();

        $repositoryMan = $this->getDoctrine()
            ->getRepository('AcmeMeetingBundle:UserMan');
        $repositoryWomen = $this->getDoctrine()
            ->getRepository('AcmeMeetingBundle:UserWomen');

        if ($request->getMethod() == 'POST') {
            $Man = $repositoryMan->findOneBy(array('email' => $req['form']['email']));
            $Women = $repositoryWomen->findOneBy(array('email' => $req['form']['email']));

            if (!$Man && !$Women) {
                if ($req['form']['gender'] == "woman") {
                    $formWomen->handleRequest($request);
                    $userWomen->upload();
                    $em = $this->getDoctrine()->getEntityManager();
                    $em->persist($formWomen->getData());
                    $em->flush();

                    return $this->render('AcmeMeetingBundle:Main:userSuccessCRUD.html.twig', array('action' => "registered",));
                } else if ($req['form']['gender'] == "man") {
                    $formMan->handleRequest($request);
                    $userMan->upload();
                    $em = $this->getDoctrine()->getEntityManager();
                    $em->persist($formMan->getData());
                    $em->flush();

                    return $this->render('AcmeMeetingBundle:Main:userSuccessCRUD.html.twig', array('action' => "registered",));
                }
            } else {
                return new Response("Sorry User on that email exist");
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

            $formMan = $this->createFormBuilder($UserMan)
                ->add('file', 'file')
                ->getForm();

            return $this->render('AcmeMeetingBundle:Main:profileLoggedUserMan.html.twig', array(
                'gender' => $UserMan->getGender(),
                'email' => $UserMan->getEmail(),
                'password' => $UserMan->getPassword(),
                'FirstName' => $UserMan->getFirstName(),
                'LastName' => $UserMan->getLastName(),
                'country' => $UserMan->getCountry(),
                'city' => $UserMan->getCity(),
                'BirthDate' => $UserMan->getBirthDate(),
                'MaritalStatus' => $UserMan->getMaritalStatus(),
                'image' => $UserMan->getImage(),
                'form' => $formMan->createView(),
            ));
        } else if ($UserWomen) {

            $formWomen = $this->createFormBuilder($UserWomen)
                ->add('file', 'file')
                ->getForm();

            return $this->render('AcmeMeetingBundle:Main:profileLoggedUserWomen.html.twig', array(
                'gender' => $UserWomen->getGender(),
                'email' => $UserWomen->getEmail(),
                'password' => $UserWomen->getPassword(),
                'FirstName' => $UserWomen->getFirstName(),
                'LastName' => $UserWomen->getLastName(),
                'country' => $UserWomen->getCountry(),
                'city' => $UserWomen->getCity(),
                'BirthDate' => $UserWomen->getBirthDate(),
                'MaritalStatus' => $UserWomen->getMaritalStatus(),
                'hips' => $UserWomen->getHips(),
                'waist' => $UserWomen->getWaist(),
                'breast' => $UserWomen->getBreast(),
                'image' => $UserWomen->getImage(),
                'form' => $formWomen->createView(),
            ));
        }

        return $this->render('AcmeMeetingBundle:Main:profileLoggedUser.html.twig', array(
            'name' => $this->get('session')->get('name'),
        ));
    }

    public function editProfileAction(Request $request)
    {
        $repositoryMan = $this->getDoctrine()
            ->getRepository('AcmeMeetingBundle:UserMan');
        $repositoryWomen = $this->getDoctrine()
            ->getRepository('AcmeMeetingBundle:UserWomen');

        $UserMan = $repositoryMan->findOneBy(array('email' => $this->get('session')->get('email')));
        $UserWomen = $repositoryWomen->findOneBy(array('email' => $this->get('session')->get('email')));

        $formMan = $this->createForm(new UserManType(), $UserMan);
        $formWomen = $this->createForm(new UserWomenType(), $UserWomen);

        $request_value = $request->request->all();

        if ($request->getMethod() == 'POST') {
            if ($UserMan) {
                $formMan->handleRequest($request);
                if ($formMan->isValid()) {
                    $em = $this->getDoctrine()->getEntityManager();
                    $em->persist($formMan->getData());
                    $em->flush();

                    $this->get('session')->set('name', $request_value['form']['FirstName']);
                    $this->get('session')->set('email', $request_value['form']['email']);
                    $this->get('session')->set('password', $request_value['form']['password']);

                    return $this->render('AcmeMeetingBundle:Main:userSuccessCRUD.html.twig', array('action' => "updated",));
                }
            } else if ($UserWomen) {
                $formWomen->handleRequest($request);
                if ($formWomen->isValid()) {
                    $em = $this->getDoctrine()->getEntityManager();
                    $em->persist($formWomen->getData());
                    $em->flush();

                    $this->get('session')->set('name', $request_value['form']['FirstName']);
                    $this->get('session')->set('email', $request_value['form']['email']);
                    $this->get('session')->set('password', $request_value['form']['password']);

                    return $this->render('AcmeMeetingBundle:Main:userSuccessCRUD.html.twig', array('action' => "updated",));
                }
            }
        } else {
            if ($UserMan) {
                return $this->render('AcmeMeetingBundle:Main:editProfileMan.html.twig', array(
                    'form' => $formMan->createView(),
                ));
            } else if ($UserWomen) {
                return $this->render('AcmeMeetingBundle:Main:editProfileMan.html.twig', array(
                    'form' => $formWomen->createView(),
                ));
            }
        }
    }

    public function loadImageAction(Request $request)
    {
        $repositoryMan = $this->getDoctrine()
            ->getRepository('AcmeMeetingBundle:UserMan');
        $repositoryWomen = $this->getDoctrine()
            ->getRepository('AcmeMeetingBundle:UserWomen');

        $UserMan = $repositoryMan->findOneBy(array('email' => $this->get('session')->get('email')));
        $UserWomen = $repositoryWomen->findOneBy(array('email' => $this->get('session')->get('email')));

        $formWomen = $this->createFormBuilder($UserWomen)
            ->add('file', 'file')
            ->getForm();
        $formMan = $this->createFormBuilder($UserMan)
            ->add('file', 'file')
            ->getForm();

        if ($UserMan) {
            $formMan->handleRequest($request);
            if ($formMan->isValid()) {

                $UserMan->upload();
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($formMan->getData());
                $em->flush();

                return $this->redirect($this->generateUrl('showProfile'));
            }

        } else if ($UserWomen) {
            $formWomen->handleRequest($request);
            if ($formWomen->isValid()) {

                $UserWomen->upload();
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($formWomen->getData());
                $em->flush();

                return $this->redirect($this->generateUrl('showProfile'));

            }
        }
    }

    public function loginAdminAction(Request $request)
    {

        if (!$this->get('session')->has('admin')) {
            $request_value = $request->request->all();

            $repository = $this->getDoctrine()
                ->getRepository('AcmeMeetingBundle:adminProfile');

            $admin = new adminProfile();

            $form = $this->createFormBuilder($admin)
                ->add('admin', 'text')
                ->add('password', 'text')
                ->getForm();

            if ($request->getMethod() == 'POST') {
                $admin = $repository->findOneBy(array('admin' => $request_value['form']['admin']));
                if (!$admin) {
                    return new Response("Sorry invalid login/password");
                } else if ($request_value['form']['admin'] == $admin->getAdmin() && $request_value['form']['password'] == $admin->getPassword()) {
                    $this->get('session')->set('admin', $request_value['form']['admin']);
                    return $this->redirect($this->generateUrl('userman'));
                } else {
                    return new Response("Sorry invalid login/password");
                }
            } else {
                return $this->render('AcmeMeetingBundle:Admin:adminPanelEnter.html.twig', array(
                    'form' => $form->createView(),
                ));
            }
        } else {
            return $this->redirect($this->generateUrl('userman'));
        }
    }

    public function adminOutAction()
    {
        $this->get('session')->remove('admin');
        return $this->redirect($this->generateUrl('main'));
    }
}

?>