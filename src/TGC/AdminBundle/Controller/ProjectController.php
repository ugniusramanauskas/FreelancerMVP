<?php

namespace TGC\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TGC\AdminBundle\Entity\User;

use TGC\AdminBundle\Entity\Project;
use TGC\AdminBundle\Form\ProjectType;
use TGC\AdminBundle\Form\ProjectsearchType;

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
        // $user = $this->container->get('fos_user.user_manager')->findUserByUsername('ugnius');
        $user = $this->container->get('security.context')->getToken()->getUser();
        $currentUserId = $user->getId();

        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();
        $qb
            ->select('prj')
            ->from('TGCAdminBundle:Project', 'prj')
            ->where($qb->expr()->eq('prj.userid', ':userid'))
            ->setParameter('userid', $currentUserId)
        ;
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
            'form'   => $form->createView(),
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
        // var_dump($searchfield);
        // die();
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb
            ->select('prj')
            ->from('TGCAdminBundle:Project', 'prj')
            ->where($qb->expr()->like('prj.title', ':title'))
            ->setParameter('title', '%' . $search_key . '%')
        ;
        $query = $qb->getQuery();
        $entities = $query->getResult();

        // $entities = $em->getRepository('TGCAdminBundle:Project')
        // ->findBy(array('title' => $searchfield), array('id' => 'DESC'));
        return $this->render('TGCAdminBundle:Project:search.html.twig', array(
            'entities' => $entities,
            'form'   => $form->createView(),
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
            'form'   => $form->createView(),
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

        $form   = $this->createCreateForm($entity);

        return $this->render('TGCAdminBundle:Project:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
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
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
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
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
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
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
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
            ->getForm()
        ;
    }
}
