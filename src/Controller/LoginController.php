<?php
// src/Controller/LoginController.php
namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\UserProfile;

class LoginController extends AbstractController
{
    /**
    * @Route("/", name="login_view")
    */

    public function viewLogin()
    {
    $view = 'login.html.twig';
    return $this->render($view);
    }
}

?>