<?php

/*
 * This overrides the default Form provided by the FOSUserBundle
 */

namespace TGC\AdminBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints;
use FOS\UserBundle\Form\Type\ProfileFormType as ProfileFormTypeBase;


class ProfileFormType extends ProfileFormTypeBase
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('description', null, array(
                'required'  => false
            ));

            $builder->addEventListener(
                FormEvents::POST_SET_DATA,
                function (FormEvent $event) {
                    $form = $event->getForm();
                    $data = $event->getData();
                    if($data) {
                        $roles = $data->getRoles();

                        if (in_array('ROLE_BUSINESS', $roles)) {
                            $form->add('firstName')
                                ->add('lastName')
                                ->add('phone')
                                ->add('location')
                                ->add('businessName')
                                ->add('website', null, array(
                                    'required'  => false
                                ));
                        } elseif(in_array('ROLE_CONSULTANT', $roles)) {
                            $form->add('firstName')
                                ->add('lastName')
                                ->add('phone')
                                ->add('location')
                                ->add('universityEmail', 'email')
                                ->add('university', null, array(
                                    'label' => 'Past/ Current University'
                                ))
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
                                    'error_bubbling' => true,
                                    'label' => 'List your skills and possible projects you can do for businesses.'
                                ))
                                ->add('photo', 'file', array(
                                    'mapped' => false,
                                    'required' => false
                                ))
                                ->add('cv', 'file', array(
                                    'mapped' => false,
                                    'required' => false
                                ))
                                ->add('linkedin', null, array(
                                    'required'  => false,
                                ));
                        } elseif(in_array('ROLE_CLUB', $roles)) {
                            $form->add('clubName')
                                ->add('phone')
                                ->add('locations', 'collection', array(
                                    'type'      => 'text',
                                    'allow_add' => true,
                                    'allow_delete' => true
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
                                    'error_bubbling' => true,
                                    'label' => 'List your organisation\'s skills and possible projects you can do for businesses.'
                                ))
                                ->add('photo', 'file', array(
                                    'mapped' => false,
                                    'required' => false
                                ))
                                ->add('website', null, array(
                                    'required'  => false
                                ));
                        }
                    }
                }
            );
    }

    public function getName()
    {
        return 'tgc_admin_profile';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TGC\AdminBundle\Entity\User',
            'validation_groups' => function(FormInterface $form) {
                $data = $form->getData();
                if (in_array("ROLE_BUSINESS", $data->getRoles())) {
                    return array('business', 'Default', 'Profile');
                } elseif (in_array("ROLE_CONSULTANT", $data->getRoles())) {
                    return array('consultant', 'Default', 'Profile');
                } elseif (in_array("ROLE_CLUB", $data->getRoles())) {
                    return array('club', 'Default', 'Profile');
                } else {
                    return array('Default', 'Registration');
                }
            }
        ));
    }
}