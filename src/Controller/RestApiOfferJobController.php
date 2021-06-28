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

class RestApiOfferJobController extends FOSRestController
{
   /**
     * @Rest\Get("/jobs", name ="apii_countrys")
     * @Rest\View(serializerGroups={"users"})
     */
    public function getjobs()
    {
            $repository =  $this->getDoctrine()->getRepository(JobsOffers::class);
            $offer = $repository->findBy(array('remove' => false), array('id' => 'DESC'));
            if (!empty($offer)) {
                return View::create($offer, JsonResponse::HTTP_OK, []);
            } else {
                return View::create('no jobs found', JsonResponse::HTTP_OK);
            }
    }

     /**
     * @Rest\Get("/jobs/{id}", name ="search_jobs")
     * @Rest\View(serializerGroups={"users"})
     */
    public function jobsbyid($id)
    {
        $repository =  $this->getDoctrine()->getRepository(JobsOffers::class);
        $jobs = $repository->findOneBy(array('id' => $id,'remove' => false));
            if (!is_null($jobs)) {
                return View::create($jobs, JsonResponse::HTTP_OK, []);
            } else {
                return View::create('jobs not Found', JsonResponse::HTTP_NOT_FOUND);
            }
         }
    /**
     * @Rest\Post("/jobs", name ="post_jobs")
     * @Rest\View(serializerGroups={"users"})
     */
    public function create(Request $request, EntityManagerInterface $entity)
    {
        $user = $this->getUser();
            $NameOffer = $request->request->get('NameOffer');
            $typeNameOffer = gettype($NameOffer);
            $offer = new JobsOffers();
            if (isset($NameOffer)) {
                if ($typeNameOffer == "string") {
                    $offer->setNameOffer($name);
                } else {
                    return View::create('offer name must be a string', JsonResponse::HTTP_BAD_REQUEST);
                }
            } else {
                return View::create('missing name of offer !!', JsonResponse::HTTP_BAD_REQUEST);
            }
            $Description = $request->request->get('Description');
            $typeDescription= gettype($Description);
            if (isset($Description)) {
                if ($typeDescription == "string") {
                    $offer->setDescription($Description);
                } else {
                    return View::create('offer Description must be a string', JsonResponse::HTTP_BAD_REQUEST);
                }
            } else {
                return View::create('you should add the Description to the country', JsonResponse::HTTP_BAD_REQUEST);
            }
            $PostVacon = $request->request->get('PostVacon');
            if (isset($PostVacon)) {
             $offer->setPostVacont($PostVacon);  
            }
            $Type = $request->request->get('Type');
            if (isset($type)) {
             $offer->setType($prefix);
            }
            $Experience = $request->request->get('Experience');
            if (isset($Experience)) {
             $offer->setExperience($Experience);
            }
            $ExperiationDate = $request->request->get('ExperiationDate');
            if (isset($ExperiationDate)) {
             $offer->setExperiationDate($ExperiationDate);
            }
            $Language = $request->request->get('Language');
            if (isset($Language)) {
             $offer->setLanguage($Language);
            }
            $City = $request->request->get('City');
            if (isset($City)) {
             $offer->setCity($City);
            }
            $Competence = $request->request->get('Competence');
            if (isset($Competence)) {
             $offer->setCompetence($Competence);
            }
            $Salary = $request->request->get('Salary');
            if (isset($Salary)) {
             $offer->setSalary($Salary);
            }
            $FormationType = $request->request->get('FormationType');
            if (isset($FormationType)) {
             $offer->setFormationType($FormationType);
            }
            $ContractType = $request->request->get('ContractType');
            if (isset($ContractType)) {
             $offer->setContractType($ContractType);
            }
            $Mission = $request->request->get('Mission');
            if (isset($Mission)) {
             $offer->setMission($Mission);
            }
            $Address = $request->request->get('Address');
            if (isset($Mission)) {
             $offer->setAddress($Address);
            }
            $NiveauEtude = $request->request->get('NiveauEtude');
            if (isset($NiveauEtude)) {
             $offer->setNiveauEtude($NiveauEtude);
            }
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
                if ($imagetype == "jpeg" || $imagetype == "png" || $imagetype == "svg") {
                    $image->move($path_uplaod, $imageName);
                    $image_url = $path_uplaod . $imageName;
                    $offer->setPicture($image_url);
                } else {
                    return View::create('there is something wrong with this file!,select picture!', JsonResponse::HTTP_BAD_REQUEST, []);
                }
            }
            $offer->setCreatedBy($user);
            $offer->setCreatedAt(new \DateTime());
            $offer->setRemove(false);
            $entity->persist($offer);
            $entity->flush();
            $response = array(
                'message' => 'offer created',
                'result' => $offer,
            );
            return View::create($response, JsonResponse::HTTP_CREATED, []);
    }
     /**
     * @param Request $request
     * @return JsonResponse
     * @Rest\Post("/jobs/picture/{id}", name ="uploqd_jobspia")
     * @Rest\View(serializerGroups={"users"})
     */
    public function uploadOfferImage($id, Request $request)
    {
        $user = $this->getUser();
        $repository =  $this->getDoctrine()->getRepository(JobsOffers::class);
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
                            'message' => 'countofferry updated',
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
     * @Rest\Delete("/jobs/{id}", name ="delete_jobs")
     */
    public function delete($id)
    {
        $user = $this->getUser();
        if ($user->getUserType() === UserType::TYPE_ADMIN) {
            $repository = $this->getDoctrine()->getRepository(Country::class);
            $jobs = $repository->findOneBy(array('id' => $id, 'created_by' => $user->getId(), 'remove' => false));
            if (!is_null($jobs)) {
                $jobs->setRemove(true);
                $jobs->setRemovedBy($user);
                $jobs->setRemovedAt(new \DateTime());
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                return View::create('jobs deleted', JsonResponse::HTTP_OK, []);
            } else {
                return View::create('jobs not Found', JsonResponse::HTTP_NOT_FOUND);
            }
        } else {
            return View::create('Not Authorized', JsonResponse::HTTP_FORBIDDEN, []);
        }
    }

}
