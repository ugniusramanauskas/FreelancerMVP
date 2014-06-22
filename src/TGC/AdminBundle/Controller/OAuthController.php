<?php

namespace TGC\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use OAuth\Common\Storage\Session;
use OAuth\Common\Storage\SymfonySession;
use TGC\AdminBundle\OAuth\LinkedinService;

class OAuthController extends Controller {

    public function loginAction(Request $request)
    {
        $router = $this->container->get('router');
        $storage = new SymfonySession($request->getSession());
        $linkedin = LinkedinService::create(
            $storage, 
            $this->container->getParameter( 'oauth_token' ),
            $this->container->getParameter( 'oauth_secret' ),
            $router->generate('oauth_login_callback', array(), true)
        );
        $token = $linkedin->requestRequestToken();
        $url = $linkedin->getAuthorizationUri(array('oauth_token' => $token->getRequestToken()));
        return new Response("<a href='".$url."'>Login</a>");
        //return $this->redirect($url);
    }
    
    public function callbackAction(Request $request) {
        $router = $this->container->get('router');
        $storage = new SymfonySession($request->getSession());
        $linkedin = LinkedinService::create(
            $storage,
            $this->container->getParameter( 'oauth_token' ),
            $this->container->getParameter( 'oauth_secret' ),
            ""
        );
        
        if (!empty($_GET['oauth_token'])) {
            $token = $storage->retrieveAccessToken('LinkedinService');
            $linkedin->requestAccessToken(
                $_GET['oauth_token'],
                $_GET['oauth_verifier'],
                $token->getRequestTokenSecret()
            );
            return $this->redirect($router->generate('custom_register_consultant', array(), true));
        }
        return new Response("error!");
    }
    
    public function pullAction(Request $request) {
        $storage = new SymfonySession($request->getSession());
        $token = $storage->retrieveAccessToken('LinkedinService');

        if ($token) {
            $linkedin = LinkedinService::create(
                $storage,
                $this->container->getParameter( 'oauth_token' ),
                $this->container->getParameter( 'oauth_secret' ),
                ""
            );

            $requestString = 'people/~:(id,first-name,last-name,';
            $requestString .= 'formatted-name,location:(name),industry,summary,';
            $requestString .=     'specialties,positions,picture-url,proposal-comments,';
            $requestString .=     'associations,interests,languages,skills,certifications,';
            $requestString .=     'educations,courses,volunteer,three-current-positions,';
            $requestString .=     'three-past-positions,recommendations-received,job-bookmarks,';
            $requestString .=     'suggestions,honors-awards)?format=json';

            $result = json_decode($linkedin->request($requestString));
            
            var_dump($result);
        }        
        //id,first-name,last-name,formatted-name,location:(name),industry,summary,specialties,positions,picture-url
        //proposal-comments,associations,interests,languages,skills,certifications,educations,courses,volunteer,three-current-positions,three-past-positions,recommendations-received,job-bookmarks,suggestions,honors-awards
        
        return new Response("success! token: " . $token);
    }
    
    private function setAccessToken($accessToken) {
        $session = $this->container->get('session');
        $session->set('_oauth_token', $accessToken);
    }
    private function getAccessToken() {
        $session = $this->container->get('session');
        return $session->get('_oauth_token', null);
    }
 
}
