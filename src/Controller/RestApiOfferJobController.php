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
        $user = $this->getUser();
      if ( $user != null){
        if ($user->getUserType() === UserType::TYPE_COMPANY) {
            $data = array(
                'id' => $user->getId(),
            );
            $repository =  $this->getDoctrine()->getRepository(JobsOffers::class);
            $offer = $repository->findBy(array('remove' => false,'created_by' => $data ), array('id' => 'DESC'));
            if (!empty($offer)) {
                return View::create($offer, JsonResponse::HTTP_OK, []);
            } else {
                return View::create('no jobs found', JsonResponse::HTTP_OK);
            }
        }
    }
        else{
            $repository =  $this->getDoctrine()->getRepository(JobsOffers::class);
            $offer = $repository->findBy(array('remove' => false), array('id' => 'DESC'));
            if (!empty($offer)) {
                return View::create($offer, JsonResponse::HTTP_OK, []);
            } else {
                return View::create('no jobs found', JsonResponse::HTTP_OK);
            }
        }
    }

     /**
     * @Rest\Get("/api/jobs/{id}", name ="search_jobs")
     * @Rest\View(serializerGroups={"users"})
     */
    public function jobsbyid($id)
    {
        $user = $this->getUser();
        $data = array(
            'id' => $user->getId(),
        );
        if ($user->getUserType() === UserType::TYPE_COMPANY) {
        $repository =  $this->getDoctrine()->getRepository(JobsOffers::class);
        $jobs = $repository->findOneBy(array('id' => $id,'remove' => false,'created_by' => $data ));
            if (!is_null($jobs)) {
                return View::create($jobs, JsonResponse::HTTP_OK, []);
            } else {
                return View::create('jobs not Found', JsonResponse::HTTP_NOT_FOUND);
            }
         }else{
            $repository =  $this->getDoctrine()->getRepository(JobsOffers::class);
            $jobs = $repository->findOneBy(array('id' => $id,'remove' => false));
                if (!is_null($jobs)) {
                    return View::create($jobs, JsonResponse::HTTP_OK, []);
                } else {
                    return View::create('jobs not Found', JsonResponse::HTTP_NOT_FOUND);
                }
         }
        }
    /**
     * @Rest\Post("/api/jobs", name ="post_jobs")
     * @Rest\View(serializerGroups={"users"})
     */
    public function create(Request $request, EntityManagerInterface $entity)
    {
        $user = $this->getUser();
            $NameOffer = $request->request->get('name_offer');
            $typeNameOffer = gettype($NameOffer);
            $offer = new JobsOffers();
            if (isset($NameOffer)) {
                if ($typeNameOffer == "string") {
                    $offer->setNameOffer($NameOffer);
                } else {
                    return View::create('offer name must be a string', JsonResponse::HTTP_BAD_REQUEST);
                }
            } else {
                return View::create('missing name of offer !!', JsonResponse::HTTP_BAD_REQUEST);
            }
            $Description = $request->request->get('description');
            $typeDescription= gettype($Description);
            if (isset($Description)) {
                if ($typeDescription == "string") {
                    $offer->setDescription($Description);
                } else {
                    return View::create('offer Description must be a string', JsonResponse::HTTP_BAD_REQUEST);
                }
            } else {
                return View::create('you should add the Description', JsonResponse::HTTP_BAD_REQUEST);
            }
            $PostVacon = $request->request->get('post_vacont');
            if (isset($PostVacon)) {
             $offer->setPostVacont($PostVacon);  
            }
         else {
            return View::create('you should add the PostVacon ', JsonResponse::HTTP_BAD_REQUEST);
        }
            $Type = $request->request->get('type');
            if (isset($Type)) {
             $offer->setType($Type);
            }
            else {
                return View::create('you should add the Type ', JsonResponse::HTTP_BAD_REQUEST);
            }
            $Experience = $request->request->get('experience');
            if (isset($Experience)) {
             $offer->setExperience($Experience);
            }
            else {
                return View::create('you should add the Experience ', JsonResponse::HTTP_BAD_REQUEST);
            }
            $ExperiationDate = $request->request->get('experiation_date');
            if (isset($ExperiationDate)) {
             $offer->setExperiationDate(new \DateTime($ExperiationDate));
            }
            else {
                return View::create('you should add the ExperiationDate ', JsonResponse::HTTP_BAD_REQUEST);
            }
            $Language = $request->request->get('language');
            if (isset($Language)) {
             $offer->setLanguage($Language);
            }
            $City = $request->request->get('city');
            if (isset($City)) {
             $offer->setCity($City);
            }
            $Competence = $request->request->get('competence');
            if (isset($Competence)) {
             $offer->setCompetence($Competence);
            }
            $Salary = $request->request->get('salary');
            if (isset($Salary)) {
             $offer->setSalary($Salary);
            }
            $FormationType = $request->request->get('formation_type');
            if (isset($FormationType)) {
             $offer->setFormationType($FormationType);
            }
            $ContractType = $request->request->get('contract_type');
            if (isset($ContractType)) {
             $offer->setContractType($ContractType);
            }
            else {
                return View::create('you should add the ContractType ', JsonResponse::HTTP_BAD_REQUEST);
            }
            $Mission = $request->request->get('mission');
            if (isset($Mission)) {
             $offer->setMission($Mission);
            }
            else {
                return View::create('you should add the Mission ', JsonResponse::HTTP_BAD_REQUEST);
            }
            $Address = $request->request->get('address');
            if (isset($Address)) {
             $offer->setAddress($Address);
            }
            else {
                return View::create('you should add the Address ', JsonResponse::HTTP_BAD_REQUEST);
            }
            $NiveauEtude = $request->request->get('niveau_etude');
            if (isset($NiveauEtude)) {
             $offer->setNiveauEtude($NiveauEtude);
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
     * @Rest\Patch("/api/jobs/{id}", name ="patch_jobs")
     * @Rest\View(serializerGroups={"users"})
     */
    public function updateJobss(Request $request, EntityManagerInterface $entity, $id)
    {
        $user = $this->getUser();
        $repository = $this->getDoctrine()->getRepository(JobsOffers::class);
        $offer = $repository->findOneBy(array('id' => $id, 'created_by' => $user->getId(), 'remove' => false));
        if (!is_null($offer)) {
            $NameOffer = $request->request->get('name_offer');
            $typeNameOffer = gettype($NameOffer);
            if (isset($NameOffer)) {
                if ($typeNameOffer == "string") {
                    $offer->setNameOffer($NameOffer);
                } else {
                    return View::create('offer name must be a string', JsonResponse::HTTP_BAD_REQUEST);
                }
            } 
            $Description = $request->request->get('description');
            $typeDescription= gettype($Description);
            if (isset($Description)) {
                if ($typeDescription == "string") {
                    $offer->setDescription($Description);
                } else {
                    return View::create('offer Description must be a string', JsonResponse::HTTP_BAD_REQUEST);
                }
            }
            $PostVacon = $request->request->get('post_vacont');
            if (isset($PostVacon)) {
             $offer->setPostVacont($PostVacon);  
            }
            $Type = $request->request->get('type');
            if (isset($Type)) {
             $offer->setType($Type);
            }
            $Experience = $request->request->get('experience');
            if (isset($Experience)) {

                
             $offer->setExperience($Experience);
            }
          
            $ExperiationDate = $request->request->get('experiation_date');
            if (isset($ExperiationDate)) {
             $offer->setExperiationDate(new \DateTime($ExperiationDate));
            }
           
            $Language = $request->request->get('language');
            if (isset($Language)) {
             $offer->setLanguage($Language);
            }
            $City = $request->request->get('city');
            if (isset($City)) {
             $offer->setCity($City);
            }
            $Competence = $request->request->get('competence');
            if (isset($Competence)) {
             $offer->setCompetence($Competence);
            }
            $Salary = $request->request->get('salary');
            if (isset($Salary)) {
             $offer->setSalary($Salary);
            }
            $FormationType = $request->request->get('formation_type');
            if (isset($FormationType)) {
             $offer->setFormationType($FormationType);
            }
            $ContractType = $request->request->get('contract_type');
            if (isset($ContractType)) {
             $offer->setContractType($ContractType);
            }
          
            $Mission = $request->request->get('mission');
            if (isset($Mission)) {
             $offer->setMission($Mission);
            }
        
            $Address = $request->request->get('address');
            if (isset($Address)) {
             $offer->setAddress($Address);
            }
            $NiveauEtude = $request->request->get('niveau_etude');
            if (isset($NiveauEtude)) {
             $offer->setNiveauEtude($NiveauEtude);
            }
            $entity->persist($offer);
            $entity->flush();
            $response = array(
                'message' => 'offer updated',
                'result' => $offer,
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
     * @Rest\Post("/api/jobs/picture/{id}", name ="uploqd_jobspia")
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
     * @Rest\Delete("/api/jobs/{id}", name ="delete_jobs")
     */
    public function delete($id)
    {
        $user = $this->getUser();
            $repository = $this->getDoctrine()->getRepository(JobsOffers::class);
            $jobs = $repository->findOneBy(array('id' => $id, 'created_by' => $user->getId(), 'remove' => false));
            if (!is_null($jobs)) {
                $jobs->setRemove(true);
                $jobs->setDeletedBy($user);
                $jobs->setDeletedAt(new \DateTime());
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                return View::create('jobs deleted', JsonResponse::HTTP_OK, []);
            } else {
                return View::create('jobs not Found', JsonResponse::HTTP_NOT_FOUND);
            }
     
    }

}
