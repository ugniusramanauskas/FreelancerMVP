<?php

namespace TGC\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use TGC\AdminBundle\Form\DataTransformer\UserToIntTransformer;
use TGC\AdminBundle\Form\DataTransformer\ProjectToIntTransformer;

class ContractType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $UserTransformer = new UserToIntTransformer($options["em"]);
        $ProjectTransformer = new ProjectToIntTransformer($options["em"]);
        
        $builder
            // ->add('startdate', 'date', array(
            //     'input'  => 'datetime',
            //     'widget' => 'single_text',
            //     'label' => 'Contract starting date:'
            //     ))

            //->add('contracttext', 'textarea')
            ->add($builder->create('userid', 'hidden')->addModelTransformer($UserTransformer))
            ->add($builder->create('projectid', 'hidden')->addModelTransformer($ProjectTransformer))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TGC\AdminBundle\Entity\Contract'
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
        return 'tgc_adminbundle_contract';
    }
}
