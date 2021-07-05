<?php

namespace App\Controller;


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
use App\Entity\TrainingOffer;
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

class RestApiTrainingOfferController extends FOSRestController
{
    /**
     * @Rest\Get("/trainings", name ="api_training")
     * @Rest\View(serializerGroups={"users"})
     */
    public function getTraining()
    {
            $repository =  $this->getDoctrine()->getRepository(TrainingOffer::class);
            $trailling = $repository->findBy(array('remove' => false), array('id' => 'DESC'));
            if (!empty($trailling)) {
                return View::create($trailling, JsonResponse::HTTP_OK, []);
            } else {
                return View::create('no training found', JsonResponse::HTTP_OK);
            }
    }
/**
     * @Rest\Get("/api/entreprise", name ="api_entreprise")
     * @Rest\View(serializerGroups={"users"})
     */
    public function getEntreprise()
    {
            $repository =  $this->getDoctrine()->getRepository(Societe::class);
            $trailling = $repository->findAll();
            if (!empty($trailling)) {
                return View::create($trailling, JsonResponse::HTTP_OK, []);
            } else {
                return View::create('no entreprise found', JsonResponse::HTTP_OK);
            }
    }
     /**
     * @Rest\Get("/api/trainings/{id}", name ="search_training")
     * @Rest\View(serializerGroups={"users"})
     */
    public function Trainingbyid($id)
    {
        $repository =  $this->getDoctrine()->getRepository(TrainingOffer::class);
        $trailling = $repository->findOneBy(array('id' => $id,'remove' => false));
            if (!is_null($trailling)) {
                return View::create($trailling, JsonResponse::HTTP_OK, []);
            } else {
                return View::create('trailling not Found', JsonResponse::HTTP_NOT_FOUND);
            }
         }
    /**
     * @Rest\Post("/api/trainings", name ="post_training")
     * @Rest\View(serializerGroups={"users"})
     */
    public function createTraining(Request $request, EntityManagerInterface $entity)
    {
        $user = $this->getUser();
            $TraningName = $request->request->get('traning_name');
            $typeTraningName = gettype($TraningName);
            $training = new TrainingOffer();
            if (isset($TraningName)) {
                if ($typeTraningName == "string") {
                    $training->setTraningName($typeTraningName);
                } else {
                    return View::create('TraningName must be a string', JsonResponse::HTTP_BAD_REQUEST);
                }
            } else {
                return View::create('missing name of TraningName !!', JsonResponse::HTTP_BAD_REQUEST);
            }
            $TrainingDescription = $request->request->get('training_description');
            $typeTrainingDescription = gettype($TrainingDescription);
            if (isset($TrainingDescription)) {
                if ($typeTrainingDescription == "string") {
                    $training->setTrainingDescription($TrainingDescription);
                } else {
                    return View::create('TrainingDescription must be a string', JsonResponse::HTTP_BAD_REQUEST);
                }

            } else {
                return View::create('you should add the Description', JsonResponse::HTTP_BAD_REQUEST);
            }
            $TrainingModality = $request->request->get('training_modality');
            if (isset($TrainingModality)) {
             $training->setTrainingModality($TrainingModality);  
            }
            $TrainingObjectif = $request->request->get('training_objectif');
            if (isset($TrainingObjectif)) {
             $training->setTrainingObjectif($TrainingObjectif);
            }
            $HourlyVolume = $request->request->get('hourly_volume');
            if (isset($HourlyVolume)) {
             $training->setHourlyVolume($HourlyVolume+"heures");
            }
            $TraningCost = $request->request->get('traning_cost');
            if (isset($TraningCost)) {
             $training->setTraningCost($TraningCost);
            }
            $City = $request->request->get('city');
            if (isset($City)) {
             $training->setCity($City);
            }
            else{
                return View::create('you should add the city', JsonResponse::HTTP_BAD_REQUEST);

            }
            $Address = $request->request->get('address');
            if (isset($Address)) {
             $training->setAddress($Address);
            }
            $TrainingDuration = $request->request->get('training_duration');
            if (isset($TrainingDuration)) {
             $training->setTrainingDuration($TrainingDuration);
            }
            $training->setCreatedBy($user);
            $training->setCreatedAt(new \DateTime());
            $training->setRemove(false);
            $entity->persist($training);
            $entity->flush();
            $response = array(
                'message' => 'offer created',
                'result' => $training
            );
            return View::create($response, JsonResponse::HTTP_CREATED, []);
    }
   /**
     * @Rest\Patch("/api/trainings/{id}", name ="patch_tarining")
     * @Rest\View(serializerGroups={"users"})
     */
    public function updateJobss(Request $request, EntityManagerInterface $entity, $id)
    {
        $user = $this->getUser();
        $repository = $this->getDoctrine()->getRepository(TrainingOffer::class);
        $training = $repository->findOneBy(array('id' => $id, 'createdBy' => $user->getId(), 'remove' => false));
        if (!is_null($training)) {
            $TraningName = $request->request->get('traning_name');
            $typeTraningName = gettype($TraningName);
            if (isset($TraningName)) {
                if ($typeTraningName == "string") {
                    $training->setTraningName($typeTraningName);
                } else {
                    return View::create('TraningName must be a string', JsonResponse::HTTP_BAD_REQUEST);
                }
            } else {
                return View::create('missing name of TraningName !!', JsonResponse::HTTP_BAD_REQUEST);
            }
            $TrainingDescription = $request->request->get('training_description');
            $typeTrainingDescription = gettype($TrainingDescription);
            if (isset($TrainingDescription)) {
                if ($typeTrainingDescription == "string") {
                    $training->setTrainingDescription($TrainingDescription);
                } else {
                    return View::create('TrainingDescription must be a string', JsonResponse::HTTP_BAD_REQUEST);
                }

            } else {
                return View::create('you should add the Description', JsonResponse::HTTP_BAD_REQUEST);
            }
            $TrainingModality = $request->request->get('training_modality');
            if (isset($TrainingModality)) {
             $training->setTrainingModality($TrainingModality);  
            }
            $TrainingObjectif = $request->request->get('training_objectif');
            if (isset($TrainingObjectif)) {
             $training->setTrainingObjectif($TrainingObjectif);
            }
            $HourlyVolume = $request->request->get('hourly_volume');
            if (isset($HourlyVolume)) {
             $training->setHourlyVolume($HourlyVolume);
            }
            $TraningCost = $request->request->get('traning_cost');
            if (isset($TraningCost)) {
             $training->setTraningCost($TraningCost);
            }
            $City = $request->request->get('city');
            if (isset($City)) {
             $training->setCity($City);
            }
            else{
                return View::create('you should add the city', JsonResponse::HTTP_BAD_REQUEST);

            }
            $Address = $request->request->get('address');
            if (isset($Address)) {
             $training->setAddress($Address);
            }
            $TrainingDuration = $request->request->get('training_duration');
            if (isset($TrainingDuration)) {
             $training->setTrainingDuration($TrainingDuration);
            }
            $entity->persist($training);
            $entity->flush();
            $response = array(
                'message' => 'training updated',
                'result' => $training,
            );
            return View::create($response, JsonResponse::HTTP_CREATED, []);
            //end of if
    }else{
        return View::create('this offer not exist', JsonResponse::HTTP_BAD_REQUEST);
    }
}
    

     /**
     * @param Request $request
     * @return JsonResponse
     * @Rest\Post("/api/trainings/picture/{id}", name ="uploqd_trainingImg")
     * @Rest\View(serializerGroups={"users"})
     */
    public function uploadTrainingImage($id, Request $request)
    {
        $user = $this->getUser();
        $repository =  $this->getDoctrine()->getRepository(TrainingOffer::class);
        $offer = $repository->findOneBy(array('id' => $id, 'created_by' => $user->getId(), 'remove' => false));
            if (!is_null($offer)) {
                $uploadedImage = $request->files->get('picture');
                if (!is_null($uploadedImage)) {
                    /**
                     * @var UploadedFile $image
                     */
                    $image = $uploadedImage;
                    $imageName = md5(uniqid()) . '.' . $image->guessExtension();
                    $type = $image->getType();
                    $size = $image->getSize();
                    $imagetype = $image->guessExtension();
                    $path = $this->getParameter('image_directory');
                    $serveur_ip = gethostbyname(gethostname());
                    $path_uplaod = 'offers/';
                    if ($imagetype == "jpeg" || $imagetype == "png") {
                        $image->move($path_uplaod, $imageName);
                        $image_url = $path_uplaod . $imageName;
                        $offer->setPicture($image_url);
                        $offer->setUpdatedBy($user);
                        $offer->setUpdatedAt(new \DateTime());
                        $em = $this->getDoctrine()->getManager();
                        $em->flush();
                        $response = array(
                            'message' => 'training updated',
                            'result' => $offer,
                        );
                        return View::create($response, JsonResponse::HTTP_OK, []);
                    } else {
                        return View::create('there is something wrong with this file!,select picture!', JsonResponse::HTTP_BAD_REQUEST, []);
                    }
                } else {
                    return View::create('picture is missing!', JsonResponse::HTTP_BAD_REQUEST, []);
                }
            } else {
                return View::create('offer not Found', JsonResponse::HTTP_NOT_FOUND);
            }
    }
     /**
     * @Rest\Delete("/api/trainings/{id}", name ="delete_training")
     */
    public function deleteTraining($id)
    {
        $user = $this->getUser();
            $repository = $this->getDoctrine()->getRepository(TrainingOffer::class);
            $jobs = $repository->findOneBy(array('id' => $id, 'remove' => false));
            if (!is_null($jobs)) {
                $jobs->setRemove(true);
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                return View::create('formation deleted', JsonResponse::HTTP_OK, []);
            } else {
                return View::create('formation not Found', JsonResponse::HTTP_NOT_FOUND);
            }
    }
}
