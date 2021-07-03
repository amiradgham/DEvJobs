<?php

namespace App\Controller;

use App\Entity\Sector;

use DateTime;
use Exception;
use App\Entity\User;
use App\Entity\Doctor;
use App\Entity\Country;
use App\Entity\Societe;
use App\Entity\UserType;
use App\Entity\JobsOffers;
use App\Entity\Speciality;
use App\Entity\Informaticien;
use FOS\RestBundle\View\View;
use App\Entity\CenterFormation;
use Vich\UploaderBundle\Entity\File;
use JMS\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Validator\Constraints\Date;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;

class SectorController extends FOSRestController
{
    /**
     * @Rest\Get("/sector", name ="sector_api")
     * @Rest\View(serializerGroups={"users"})
     */
    public function getsector()
    {
            $repository =  $this->getDoctrine()->getRepository(Sector::class);
            $sector = $repository->findBy(array('remove' => false), array('id' => 'DESC'));
            if (!empty($sector)) {
                return View::create($sector, JsonResponse::HTTP_OK, []);
            } else {
                return View::create('no sector found', JsonResponse::HTTP_OK);
            }
    }
}
