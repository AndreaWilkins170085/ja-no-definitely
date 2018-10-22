<?php
// src/Controller/LoginController.php
namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\Login;
use App\Form\Register;

class LoginController extends AbstractController
{
    /**
    * @Route("/", name="login_view")
    */

    public function viewLogin(Request $request)
    {
    $user = new User();
    $loginForm = $this->createForm(Login::class, $user);
    $loginForm->handleRequest($request);
    $registerForm = $this->createForm(Register::class, $user);
    $registerForm->handleRequest($request);
    $view = 'login.html.twig';
    $model = array('loginForm' => $loginForm->createView(), 'registerForm' => $registerForm->createView());
    return $this->render($view, $model);
    }

}
?>