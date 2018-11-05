<?php
// src/Controller/ProfileController.php
namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\UserAccount;
use App\Entity\Category;
use App\Entity\Question;
use App\Entity\Answer;
use App\Form\ProfileType;
use App\Form\BanType;
use App\Form\ImageType;

class ProfileController extends AbstractController
{
    
    /**
    * @Route("/profile/{id}", name="profile_view")
    */
    public function viewProfilepage(Request $request, $id="1", SessionInterface $session)
    {

        $name = '';
        $surname='';
        $usernameT='';
        $emailT='';
        $errors='';
        $valid= true;
        $usernameCheck = '';
        
        $userPro = new UserAccount();

            $profileForm = $this->createForm(ProfileType::class, $userPro);
            $profileForm->handleRequest($request);

            $banForm = $this->createForm(BanType::class);
            $banForm->handleRequest($request);

            $imageForm = $this->createForm(ImageType::class);
            $imageForm->handleRequest($request);

            if ($banForm->get('submitBan')->isClicked()) {

                $entityManager = $this->getDoctrine()->getManager();
                $banned = $entityManager->getRepository(UserAccount::class)->find($id);

                $user_type = "banned";

                $banned->setType($user_type);

                $entityManager->flush();

            }

            if ($banForm->get('submitUnban')->isClicked()) {

                $entityManager = $this->getDoctrine()->getManager();
                $unbanned = $entityManager->getRepository(UserAccount::class)->find($id);

                $user_type = "user";

                $unbanned->setType($user_type);

                $entityManager->flush();

            }

            if ($profileForm->isSubmitted()) {

                $entityManager = $this->getDoctrine()->getManager();
                $userPro = $entityManager->getRepository(UserAccount::class)->find($id);

                // $session->start();
                // $session->get('loggedInUser', $loggedInUser);

                $data = $profileForm->getData();
                $username = $data->{'username'};
                $email = $data->{'email'};
                $password = $data->{'password'};

                $repository = $this->getDoctrine()->getRepository(UserAccount::class);

                $emailCheck = $repository->findOneBy(['email' => $email]);
                $usernameCheck = $repository->findOneBy(['username' => $username]);


                //validation
                if (!$emailCheck == null){
                    $emailT='This email has been already registered';
                    $valid = false;
                }
                if (!$usernameCheck == null){
                    $usernameT='This username has been already registered';
                    $valid = false;
                }
                
                if (!$password==''){
                if (strlen($password) < 8) {
                    $errors = "The password should be at least 8 characters";
                    $valid = false;
                }
            }
                if ($name){
                    $userPro->setName($name);
                }
                if ($surname){
                    $userPro->setSurname($surname);
                }
                if ($username){
                    $userPro->setUsername($username);
                }
                if ($email){
                    $userPro->setEmail($email);
                }
                if ($password){
                    $userPro->setEncodedPassword($password);
                }

                if ($valid){

                $entityManager->flush();
                }
            }



        $userId = (int) $id;
        $useraccount = $this->getDoctrine()
        ->getRepository(UserAccount::class)
        ->find($userId);

        $questions = $this->getDoctrine()
        ->getRepository(Question::class)
        ->findAll(); 
        
        $answers = $this->getDoctrine()
        ->getRepository(Answer::class)
        ->findAll(); 

        $categories = $this->getDoctrine()
        ->getRepository(Category::class)
        ->findAll();

        $view = 'profile.html.twig';
        $model = array('categories' => $categories, 'useraccount' => $useraccount, 'questions' => $questions, 
        'answers' => $answers, 'profileForm' => $profileForm->createView(), 'imageForm' => $imageForm->createView(), 
        'name'=>$name, 'surname'=>$surname, 'usernameT'=>$usernameT, 'emailT'=>$emailT, 'errors'=>$errors);
        return $this->render($view, $model);
    }


}

?>