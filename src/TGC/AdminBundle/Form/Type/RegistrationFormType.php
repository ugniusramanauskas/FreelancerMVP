<?php

/*
 * This overrides the default Form provided by the FOSUserBundle
 */

namespace TGC\AdminBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormInterface;
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
                        'choices' => $roles,
                        'expanded' => true,
                        'multiple'  => false,
                    ))
                    ->addModelTransformer($arrayTransformer)
            )
            ->add('firstName')
            ->add('lastName')
            ->add('phone')
            ->add('location')
                
            // business fields
            ->add('businessName')
            ->add('businessDescription', null, array(
                'required'  => false
            ))
            ->add('businessWebsite', null, array(
                'required'  => false
            ))
                
            // consultant fields
            ->add('universityEmail', 'email')
            ->add('university')
            ->add('degree')
            ->add('sectors', null, array(
                'expanded'  => true,
                'multiple'  => true
            ))
            ->add('skills')
            ->add('tasks')
            ->add('photo', 'file')
            ->add('cv', 'file')
            ->add('linkedin', null, array(
                'required'  => false
            ))
                
            // readding password field with error_bubbling to be able
            // to get validation errors
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'form.password', 'error_bubbling' => true),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
//            ->add('nextStep', 'submit', array(
//                'validation_groups' => array('Registration'),
//                'label' => 'Go to step 2'
//            ))
            ->add('submit', 'submit');

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
            'csrf_protection' => false,
            'validation_groups' => function(FormInterface $form) {
                $data = $form->getData();
                if (in_array("ROLE_BUSINESS", $data->getRoles())) {
                    return array('business', 'Default', 'Registration');
                } elseif (in_array("ROLE_CONSULTANT", $data->getRoles())) {
                    return array('consultant', 'Default', 'Registration');
                } else {
                    return array('Default', 'Registration');
                }
            }
        ));
    }
}