<?php
// src/Controller/DeleteController.php
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
use App\Entity\UserAccount;

class DeleteController extends AbstractController
{
    /**
    * @Route("/delete", name="delete_view")
    */

    public function adminDeletePost($id)
    {
        
        $database = $this->getDoctrine()->getEntityManager();
        $toBeDeleted = $database->getRepository(Question::class)->find($id);
        $database->remove($qToBeDeleted);
        $database->flush();   

    }

}

?>