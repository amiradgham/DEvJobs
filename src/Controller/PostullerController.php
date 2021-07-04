<?php

namespace App\Controller;

use DateTime;
use Exception;
use App\Entity\User;
use App\Entity\Device;
use App\Entity\Postuler;
use App\Entity\UserType;
use App\Entity\JobsOffers;
use App\Entity\Notification;
use App\Entity\Informaticien;
use FOS\RestBundle\View\View;
use App\Entity\DoctorAssignement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostullerController extends AbstractController
{ 
      /**
    * @Rest\Get("/api/postuler", name ="apii_countrys")
    * @Rest\View(serializerGroups={"users"})
    */
    public function getPostResult(): Response
    {
        $user = $this->getUser();
        $data = array(
            'id' => $user->getId(),
        );
        if ($user->getUserType() === UserType::TYPE_COMPANY) {
            $repository =  $this->getDoctrine()->getRepository(Postuler::class);
            $offer = $repository->findBy(array('remove' => false,'societe' => $data ), array('id' => 'DESC'));
            if (!empty($offer)) {
                return View::create($offer, JsonResponse::HTTP_OK, []);
            } else {
                return View::create('no one apply found', JsonResponse::HTTP_OK);
            }
        }
    }
       /**
     * @Rest\Post("/api/postuler", name ="post_postuler")
     * @Rest\View(serializerGroups={"users"})
     */
    public function create(Request $request, EntityManagerInterface $entity)
    {
        $user = $this->getUser();

        $repository =  $this->getDoctrine()->getRepository(Informaticien::class);
        $createBY = $repository->findOneBy(array('created_by' => $user->getId() ));   
            $NameOffer = $request->request->get('type');
            $typeNameOffer = gettype($NameOffer);
            $offer = new Postuler();
            if (isset($NameOffer)) {
                if ($typeNameOffer == "string") {
                    $offer->setType($NameOffer);
                } else {
                    return View::create('offer name must be a string', JsonResponse::HTTP_BAD_REQUEST);
                }
            } else {
                return View::create('missing name of offer !!', JsonResponse::HTTP_BAD_REQUEST);
            }
            $id = $request->request->get('entreprise');
            if (isset($id)) {
                $repository =  $this->getDoctrine()->getRepository(User::class);
                $checksociete = $repository->findOneBy(array('id' => $id ));   
             if   (!empty($checksociete)) {
                 $offer->setEntreprise($checksociete);
             }

          } else {
                return View::create('you should add the id of entreprise', JsonResponse::HTTP_BAD_REQUEST);
            }

            $OfferId = $request->request->get('OfferId');
            if (isset($OfferId)) {
                $repository =  $this->getDoctrine()->getRepository(JobsOffers::class);
                $checkJob = $repository->findOneBy(array('id' => $OfferId ));   
             if   (!empty($checkJob)) {
                 $offer-> setOfferId($checkJob);
             }

          } else {
                return View::create('you should add the id of offer', JsonResponse::HTTP_BAD_REQUEST);
            }
            
            $offer->setCreatedBy($createBY);
            $offer->setCreatedAt(new \DateTime());
            $entity->persist($offer);
            $entity->flush();
            $response = array(
                'message' => 'postuler avec succee',
                'result' => $offer,
            );
            return View::create($response, JsonResponse::HTTP_CREATED, []);
    }

}
