<?php

namespace App\Controller;

use App\Entity\UserType;
use App\Entity\JobsOffers;
use App\Entity\Speciality;
use App\Entity\Informaticien;
use FOS\RestBundle\View\View;
use App\Entity\StageFormation;
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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StageFormationController extends FOSRestController
{
    /**
     * @Rest\Get("/stage", name ="api_stage")
     * @Rest\View(serializerGroups={"users"})
     */
    public function getjobs()
    {
        $user = $this->getUser();
      if ($user !=null){
        if ($user->getUserType() === UserType::TYPE_COMPANY) {
            $data = array(
                'id' => $user->getId(),
            );
            $repository =  $this->getDoctrine()->getRepository(StageFormation::class);
            $offer = $repository->findBy(array('remove' => false,'createdBy' => $data ), array('id' => 'DESC'));
            if (!empty($offer)) {
                return View::create($offer, JsonResponse::HTTP_OK, []);
            } else {
                return View::create('no stage found', JsonResponse::HTTP_OK);
            }
        }
    }
        else{
            $repository =  $this->getDoctrine()->getRepository(StageFormation::class);
            $offer = $repository->findBy(array('remove' => false ), array('id' => 'DESC'));
            if (!empty($offer)) {
                return View::create($offer, JsonResponse::HTTP_OK, []);
            } else {
                return View::create('no satge found', JsonResponse::HTTP_OK);
            }
        }
    }

     /**
     * @Rest\Get("/api/stage/{id}", name ="search_stage")
     * @Rest\View(serializerGroups={"users"})
     */
    public function jobsbyid($id)
    {
        $user = $this->getUser();
        $data = array(
            'id' => $user->getId(),
        );
        if ($user->getUserType() === UserType::TYPE_COMPANY) {
        $repository =  $this->getDoctrine()->getRepository(StageFormation::class);
        $jobs = $repository->findOneBy(array('id' => $id,'remove' => false,'createdBy' => $data ));
            if (!is_null($jobs)) {
                return View::create($jobs, JsonResponse::HTTP_OK, []);
            } else {
                return View::create('stage not Found', JsonResponse::HTTP_NOT_FOUND);
            }
         }else{
            $repository =  $this->getDoctrine()->getRepository(StageFormation::class);
            $jobs = $repository->findOneBy(array('id' => $id,'remove' => false));
                if (!is_null($jobs)) {
                    return View::create($jobs, JsonResponse::HTTP_OK, []);
                } else {
                    return View::create('stage not Found', JsonResponse::HTTP_NOT_FOUND);
                }
         }
        }
    /**
     * @Rest\Post("/api/stage", name ="post_stage")
     * @Rest\View(serializerGroups={"users"})
     */
    public function create(Request $request, EntityManagerInterface $entity)
    {
        $user = $this->getUser();
            $NomSujet = $request->request->get('nom_sujet');
            $offer = new StageFormation();
            if (isset($NomSujet)) {
                    $offer->setNomSujet($NomSujet);
            } else {
                return View::create('missing name of stage !!', JsonResponse::HTTP_BAD_REQUEST);
            }
            $Description = $request->request->get('description');
            if (isset($Description)) {
                    $offer->setDescription($Description);
            } else {
                return View::create('you should add the Description', JsonResponse::HTTP_BAD_REQUEST);
            }
            $postVacon = $request->request->get('post_vacon');
            if (isset($postVacon)) {
             $offer->setPostVacon($postVacon);  
            }
         else {
            return View::create('you should add the PostVacon ', JsonResponse::HTTP_BAD_REQUEST);
        }
            $technology = $request->request->get('technology');
            if (isset($technology)) {
             $offer->setTechnology($technology);
            }
            else {
                return View::create('you should add the technology ', JsonResponse::HTTP_BAD_REQUEST);
            }
            $Competence = $request->request->get('competence');
            if (isset($Competence)) {
             $offer->setCompetence($Competence);
            }
            else {
                return View::create('you should add the competence ', JsonResponse::HTTP_BAD_REQUEST);
            }
            $dateExperation = $request->request->get('date_experation');
            if (isset($dateExperation)) {
             $offer->setDateExperation(new \DateTime($dateExperation));
            }
            else {
                return View::create('you should add the dateExperation ', JsonResponse::HTTP_BAD_REQUEST);
            }
            $offer->setCreatedBy($user);
            $offer->setCreatedAt(new \DateTime());
            $offer->setRemove(false);
            $entity->persist($offer);
            $entity->flush();
            $response = array(
                'message' => 'stage created',
                'result' => $offer,
            );
            return View::create($response, JsonResponse::HTTP_CREATED, []);
    }

    /**
     * @Rest\Patch("/api/stage/{id}", name ="patch_stage")
     * @Rest\View(serializerGroups={"users"})
     */
    public function updateJobss(Request $request, EntityManagerInterface $entity, $id)
    {
        $user = $this->getUser();
        $repository = $this->getDoctrine()->getRepository(StageFormation::class);
        $offer = $repository->findOneBy(array('id' => $id, 'createdBy' => $user->getId(), 'remove' => false));
        if (!is_null($offer)) {
            if (isset($NomSujet)) {
                $offer->setNomSujet($NomSujet);
        } else {
            return View::create('missing name of stage !!', JsonResponse::HTTP_BAD_REQUEST);
        }
        $Description = $request->request->get('description');
        if (isset($Description)) {
                $offer->setDescription($Description);
        } else {
            return View::create('you should add the Description', JsonResponse::HTTP_BAD_REQUEST);
        }
        $postVacon = $request->request->get('postVacon');
        if (isset($postVacon)) {
         $offer->setPostVacon($postVacon);  
        }
     else {
        return View::create('you should add the PostVacon ', JsonResponse::HTTP_BAD_REQUEST);
    }
        $technology = $request->request->get('technology');
        if (isset($technology)) {
         $offer->setTechnology($technology);
        }
        else {
            return View::create('you should add the technology ', JsonResponse::HTTP_BAD_REQUEST);
        }
        $Competence = $request->request->get('competence');
        if (isset($Competence)) {
         $offer->setCompetence($Competence);
        }
        else {
            return View::create('you should add the competence ', JsonResponse::HTTP_BAD_REQUEST);
        }
        $dateExperation = $request->request->get('dateExperation');
        if (isset($dateExperation)) {
         $offer->setDateExperation(new \DateTime($dateExperation));
        }
        else {
            return View::create('you should add the dateExperation ', JsonResponse::HTTP_BAD_REQUEST);
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
     * @Rest\Post("/api/stage/picture/{id}", name ="uploqd_stagePicture")
     * @Rest\View(serializerGroups={"users"})
     */
    public function uploadOfferImage($id, Request $request)
    {
        $user = $this->getUser();
        $repository =  $this->getDoctrine()->getRepository(StageFormation::class);
        $offer = $repository->findOneBy(array('id' => $id, 'createdBy' => $user->getId(), 'remove' => false));
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
                            'message' => 'offer updated',
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
     * @Rest\Delete("/api/stage/{id}", name ="delete_stage")
     */
    public function delete($id)
    {
        $user = $this->getUser();
            $repository = $this->getDoctrine()->getRepository(StageFormation::class);
            $jobs = $repository->findOneBy(array('id' => $id, 'createdBy' => $user->getId(), 'remove' => false));
            if (!is_null($jobs)) {
                $jobs->setRemove(true);
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                return View::create('jobs deleted', JsonResponse::HTTP_OK, []);
            } else {
                return View::create('jobs not Found', JsonResponse::HTTP_NOT_FOUND);
            }
     
    }

}
