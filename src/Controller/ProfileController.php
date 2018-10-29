<?php
// src/Controller/ProfileController.php
namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\UserAccount;
use App\Entity\Category;

class ProfileController extends AbstractController
{
    
    /**
    * @Route("/profile/{id}", name="profile_view")
    */
    public function viewProfilepage(Request $request, $id="1")
    {

        $userId = (int) $id;
        $useraccount = $this->getDoctrine()
        ->getRepository(UserAccount::class)
        ->find($userId);

        $categorys = $this->getDoctrine()
        ->getRepository(Category::class)
        ->findAll();

        $view = 'profile.html.twig';
        $model = array('categorys' => $categorys, 'useraccount' => $useraccount);
        return $this->render($view, $model);
    }

}

?>