<?php

namespace Acme\MeetingBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\MeetingBundle\Entity\UserMan;
use Acme\MeetingBundle\Entity\country;
use Acme\MeetingBundle\Entity\town;
use Acme\MeetingBundle\Form\UserManType;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * UserMan controller.
 *
 */
class UserManController extends Controller
{

    /**
     * Lists all UserMan entities.
     *
     */
    public function indexAction(Request $request)
    {
        if ($this->get('session')->has('admin')) {
            $EntityCountries = $this->getDoctrine()->getManager()->getRepository('AcmeMeetingBundle:country')->findAll();

            $arrayCountries = array();
            foreach($EntityCountries as $value){
                $arrayCountries[] = $value->getName();
            }

            $formBuilder = $this->createFormBuilder($EntityCountries)->add('Country', 'choice', array(
                'choices' =>  $arrayCountries,
                'required'  => false,
            ));

            $form = $formBuilder->getForm();


            $em = $this->getDoctrine()->getManager();

            $entities = $em->getRepository('AcmeMeetingBundle:UserMan')->findAll();
            $request_value = $request->request->all();

            if($request->getMethod() == 'POST'){
                $index = $request_value['form']['Country'] + 1;
                $countryChoice = $this->getDoctrine()->getManager()->getRepository('AcmeMeetingBundle:country')->find($index);
                $listCities = $countryChoice->getTowns();
                $arrayCities = array();
                foreach($listCities as $value){
                    $arrayCities[] = $value->getName();
                }

                $formBuilder = $this->createFormBuilder($arrayCities)->add('Cities', 'choice', array(
                    'choices' =>  $arrayCities,
                    'required'  => false,
                ));


                $form = $formBuilder->getForm();

                return $this->render('AcmeMeetingBundle:UserMan:index.html.twig', array(
                    'entities' => $entities,
                    'form' => $form->createView(),
                ));
            }
            else{

                return $this->render('AcmeMeetingBundle:UserMan:index.html.twig', array(
                    'entities' => $entities,
                    'form' => $form->createView(),
                ));
            }

        } else {
            return new Response("you haven't rights");
        }
    }

    /**
     * Creates a new UserMan entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new UserMan();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('userman_show', array('id' => $entity->getId())));
        }

        return $this->render('AcmeMeetingBundle:UserMan:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a UserMan entity.
     *
     * @param UserMan $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(UserMan $entity)
    {
        $form = $this->createForm(new UserManType(), $entity, array(
            'action' => $this->generateUrl('userman_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new UserMan entity.
     *
     */
    public function newAction()
    {
        $entity = new UserMan();
        $form = $this->createCreateForm($entity);

        return $this->render('AcmeMeetingBundle:UserMan:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a UserMan entity.
     *
     */
    public function showAction($id)
    {
        if ($this->get('session')->has('admin')) {
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository('AcmeMeetingBundle:UserMan')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find UserMan entity.');
            }

            $deleteForm = $this->createDeleteForm($id);

            return $this->render('AcmeMeetingBundle:UserMan:show.html.twig', array(
                'entity' => $entity,
                'delete_form' => $deleteForm->createView(),
            ));
        } else {
            return new Response("you haven't rights");
        }
    }

    /**
     * Displays a form to edit an existing UserMan entity.
     *
     */
    public function editAction($id)
    {
        if ($this->get('session')->has('admin')) {
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository('AcmeMeetingBundle:UserMan')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find UserMan entity.');
            }

            $editForm = $this->createEditForm($entity);
            $deleteForm = $this->createDeleteForm($id);

            return $this->render('AcmeMeetingBundle:UserMan:edit.html.twig', array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));
        } else {
            return new Response("you haven't rights");
        }
    }

    /**
     * Creates a form to edit a UserMan entity.
     *
     * @param UserMan $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(UserMan $entity)
    {
        $form = $this->createForm(new UserManType(), $entity, array(
            'action' => $this->generateUrl('userman_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing UserMan entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        if ($this->get('session')->has('admin')) {
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository('AcmeMeetingBundle:UserMan')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find UserMan entity.');
            }

            $deleteForm = $this->createDeleteForm($id);
            $editForm = $this->createEditForm($entity);
            $editForm->handleRequest($request);

            if ($editForm->isValid()) {
                $em->flush();

                return $this->redirect($this->generateUrl('userman_edit', array('id' => $id)));
            }

            return $this->render('AcmeMeetingBundle:UserMan:edit.html.twig', array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));
        } else {
            return new Response("you haven't rights");
        }
    }

    /**
     * Deletes a UserMan entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        if ($this->get('session')->has('admin')) {
            $form = $this->createDeleteForm($id);
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $entity = $em->getRepository('AcmeMeetingBundle:UserMan')->find($id);

                if (!$entity) {
                    throw $this->createNotFoundException('Unable to find UserMan entity.');
                }

                $em->remove($entity);
                $em->flush();
            }

            return $this->redirect($this->generateUrl('userman'));
        } else {
            return new Response("you haven't rights");
        }
    }

    /**
     * Creates a form to delete a UserMan entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('userman_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }
}
