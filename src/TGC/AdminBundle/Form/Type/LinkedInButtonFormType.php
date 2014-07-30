<?php

namespace TGC\AdminBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Form\AbstractType;

class LinkedInButtonFormType extends AbstractType
{

    public function __construct($linkedInUrl)
    {
        $this->linkedInUrl = $linkedInUrl;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
        $builder
            ->add('submit', 'submit', array(
                'label' => 'Sign up with LinkedIn'
            ));
    }

    public function getName()
    {
        return 'tgc_admin_consultant_basic_registration';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            // 'data_class' => 'TGC\AdminBundle\Entity\User',
        ));
    }
}