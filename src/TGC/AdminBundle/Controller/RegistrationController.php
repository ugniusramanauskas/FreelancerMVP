<?php

namespace TGC\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Controller\RegistrationController as BaseController;

class RegistrationController extends BaseController
{
    /*
     * Overriding default method to make this page available
     * to non-authenticated users
     */
    public function confirmedAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:confirmed.html.'.$this->getEngine(), array(
            'user' => $user,
        ));
    }
    
    public function validateFormAction(Request $request)
    {
        $formFactory = $this->container->get('fos_user.registration.form.factory');
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->createUser();

        $form = $formFactory->createForm();
        $form->setData($user);
        $result = array();

        if ($request->isXmlHttpRequest()) {
            $form->bind($request);

            if (!$form->isValid()) {
                $result['errors'] = $this->getErrorMessages($form);
            }
        }
        
        return new JsonResponse($result);
    }
    
    /*
     * Extracts all errors messages from the form
     */
    private function getErrorMessages(\Symfony\Component\Form\Form $form) {      
        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }

        foreach ($form->all() as $key => $child) {
            foreach ($child->getErrors() as $error) {
                $errors[$child->getName()] = $error->getMessage();
            }
        }

        return $errors;
    }
}
