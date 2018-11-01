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
        $categories = $this->getDoctrine()
        ->getRepository(Category::class)
        ->findAll();

        $categoryDropdownOptions = [];

        foreach ($categories as $category) {
            $categoryDropdownOptions[$category->category_name] = $category->id;
        }

    // FORMS
    $question = new Question();
    $questionForm = $this->createForm(QuestionType::class, $question, ['categories' => $categoryDropdownOptions]);
    $questionForm->handleRequest($request);

    $answer = new Answer();
    $answerForm = $this->createForm(AnswerType::class, $answer);
    $answerForm->handleRequest($request);

    //DATA
    $questions = $this->getDoctrine()
    ->getRepository(Question::class)
    ->findAll(); 
    
    $answers = $this->getDoctrine()
    ->getRepository(Answer::class)
    ->findAll(); 

    // $category = $questions -> getCategory() -> getCategoryName();

    $view = 'home.html.twig';
    $model = array('questionForm' => $questionForm->createView(), 'answerForm' => $answerForm->createView(), 'questions' => $questions, 'answers' => $answers, 
    'categories' => $categories);
    return $this->render($view, $model);
    }

}

?>