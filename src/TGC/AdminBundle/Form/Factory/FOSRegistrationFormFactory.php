<?php

namespace TGC\AdminBundle\Form\Factory;

use Symfony\Component\Form\FormFactoryInterface;
use FOS\UserBundle\Form\Factory\FormFactory as BaseFormFactory;

/*
 * Class overridden to allow specifying validation groups at runtime
 * based on submitted data
 */
class FOSRegistrationFormFactory extends BaseFormFactory
{
    private $formFactory;
    private $name;
    private $type;
    private $validationGroups;

    public function __construct(FormFactoryInterface $formFactory, $name, $type, array $validationGroups = null)
    {
        $this->formFactory = $formFactory;
        $this->name = $name;
        $this->type = $type;
        $this->validationGroups = $validationGroups;
    }
    
    public function createForm()
    {
        $options = array();
        if ($this->validationGroups) {
            $options['validation_groups'] = $this->validationGroups;
        }
        return $this->formFactory->createNamed($this->name, $this->type, null, $options);
    }
}
