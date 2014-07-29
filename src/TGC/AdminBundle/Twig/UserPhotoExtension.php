<?php

namespace TGC\AdminBundle\Twig;

use Twig_Extension;
use Twig_Function_Method;
use TGC\AdminBundle\Entity\User;

class UserPhotoExtension extends Twig_Extension
{
    protected $photosUrl;

    public function __construct($photosUrl)
    {
        $this->photosUrl = $photosUrl;
    }  
    
    public function getFunctions()
    {
        return array(
            'userPhotoUrl' => new Twig_Function_Method($this, 'getPhotoUrl'),
        );
    }

    public function getPhotoUrl($user)
    {
        $path = '';
        if ($user->getPhoto()) {
            $path = '/'.$this->photosUrl .'/'.$user->getPhoto();
        }

        return $path;
    }

    public function getName()
    {
        return 'user_photo_extension';
    }
}