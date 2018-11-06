<?php
// src/Controller/CommentController.php
namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Entity\Category;
use App\Entity\UserAccount;

class CommentController extends AbstractController
{
    /**
    * @Route("/comment", name="comment_view")
    */

    public function viewCommentPage(Request $request, SessionInterface $session)
    {

        $categories = $this->getDoctrine()
        ->getRepository(Category::class)
        ->findAll();

        $comments = $this->getDoctrine()
        ->getRepository(Comment::class)
        ->findAll();

        $currentUserId = $session->get('loggedInUser')->id;

        $useraccount = $this->getDoctrine()
        ->getRepository(UserAccount::class)
        ->find($currentUserId);

        $currentUsername = $session->get('loggedInUser')->username;

        $comment = new Comment();
        $commentForm = $this->createForm(CommentType::class, $comment);
        $commentForm->get("comment_author")->setData($currentUsername);
            
        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {

            $comment = $commentForm->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();
        }
        
        $view = 'comment.html.twig';
        $model = array('commentForm' => $commentForm->createView(),'categories' => $categories, 'comments' => $comments,
    'useraccount' => $useraccount);
        return $this->render($view, $model);
    }

}

?>