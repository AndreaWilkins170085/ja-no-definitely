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

class ProfileController extends AbstractController
{
    
    /**
    * @Route("/profile/{id}", name="profile_view")
    */
    public function viewProfilepage(Request $request, $id="1", SessionInterface $session)
    {

        
        $userPro = new UserAccount();

             $profileForm = $this->createForm(ProfileType::class, $userPro );
            $profileForm->handleRequest($request);


            if ($profileForm->isSubmitted()) {

                $entityManager = $this->getDoctrine()->getManager();
                $userPro = $entityManager->getRepository(UserAccount::class)->find($id);

                // $session->start();
                // $session->get('loggedInUser', $loggedInUser);

                $data = $profileForm->getData();
                $name = $data->{'name'};
                $surname = $data->{'surname'};
                $username = $data->{'username'};
                $email = $data->{'email'};
                $password = $data->{'password'};

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



                $entityManager->flush();

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
        $model = array('categories' => $categories, 'useraccount' => $useraccount, 'questions' => $questions, 'answers' => $answers, 'profileForm' => $profileForm->createView());
        return $this->render($view, $model);
    }

}

?>