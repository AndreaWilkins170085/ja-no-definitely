<?php
// src/Controller/NavController.php
namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;

class NavController extends AbstractController
{

    public function viewSidebar(Request $request, $id="1")
    { 
    
    $userId = (int) $id;
    $useraccount = $this->getDoctrine()
    ->getRepository(UserAccount::class)
    ->find($userId);

    $categories = $this->getDoctrine()
    ->getRepository(Category::class)
    ->findAll(); 

    $view = 'base.html.twig';
    $model = array('categorys' => $categories, 'useraccount' => $useraccount);
    return $this->render($view, $model);
    }

}

?>