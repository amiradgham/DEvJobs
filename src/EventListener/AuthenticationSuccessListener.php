<?php

namespace App\EventListener;

use Stripe\Stripe;
use App\Entity\User;
use App\Entity\Doctor;
use App\Entity\Patient;
use App\Entity\UserType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * AuthenticationSuccessListener
 */
class AuthenticationSuccessListener extends Controller
{
     /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var ParameterBagInterface
     */
    private $params;


    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param AuthenticationSuccessEvent $event
     */

    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
      
        
        $data = $event->getData();
        $user = $event->getUser();
       
        $data['id'] = $user->getId();
        $data['userType'] = $user->getUserType();
        $data['username'] = $user->getUsername();
        $data['email'] = $user->getEmail();
        $data['gender'] = $user->getGender();
        $data['phone'] = $user->getPhone();
        $data['birthDate'] = $user->getBirthDate();
        $data['picture'] = $user->getPicture();
        $data['address'] = $user->getAddress();
        $data['zipCode'] = $user->getZipCode();
        $data['city'] = $user->getCity();
        $data['country'] = $user->getCountry();
        $event->setData($data);
    }
}