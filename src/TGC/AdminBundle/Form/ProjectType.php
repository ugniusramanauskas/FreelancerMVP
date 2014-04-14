<?php

namespace TGC\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use TGC\AdminBundle\Form\DataTransformer\UserToIntTransformer;


class ProjectType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $UserTransformer = new UserToIntTransformer($options["em"]);
        $builder
            // ->add('title')
            // ->add('startdate')
            // ->add('description')
            // ->add('registrationtimestamp')
            // ->add('status')
            // ->add('userid')
            ->add('title', 'text', array(
                'label' => 'Title (Pick a name for your project):',
                ))
            ->add('description', 'textarea', array(
                'label' => 'Description:',
                ))
            ->add('budget')
            ->add('duration')
            ->add('sector', null, array(
                'empty_value' => 'Please select sector',
                'required'    => true
            ))
            ->add('startdate', 'date', array(
                'input'  => 'datetime',
                'widget' => 'single_text',
                'label' => 'Project starting date:'
                )
            )
            ->add('deadline', 'date', array(
                'input'  => 'datetime',
                'widget' => 'single_text'
                )
            )
            ->add($builder->create('userid', 'hidden')->addModelTransformer($UserTransformer))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TGC\AdminBundle\Entity\Project'
        ));
        $resolver->setRequired(array(
            'em',
        ));
        $resolver->setAllowedTypes(array(
            'em' => 'Doctrine\Common\Persistence\ObjectManager',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'tgc_adminbundle_project';
    }
}
