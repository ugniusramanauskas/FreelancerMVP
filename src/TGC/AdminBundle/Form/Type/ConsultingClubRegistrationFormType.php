<?php

namespace TGC\AdminBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints;
use FOS\UserBundle\Form\Type\RegistrationFormType as RegistrationFormTypeBase;

class ConsultingClubRegistrationFormType extends RegistrationFormTypeBase
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
        $builder->add('clubName')
            ->add('phone')
            ->add('location')
            ->add('description', null, array(
                'required'  => false
            ))
            ->add('universityEmail', 'email')
            ->add('university')
            ->add('sectors', null, array(
                'expanded'  => true,
                'multiple'  => true
            ))
            ->add('skills', 'collection', array(
                'type'      => 'text',
                'allow_add' => true,
                'allow_delete' => true,
                'error_bubbling' => true
            ))
            ->add('photo', 'file')
            ->add('website', null, array(
                'required'  => false
            ))
            ->add('invitation', 'tgc_invitation_type')
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
        return 'tgc_admin_club_registration';
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