<?php

namespace TGC\AdminBundle\EventListener\Registration;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class FileUploadListener implements EventSubscriberInterface
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
     * Moves CV file uploaded by user to the directory specified in config
     */
    public function upload(FormEvent $event)
    {
        $form = $event->getForm();
        if ($form->isValid()) {
            $username = $form['username']->getData();
            $file = $form['cv']->getData();

            $extension = $file->guessExtension();
            if (!$extension) {
                $extension = 'bin';
            }
            $file->move($this->uploadDir . '/' . $username, 'cv.' . $extension);

        }
    }
}
