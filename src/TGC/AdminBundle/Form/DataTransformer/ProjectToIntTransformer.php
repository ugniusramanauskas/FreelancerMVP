<?php

namespace TGC\AdminBundle\Form\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;

class ProjectToIntTransformer extends EntityToIntTransformer
{
    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        parent::__construct($om);
        $this->setEntityClass("\\TGC\\AdminBundle\\Entity\\Project");
        $this->setEntityRepository("TGCAdminBundle:Project");
        $this->setEntityType("project");
    }

}