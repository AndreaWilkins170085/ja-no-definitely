<?php
// src/Controller/HomeController.php
namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Questions;
use App\Form\Question;
use App\Entity\Answers;
use App\Form\Answer;

class HomeController extends AbstractController
{
    /**
    * @Route("/home", name="home_view")
    */

    public function viewHomepage(Request $request)
    {
    $question = new Questions();
    $questionForm = $this->createForm(Question::class, $question);
    $questionForm->handleRequest($request);

    $answer = new Answers();
    $answerForm = $this->createForm(Answer::class, $answer);
    $answerForm->handleRequest($request);

    $view = 'home.html.twig';
    $model = array('questionForm' => $questionForm->createView(), 'answerForm' => $answerForm->createView());
    return $this->render($view, $model);
    }
}

?>