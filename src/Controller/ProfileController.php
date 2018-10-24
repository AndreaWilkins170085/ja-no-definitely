<?php
// src/Controller/ProfileController.php
namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Category;

class ProfileController extends AbstractController
{
    
    /**
    * @Route("/profile/{id}", name="profile_view")
    */
    public function viewProfilepage($id = "1")
    {
        $userId = (int) $id;
        $user = $this->getDoctrine()
        ->getRepository(User::class)
        ->find($userId);

        $categorys = $this->getDoctrine()
        ->getRepository(Category::class)
        ->findAll();

        $view = 'profile.html.twig';
        $model = array('user' => $user, 'categorys' => $categorys);
        return $this->render($view, $model);
    }

}

?>