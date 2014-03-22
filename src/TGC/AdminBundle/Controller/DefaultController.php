<?php

namespace TGC\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('TGCAdminBundle:Default:index.html.twig', array('name' => $name));
    }
}
