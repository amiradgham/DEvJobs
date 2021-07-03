<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Entity\Doctor;
use App\Entity\Country;
use App\Entity\Patient;
use App\Entity\Societe;
use App\Entity\Hospital;
use App\Entity\UserType;
use App\Entity\Speciality;
use App\Entity\Informaticien;
use FOS\RestBundle\View\View;
use App\Entity\CenterFormation;
use App\Entity\DoctorAssignement;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RestApiUserController extends AbstractFOSRestController
{
   private $user = null;
   private $patient = null;
   private $doctor = null;
   private $hospital = null;
   /**
    * @Rest\Post("/api/user")
    * @Rest\View(serializerGroups={"admin"})
    */
   public function showUser()
   {
      $user = $this->getUser();
      $data = array(
         "id" => $user->getId()
      );
      if (($user->getUserType() === UserType::TYPE_ADMIN)) {
         $repository = $this->getDoctrine()->getRepository(User::class);
         $user = $repository->findAll(array("id" => "DESC", "remove" => false));
         if (!empty($user)) {
            return View::create($user, Response::HTTP_OK);
         } else {
            return View::create("No data found", JsonResponse::HTTP_OK, []);
         }
      }
   }

   private function checkPhone(Request $request)
   {
      $phone = $request->request->get("phone");
      if (isset($phone)) {
         $typephone = gettype($phone);
         if ($typephone === "string") {
            $this->user->setPhone($phone);
            return null;
         } else {
            return View::create("phone must be string", JsonResponse::HTTP_BAD_REQUEST, []);
         }
      } else {
         return View::create("Missing phone filed", JsonResponse::HTTP_BAD_REQUEST, []);
      }
   }

   private function checkGender(Request $request)
   {
      $gender = $request->request->get("gender");
      if (isset($gender)) {
         $typegender = gettype($gender);
         if ($typegender == "string") {
            if ($gender == "Male" || $gender == "Female") {
               $this->user->setGender($gender);
            } else {
               return View::create("Gender must be type of Male or Female", JsonResponse::HTTP_BAD_REQUEST, []);
            }
         } else {
            return View::create("gender must be string", JsonResponse::HTTP_BAD_REQUEST, []);
         }
      } else {
         return View::create("Missing gender type", JsonResponse::HTTP_BAD_REQUEST, []);
      }
   }
   private function checkCity(Request $request)
   {
      $city = $request->request->get("city");
      if (isset($city)) {
         $typecity = gettype($city);
         if ($typecity == "string") {
            $this->user->setCity($city);
         } else {
            return View::create("city must be string", JsonResponse::HTTP_BAD_REQUEST, []);
         }
      } else {
         return View::create("Missing city filed", JsonResponse::HTTP_BAD_REQUEST, []);
      }
   }

   private function checkBirth(Request $request)
   {

      $birth = $request->request->get("birth_date");
      if (isset($birth)) {
         $typebirth = gettype($birth);
         $this->user->setBirthDate(new \DateTime($birth));
      } else {
         return View::create("Missing birth_date filed", JsonResponse::HTTP_BAD_REQUEST, []);
      }
   }
   private function checkAddress(Request $request)
   {
      $address = $request->request->get("address");
      if (isset($address)) {
         $typeaddress = gettype($address);
         if ($typeaddress == "string") {
            $this->user->setAddress($address);
         } else {
            return View::create("address must be string", JsonResponse::HTTP_BAD_REQUEST, []);
         }
      } else {
         return View::create("Missing address filed", JsonResponse::HTTP_BAD_REQUEST, []);
      }
   }

   private function checkCountry(Request $request)
   {
      $country = $request->request->get("country");
      if (isset($country)) {
         $typecountry = gettype($country);
         if ($typecountry == "integer") {
            $repository = $this->getDoctrine()->getRepository(Country::class);
            $countryy = $repository->findOneBy(array("id" => $country, "remove" => false));
            if (!is_null($countryy)) {
               $this->user->setCountry($countryy);
            } else {
               return View::create("country not found", JsonResponse::HTTP_NOT_FOUND, []);
            }
         } else {
            return View::create("country must be type of Country", JsonResponse::HTTP_BAD_REQUEST, []);
         }
      
   } else {
      return View::create("missing country", JsonResponse::HTTP_BAD_REQUEST, []);
   }
   }

   private function checkUsername(Request $request)
   {
      $username = $request->request->get("username");
      if (isset($username)) {
         $typeusername = gettype($username);
         if ($typeusername == "string") {
            $this->user->setUsername($username);
         } else {
            return View::create("username must be string", JsonResponse::HTTP_BAD_REQUEST, []);
         }
      } else {
         return View::create("missing acount username", JsonResponse::HTTP_BAD_REQUEST, []);
      }
   }
   private function checkEmail(Request $request)
   {
      $email = $request->request->get("email");
      if (isset($email)) {
         $typeemail = gettype($email);
         if ($typeemail == "string") {
            $this->user->setEmail($email);
         } else {
            return View::create("email must be string", JsonResponse::HTTP_BAD_REQUEST, []);
         }
      } else {
         return View::create("missing acount email", JsonResponse::HTTP_BAD_REQUEST, []);
      }
   }




   private function checkWebSite(Request $request)
   {
      $website = $request->request->get("web_site");
      $typewebsite= gettype($website);
      if (isset($website)) {
         if ($typewebsite== "string") {
            $this->hospital->setWebSite($website);
         } else {
            return View::create("web_site should be string!", JsonResponse::HTTP_BAD_REQUEST, []);
         }
      }
   }

   private function checkLocation(Request $request)
   {
      $location = $request->request->get("location");
      $typewebsite= gettype($location);
      if (isset($location)) {
         if ($typelocation== "string") {
            $this->hospital->setLocation($location);
         } else {
            return View::create("location should be string!", JsonResponse::HTTP_BAD_REQUEST, []);
         }
      }
   }


   /**
    * @Rest\Post("/authRegister")
    * @Rest\View(serializerGroups={"users"})
    */
   public function create(Request $request, SerializerInterface $s, EntityManagerInterface $entity, UserPasswordEncoderInterface $encoder, ValidatorInterface $validator)
   {
      $this->user = new User();
      $r = $request->getContent();
      try {
         $usertype = $request->request->get("user_type");
         if (isset($usertype)) {

            if ($usertype == 'trainingManager' || $usertype == 'companyManager' || $usertype == 'userIT' || $usertype == 'admin') {

               $this->user->setUserType($usertype);
            } else {
               return View::create("user type must be one of trainingManager/companyManager/userIT/admin", JsonResponse::HTTP_BAD_REQUEST, []);
            }
         } else {
            return View::create("mising user_type", JsonResponse::HTTP_BAD_REQUEST, []);
         }
         $usertype = $request->request->get("user_type");
            $checkGenderResult = $this->checkGender($request);
            if (!is_null($checkGenderResult)) {
               return $checkGenderResult;
            }
            $checkBirthResult = $this->checkBirth($request);
            if (!is_null($checkBirthResult)) {
               return $checkBirthResult;
            }
            // $checkCountry= $this->checkCountry($request);
            // if (!is_null($checkCountry)) {
            //    return $checkCountry;
            // }
            $checkCityResult = $this->checkCity($request);
            if (!is_null($checkCityResult)) {
               return $checkCityResult;
            }
            $checkAdressResult = $this->checkAddress($request);
            if (!is_null($checkAdressResult)) {
               return $checkAdressResult;
            }

            $checkPhoneResult = $this->checkPhone($request);
            if (!is_null($checkPhoneResult)) {
               return $checkPhoneResult;
            }
            $checkUsernameResult = $this->checkUsername($request);
            if (!is_null($checkUsernameResult)) {
               return $checkUsernameResult;
            }
            $checkEmailResult = $this->checkEmail($request);
            if (!is_null($checkEmailResult)) {
               return $checkEmailResult;
            }
            $password = $request->request->get("password");
            if (isset($password)) {
               $hash = $encoder->encodePassword($this->user, $password);
               $this->user->setPassword($hash);
            } else {
               return View::create("missing acount password", JsonResponse::HTTP_BAD_REQUEST, []);
            }
         
            $qrcode = md5(uniqid());
            $this->user->setQRCode($qrcode);
            $this->user->setEnabled(true);
            $this->user->setSalt(base_convert(sha1(uniqid(mt_rand(), true)), 16, 36));
            $this->user->setCreatedAt(new \DateTime());
            $this->user->setRemove(false);
            $entity->persist($this->user);
            $entity->flush();
            if ($this->user->getUserType() == 'userIT'){
               $informaticien = new Informaticien();
               $informaticien->setCreatedBy($this->user);
               $informaticien->setCreatedAt(new \DateTime()); 
               $informaticien->setRecieveNotification(true);
               $entity->persist($informaticien);
               $entity->flush();
               return View::create($this->user, Response::HTTP_CREATED);
            }
            if ($this->user->getUserType()  == 'companyManager'){
               $societe = new Societe();
               $societe->setCreatedBy($this->user);
               $societe->setCreatedAt(new \DateTime()); 
               $entity->persist($societe);
               $entity->flush();
               return View::create($societe, Response::HTTP_CREATED);
            }
            if ($this->user->getUserType()  == 'trainingManager'){
               $centre = new CenterFormation();
               $centre->setCreatedBy($this->user);
               $centre->setCreatedAt(new \DateTime()); 
               $entity = $this->getDoctrine()->getManager();           
               $entity->persist($centre);
               $entity->flush();
               return View::create($this->user, Response::HTTP_CREATED);
            }
      } catch (\Exception $ex) {
       
         return View::create("cannot create this account", JsonResponse::HTTP_BAD_REQUEST);
      }
   }

   /**
    * @Route("/api/user/{id}", name ="api_delete", methods={"DELETE"})
    */
   public function delete(UserRepository $user, EntityManagerInterface $entity, $id)
   {
      $existingUser = $user->find($id);
      if (empty($existingUser)) {
         $response = array(
            "code" => 1,
            "message" => "user Not found !",
            "errors" => null,
            "result" => null,
         );
         return new JsonResponse($response, Response::HTTP_NOT_FOUND);
      }
      $entity->remove($existingUser);
      $entity->flush();
      $response = array(
         "code" => 0,
         "message" => "account deleted successfuly!",
         "errors" => null,
         "result" => null,
      );
      return new JsonResponse($response, 200);
   }

   /**
    * @Route("/api/userNumber", name="number_user", methods={"GET"})
    */
   public function userNumber(UserRepository $userRepository)
   {
      $userRepository = $this->getDoctrine()->getRepository(User::class);
      $num = $userRepository->findAll();
      $number = count($num);
      $response = array(
         "user_number" => $number
      );
      return View::create($response, JsonResponse::HTTP_CREATED, []);
   }

   /**
    * @Route("/api/patientNumber", name="number_patient", methods={"GET"})
    */
   public function PatientNumber()
   {
      $userRepository = $this->getDoctrine()->getRepository(Patient::class);
      $num = $userRepository->findAll();
      $number = count($num);
      $response = array(
         "patient_number" => $number
      );
      return View::create($response, JsonResponse::HTTP_CREATED, []);
   }
  
}
