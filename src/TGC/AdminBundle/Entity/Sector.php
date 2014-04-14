<?php

namespace TGC\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sector
 */
class Sector
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $projects;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $users;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * Set name
     *
     * @param string $name
     * @return Sector
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add users
     *
     * @param \TGC\AdminBundle\Entity\User $users
     * @return Sector
     */
    public function addUser(\TGC\AdminBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \TGC\AdminBundle\Entity\User $users
     */
    public function removeUser(\TGC\AdminBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
    
    public function __toString()
    {
        return $this->name;
    }

    /**
     * Add projects
     *
     * @param \TGC\AdminBundle\Entity\Project $projects
     * @return Sector
     */
    public function addProject(\TGC\AdminBundle\Entity\Project $projects)
    {
        $this->projects[] = $projects;

        return $this;
    }

    /**
     * Remove projects
     *
     * @param \TGC\AdminBundle\Entity\Project $projects
     */
    public function removeProject(\TGC\AdminBundle\Entity\Project $projects)
    {
        $this->projects->removeElement($projects);
    }

    /**
     * Get projects
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProjects()
    {
        return $this->projects;
    }
}