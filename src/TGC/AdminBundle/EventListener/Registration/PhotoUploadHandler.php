<?php

namespace TGC\AdminBundle\EventListener\Registration;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PhotoUploadHandler implements EventSubscriberInterface
{
    private $uploadDir;
    
    public function __construct($uploadDir) {
        $this->uploadDir = $uploadDir;
    }
    
    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_SUCCESS => 'upload'
        );
    }

    /*
     * Moves photo uploaded by user to the directory specified in config
     */
    public function upload(FormEvent $event)
    {
        $form = $event->getForm();
        if ($form->isValid()) {
            $username = $form['username']->getData();
            $file = $form['photo']->getData();
            
            if ($file) {
                $extension = $file->guessExtension();
                if (!$extension) {
                    $extension = 'bin';
                }
                $filename = $username . '.' . $extension;

                $file->move($this->uploadDir, $filename);

                $form->getData()->setPhoto($filename);
            }
        }
    }
}
