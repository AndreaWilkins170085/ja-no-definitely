<?php
// src/Controller/HomepageController.php
namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\UserProfile;

class HomepageController extends AbstractController
{
    /**
    * @Route("/home", name="home_view")
    */

    public function viewHomepage()
    {
    $view = 'home.html.twig';
    return $this->render($view);
    }
}

?>