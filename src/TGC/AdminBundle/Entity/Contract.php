<?php

namespace TGC\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contract
 */
class Contract
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $startdate;

    /**
     * @var string
     */
    private $contracttext;

    /**
     * @var \DateTime
     */
    private $registrationtimestamp;

    /**
     * @var integer
     */
    private $status;

    /**
     * @var \TGC\AdminBundle\Entity\User
     */
    private $userid;

    /**
     * @var \TGC\AdminBundle\Entity\Project
     */
    private $projectid;


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
     * Set startdate
     *
     * @param \DateTime $startdate
     * @return Contract
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
     * Set contracttext
     *
     * @param string $contracttext
     * @return Contract
     */
    public function setContracttext($contracttext)
    {
        $this->contracttext = $contracttext;

        return $this;
    }

    /**
     * Get contracttext
     *
     * @return string 
     */
    public function getContracttext()
    {
        return $this->contracttext;
    }

    /**
     * Set registrationtimestamp
     *
     * @param \DateTime $registrationtimestamp
     * @return Contract
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
     * @return Contract
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
     * Set userid
     *
     * @param \TGC\AdminBundle\Entity\User $userid
     * @return Contract
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

    /**
     * Set projectid
     *
     * @param \TGC\AdminBundle\Entity\Project $projectid
     * @return Contract
     */
    public function setProjectid(\TGC\AdminBundle\Entity\Project $projectid = null)
    {
        $this->projectid = $projectid;

        return $this;
    }

    /**
     * Get projectid
     *
     * @return \TGC\AdminBundle\Entity\Project 
     */
    public function getProjectid()
    {
        return $this->projectid;
    }
}