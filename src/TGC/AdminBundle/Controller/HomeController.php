<?php
/**
 * Created by PhpStorm.
 * User: argi
 * Date: 06/07/2014
 * Time: 12:31
 */

namespace TGC\AdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller {

    public function indexAction()
    {
        return $this->render('TGCAdminBundle:Home:index.html.twig');
    }

    public function contactAction(Request $request)
    {
        if ($request->getMethod() === 'POST') {

            $message = \Swift_Message::newInstance()
                ->setSubject('Web site contact from '.$request->request->get('name'))
                ->setFrom('lisettluik@gmail.com')
                ->setTo('lisettluik@gmail.com')
                ->setBody($request->request->get('email').' says: '.$request->request->get('message'))
            ;
            $this->get('mailer')->send($message);

            return $this->render('TGCAdminBundle:Home:thankyou.html.twig');
        }

        return $this->render('TGCAdminBundle:Home:contact.html.twig');
    }

    public function aboutAction()
    {
        return $this->render('TGCAdminBundle:Home:about.html.twig');
    }

    public function termsAction()
    {
        return $this->render('TGCAdminBundle:Home:terms.html.twig');
    }

    public function howAction()
    {
        return $this->render('TGCAdminBundle:Home:how.html.twig');
    }

} 