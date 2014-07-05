<?php

namespace TGC\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TGC\AdminBundle\Entity\User;

use TGC\AdminBundle\Entity\Project;
use TGC\AdminBundle\Form\ProjectType;
use TGC\AdminBundle\Form\ProjectsearchType;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Project controller.
 *
 */
class ProjectController extends Controller
{

    /**
     * Lists all Project entities.
     *
     */
    public function indexAction()
    {
        if (false === $this->get('security.context')->isGranted('ROLE_BUSINESS')) {
            throw new AccessDeniedException("You must be registered on TGC system as a Business to access this functionality.");
        }
        // $user = $this->container->get('fos_user.user_manager')->findUserByUsername('ugnius');
        $user = $this->container->get('security.context')->getToken()->getUser();
        $currentUserId = $user->getId();

        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();
        $qb
            ->select('prj')
            ->from('TGCAdminBundle:Project', 'prj')
            ->where($qb->expr()->eq('prj.userid', ':userid'))
            ->setParameter('userid', $currentUserId);
        $query = $qb->getQuery();
        $entities = $query->getResult();
        // $entities = $em->getRepository('TGCAdminBundle:Project')->findAll();

        return $this->render('TGCAdminBundle:Project:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Shows search form
     */
    public function searchProjectsAction()
    {
        $entity = new Project();
        $form = $this->createSearchForm($entity);

        return $this->render('TGCAdminBundle:Project:search.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
            'entities' => null,
        ));
    }

    private function createSearchForm(Project $entity)
    {
        $form = $this->createForm(new ProjectsearchType(), $entity, array(
            'action' => $this->generateUrl('project_searchresults'),
            'method' => 'POST',
            'em' => $this->getDoctrine()->getManager()
        ));

        $form->add('submit', 'submit', array('label' => 'Search'));

        return $form;
    }


    /**
     * Shows search results
     */
    public function showSearchResultsAction(Request $request)
    {

        $user = $this->container->get('security.context')->getToken()->getUser();
        $currentUserId = $user->getId();

        $entity = new Project();
        $form = $this->createSearchForm($entity);
        // 'entity' => $entity

        $search_key = '';
        $parameters = $request->request->all();
        foreach ($parameters as $key => $value) {
            if (isset($value["searchfield"])) {
                $search_key = $value["searchfield"];
                break;
            }
        }

        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();

        /**
         * Query should be:
         *
         * SELECT * FROM project LEFT JOIN
         *     (SELECT id as proposalid, project_id, consultant_user_id
         *     FROM proposal
         *     WHERE proposal.consultant_user_id = 9)
         * as props
         * ON project.id = props.project_id
         * WHERE project.title LIKE '%p%'
         */

        /**
         * Then in the view, sort the view by proposalid. When proposalid is not NULL,
         * it means that the project has already been applied for.
         */

        $qb
            ->select('prj')
            ->from('TGCAdminBundle:Project', 'prj')
            // ->from('TGCAdminBundle:Proposal', 'prop')
            ->where($qb->expr()->like('prj.title', ':title'))
            // ->where($qb->expr()->eq('prop.projectid', 'prj.id'))
            // ->where($qb->expr()->eq('prop.userid', ':userid'))
            ->setParameter('title', '%' . $search_key . '%')// ->setParameter('userid', $currentUserId)
        ;

        $query = $qb->getQuery();
        $entities = $query->getResult();

        // $entities = $em->getRepository('TGCAdminBundle:Project')
        // ->findBy(array('title' => $searchfield), array('id' => 'DESC'));
        return $this->render('TGCAdminBundle:Project:search.html.twig', array(
            'entities' => $entities,
            'form' => $form->createView(),
        ));

    }

    /**
     * Creates a new Project entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Project();

        $user = new User();
        $entity->setUserid($user);

        // Dafault values:
        $entity->setStatus(1);
        $entity->setApproved(0);

        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('project'));
            // $this->generateUrl('project_show', array('id' => $entity->getId()))
        }

        return $this->render('TGCAdminBundle:Project:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Project entity.
     *
     * @param Project $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Project $entity)
    {
        $form = $this->createForm(new ProjectType(), $entity, array(
            'action' => $this->generateUrl('project_create'),
            'method' => 'POST',
            'em' => $this->getDoctrine()->getManager()
        ));

        $form->add('submit', 'submit', array('label' => 'Save Project'));

        return $form;
    }

    /**
     * Displays a form to create a new Project entity.
     *
     */
    public function newAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        // $currentUserId = $user->getId();
        // $em = $this->getDoctrine()->getManager();
        // $user = $em->getRepository('TGCAdminBundle:User')->find($currentUserId);

        $entity = new Project();
        $entity->setUserid($user);
        $entity->setStatus(1);

        $form = $this->createCreateForm($entity);

        return $this->render('TGCAdminBundle:Project:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Project entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TGCAdminBundle:Project')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Project entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TGCAdminBundle:Project:show.html.twig', array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Displays a form to edit an existing Project entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TGCAdminBundle:Project')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Project entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TGCAdminBundle:Project:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Project entity.
     *
     * @param Project $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Project $entity)
    {
        $form = $this->createForm(new ProjectType(), $entity, array(
            'action' => $this->generateUrl('project_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'em' => $this->getDoctrine()->getManager()
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Project entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TGCAdminBundle:Project')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Project entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('project_edit', array('id' => $id)));
        }

        return $this->render('TGCAdminBundle:Project:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Project entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TGCAdminBundle:Project')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Project entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('project'));
    }

    public function listAction(Request $request)
    {

        $sectors = $this->getDoctrine()->getRepository('TGCAdminBundle:Sector')->findAll();

        $em = $this->get('doctrine.orm.entity_manager');
        $queryBuilder = $em->createQueryBuilder();
        $queryBuilder
            ->select('a')
            ->from('TGCAdminBundle:Project', 'a');

        $a = $request->query->get('sector');
        if (isset($a)) {
            $queryBuilder
                ->where('a.sector = :sector_id')
                ->setParameter('sector_id', $a);
        }

        $query = $queryBuilder->getQuery()->getResult();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1) /*page number*/,
            10/*limit per page*/
        );

        return $this->render('TGCAdminBundle:Admin:list_projects.html.twig',
            array('pagination' => $pagination, 'sectors' => $sectors)
        );
    }

    public function approveAction($id)
    {

        $project = $this->getDoctrine()->getRepository('TGCAdminBundle:Project')->find($id);
        $project->setApproved(1);
        $em = $this->getDoctrine()->getManager();
        $em->persist($project);
        $em->flush();

        return $this->redirect($this->generateUrl('project_list'));
    }

    /**
     * Creates a form to delete a Project entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('project_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }
}
