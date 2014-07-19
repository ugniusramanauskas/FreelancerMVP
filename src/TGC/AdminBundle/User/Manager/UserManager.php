<?php

/**
 * 
 */

namespace TGC\AdminBundle\User\Manager;

use Doctrine\Common\Persistence\ObjectManager;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManager as BaseUserManager;
use FOS\UserBundle\Util\CanonicalizerInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

use TGC\AdminBundle\Entity\User;

use FOS\UserBundle\Doctrine\UserManager as FOSUserManager;

class UserManager extends FOSUserManager
{
	public function __construct(EncoderFactoryInterface $encoderFactory, 
        CanonicalizerInterface $usernameCanonicalizer, 
        CanonicalizerInterface $emailCanonicalizer, 
        ObjectManager $om, 
        $class)
	{
		parent::__construct($encoderFactory, $usernameCanonicalizer, $emailCanonicalizer, $om, $class);
	}

	/**
	 * @param $populateData array
	 */
	function populateUser(User $user, $populateData)
	{
        // var_dump($populateData);
        # Transform Skills array into a flat array of strings
        foreach ($populateData['skills']['values'] as $key => $value) {
             $populateData['skill_array'][] = $value['skill']['name'];
         } 

        $user->setFirstName($populateData['firstName']);
        $user->setLastName($populateData['lastName']);
        $user->setEmail($populateData['emailAddress']);
        $user->setLocation($populateData['location']['name']);
        $user->setSkills($populateData['skill_array']);
        // $user->setPhone($populateData['phone-numbers']);

        return $this;
	}
}