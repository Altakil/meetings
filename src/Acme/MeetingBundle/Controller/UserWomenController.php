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
    public function indexAction(Request $request)
    {
        $array_page = array();
        if ($this->get('session')->has('admin')) {
            $EntityCountries = $this->getDoctrine()->getManager()->getRepository('AcmeMeetingBundle:country')->findAll();

            $arrayCountries = array();
            foreach ($EntityCountries as $value) {
                $arrayCountries[] = $value->getName();
            }

            $formBuilder = $this->createFormBuilder($EntityCountries)->add('Country', 'choice', array(
                'choices' => $arrayCountries,
                'required' => false,
            ));

            $form = $formBuilder->getForm();


            $em = $this->getDoctrine()->getManager();

            $count = count($em->getRepository('AcmeMeetingBundle:UserWomen')->findAll());
            $max = 5;
            $page = ceil($count / $max);
            $current = $request->query->get('id');
            for ($i = 0; $i < $page; $i++) {
                $array_page[] = $i;
            }
            $repository = $em->getRepository('AcmeMeetingBundle:UserWomen');
            $query = $repository->createQueryBuilder('p')
                ->setMaxResults($max)
                ->setFirstResult($current * $max)
                ->getQuery();

            $entities = $query->getResult();

            $request_value = $request->request->all();

            if ($request->getMethod() == 'POST') {
                if (isset($request_value['form']['Country']) && $request_value['form']['Country'] != "") {

                    $index = $request_value['form']['Country'] + 1;
                    $countryChoice = $this->getDoctrine()->getManager()->getRepository('AcmeMeetingBundle:country')->find($index);
                    $listCities = $countryChoice->getTowns();

                    $arrayCities = array();
                    foreach ($listCities as $value) {
                        $arrayCities[$value->getName()] = $value->getName();
                    }

                    $parameter = $countryChoice->getName();
                    $em = $this->getDoctrine()->getManager();
                    $query = $query = $em->createQuery('SELECT p FROM AcmeMeetingBundle:UserWomen p WHERE p.country = :country ORDER BY p.country'
                    )->setParameter('country', $parameter);

                    $entities = $query->getResult();

                    $formBuilder = $this->createFormBuilder($arrayCities)->add('Cities', 'choice', array(
                        'choices' => $arrayCities,
                        'required' => false,
                    ));

                    $form = $formBuilder->getForm();

                    return $this->render('AcmeMeetingBundle:UserWomen:index.html.twig', array(
                        'entities' => $entities,
                        'form' => $form->createView(),
                        'array' => $array_page,
                    ));

                } else if (isset($request_value['form']['Cities']) && $request_value['form']['Cities'] != "") {

                    $parameter = substr($request_value['form']['Cities'], 0);
                    $em = $this->getDoctrine()->getManager();
                    $query = $query = $em->createQuery('SELECT p FROM AcmeMeetingBundle:UserWomen p WHERE p.city = :city ORDER BY p.city'
                    )->setParameter('city', $parameter);

                    $entities = $query->getResult();
                    return $this->render('AcmeMeetingBundle:UserWomen:index.html.twig', array(
                        'entities' => $entities,
                        'form' => $form->createView(),
                        'array' => $array_page,
                    ));
                } else {
                    return $this->render('AcmeMeetingBundle:UserWomen:index.html.twig', array(
                        'entities' => $entities,
                        'form' => $form->createView(),
                        'array' => $array_page,
                    ));
                }
            } else {

                return $this->render('AcmeMeetingBundle:UserWomen:index.html.twig', array(
                    'entities' => $entities,
                    'form' => $form->createView(),
                    'array' => $array_page,
                ));
            }

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