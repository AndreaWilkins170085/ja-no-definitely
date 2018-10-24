<?php
// src/Controller/HomeController.php
namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Question;
use App\Form\QuestionType;
use App\Entity\Answer;
use App\Form\AnswerType;
use App\Entity\Category;

class HomeController extends AbstractController
{
    /**
    * @Route("/home", name="home_view")
    */

    public function viewHomepage(Request $request)
    { 

    $question = new Question();
    $questionForm = $this->createForm(QuestionType::class, $question);
    $questionForm->handleRequest($request);

    $answer = new Answer();
    $answerForm = $this->createForm(AnswerType::class, $answer);
    $answerForm->handleRequest($request);

    $questions = $this->getDoctrine()
    ->getRepository(Question::class)
    ->findAll(); 
    
    $answers = $this->getDoctrine()
    ->getRepository(Answer::class)
    ->findAll(); 

    $categorys = $this->getDoctrine()
    ->getRepository(Category::class)
    ->findAll();

    $view = 'home.html.twig';
    $model = array('questionForm' => $questionForm->createView(), 'answerForm' => $answerForm->createView(), 'questions' => $questions, 'answers' => $answers, 'categorys' => $categorys);
    return $this->render($view, $model);
    }

}

?>