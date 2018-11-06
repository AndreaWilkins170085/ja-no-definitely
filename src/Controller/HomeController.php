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
use App\Form\DeleteType;
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

        $questionDropdownOptions = [];

        foreach ($questions as $question) {
            $questionDropdownOptions[$question->question_text] = $question;
        }
        
        $answers = $this->getDoctrine()
        ->getRepository(Answer::class)
        ->findAll(); 
        
        // FORMS

        $currentUsername = $session->get('loggedInUser')->username;
        $currentUserId = $session->get('loggedInUser')->id;

        $useraccount = $this->getDoctrine()
        ->getRepository(UserAccount::class)
        ->find($currentUserId);

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
        $answerForm = $this->createForm(AnswerType::class, $answer, ['questions' => $questionDropdownOptions]);
        $answerForm->get("answer_author")->setData($currentUsername);
        $answerForm->get("authorId")->setData($currentUserId);

        $answerForm->handleRequest($request);

        if ($answerForm->isSubmitted() && $answerForm->isValid()) {

            $authorId = intval($answerForm->get("authorId")->getData());
            // $questionId = intval($answerForm->get("questionId")->getData());

            $author = $this->getDoctrine()
            ->getRepository(UserAccount::class)
            ->find($authorId);

            // $thisQuestion = $this->getDoctrine()
            // ->getRepository(Question::class)
            // ->find($questionId);

            $answer = $answerForm->getData();
            $answer->setAuthor($author);
            // $answer->setQuestion($thisQuestion);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($answer);
            $entityManager->flush();

        }



        $view = 'home.html.twig';
        $model = array('questionForm' => $questionForm->createView(), 'answerForm' => $answerForm->createView(), 'questions' => $questions, 
        'answers' => $answers, 'categories' => $categories, 'useraccount' => $useraccount);
        return $this->render($view, $model);

    }
            

        /**
         * @Route("/ajax/vote", name="ajax")
        */

        
        public function Vote(Request $request, SessionInterface $session) {

            

            if($request->request->get('deleteQ')){


                $id = $request->request->get('deleteQ');

                $entityManager = $this->getDoctrine()->getManager();
                $repository = $this->getDoctrine()->getRepository(Answer::class);
                $data = $repository->findBy(['questionId' => $id]);
                
                foreach ($data as $set) {
                $entityManager->remove($set);
                 $entityManager->flush();
                }

                $repository = $this->getDoctrine()->getRepository(Question::class);
                $data = $repository->findOneBy(['id' => $id]);

                $entityManager->remove($data);
                $entityManager->flush();

                return new JsonResponse("done");
            }

            if($request->request->get('deleteA')){

                $id = $request->request->get('deleteA');

                $entityManager = $this->getDoctrine()->getManager();
                $repository = $this->getDoctrine()->getRepository(Answer::class);
                $data = $repository->findOneBy(['id' => $id]);
                
                $entityManager->remove($data);
                $entityManager->flush();


                return new JsonResponse("done");
            }

            if($request->request->get('voteupQ')){

                $entityManager = $this->getDoctrine()->getManager();
                $repository = $this->getDoctrine()->getRepository(Question::class);
                $id=$request->request->get('voteupQ');
                $data = $repository->findOneBy(['id' => $id]);
                
                $vote = $request->request->get('voteupQ');
                $value = $data->{'question_upvotes'};
                $valueE = $data->{'question_downvotes'};
                $value++;
                $data->setQuestionUpvotes($value);

                $entityManager->flush();
                return new JsonResponse($value-$valueE);
            }

            if($request->request->get('votedoQ')){

                $entityManager = $this->getDoctrine()->getManager();
                $repository = $this->getDoctrine()->getRepository(Question::class);
                $id=$request->request->get('votedoQ');
                $data = $repository->findOneBy(['id' => $id]);
                
                $vote = $request->request->get('votedoQ');
                $value = $data->{'question_upvotes'};
                $valueE = $data->{'question_downvotes'};
                $valueE++;
                $data->setQuestionDownvotes($valueE);

                $entityManager->flush();
                return new JsonResponse($value-$valueE);
            }

            if($request->request->get('voteupA')){

                $entityManager = $this->getDoctrine()->getManager();
                $repository = $this->getDoctrine()->getRepository(Answer::class);
                $id=$request->request->get('voteupA');
                $data = $repository->findOneBy(['id' => $id]);
                
                $vote = $request->request->get('voteupA');
                $value = $data->{'answer_upvotes'};
                $valueE = $data->{'answer_downvotes'};
                $value++;
                $data->setAnswerUpvotes($value);

                $entityManager->flush();
                return new JsonResponse($value-$valueE);
            }

            if($request->request->get('votedoA')){

                $entityManager = $this->getDoctrine()->getManager();
                $repository = $this->getDoctrine()->getRepository(Answer::class);
                $id=$request->request->get('votedoA');
                $data = $repository->findOneBy(['id' => $id]);
                
                $vote = $request->request->get('votedoA');
                $value = $data->{'answer_upvotes'};
                $valueE = $data->{'answer_downvotes'};
                $valueE++;
                $data->setAnswerDownvotes($valueE);

                $entityManager->flush();
                return new JsonResponse($value-$valueE);
            }
        
    }

}

?>