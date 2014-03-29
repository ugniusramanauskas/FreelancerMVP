<?php

/*
 * This overrides the default Form provided by the FOSUserBundle
 */

namespace TGC\AdminBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as RegistrationFormTypeBase;

use TGC\AdminBundle\Form\DataTransformer\StringToArrayTransformer;


class RegistrationFormType extends RegistrationFormTypeBase
{
    private $class;

    /**
     * @param string $class The User class name
     */
    public function __construct($class, $roles_hierarchy = null)
    {
        $this->roles_hierarchy = $roles_hierarchy;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $arrayTransformer = new StringToArrayTransformer();

        parent::buildForm($builder, $options);

        $roles = array();
        foreach ($this->roles_hierarchy["ROLE_CUSTOMER"] as $key => $value) {
            $roles[$value] = substr($value, 5);
        }

        // add your custom field
        $builder->add(
                $builder
                    ->create('roles', 'choice', array(
                        'choices' => $roles
                    ))
                    ->addModelTransformer($arrayTransformer)
        );

        // $builder->add('gender', 'choice', array(
        //     'choices'   => array('m' => 'Male', 'f' => 'Female'),
        //     'required'  => false,
        //     'mapped' => false
        // ));
    }

    public function getName()
    {
        return 'tgc_admin_registration';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TGC\AdminBundle\Entity\User',
            'intention'  => 'registration',
        ));
    }
}