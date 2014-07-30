<?php

namespace TGC\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 */
class User extends BaseUser
{
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';
    
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
     * @var string
     */
    private $status = self::STATUS_PENDING;
    
    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $location;

    /**
     * @var string
     */
    private $businessName;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $businessDescription;

    /**
     * @var string
     */
    private $businessWebsite;

    /**
     * @var string
     */
    private $university;

    /**
     * @var string
     */
    private $universityEmail;

    /**
     * @var string
     */
    private $degree;

    /**
     * @var string
     */
    private $skills;

    /**
     * @var string
     */
    private $tasks;

    /**
     * @var string
     */
    private $cv;
    
    /**
     * @var string
     */
    private $photo;

    /**
     * @var string
     */
    private $linkedin;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $sectors;

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
     * @var \DateTime
     */
    private $created;
    
    /**
     * @var \DateTime
     */
    private $updated;

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

    /**
     * Set status
     *
     * @param string $status
     * @return User
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }
    
    /**
     * Overriding default method to allow only approved users to login
     *
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->status == self::STATUS_APPROVED;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return User
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set businessName
     *
     * @param string $businessName
     * @return User
     */
    public function setBusinessName($businessName)
    {
        $this->businessName = $businessName;

        return $this;
    }

    /**
     * Get businessName
     *
     * @return string 
     */
    public function getBusinessName()
    {
        return $this->businessName;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set businessDescription
     *
     * @param string $businessDescription
     * @return User
     */
    public function setBusinessDescription($businessDescription)
    {
        $this->businessDescription = $businessDescription;

        return $this;
    }

    /**
     * Get businessDescription
     *
     * @return string 
     */
    public function getBusinessDescription()
    {
        return $this->businessDescription;
    }

    /**
     * Set businessWebsite
     *
     * @param string $businessWebsite
     * @return User
     */
    public function setBusinessWebsite($businessWebsite)
    {
        $this->businessWebsite = $businessWebsite;

        return $this;
    }

    /**
     * Get businessWebsite
     *
     * @return string 
     */
    public function getBusinessWebsite()
    {
        return $this->businessWebsite;
    }

    /**
     * Set university
     *
     * @param string $university
     * @return User
     */
    public function setUniversity($university)
    {
        $this->university = $university;

        return $this;
    }

    /**
     * Get university
     *
     * @return string 
     */
    public function getUniversity()
    {
        return $this->university;
    }

    /**
     * Set universityEmail
     *
     * @param string $universityEmail
     * @return User
     */
    public function setUniversityEmail($universityEmail)
    {
        $this->universityEmail = $universityEmail;

        return $this;
    }

    /**
     * Get universityEmail
     *
     * @return string 
     */
    public function getUniversityEmail()
    {
        return $this->universityEmail;
    }

    /**
     * Set degree
     *
     * @param string $degree
     * @return User
     */
    public function setDegree($degree)
    {
        $this->degree = $degree;

        return $this;
    }

    /**
     * Get degree
     *
     * @return string 
     */
    public function getDegree()
    {
        return $this->degree;
    }

    /**
     * Set skills
     *
     * @param string $skills
     * @return User
     */
    public function setSkills($skills)
    {
        $this->skills = $skills;

        return $this;
    }

    /**
     * Get skills
     *
     * @return string 
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * Set tasks
     *
     * @param string $tasks
     * @return User
     */
    public function setTasks($tasks)
    {
        $this->tasks = $tasks;

        return $this;
    }

    /**
     * Get tasks
     *
     * @return string 
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * Set cv
     *
     * @param string $cv
     * @return User
     */
    public function setCv($cv)
    {
        $this->cv = $cv;

        return $this;
    }

    /**
     * Get cv
     *
     * @return string 
     */
    public function getCv()
    {
        return $this->cv;
    }

    /**
     * Set linkedin
     *
     * @param string $linkedin
     * @return User
     */
    public function setLinkedin($linkedin)
    {
        $this->linkedin = $linkedin;

        return $this;
    }

    /**
     * Get linkedin
     *
     * @return string 
     */
    public function getLinkedin()
    {
        return $this->linkedin;
    }

    /**
     * Add sectors
     *
     * @param \TGC\AdminBundle\Entity\Sector $sectors
     * @return User
     */
    public function addSector(\TGC\AdminBundle\Entity\Sector $sectors)
    {
        $this->sectors[] = $sectors;

        return $this;
    }

    /**
     * Remove sectors
     *
     * @param \TGC\AdminBundle\Entity\Sector $sectors
     */
    public function removeSector(\TGC\AdminBundle\Entity\Sector $sectors)
    {
        $this->sectors->removeElement($sectors);
    }

    /**
     * Get sectors
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSectors()
    {
        return $this->sectors;
    }

    /**
     * Set photo
     *
     * @param string $photo
     * @return User
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return User
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    
        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return User
     */
    public function setCreated($created)
    {
        $this->created = $created;
    
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @var string
     */
    private $description;

    /**
     * @var array
     */
    private $bio;


    /**
     * Set description
     *
     * @param string $description
     * @return User
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
     * Set bio
     *
     * @param array $bio
     * @return User
     */
    public function setBio($bio)
    {
        $this->bio = $bio;
    
        return $this;
    }

    /**
     * Get bio
     *
     * @return array 
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Add addresses
     *
     * @param \TGC\AdminBundle\Entity\Address $addresses
     * @return User
     */
    public function addAddresse(\TGC\AdminBundle\Entity\Address $addresses)
    {
        $this->addresses[] = $addresses;
    
        return $this;
    }

    /**
     * Remove addresses
     *
     * @param \TGC\AdminBundle\Entity\Address $addresses
     */
    public function removeAddresse(\TGC\AdminBundle\Entity\Address $addresses)
    {
        $this->addresses->removeElement($addresses);
    }
    /**
     * @var string
     */
    private $clubName;


    /**
     * Set clubName
     *
     * @param string $clubName
     * @return User
     */
    public function setClubName($clubName)
    {
        $this->clubName = $clubName;
    
        return $this;
    }

    /**
     * Get clubName
     *
     * @return string 
     */
    public function getClubName()
    {
        return $this->clubName;
    }
    /**
     * @var \TGC\AdminBundle\Entity\Invitation
     */
    private $invitation;


    /**
     * Set invitation
     *
     * @param \TGC\AdminBundle\Entity\Invitation $invitation
     * @return User
     */
    public function setInvitation(\TGC\AdminBundle\Entity\Invitation $invitation = null)
    {
        $this->invitation = $invitation;
    
        return $this;
    }

    /**
     * Get invitation
     *
     * @return \TGC\AdminBundle\Entity\Invitation 
     */
    public function getInvitation()
    {
        return $this->invitation;
    }
    /**
     * @var string
     */
    private $website;


    /**
     * Set website
     *
     * @param string $website
     * @return User
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    
        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }
    /**
     * @var array
     */
    private $locations;


    /**
     * Set locations
     *
     * @param array $locations
     * @return User
     */
    public function setLocations($locations)
    {
        $this->locations = $locations;
    
        return $this;
    }

    /**
     * Get locations
     *
     * @return array 
     */
    public function getLocations()
    {
        return $this->locations;
    }
}