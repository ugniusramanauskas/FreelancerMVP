<?php

namespace TGC\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 */
class Address
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \TGC\AdminBundle\Entity\User
     */
    private $userid;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userid
     *
     * @param \TGC\AdminBundle\Entity\User $userid
     * @return Address
     */
    public function setUserid(\TGC\AdminBundle\Entity\User $userid = null)
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Get userid
     *
     * @return \TGC\AdminBundle\Entity\User 
     */
    public function getUserid()
    {
        return $this->userid;
    }
}
