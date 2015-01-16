<?php

namespace Acme\MeetingBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\MeetingBundle\Entity\UserWomen;
use Acme\MeetingBundle\Form\UserWomenType;
use Symfony\Component\HttpFoundation\Response;

/**
 * UserWomen controller.
 *
 */
class UserWomenController extends Controller
{

    /**
     * Lists all UserWomen entities.
     *
     */
    public function indexAction()
    {
        if ($this->get('session')->has('admin')) {
            $em = $this->getDoctrine()->getManager();

            $entities = $em->getRepository('AcmeMeetingBundle:UserWomen')->findAll();

            return $this->render('AcmeMeetingBundle:UserWomen:index.html.twig', array(
                'entities' => $entities,
            ));
        } else {
            return new Response("you haven't rights");
        }
    }

    /**
     * Creates a new UserWomen entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new UserWomen();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('userwomen_show', array('id' => $entity->getId())));
        }

        return $this->render('AcmeMeetingBundle:UserWomen:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a UserWomen entity.
     *
     * @param UserWomen $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(UserWomen $entity)
    {
        $form = $this->createForm(new UserWomenType(), $entity, array(
            'action' => $this->generateUrl('userwomen_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new UserWomen entity.
     *
     */
    public function newAction()
    {
        $entity = new UserWomen();
        $form = $this->createCreateForm($entity);

        return $this->render('AcmeMeetingBundle:UserWomen:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a UserWomen entity.
     *
     */
    public function showAction($id)
    {
        if ($this->get('session')->has('admin')) {
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository('AcmeMeetingBundle:UserWomen')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find UserWomen entity.');
            }

            $deleteForm = $this->createDeleteForm($id);

            return $this->render('AcmeMeetingBundle:UserWomen:show.html.twig', array(
                'entity' => $entity,
                'delete_form' => $deleteForm->createView(),
            ));
        } else {
            return new Response("you haven't rights");
        }
    }

    /**
     * Displays a form to edit an existing UserWomen entity.
     *
     */
    public function editAction($id)
    {
        if ($this->get('session')->has('admin')) {
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository('AcmeMeetingBundle:UserWomen')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find UserWomen entity.');
            }

            $editForm = $this->createEditForm($entity);
            $deleteForm = $this->createDeleteForm($id);

            return $this->render('AcmeMeetingBundle:UserWomen:edit.html.twig', array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));
        } else {
            return new Response("you haven't rights");
        }
    }

    /**
     * Creates a form to edit a UserWomen entity.
     *
     * @param UserWomen $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(UserWomen $entity)
    {
        $form = $this->createForm(new UserWomenType(), $entity, array(
            'action' => $this->generateUrl('userwomen_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing UserWomen entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        if ($this->get('session')->has('admin')) {
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository('AcmeMeetingBundle:UserWomen')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find UserWomen entity.');
            }

            $deleteForm = $this->createDeleteForm($id);
            $editForm = $this->createEditForm($entity);
            $editForm->handleRequest($request);

            if ($editForm->isValid()) {
                $em->flush();

                return $this->redirect($this->generateUrl('userwomen_edit', array('id' => $id)));
            }

            return $this->render('AcmeMeetingBundle:UserWomen:edit.html.twig', array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));
        } else {
            return new Response("you haven't rights");
        }
    }

    /**
     * Deletes a UserWomen entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        if ($this->get('session')->has('admin')) {
            $form = $this->createDeleteForm($id);
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $entity = $em->getRepository('AcmeMeetingBundle:UserWomen')->find($id);

                if (!$entity) {
                    throw $this->createNotFoundException('Unable to find UserWomen entity.');
                }

                $em->remove($entity);
                $em->flush();
            }

            return $this->redirect($this->generateUrl('userwomen'));
        } else {
            return new Response("you haven't rights");
        }
    }

    /**
     * Creates a form to delete a UserWomen entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('userwomen_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }
}
