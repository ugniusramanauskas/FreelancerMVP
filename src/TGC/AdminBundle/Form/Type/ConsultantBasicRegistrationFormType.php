<?php

namespace TGC\AdminBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints;
use FOS\UserBundle\Form\Type\RegistrationFormType as RegistrationFormTypeBase;

class ConsultantBasicRegistrationFormType extends RegistrationFormTypeBase
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
        $builder
            ->add('linkedInButton', 'button', array(
                'label' => 'Sign up with LinkedIn'
            ))
            ->add('firstName')
            ->add('lastName')
            ->add('universityEmail', 'email')
            // to get validation errors
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'form.password', 'error_bubbling' => true),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))

            // add your custom field
            ->add('phone')
            ->add('location')
            ->add('description', null, array(
                'required'  => false
            ))
                
            // consultant fields
            ->add('university')
            ->add('degree')
            ->add('sectors', null, array(
                'expanded'  => true,
                'multiple'  => true
            ))
            ->add('bio', 'collection', array(
                'type'      => 'textarea',
                'allow_add' => true,
                'allow_delete' => true,
                'error_bubbling' => true
            ))
            ->add('skills', 'collection', array(
                'type'      => 'text',
                'allow_add' => true,
                'allow_delete' => true,
                'error_bubbling' => true
            ))
            ->add('photo', 'file')
            ->add('cv', 'file')
            ->add('linkedin', null, array(
                'required'  => false
            ))

            ->add(
                'terms',
                'checkbox',
                array(
                    'mapped' => false,
                    'constraints' => array(
                        new Constraints\NotBlank(array('groups' => array('business', 'consultant', 'club'))),
                        new Constraints\True(array(
                            'groups' => array('business', 'consultant', 'club'),
                            'message'   => 'Please accept terms and conditions'
                            ))
                    )
                )
            )
            ->add('submit', 'submit');
    }

    public function getName()
    {
        return 'tgc_admin_consultant_basic_registration';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TGC\AdminBundle\Entity\User',
            'intention'  => 'registration',
            'validation_groups' => array('club', 'Default', 'Registration')
        ));
    }
}