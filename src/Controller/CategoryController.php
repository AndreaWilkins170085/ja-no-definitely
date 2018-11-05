<?php
// src/Controller/HomeController.php
namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Question;
use App\Form\QuestionType;
use App\Entity\Answer;
use App\Form\AnswerType;
use App\Entity\Category;

class CategoryController extends AbstractController
{
    /**
    * @Route("/category/{id}", name="category_view")
    */

    public function viewCategorypage(Request $request, $id = "1", SessionInterface $session)
    { 

    $categoryId = (int) $id;
    $thisCategory = $this->getDoctrine()
    ->getRepository(Category::class)
    ->find($categoryId);

    $questions = $this->getDoctrine()
    ->getRepository(Question::class)
    ->findAll(); 
    
    $answers = $this->getDoctrine()
    ->getRepository(Answer::class)
    ->findAll(); 

    $categories = $this->getDoctrine()
    ->getRepository(Category::class)
    ->findAll();


    $categoryDropdownOptions = [];

    foreach ($categories as $category) {
        $categoryDropdownOptions[$category->category_name] = $category;
    }


    $currentUsername = $session->get('loggedInUser')->username;
    $currentUserId = $session->get('loggedInUser')->id;

    $question = new Question();
    $questionForm = $this->createForm(QuestionType::class, $question, ['categories' => $categoryDropdownOptions]);
    $questionForm->get("question_author")->setData($currentUsername);
    $questionForm->get("authorId")->setData($currentUserId);
        
    $questionForm->handleRequest($request);

    if ($questionForm->isSubmitted() && $questionForm->isValid()) {

        $question = $questionForm->getData();
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($question);
        $entityManager->flush();

        return $this->redirectToRoute('category_view');
    }

    $answer = new Answer();
    $answerForm = $this->createForm(AnswerType::class, $answer);
    $answerForm->get("answer_author")->setData($currentUsername);
    // $answerForm->get("question")->setData();
    $answerForm->handleRequest($request);

    if ($answerForm->isSubmitted() && $answerForm->isValid()) {

        $answer = $answerForm->getData();
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($answer);
        $entityManager->flush();

        return $this->redirectToRoute('category_view');
    }



    $view = 'category.html.twig';
    $model = array('questionForm' => $questionForm->createView(), 'answerForm' => $answerForm->createView(), 'questions' => $questions, 
    'answers' => $answers, 'categories' => $categories, 'thisCategory' => $thisCategory);
    return $this->render($view, $model);
    }

}

?>