<?php

namespace TGC\AdminBundle\Form\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;

class UserToIntTransformer extends EntityToIntTransformer
{
    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        parent::__construct($om);
        $this->setEntityClass("\\TGC\\AdminBundle\\Entity\\User");
        $this->setEntityRepository("TGCAdminBundle:User");
        $this->setEntityType("user");
    }

}