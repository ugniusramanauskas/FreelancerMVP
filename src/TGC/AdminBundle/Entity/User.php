<?php

namespace TGC\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 */
class User extends BaseUser
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    // protected $username;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $addresses;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $proposals;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $contracts;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $projects;

    /**
     * @var \TGC\AdminBundle\Entity\Role
     */
    private $roleid;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->addresses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->proposals = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contracts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->projects = new \Doctrine\Common\Collections\ArrayCollection();
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

    // /**
    //  * Set username
    //  *
    //  * @param string $username
    //  * @return User
    //  */
    // public function setUsername($username)
    // {
    //     $this->username = $username;

    //     return $this;
    // }

    // /**
    //  * Get username
    //  *
    //  * @return string 
    //  */
    // public function getUsername()
    // {
    //     return $this->username;
    // }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Add addresses
     *
     * @param \TGC\AdminBundle\Entity\Address $addresses
     * @return User
     */
    public function addAddress(\TGC\AdminBundle\Entity\Address $addresses)
    {
        $this->addresses[] = $addresses;

        return $this;
    }

    /**
     * Remove addresses
     *
     * @param \TGC\AdminBundle\Entity\Address $addresses
     */
    public function removeAddress(\TGC\AdminBundle\Entity\Address $addresses)
    {
        $this->addresses->removeElement($addresses);
    }

    /**
     * Get addresses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * Add proposals
     *
     * @param \TGC\AdminBundle\Entity\Proposal $proposals
     * @return User
     */
    public function addProposal(\TGC\AdminBundle\Entity\Proposal $proposals)
    {
        $this->proposals[] = $proposals;

        return $this;
    }

    /**
     * Remove proposals
     *
     * @param \TGC\AdminBundle\Entity\Proposal $proposals
     */
    public function removeProposal(\TGC\AdminBundle\Entity\Proposal $proposals)
    {
        $this->proposals->removeElement($proposals);
    }

    /**
     * Get proposals
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProposals()
    {
        return $this->proposals;
    }

    /**
     * Add contracts
     *
     * @param \TGC\AdminBundle\Entity\Contract $contracts
     * @return User
     */
    public function addContract(\TGC\AdminBundle\Entity\Contract $contracts)
    {
        $this->contracts[] = $contracts;

        return $this;
    }

    /**
     * Remove contracts
     *
     * @param \TGC\AdminBundle\Entity\Contract $contracts
     */
    public function removeContract(\TGC\AdminBundle\Entity\Contract $contracts)
    {
        $this->contracts->removeElement($contracts);
    }

    /**
     * Get contracts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContracts()
    {
        return $this->contracts;
    }

    /**
     * Add projects
     *
     * @param \TGC\AdminBundle\Entity\Project $projects
     * @return User
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

    /**
     * Set roleid
     *
     * @param \TGC\AdminBundle\Entity\Role $roleid
     * @return User
     */
    public function setRoleid(\TGC\AdminBundle\Entity\Role $roleid = null)
    {
        $this->roleid = $roleid;

        return $this;
    }

    /**
     * Get roleid
     *
     * @return \TGC\AdminBundle\Entity\Role 
     */
    public function getRoleid()
    {
        return $this->roleid;
    }

    public function __toString()
    {
        return $this->username;
    }

    /**
     * Returns the user roles
     *
     * @return array The roles
     */
    public function getRoles()
    {
        $roles = $this->roles;

        foreach ($this->getGroups() as $group) {
            $roles = array_merge($roles, $group->getRoles());
        }

        // we need to make sure to have at least one role
        $roles[] = static::ROLE_DEFAULT;

        return array_unique($roles);
    }

}
