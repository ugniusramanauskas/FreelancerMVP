<?php

namespace TGC\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proposal
 */
class Proposal
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $coverletter;

    /**
     * @var integer
     */
    private $hourlyrate;

    /**
     * @var integer
     */
    private $duration;

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
     * Set coverletter
     *
     * @param string $coverletter
     * @return Proposal
     */
    public function setCoverletter($coverletter)
    {
        $this->coverletter = $coverletter;

        return $this;
    }

    /**
     * Get coverletter
     *
     * @return string 
     */
    public function getCoverletter()
    {
        return $this->coverletter;
    }

    /**
     * Set hourlyrate
     *
     * @param integer $hourlyrate
     * @return Proposal
     */
    public function setHourlyrate($hourlyrate)
    {
        $this->hourlyrate = $hourlyrate;

        return $this;
    }

    /**
     * Get hourlyrate
     *
     * @return integer 
     */
    public function getHourlyrate()
    {
        return $this->hourlyrate;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     * @return Proposal
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
     * Set registrationtimestamp
     *
     * @param \DateTime $registrationtimestamp
     * @return Proposal
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
     * @return Proposal
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
     * @return Proposal
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
     * @return Proposal
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
