<?php

namespace TGC\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TGC\AdminBundle\Entity\Proposal;
use TGC\AdminBundle\Form\ProposalType;

/**
 * Proposal controller.
 *
 */
class ProposalController extends Controller
{

    /**
     * Lists all Proposal entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TGCAdminBundle:Proposal')->findAll();

        return $this->render('TGCAdminBundle:Proposal:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Proposal entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Proposal();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('proposal_show', array('id' => $entity->getId())));
        }

        return $this->render('TGCAdminBundle:Proposal:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Proposal entity.
    *
    * @param Proposal $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Proposal $entity)
    {
        $form = $this->createForm(new ProposalType(), $entity, array(
            'action' => $this->generateUrl('proposal_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Proposal entity.
     *
     */
    public function newAction()
    {
        $entity = new Proposal();
        $form   = $this->createCreateForm($entity);

        return $this->render('TGCAdminBundle:Proposal:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Proposal entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TGCAdminBundle:Proposal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Proposal entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TGCAdminBundle:Proposal:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Proposal entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TGCAdminBundle:Proposal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Proposal entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TGCAdminBundle:Proposal:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Proposal entity.
    *
    * @param Proposal $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Proposal $entity)
    {
        $form = $this->createForm(new ProposalType(), $entity, array(
            'action' => $this->generateUrl('proposal_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Proposal entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TGCAdminBundle:Proposal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Proposal entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('proposal_edit', array('id' => $id)));
        }

        return $this->render('TGCAdminBundle:Proposal:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Proposal entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TGCAdminBundle:Proposal')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Proposal entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('proposal'));
    }

    /**
     * Creates a form to delete a Proposal entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('proposal_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
