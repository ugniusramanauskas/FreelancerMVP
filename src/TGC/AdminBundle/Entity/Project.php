<?php

namespace TGC\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 */
class Project
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var \DateTime
     */
    private $startdate;

    /**
     * @var integer
     */
    private $budget;

    /**
     * @var integer
     */
    private $duration;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $registrationtimestamp;

    /**
     * @var integer
     */
    private $status;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $proposals;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $contracts;

    /**
     * @var \TGC\AdminBundle\Entity\User
     */
    private $userid;
    
    /**
     * @var \TGC\AdminBundle\Entity\Sector
     */
    private $sector;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->proposals = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contracts = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Project
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set startdate
     *
     * @param \DateTime $startdate
     * @return Project
     */
    public function setStartdate($startdate)
    {
        $this->startdate = $startdate;

        return $this;
    }

    /**
     * Get startdate
     *
     * @return \DateTime 
     */
    public function getStartdate()
    {
        return $this->startdate;
    }

    /**
     * Set budget
     *
     * @param integer $budget
     * @return Project
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * Get budget
     *
     * @return integer 
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     * @return Project
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer 
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Project
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set registrationtimestamp
     *
     * @param \DateTime $registrationtimestamp
     * @return Project
     */
    public function setRegistrationtimestamp($registrationtimestamp)
    {
        $this->registrationtimestamp = $registrationtimestamp;

        return $this;
    }

    /**
     * Get registrationtimestamp
     *
     * @return \DateTime 
     */
    public function getRegistrationtimestamp()
    {
        return $this->registrationtimestamp;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Project
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Add proposals
     *
     * @param \TGC\AdminBundle\Entity\Proposal $proposals
     * @return Project
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
     * @return Project
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
     * Set userid
     *
     * @param \TGC\AdminBundle\Entity\User $userid
     * @return Project
     */
    public function setUserid(\TGC\AdminBundle\Entity\User $userid)
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

    public function __toString()
    {
        return $this->title;
    }

    /**
     * Set sector
     *
     * @param \TGC\AdminBundle\Entity\Sector $sector
     * @return Project
     */
    public function setSector(\TGC\AdminBundle\Entity\Sector $sector = null)
    {
        $this->sector = $sector;

        return $this;
    }

    /**
     * Get sector
     *
     * @return \TGC\AdminBundle\Entity\Sector 
     */
    public function getSector()
    {
        return $this->sector;
    }
}
