<?php

namespace TGC\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TGC\AdminBundle\Entity\Contract;
use TGC\AdminBundle\Form\ContractType;

use TGC\AdminBundle\Entity\User;
use TGC\AdminBundle\Entity\Project;

/**
 * Contract controller.
 *
 */
class ContractController extends Controller
{

    /**
     * Lists all Contract entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TGCAdminBundle:Contract')->findAll();

        return $this->render('TGCAdminBundle:Contract:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
    /**
     * Creates a new Contract entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Contract();

        $user = new User();
        $entity->setUserid($user);

        $attributes = $request->request->all();

        $project = $this->getDoctrine()->getRepository('TGCAdminBundle:Project')->find($attributes['tgc_adminbundle_contract']['projectid']);
        $entity->setProjectid($project);

        $project->setStatus(2);

        // Deafault values:
        $entity->setStatus(1);

        $entity->setStartdate(new \DateTime());

        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->persist($project);
            $em->flush();

            $message = \Swift_Message::newInstance()
                ->setSubject('Hello Email')
                ->setFrom('lisettluik@gmail.com')
                ->setTo('lisettluik@gmail.com')
                ->setBody('A bussiness has selected a consultant')
            ;
            $this->get('mailer')->send($message);

            return $this->redirect($this->generateUrl('project', array('id' => $entity->getId())));
        }

        return $this->render('TGCAdminBundle:Contract:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Contract entity.
    *
    * @param Contract $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Contract $entity)
    {
        $form = $this->createForm(new ContractType(), $entity, array(
            'action' => $this->generateUrl('contract_create'),
            'method' => 'POST',
            'em' => $this->getDoctrine()->getManager()
        ));

        $form->add('submit', 'submit', array('label' => 'Choose this consultant'));

        return $form;
    }

    /**
     * Displays a form to create a new Contract entity.
     *
     */
    public function newAction($projectid, $consultant_userid)
    {
        if (!$projectid) {
            throw new InvalidArgumentException("No projectId provided. Please contact the website support.");
        }
        if (!$consultant_userid) {
            throw new InvalidArgumentException("No consultantId provided. Please contact the website support.");
        }

        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository('TGCAdminBundle:Project')->findById($projectid);
        $user = $em->getRepository('TGCAdminBundle:User')->findById($consultant_userid);

        $entity = new Contract();

        if (isset($user[0])) {            
            $entity->setUserid($user[0]);
        }

        if (isset($project[0])) {            
            $entity->setProjectid($project[0]);
        }

        $entity->setContracttext("This a default contract text. \n" . 
            "If you disagree with the terms, you can write your frustrations" .
            "on a piece of paper, go home, and kill yourself.");


        $form   = $this->createCreateForm($entity);
        return $this->render('TGCAdminBundle:Contract:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Contract entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TGCAdminBundle:Contract')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contract entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TGCAdminBundle:Contract:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Contract entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TGCAdminBundle:Contract')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contract entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TGCAdminBundle:Contract:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Contract entity.
    *
    * @param Contract $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Contract $entity)
    {
        $form = $this->createForm(new ContractType(), $entity, array(
            'action' => $this->generateUrl('contract_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Contract entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TGCAdminBundle:Contract')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contract entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('contract_edit', array('id' => $id)));
        }

        return $this->render('TGCAdminBundle:Contract:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Contract entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TGCAdminBundle:Contract')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Contract entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('contract'));
    }

    /**
     * Creates a form to delete a Contract entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('contract_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
