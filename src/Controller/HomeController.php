<?php
// src/Controller/HomeController.php
namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Question;
use App\Form\QuestionType;
use App\Entity\Answer;
use App\Form\AnswerType;
use App\Entity\Category;
use App\Entity\UserAccount;

class HomeController extends AbstractController
{
    /**
    * @Route("/home", name="home_view")
    */

    public function viewHomepage(Request $request, SessionInterface $session)
    {
        $categories = $this->getDoctrine()
        ->getRepository(Category::class)
        ->findAll();

        $categoryDropdownOptions = [];

        foreach ($categories as $category) {
            $categoryDropdownOptions[$category->category_name] = $category;
        }

        //DATA
        $questions = $this->getDoctrine()
        ->getRepository(Question::class)
        ->findAll(); 
        
        $answers = $this->getDoctrine()
        ->getRepository(Answer::class)
        ->findAll(); 

    $userId = (int) $id;
    $useraccount = $this->getDoctrine()
    ->getRepository(UserAccount::class)
    ->find($userId);

    // FORMS
        // FORMS


        $currentUsername = $session->get('loggedInUser')->username;
        $currentUserId = $session->get('loggedInUser')->id;

        $question = new Question();
        $questionForm = $this->createForm(QuestionType::class, $question, ['categories' => $categoryDropdownOptions]);
        $questionForm->get("question_author")->setData($currentUsername);
        $questionForm->get("authorId")->setData($currentUserId);
            
        $questionForm->handleRequest($request);

        if ($questionForm->isSubmitted() && $questionForm->isValid()) {

            $authorId = intval($questionForm->get("authorId")->getData());

            $author = $this->getDoctrine()
            ->getRepository(UserAccount::class)
            ->find($authorId);

            $question = $questionForm->getData();
            $question->setAuthor($author);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($question);
            $entityManager->flush();
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

            return $this->redirectToRoute('home_view');
        }



        $view = 'home.html.twig';
        $model = array('questionForm' => $questionForm->createView(), 'answerForm' => $answerForm->createView(), 'questions' => $questions, 
        'answers' => $answers, 'categories' => $categories);
        return $this->render($view, $model);

    }

    
    //DELETE 
    // $database = $this->getDoctrine()->getEntityManager();
    // $qToBeDeleted = $database->getRepository(Question::class)->find($deleteId);
    // $database->remove($qToBeDeleted);
    // $database->flush();   


    // /**
    // * @Route("/answer", name="answer_view")
    // */
    // public function viewAnswerForm(Request $request, SessionInterface $session)
    // {
    //     $categories = $this->getDoctrine()
    //     ->getRepository(Category::class)
    //     ->findAll();

    //     $questions = $this->getDoctrine()
    //     ->getRepository(Question::class)
    //     ->findAll(); 
        
    //     $answers = $this->getDoctrine()
    //     ->getRepository(Answer::class)
    //     ->findAll(); 


    //     $currentUsername = $session->get('loggedInUser')->username;
    //     $currentUserId = $session->get('loggedInUser')->id;

    //     $question = new Question();
    //     $questionForm = $this->createForm(QuestionType::class, $question);
    //     $questionForm->get("question_author")->setData($currentUsername);
    //     $questionForm->get("author")->setData($currentUserId);
            
    //     $questionForm->handleRequest($request);

    //     if ($questionForm->isSubmitted() && $questionForm->isValid()) {

    //         $question = $questionForm->getData();
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->persist($question);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('home_view');
    //     }

    //     $answer = new Answer();
    //     $answerForm = $this->createForm(AnswerType::class, $answer);
    //     $answerForm->get("answer_author")->setData($currentUsername);
    //     // $answerForm->get("question")->setData();
    //     $answerForm->handleRequest($request);

    //     if ($answerForm->isSubmitted() && $answerForm->isValid()) {

    
        /** 
         * @Route("/ajax/voteup", name="ajax") 
        */ 
        public function upVote(Request $request) {  

            if($request->request->get('some_var_name')){
                $entityManager = $this->getDoctrine()->getManager();
                $repository = $this->getDoctrine()->getRepository(Question::class);
                $id=1;
                $data = $repository->findOneBy(['id' => $id]);
                $userPro = $entityManager->getRepository(Question::class)->find($id);

               
                
                $vote = $request->request->get('voteup');
                $test = $data->{'question_upvotes'};
                $test++;
                $data->setQuestionUpvotes($test);

                $entityManager->flush();
            }
        
            return $this->render('app/main/index.html.twig');
        
        } 

}

?>