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

class HomeController extends AbstractController
{
    /**
    * @Route("/home", name="home_view")
    */

    public function viewHomepage(Request $request, $id = "1")
    { 

    $question = new Question();
    $questionForm = $this->createForm(QuestionType::class, $question);
    $questionForm->handleRequest($request);

    $answer = new Answer();
    $answerForm = $this->createForm(AnswerType::class, $answer);
    $answerForm->handleRequest($request);

    $questionId = (int) $id;
    $questionAsked = $this->getDoctrine()
    ->getRepository(Question::class)
    ->find($questionId);  

    $view = 'home.html.twig';
    $model = array('questionForm' => $questionForm->createView(), 'answerForm' => $answerForm->createView(), 'question' => $question);
    return $this->render($view, $model);
    }

}

?>