<?php
// src/Controller/ProfileController.php
namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\UserAccount;
use App\Entity\Category;
use App\Entity\Question;
use App\Entity\Answer;

class ProfileController extends AbstractController
{
    
    /**
    * @Route("/profile/{id}", name="profile_view")
    */
    public function viewProfilepage(Request $request, $id="1")
    {

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

        $categorys = $this->getDoctrine()
        ->getRepository(Category::class)
        ->findAll();

        $view = 'profile.html.twig';
        $model = array('categorys' => $categorys, 'useraccount' => $useraccount, 'questions' => $questions, 'answers' => $answers);
        return $this->render($view, $model);
    }

}

?>