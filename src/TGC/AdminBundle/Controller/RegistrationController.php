<?php

namespace TGC\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use TGC\AdminBundle\Form\Type\ConsultingClubRegistrationFormType;
use TGC\AdminBundle\Form\Type\ConsultantBasicRegistrationFormType;
use TGC\AdminBundle\Form\Type\BusinessBasicRegistrationFormType;
use TGC\AdminBundle\Form\Type\LinkedInButtonFormType;
use OAuth\Common\Http\Exception\TokenResponseException;

use OAuth\Common\Storage\Session;
use OAuth\Common\Storage\SymfonySession;
use TGC\AdminBundle\OAuth\LinkedinService;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RegistrationController extends BaseController
{
    public function registerClubAction(Request $request)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $dispatcher = $this->container->get('event_dispatcher');

        $user = $userManager->createUser();
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_CLUB'));

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $userClass = $this->container->getParameter('fos_user.model.user.class');
        $form = $this->container->get('form.factory')->create(new ConsultingClubRegistrationFormType($userClass));
        $form->setData($user);

        if ('POST' === $request->getMethod()) {
            $form->bind($request);

            if ($form->isValid()) {
                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

                $userManager->updateUser($user);

                if (null === $response = $event->getResponse()) {
                    $url = $this->container->get('router')->generate('fos_user_registration_confirmed');
                    $response = new RedirectResponse($url);
                }

                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }
        }

        return $this->container->get('templating')->renderResponse('TGCAdminBundle:Registration:registerClub.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function registerConsultantAction(Request $request)
    {

        $userManager = $this->container->get('tgc_admin.user_manager');

        $dispatcher = $this->container->get('event_dispatcher');

        $user = $userManager->createUser();
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_CONSULTANT'));

        $storage = new SymfonySession($request->getSession());
        $token = $storage->retrieveAccessToken('LinkedinService');

        if ($token) {
            $linkedin = LinkedinService::create(
                $storage,
                $this->container->getParameter( 'oauth_token' ),
                $this->container->getParameter( 'oauth_secret' ),
                ""
            );

            $requestString =    'people/~:(id,first-name,last-name,';
            $requestString .=   'formatted-name,email-address,phone-numbers,main-address,';
            $requestString .=   'location:(name),industry,summary,';
            $requestString .=     'specialties,positions,picture-url,proposal-comments,';
            $requestString .=     'associations,interests,languages,skills,certifications,';
            $requestString .=     'educations,courses,volunteer,three-current-positions,';
            $requestString .=     'three-past-positions,recommendations-received,job-bookmarks,';
            $requestString .=     'suggestions,honors-awards)?format=json';

            // var_dump($requestString);
            try {
                $response = $linkedin->request($requestString);   
                $decodedResponse = json_decode($response, true);
                if ($decodedResponse) {
                    $userManager->populateUser($user, $decodedResponse);
                }
            }
            catch (TokenResponseException $e) {
                // To be implemented
            }
        }


        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $userClass = $this->container->getParameter('fos_user.model.user.class');
        $regForm = $this->container->get('form.factory')->create(new ConsultantBasicRegistrationFormType($userClass));
        $regForm->setData($user);

        if ('POST' === $request->getMethod()) {
            $regForm->bind($request);

            if ($regForm->isValid()) {
                $event = new FormEvent($regForm, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

                $userManager->updateUser($user);

                if (null === $response = $event->getResponse()) {
                    $url = $this->container->get('router')->generate('fos_user_registration_confirmed');
                    $response = new RedirectResponse($url);
                }

                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }
        }

        $router = $this->container->get('router');
        $storage = new SymfonySession($request->getSession());
        $linkedin = LinkedinService::create(
            $storage, 
            $this->container->getParameter( 'oauth_token' ),
            $this->container->getParameter( 'oauth_secret' ),
            $router->generate('oauth_login_callback', array(), true)
        );
        $token = $linkedin->requestRequestToken();
        $linkedInUrl = $linkedin->getAuthorizationUri(array('oauth_token' => $token->getRequestToken()));

        // var_dump(sprintf("%s", $linkedInUrl)); 

        $linkedinForm = $this->container->get('form.factory')->create(new LinkedInButtonFormType($linkedInUrl), null, array(
            'action' => $linkedInUrl,
            'method' => 'POST',
            // 'em' => $this->getDoctrine()->getManager()
        ));

        return $this->container->get('templating')->renderResponse('TGCAdminBundle:Registration:registerConsultant.html.twig', array(
            'reg_form' => $regForm->createView(),
            'linkedin_form' => $linkedinForm->createView(),
        ));  
    }

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
