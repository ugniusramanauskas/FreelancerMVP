<?php

namespace TGC\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TGC\AdminBundle\Entity\Proposal;
use TGC\AdminBundle\Form\ProposalType;

use TGC\AdminBundle\Entity\User;
use TGC\AdminBundle\Entity\Project;
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
    public function indexAction($projectid)
    {
        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();
        $qb
            ->select('prop')
            ->from('TGCAdminBundle:Proposal', 'prop')
            ->where($qb->expr()->eq('prop.projectid', ':projectid'))
            ->setParameter('projectid', $projectid)
        ;
        $query = $qb->getQuery();
        $entities = $query->getResult();

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

        $user = new User();
        $entity->setUserid($user);

        $project = new Project();
        $entity->setProjectid($project);

        // Deafault values:
        $entity->setDuration(1);
        $entity->setStatus(1);

        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);


        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            // Navigate back to the previous view (project_search with the search parameters)
            // And pass on a message as a parameter (will appear in the url (not optimal))
            // The message should be passed via the SESSION variables, but not $_GET.

            return $this->redirect($this->generateUrl('project_search', array(
                'notification' => 'Thank you '.$user->getUsername().' for your application!',
            )));
        }

        // Return to the same view with the messages from the validation engine
        return $this->render('TGCAdminBundle:Proposal:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'notification' => '',
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
            'em' => $this->getDoctrine()->getManager()
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Proposal entity.
     *
     */
    public function newAction($projectid)
    {
        if (!$projectid) {
            throw new InvalidArgumentException("No projectId provided. Please contact the website support.");
        }

        $user = $this->container->get('security.context')->getToken()->getUser();
        // $currentUserId = $user->getId();

        $em = $this->getDoctrine()->getManager();


        $project = $em->getRepository('TGCAdminBundle:Project')->findById($projectid);

        $queryBuilder = $em->createQueryBuilder();
        $queryBuilder
            ->select('a.id')
            ->from('TGCAdminBundle:Proposal','a')
            ->where('a.userid = :userId')
            ->andWhere('a.projectid = :projectId')
            ->setParameter('userId',$user)
            ->setParameter('projectId',$project)
        ;

        $hasAppliedForProject = $queryBuilder->getQuery()->getResult();

        if (!empty($hasAppliedForProject)) {
            return $this->redirect($this->generateUrl('project_search', array(
                'notification' => 'You have already applied for this project!',
            )));
        }

        $entity = new Proposal();
        $entity->setUserid($user);

        if (isset($project[0])) {            
            $entity->setProjectid($project[0]);
        }

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
